<?php

header('content-type:application/json');

session_start();
require_once("model/alimFunctions.php");
require_once("model/App.php");

use App\App;

$auth = App::getAuth();
$user = $auth->user();
$res = ["ok" => true, "err" => ""];

if (array_key_exists("recipe_name", $_POST)) {
  /* La recette à ajouter est envoyée via POST */
  if (sizeof(getRecipesByName($_POST["recipe_name"])) <= 0) {
    $res["ok"] = false;
    $res["err"] = "Recette inconnue";
  } else {
    if ($user) {
      $user->toggle_fav($_POST["recipe_name"]);
    } else {
      if (!array_key_exists("recipe_list", $_SESSION)) // Le "panier" n'est pas encore créé
        $_SESSION["recipe_list"] = [];
      if (!in_array($_POST["recipe_name"], $_SESSION["recipe_list"])) {
        /* La recette n'est pas déjà en favori */
        $_SESSION["recipe_list"][] = $_POST["recipe_name"]; // On ajoute la recette au "panier"
      } else {
        /* La recette est déjà en favoris, on veut la supprimer*/
        $i = array_search($_POST["recipe_name"], $_SESSION["recipe_list"]);
        array_splice($_SESSION["recipe_list"], $i, 1);
      }
    }
  }
}


echo json_encode($res);
