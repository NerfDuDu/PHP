<?php
session_start();
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Initialiser panier en session si non défini
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter à la session
if (!in_array($id, $_SESSION['panier'])) {
    $_SESSION['panier'][] = $id;
}

// Ajouter à la base si utilisateur connecté
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("INSERT IGNORE INTO paniers (user_id, jeu_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $id]);
}

header('Location: index.php');
exit;
