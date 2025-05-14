<?php
session_start();
require 'db.php';
require 'nav.php';

$jeux = $pdo->query("SELECT * FROM jeux")->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="style.css">
<h1 id="catalogue">Catalogue de jeux vidéo</h1>

<?php if (isset($_SESSION['user'])): ?>
    <h2>Bienvenue <?= htmlspecialchars($_SESSION['user']) ?> !</h2>
<?php else: ?>
    <h2>Bienvenue visiteur !</h2>
<?php endif; ?>

<ul>
<?php foreach ($jeux as $jeu): ?>
    <li class="jeu-card">
        <div class="jeu-info">
            <strong><?= htmlspecialchars($jeu['titre']) ?></strong> -
            <?= $jeu['genre'] ?> - <?= $jeu['plateforme'] ?> -
            <?= number_format($jeu['prix'], 2) ?> €
        </div>
        <a href="ajouter_panier.php?id=<?= $jeu['id'] ?>" class="ajouter-panier">Ajouter au panier</a>
    </li>
<?php endforeach; ?>
</ul>


