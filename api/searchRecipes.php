<?php

header('content-type:application/json');

require_once("model/alimFunctions.php");
require_once("view/template/recipeTile.php");
require_once("model/App.php");

use App\App;
$auth = App::getAuth();
$user = $auth->user();

function recipeInfoSort($a, $b)
{
  return $a["score"] - $b["score"];
}

$recipes = [];
$title = isset($_POST["title"]) ? $_POST["title"] : "";
$withAlims = isset($_POST["with_alims"]) ? $_POST["with_alims"] : [];
$withAlims = alimsToLeafs($withAlims);

$withoutAlims = isset($_POST["without_alims"]) ? $_POST["without_alims"] : [];
$withoutAlims = alimsToLeafs($withoutAlims);

$recipes = getRecipesByName($title, true); // Récupérer les recettes dont le nom contient $_POST["title"]
$recipes = getRecipesWith($withAlims, $withoutAlims, $recipes, 0); // Filtrer par rapport aux aliments demandés/refusés
$success = usort($recipes, "recipeInfoSort"); // On tri les recettes en fonction de leur score
if ($success) {
  $recipes = array_reverse($recipes); // On ordonne par ordre décroissant pour avoir les meilleurs résultats en premier
} else $recipes = [];

if ($user) $favList = $user->get_favorites();
else $favList = $_SESSION["recipe_list"] ?? [];
foreach ($recipes as $recipeInfos) {
  recipeTileTemplate($recipeInfos["recipe"], $recipeInfos["with"], $recipeInfos["without"], $favList);
}
