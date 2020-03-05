<?php

namespace App;

use App\db\User;

/**
 * Gère l'aspect utilisateur du site
 */
class Auth
{
  private $pdo;
  private $login_path;
  private $user;

  public function __construct($pdo, $login_path)
  {
    $this->pdo = $pdo;
    $this->login_path = $login_path;
    $this->user = null;
  }

  /**
   * Renvoie l'objet User correspondant à l'utilisateur authentifié, s'il y en a un
   */
  public function user($force_update = false)
  {
    if (!$force_update) {
      if ($this->user) return $this->user;
    }
    if (session_status() === PHP_SESSION_NONE)
      session_start();
    $id = $_SESSION["auth"] ?? null;
    if (!$id) return null;
    $id = intval($id);
    $query = $this->pdo->prepare("SELECT * FROM USERS WHERE id_user=:id");
    $query->execute(["id" => $id]);
    $this->user = $query->fetchObject(User::class);

    if (!$this->user) return null;
    return $this->user;
  }

  /**
   * Vérifie que l'utilisateur est authentifié et renvoie à la page de connexion si non
   */
  public function require_auth()
  {
    $user = $this->user();
    if (!$user) {
      header("location: $this->login_path");
    }
    return $user;
  }

  /**
   * Authentifie un utilisateur via son login/mot de passe
   */
  public function login($username, $password)
  {
    if (session_status() === PHP_SESSION_NONE)
      session_start();
    $query = $this->pdo->prepare("SELECT * FROM USERS WHERE login=:username");
    $query->execute(["username" => $username]);
    $this->user = $query->fetchObject(User::class);
    if (!$this->user) return null;

    if (password_verify($password, $this->user->password)) {
      $_SESSION["auth"] = intval($this->user->id_user);
      return $this->user;
    }
    return null;
  }
}
