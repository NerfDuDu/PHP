<?php
session_start();
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: panier.php');
    exit;
}

// Si utilisateur connecté : suppression en base + session
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("DELETE FROM paniers WHERE user_id = ? AND jeu_id = ?");
    $stmt->execute([$_SESSION['user_id'], $id]);
}

// Supprimer aussi de la session (connecté ou non)
if (isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array_values(
        array_filter($_SESSION['panier'], fn($item) => $item != $id)
    );
}

header('Location: panier.php');
exit;
