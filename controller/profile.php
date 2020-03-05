<?php
require_once("model/App.php");

use App\App;

$auth = App::getAuth();
$user = $auth->require_auth();
$ok = false;

if (isset($_POST["submit"])) { // On cherche à modifier les données
  $errors = [];
  $vars = [];

  $vars["username"] = htmlspecialchars($_POST["username"]);
  $vars["first_name"] = htmlspecialchars($_POST["first_name"]);
  $vars["last_name"] = htmlspecialchars($_POST["last_name"]);
  $vars["sex"] = $_POST["sex"] ?? "";
  $vars["mail"] = htmlspecialchars($_POST["mail"]);
  if (strlen($vars["mail"]) > 0 && !filter_var($vars["mail"], FILTER_VALIDATE_EMAIL))
    $errors["mail"] = "Mail invalide";
  $vars["birth"] = htmlspecialchars($_POST["birth"]);
  $vars["birth"] = strlen($vars["birth"]) > 0 ? $vars["birth"] : null;
  $vars["tel"] = htmlspecialchars($_POST["tel"]);
  $vars["address"] = htmlspecialchars($_POST["address"]);
  $vars["postal_code"] = htmlspecialchars($_POST["postal_code"]);
  $vars["city"] = htmlspecialchars($_POST["city"]);
  $vars["id"] = $user->id_user;

  if (!isset($errors["mail"])) {
    $pdo = App::getPDO();
    $stmt = $pdo->prepare("UPDATE USERS set login=:username, first_name=:first_name, last_name=:last_name, sex=:sex, mail=:mail, address=:address, postal_code=:postal_code, city=:city, tel=:tel, birth=:birth WHERE id_user=:id");
    if ($stmt->execute($vars)) {
      // La mise à jour s'est bien passée
      $ok = true;
      $user = $auth->user(true);
    } else {
      //Sinon
      $errors["bdd"] = "Une erreur s'est produite lors de la mise à jour des données, veuillez réessayer plus tard. ";
      // var_dump($stmt->errorInfo());
    }
  }
}

require_once("view/profile.php");
