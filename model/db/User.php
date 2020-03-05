<?php

namespace App\db;

require_once("model/App.php");

use App\App;

class User
{
  // Initialisation via PDO
  public $id_user;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $sex;
  public $mail;
  public $address;
  public $postal_code;
  public $city;
  public $tel;
  public $birth;

  public function get_favorites()
  {
    require_once("model/alimFunctions.php");
    $pdo = App::getPDO();
    $list = [];

    $stmt = $pdo->prepare("SELECT recipe FROM FAVORITES WHERE id_user=:id");
    if ($stmt->execute(["id" => $this->id_user])) {
      $res = $stmt->fetchAll();
      foreach ($res as $row) {
        $list[] = $row["recipe"];
      }
      $stmt->closeCursor();
    }
    return $list;
  }

  public function add_fav($recipe_name)
  {
    $pdo = App::getPDO();
    $vars = ["id" => $this->id_user, "recipe_name" => $recipe_name];

    $select = $pdo->prepare("SELECT * FROM FAVORITES WHERE id_user=:id AND recipe=:recipe_name");

    if (!$select->execute($vars)) return false; // Erreur lors de la requête
    if ($select->rowCount() > 0) return false; // La recette est déjà en favori
    $select->closeCursor();

    $insert = $pdo->prepare("INSERT INTO FAVORITES (id_user, recipe) VALUES (:id, :recipe_name)");

    if (!$insert->execute($vars)) return false; // Erreur lors de la requête
    $insert->closeCursor();
    return true;
  }

  public function toggle_fav($recipe_name)
  {
    $pdo = App::getPDO();
    $vars = ["id" => $this->id_user, "recipe_name" => $recipe_name];

    $select = $pdo->prepare("SELECT * FROM FAVORITES WHERE id_user=:id AND recipe=:recipe_name");

    if (!$select->execute($vars)) return false; // Erreur lors de la requête
    if ($select->rowCount() > 0) { // La recette est déjà en favori => On la supprime
      $delete = $pdo->prepare("DELETE FROM FAVORITES WHERE id_user=:id AND recipe=:recipe_name");
      if (!$delete->execute($vars)) return false;
      $delete->closeCursor();
    } else { // Sinon on l'ajoute
      $insert = $pdo->prepare("INSERT INTO FAVORITES (id_user, recipe) VALUES (:id, :recipe_name)");
      if (!$insert->execute($vars)) return false; // Erreur lors de la requête
      $insert->closeCursor();
    }
    $select->closeCursor();

    return true;
  }
}
