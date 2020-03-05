<?php
require_once("view/template/recipeTile.php");
require_once("view/template/alimLink.php");
require_once("model/App.php");

use App\App;

$auth = App::getAuth();
$user = $auth->user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style/alimPage.css">
  <link rel="stylesheet" href="assets/style/toggleNav.css">
  <link rel="stylesheet" href="assets/style/recipe.css">
  <link rel="stylesheet" href="assets/style/navbar.css">
  <link rel="stylesheet" href="assets/style/container.css">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/recipe.js"></script>
  <script src="assets/js/sidebar.js"></script>
  <script src="https://kit.fontawesome.com/e69be3e43c.js" crossorigin="anonymous"></script>
  <title>Des recettes à foisons</title>
</head>

<body>
  <div class="page-content">
    <?php require_once("view/template/navbar.php") ?>
    <div id="toggle-nav">
      <div></div>
    </div>
    <nav id="home-nav">
      <h1 class="alim-title"><?= $selectedAlimName ?></h1>
      <ul>
        <?php
        if (isset($selectedAlim["sous-categorie"])) {
          foreach ($selectedAlim["sous-categorie"] as $alim) {
            ?>
            <li><?= alimLinkTemplate($alim) ?></li>
        <?php
          }
        }
        ?>
      </ul>
    </nav>
    <h2 class="alim-title"><?= $selectedAlimName ?></h2>
    <ul class="secondary-list">
      <?php
      foreach ($pathList as $path) {
        echo "<li>";
        foreach ($path as $alimName) {
          echo "&gt";
          if ($alimName !== $selectedAlimName)
            alimLinkTemplate($alimName);
          else echo " $alimName";
        }
        echo "</li>";
      }
      ?>
    </ul>
    <hr>
    <ul class="recipe-list">
      <?php
      if ($user) $favList = $user->get_favorites();
      else $favList = $_SESSION["recipe_list"] ?? [];
      foreach ($recipeList as $recipeInfos) {
        $recipe = $recipeInfos["recipe"];
        recipeTileTemplate($recipe, null, null, $favList);
        ?>
      <?php
      }
      ?>
    </ul>
  </div>
</body>

</html>