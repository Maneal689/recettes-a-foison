<?php
session_start();
require_once("model/alimFunctions.php");
require_once("model/App.php");

use App\App;

$auth = App::getAuth();
$user = $auth->user();

$recipeList = [];

if ($user) {
  $tmp = $user->get_favorites();
  foreach ($tmp as $recipeName) {
    $recipes = getRecipesByName($recipeName);
    if (sizeof($recipes) > 0)
      $recipeList[] = $recipes[0];
  }
} else {
  if (array_key_exists("recipe_list", $_SESSION)) {
    /* On récupère les informations sur chacune des recettes en favories */
    foreach ($_SESSION["recipe_list"] as $recipeName) {
      $recipes = getRecipesByName($recipeName);
      if (sizeof($recipes) > 0)
        $recipeList[] = $recipes[0];
    }
  }
}

require_once("view/favorites.php");
