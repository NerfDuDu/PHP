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

<!-- Formulaire -->
<form class="form" method="post">
  <div class="form-title"><span>Inscription</span></div><br>
  <div class="title-2"><span>JEUX</span></div>

  <!-- Pseudo -->
  <div class="input-container">
    <input placeholder="Pseudo" type="text" class="input-mail" name ="username" maxlenght = "128" required/>
    <span> </span>
  </div>

  <!-- Décoration d'arrière plan -->
  <section class="bg-stars">
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
  </section>

  <!-- Mot de passe -->
  <div class="input-container">
    <input placeholder="Mot de passe" type="password" class="input-pwd" name = "password" maxlenght = "128" required/>
  </div>

  <button class="submit" type="submit">
    <span class="sign-text">S'inscrire</span>
  </button>
  <!-- Redirection vers la page d'inscription -->
  <p class="signup-link">
    Déjà un compte ?
    <a class="up" href="connexion.php">Se connecter !</a>
  </p>
</form>
<!-- Affiche une erreure si elle existe --> 
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

