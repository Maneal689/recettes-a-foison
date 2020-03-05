<?php
require_once("view/template/recipeTile.php");
require_once("model/App.php");

use App\App;
$auth = App::getAuth();
$user = $auth->user();
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
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/recipe.js"></script>
  <script src="https://kit.fontawesome.com/e69be3e43c.js" crossorigin="anonymous"></script>
  <title>Recettes favories</title>
</head>

<body>
  <?php require_once("view/template/navbar.php"); ?>
  <div class="page-content">
    <h1>Liste de mes recettes préférées</h1>
    <hr>
    <ul>
      <?php
      if ($user) $favList = $user->get_favorites();
      else $favList = $_SESSION["recipe_list"] ?? [];
      foreach ($recipeList as $recipe) {
        recipeTileTemplate($recipe, null, null, $favList);
      } ?>
    </ul>
  </div>
</body>

</html>