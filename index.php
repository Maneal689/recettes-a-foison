<?php

namespace App;

use App\Router\Router;

require_once("model/router/Router.php");

ini_set("display_errors", "On");
error_reporting(E_ALL);

$url = $_SERVER["REQUEST_URI"];

$router = new Router($url);
// Acceuil
$router->get("/aliment", function () {
  require_once("controller/aliment.php");
});
$router->get("/home", function () {
  require_once("controller/aliment.php");
});
$router->get("/", function () {
  require_once("controller/aliment.php");
});

// Autres
$router->get("/panier", function () {
  require_once("controller/favorites.php");
});
$router->get("/recherche", function () {
  require_once("controller/search.php");
});

// Compte utilisateur
$router->all("/profil", function () {
  require_once("controller/profile.php");
});
$router->all("/connexion", function () {
  require_once("controller/login.php");
});
$router->all("/inscription", function () {
  require_once("controller/subscribe.php");
});
$router->all("/logout", function () {
  require_once("controller/logout.php");
});

// API
$router->post("/api/toggleFav", function () {
  require_once("api/toggleFav.php");
});
$router->get("/api/searchAlim", function () {
  require_once("api/searchAlim.php");
});
$router->get("/api/alimExists", function () {
  require_once("api/alimExists.php");
});
$router->post("/api/searchRecipes", function () {
  require_once("api/searchRecipes.php");
});

$router->run();
