<?php

require_once("model/App.php");

use App\App;

$error = null;
session_start();
$auth = App::getAuth();
if ($auth->user()) header("location: /home");
if (isset($_POST) && isset($_POST["submit"])) { //On a reçu une demande de connexion
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);

  $user = $auth->login($username, $password);
  if (!$user) {
    $error = "Identifiants invalides";
  } else {
    // Ajout des favoris de la session au compte
    if (isset($_SESSION["recipe_list"])) {
      foreach ($_SESSION["recipe_list"] as $recipe) {
        $user->add_fav($recipe);
      }
    }
    header("location: /home"); // Connexion réussie, on redirige vers la page d'acceuil
  }
}
require_once("view/login.php");
