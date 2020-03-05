<?php

require_once("model/App.php");

use App\App;

function isError($errors)
{
  foreach ($errors as $subject => $text) {
    if (isset($text))
      return true;
  }
  return false;
}

$errors = [];
$auth = App::getAuth();
$user = $auth->user();
if ($user) header("location: /home");

$pdo = App::getPDO();

if (isset($_POST) && isset($_POST["submit"])) { // On reçoit les informations pour l'inscription
  $vars = [];
  $vars["username"] = htmlspecialchars($_POST["username"]);
  $vars["password"] = htmlspecialchars($_POST["password"]);
  if (strlen($vars["password"]) < 6) $errors["password"] = "Mot de passe trop court";
  $vars["password"] = password_hash($vars["password"], PASSWORD_DEFAULT);
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

  //Insertion dans la BDD
  if (!isset($errors["password"]) && !isset($errors["mail"])) {
    $stmt = $pdo->prepare("INSERT INTO USERS (login, password, first_name, last_name, sex, mail, address, postal_code, city, tel, birth) values (:username, :password, :first_name, :last_name, :sex, :mail, :address, :postal_code, :city, :tel, :birth)");
    if ($stmt->execute($vars)) {
      //L'inscription s'est bien passée
      header("location: /connexion?sub=1");
    } else {
      //Sinon
      $errors["bdd"] = "Une erreur s'est produite lors de l'inscription, veuillez réessayer plus tard.<br>" . print_r($stmt->errorInfo(), true);
      // var_dump($stmt->errorInfo());
    }
  }
}
require_once("view/subscribe.php");
