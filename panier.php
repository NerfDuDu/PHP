<link rel="stylesheet" href="style.css">
<?php
session_start();
require 'db.php';
require 'nav.php';

$ids = $_SESSION['panier'] ?? [];

if (empty($ids)) {
    
    echo "<h1>Votre panier est vide</h1>";
    exit;
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT * FROM jeux WHERE id IN ($placeholders)");
$stmt->execute($ids);
$jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = array_sum(array_column($jeux, 'prix'));
?>
<link rel="stylesheet" href="style.css">
<h1>Votre panier</h1>
<ul>
<?php foreach ($jeux as $jeu): ?>
    <li>
        <?= htmlspecialchars($jeu['titre']) ?> - <?= number_format($jeu['prix'], 2) ?> €
        <a href="supr_panier.php?id=<?= $jeu['id'] ?>">Retirer</a>
    </li>
<?php endforeach; ?>
</ul>

<p><strong>Total : <?= number_format($total, 2) ?> €</strong></p>
