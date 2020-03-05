<?php
require_once("view/template/recipeTile.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style/recipe.css">
  <link rel="stylesheet" href="assets/style/navbar.css">
  <link rel="stylesheet" href="assets/style/container.css">
  <link rel="stylesheet" href="assets/style/search.css">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/recipe.js"></script>
  <script src="assets/js/search.js"></script>
  <script src="https://kit.fontawesome.com/e69be3e43c.js" crossorigin="anonymous"></script>
  <title>Des recettes à foison</title>
</head>

<body>
  <?php require_once("view/template/navbar.php"); ?>
  <div class="page-content">
    <h1>Recherche de recettes</h1>
    <hr>
    <input type="text" name="recipe" placeholder="Nom de la recette" id="input-recipe-name">
    <div class="row">
      <div class="alim-select">
        <div class="row">
          <input placeholder="Aliment désiré" type="text" name="avec-aliment" id="" list="alims-autocomplete1">
          <datalist id="alims-autocomplete1">
          </datalist>
          <button>+</button>
        </div>
        Aliments désirés:
        <ul>
        </ul>
      </div>
      <div class="alim-select">
        <div class="row">
          <input placeholder="Aliment non désiré" type="text" name="sans-aliment" id="" list="alims-autocomplete2">
          <datalist id="alims-autocomplete2">
          </datalist>
          <button>+</button>
        </div>
        Aliments non désirés:
        <ul></ul>
      </div>
    </div>
    <button id="search-btn">Rechercher</button>
    <ul id="recipe-list">
    </ul>
  </div>
</body>

</html>