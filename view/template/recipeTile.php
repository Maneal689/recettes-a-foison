<?php
function recipeTileTemplate($recipe, $with = null, $without = null, $favList = null)
{
  $is_star = false;
  if (!isset($favList)) {
    if (isset($_SESSION) && array_key_exists("recipe_list", $_SESSION)) {
      if (in_array($recipe["titre"], $_SESSION["recipe_list"])) $is_star = true;
    }
  } else {
      if (in_array($recipe["titre"], $favList)) $is_star = true;
  }
  $ingredientList = explode("|", $recipe["ingredients"]);
  ?>
  <li class="recipe content-hidden">
    <div class="row">
      <i class=<?= $is_star ? '"fas fa-star fav-add"' : '"far fa-star fav-add"' ?>></i>
      <div class="recipe-title">
        <b><?= $recipe["titre"] ?></b>
        <div class="toggle-recipe-infos"></div>
      </div>
      <div class="column count-nb">
        <span class="success-text">
          <?= isset($with) ? ($with . " aliments désirés") : "" ?>
        </span>
        <span class="error-text">
          <?= isset($without) ? ($without . " aliments non désirés") : "" ?>
        </span>
      </div>
    </div>
    <div class="recipe-infos">
      <div class="row">
        <div class="ingredients">
          <b>Vous aurez besoin de :</b>
          <ul class="ingredient-list">
            <?php
              foreach ($ingredientList as $ingredient) {
                ?>
              <li><?= $ingredient ?></li>
            <?php
              }
              ?>
          </ul>
        </div>
        <?php
          $imgUrl = ucwords(strtolower(str_replace(" ", "_", trim($recipe["titre"]))));
          $imgUrl = "assets/Photos/" . $imgUrl . ".jpg";
          if (file_exists($imgUrl)) {
            ?>
          <img src=<?= $imgUrl ?> alt=<?= "Photo de " . $recipe["titre"] ?>>
        <?php
          }
          ?>
      </div>
      <p class="preparation">
        <b>Préparation: </b><br>
        <em><?= $recipe["preparation"] ?></em>
      </p>
    </div>
  </li>
<?php
}
