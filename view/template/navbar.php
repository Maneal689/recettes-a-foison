<?php
use App\App;
require_once("model/App.php");

$auth = App::getAuth();
?>

<nav class="navbar">
  <ul>
    <li><a href="/home">Aliments</a></li>
    <li><a href="/panier">Mes recettes préférées</a></li>
    <li><a href="/recherche">Rechercher</a></li>
    <?php
    if ($auth->user()) {
      ?>
      <li><a href="/profil">Mon profil</a></li>
      <li><a href="/logout">Se déconnecter</a></li>
    <?php
    } else {
      ?>
      <li><a href="/connexion">Connectez-vous</a></li>
      <?php
    }
    ?>
  </ul>
</nav>