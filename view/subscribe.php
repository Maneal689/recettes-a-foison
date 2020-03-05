<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style/container.css">
  <link rel="stylesheet" href="assets/style/form.css">
  <link rel="stylesheet" href="assets/style/navbar.css">
  <title>Inscription</title>
</head>

<body>
  <?php require_once("view/template/navbar.php"); ?>
  <div class="middle">
    <div class="card" style="width: 40%;">
      <h1 class="centered">Inscription</h1>
      <form action="/inscription" method="post">
        <?= isset($errors["bdd"]) ? ('<span class="error-text">' . $errors["bdd"] . '</span><br>') : "" ?>
        <label for="username">Login*: </label>
        <input type="text" name="username" placeholder="login" value=<?= $_POST["username"] ?? '""' ?> id="" required><br>
        <label for="password">Mot de passe*: </label>
        <input type="password" name="password" placeholder="mot de passe" id="" required><br>
        <?= isset($errors["password"]) ? ('<span class="error-text">' . $errors["password"] . '</span><br>') : "" ?>
        <label for="first_name">Prénom: </label>
        <input type="text" name="first_name" placeholder="prénom" id=""><br>
        <label for="last_name">Nom: </label>
        <input type="text" name="last_name" placeholder="nom" id=""><br>
        <label for="mail">e-mail: </label>
        <input type="email" name="mail" placeholder="e-mail" id=""><br>
        <?= isset($errors["mail"]) ? ('<span class="error-text">' . $errors["mail"] . '</span><br>') : "" ?>
        <label for="tel">Téléphone: </label>
        <input type="tel" name="tel" placeholder="Téléphone" id=""><br>
        <label for="birth">Date de naissance: </label>
        <input type="date" name="birth" id=""><br>
        <label for="radio-homme">Homme </label>
        <input type="radio" name="sex" value="homme" id="radio-homme">
        <label for="radio-femme">Femme </label>
        <input type="radio" name="sex" value="femme" id="radio-femme"><br>
        <label for="address">Adresse: </label>
        <input type="text" name="address" placeholder="adresse" id=""><br>
        <label for="city">Ville: </label>
        <input type="text" name="city" placeholder="ville" id=""><br>
        <label for="postal_code">Code postal: </label>
        <input type="text" name="postal_code" placeholder="code postal" id=""><br>

        <div class="centered" style="margin-top: 1em;">
          <input type="submit" value="S'inscrire" name="submit">
        </div>
      </form>
      <span class="secondary">
        Déjà un compte ? <a href="/connexion">Connectez-vous</a>
      </span>
    </div>
  </div>
</body>

</html>