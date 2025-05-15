<?php
require 'db.php';
require 'nav.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user['id']; // Ajout essentiel pour lier l'utilisateur

        $stmt = $pdo->prepare("SELECT jeu_id FROM paniers WHERE user_id = ?");
        $stmt->execute([$user['id']]);
        $_SESSION['panier'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        header("Location: index.php");
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<link rel="stylesheet" href="style.css">
<form class="form" method="post">
  <div class="form-title"><span>Connexion</span></div><br>
  <div class="title-2"><span>JEUX</span></div>

  <div class="input-container">
    <input placeholder="Pseudo" type="text" class="input-mail" name="username" required />
    <span></span>
  </div>

  <section class="bg-stars">
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
    <span class="star"></span>
  </section>

  <div class="input-container">
    <input placeholder="Mot de passe" type="password" class="input-pwd" name="password" required />
  </div>

  <button class="submit" type="submit">
    <span class="sign-text">Se connecter</span>
  </button>

  <p class="signup-link">
    Pas de compte ?
    <a class="up" href="inscription.php">S'inscrire !</a>
  </p>
</form>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
