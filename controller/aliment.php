<?php

session_start();
require_once("model/Donnees.inc.php");
require_once("model/alimFunctions.php");

$selectedAlimName = array_key_exists("alim", $_GET) && alimExists($_GET["alim"]) ? $_GET["alim"] : "Aliment";
$selectedAlim = $Hierarchie[$selectedAlimName];

$pathList = getSuperCat($selectedAlimName);
$recipeList = getRecipesWith(alimToLeafs($selectedAlimName), [], null, 1);
require_once("view/aliment.php");
