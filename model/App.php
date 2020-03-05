<?php

namespace App;

require_once("model/Auth.php");
require_once("model/db/User.php");

use PDO;
use App\Auth;
use App\db\User;

/**
 * Classe 'statique' permettant d'accèdes aux principales fonctions relatives à l'application
 */
class App
{

  public static $pdo;
  public static $auth;

  /**
   * Renvoie une instance de PDO pour intéragir avec la BDD
   */
  public static function getPDO()
  {
    global $_CONFIG;
    if (!self::$pdo) {
      // Informations à remplir pour l'accès à la base de données
      $host = NULL;
      $db_name = NULL;
      $user = NULL;
      $pwd = NULL;
      $dsn = "mysql:host=$host;dbname=$db_name";
      self::$pdo = new PDO($dsn, $user, $pwd);
    }
    return self::$pdo;
  }

  /**
   * Recherche et renvoie une instance de User à partir de l'id
   */
  public static function get_user_by_id($id)
  {
    $pdo = self::getPDO();
    $query = $pdo->prepare("SELECT * FROM USERS WHERE id_user=:id");
    $query->execute(["id" => $id]);
    $user = $query->fetchObject(User::class);
    return $user ?? null;
  }

  /**
   * Recherche et renvoie une instance de User à partir du login
   */
  public static function get_user_by_username($username)
  {
    $pdo = self::getPDO();
    $query = $pdo->prepare("SELECT * FROM USERS WHERE username=:username");
    $query->execute(["username" => $username]);
    $user = $query->fetchObject(User::class);
    return $user ?? null;
  }

  /**
   * Renvoie une instance de Auth permettant de gérer l'authentification
   */
  public static function getAuth()
  {
    if (!self::$auth) {
      self::$auth = new Auth(self::getPDO(), "/connexion");
    }
    return self::$auth;
  }
}
