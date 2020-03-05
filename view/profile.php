<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/style/container.css">
  <link rel="stylesheet" href="assets/style/form.css">
  <link rel="stylesheet" href="assets/style/navbar.css">
  <title>Profil</title>
</head>

<body>
  <?php require_once("view/template/navbar.php"); ?>

  <div class="page-content">
    <h1 class="centered">Profil</h1>
    <form action="/profil" style="margin: 0 auto; max-width: 50%;" method="post">
      <?= isset($errors["bdd"]) ? ('<span class="error-text">' . $errors["bdd"] . '</span><br>') : "" ?>
      <?= $ok ? ('<span class="success-text">Les modifications ont été prisent en compte.</span><br>') : "" ?>
      <label for="username" style="display: inline-block; width: 35%;">Login: </label>
      <input type="text" name="username" placeholder="login" value="<?= $user->login ?>" id=""><br>

      <label for="first_name" style="display: inline-block; width: 35%;">Prénom: </label>
      <input type="text" name="first_name" placeholder="prénom" id="" value="<?= $user->first_name ?>"><br>

      <label for="last_name" style="display: inline-block; width: 35%;">Nom: </label>
      <input type="text" name="last_name" value="<?= $user->last_name ?>" placeholder="nom" id=""><br>

      <label for="mail" style="display: inline-block; width: 35%;">e-mail: </label>
      <input type="email" name="mail" value="<?= $user->mail ?>" placeholder="e-mail" id=""><br>
      <?= isset($errors["mail"]) ? ('<span class="error-text">' . $errors["mail"] . '</span><br>') : "" ?>

      <label for="tel" style="display: inline-block; width: 35%;">Téléphone: </label>
      <input type="tel" name="tel" value="<?= $user->tel ?>" placeholder="Téléphone" id=""><br>

      <label for="birth" style="display: inline-block; width: 35%;">Date de naissance: </label>
      <input type="date" name="birth" value="<?= $user->birth ?>" id=""><br>

      <label for="radio-homme">Homme </label>
      <input type="radio" name="sex" <?= $user->sex == "homme" ? "checked='checked'" : "" ?> value="homme" id="radio-homme">

      <label for="radio-femme">Femme </label>
      <input type="radio" name="sex" <?= $user->sex == "femme" ? "checked='checked'" : "" ?> value="femme" id="radio-femme"><br>

      <label for="address" style="display: inline-block; width: 35%;">Adresse: </label>
      <input type="text" name="address" value="<?= $user->address ?>" placeholder="adresse" id=""><br>

      <label for="city" style="display: inline-block; width: 35%;">Ville: </label>
      <input type="text" name="city" value="<?= $user->city ?>" placeholder="ville" id=""><br>

      <label for="postal_code" style="display: inline-block; width: 35%;">Code postal: </label>
      <input type="text" name="postal_code" value="<?= $user->postal_code ?>" placeholder="code postal" id=""><br>

      <div class="centered" style="margin-top: 1em;">
        <input type="submit" value="Modifier les données" name="submit">
      </div>
    </form>
  </div>


</body>

</html>