<?php

function alimExists($alimName)
{
  if (!isset($Hierarchie))
    require("model/Donnees.inc.php");

  if (!isset($alimName)) return false;
  return array_key_exists($alimName, $Hierarchie);
}

function strToRegWild($str, $sep = "/")
{
  return ($sep . implode(".*", str_split($str)) . $sep);
}

/**
 * Search for alim from name
 * 
 * @param $alimName (str) alim name
 * 
 * @return (array) of alims that names match with $alimName with fuzzy finding
 */
function findAlim($alimName)
{
  if (!isset($Hierarchie))
    require("model/Donnees.inc.php");

  $res = [];
  $toFindReg = strToRegWild($alimName);
  $toFindReg .= "i";
  foreach ($Hierarchie as $alim => $infos) {
    if (preg_match($toFindReg, $alim)) {
      $res[] = $alim;
    }
  }
  return ($res);
}

/**
 * Renvoie la liste des recettes dont le titre "match" avec $recipeName
 * 
 * @param $recipeName Le nom de la recette à rechercher ou le pattern
 * @param $wildSearch Bool qui indique si on recherche des "match" exacts ou non
 * 
 * @return liste des recettes qui matchent avec $recipeName
 */
function getRecipesByName($recipeName, $wildSearch = false)
{
  if (!isset($Hierarchie))
    require("model/Donnees.inc.php");
  if (!isset($recipeName)) return false;

  $recipeReg = strToRegWild($recipeName);
  $recipeReg .= "i";
  $res = [];
  foreach ($Recettes as $recipe) {
    if ($recipe["titre"] === $recipeName) // Si le titre correspond
      return [$recipe];
    elseif ($wildSearch && preg_match("$recipeReg", $recipe["titre"]))
      $res[] = $recipe;
  }
  return ($res);
}

// function getSuperCat($alimName)
// {
//   require("model/Donnees.inc.php");

//   $res = [$alimName => []];
//   if (!isset($alimName)) return res;
//   $tmp = $Hierarchie[$alimName];
//   if (!array_key_exists("super-categorie", $tmp)) return $res;
//   foreach ($tmp["super-categorie"] as $catName) {
//     $res[$alimName][] = getSuperCat($catName);
//   }
//   return $res;
// }

/**
 * Renvoie une liste de chemins (liste d'aliments/catégories) menants à l'aliment envoyé en argument
 * 
 * @param $alimName Nom de l'aliment
 * 
 * @return $[[str(nom d'aliments)], ...]
 */
function getSuperCat($alimName)
{
  if (!isset($Hierarchie))
    require("model/Donnees.inc.php");

  $res = [];
  if (!isset($alimName)) return $res;
  $tmp = $Hierarchie[$alimName]; // On récupère les données sur l'aliment
  if (array_key_exists("super-categorie", $tmp)) {
    /* L'aliment a une ou des super-categories */
    foreach ($tmp["super-categorie"] as $super) { // Pour chacune de ses super-categorie
      $supRes = getSuperCat($super); // On récupère les différents chemins pouvant y mener
      foreach ($supRes as $path) { // Pour chacun des chemins vers le parent
        $path[] = $alimName; // On s'ajoute à la fin
        $res[] = $path; // On met à jour le resultat
      }
    }
  } elseif (!array_key_exists("super-categorie", $tmp)) return [[$alimName]]; // Si on a pas de super-categorie, un seul chemin (soi-même)
  return $res;
}

/**
 * Renvoie la liste de tous les aliments feuilles de la hierarchie
 * 
 * @param str alimName nom de l'aliment
 * 
 * @return array(str) liste des aliments enfants de $alimName et feuilles de la hierarchie
 */
function alimToLeafs($alimName)
{
  if (!isset($Hierarchie)) require("model/Donnees.inc.php");

  $res = [];
  if (!alimExists($alimName))
    return $res;
  $alim = $Hierarchie[$alimName];
  if (array_key_exists("sous-categorie", $alim)) {
    foreach ($alim["sous-categorie"] as $childName) {
      $res = array_merge($res, alimToLeafs($childName));
    }
  }
  if (sizeof($res) <= 0) $res[] = $alimName;
  return $res;
}

function alimsToLeafs($alimNameList)
{
  $res = [];
  foreach ($alimNameList as $alimName) {
    $res = array_merge($res, alimToLeafs($alimName));
  }
  return ($res);
}

function getRecipesWith($withAlimList, $withoutAlimList, $recipes = null, $min_score)
{
  if (!isset($recipes)) {
    if (!isset($Recettes))
      require("model/Donnees.inc.php");
    $recipes = $Recettes;
  }

  $res = [];
  foreach ($recipes as $index => $recipe) {
    $with = 0;
    $without = 0;
    foreach ($withAlimList as $alim) {
      if (in_array($alim, $recipe["index"]))
        $with++;
    }
    foreach ($withoutAlimList as $alim) {
      if (in_array($alim, $recipe["index"]))
        $without++;
    }
    $score = $with - $without * 2;
    if ($score >= $min_score)
      $res[] = ["recipeIndex" => $index, "recipe" => $recipe, "score" => $score, "with" => $with, "without" => $without];
  }
  return $res;
}
