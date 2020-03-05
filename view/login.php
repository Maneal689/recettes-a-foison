<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style/container.css">
  <link rel="stylesheet" href="assets/style/form.css">
  <link rel="stylesheet" href="assets/style/navbar.css">
  <title>Connexion</title>
</head>

<body>
  <?php require_once("view/template/navbar.php"); ?>
  <div class="middle">
    <div class="card" style="width: 40%;">
      <h1 class="centered">Connexion</h1>

      <form action="/connexion" method="post">
      <span class="success-text"><?= (isset($_GET["sub"]) && $_GET["sub"] == 1) ? "Inscription réussie" : "" ?></span>
        <span class="error-text"><?= $error ?></span><br>
        <label for="username">Login: </label>
        <input type="text" name="username" placeholder="login" id=""><br>
        <label for="password">Mot de passe: </label>
        <input type="password" name="password" placeholder="mot de passe" id=""><br>
        <div class="centered" style="margin-top: 1em;">
          <input type="submit" value="Se connecter" name="submit">
        </div>
      </form>
      <span class="secondary">
        Pas encore de compte ? <a href="/inscription">Inscrivez-vous</a>
      </span>
    </div>
  </div>
</body>

</html>