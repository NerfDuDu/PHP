<?php
require 'db.php';
require 'nav.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    try {
        $stmt->execute([$username, $password]);
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Nom d'utilisateur déjà pris.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<form class="form" method="post">
  <div class="form-title"><span>Inscription</span></div><br>
  <div class="title-2"><span>JEUX</span></div>
  <div class="input-container">
    <input placeholder="Pseudo" type="text" class="input-mail" name ="username"/>
    <span> </span>
  </div>

  <section class="bg-stars">
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
  </section>

  <div class="input-container">
    <input placeholder="Mot de passe" type="password" class="input-pwd" name = "password"/>
  </div>
  <button class="submit" type="submit">
    <span class="sign-text">S'inscrire</span>
  </button>

  <p class="signup-link">
    Déjà un compte ?
    <a class="up" href="connexion.php">Se connecter !</a>
  </p>
</form>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>


