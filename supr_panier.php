<?php
session_start();
require 'db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: panier.php');
    exit;
}

if (isset($_SESSION['user_id'])) {
    // Pour utilisateur connecté : suppression en base
    $stmt = $pdo->prepare("DELETE FROM paniers WHERE user_id = ? AND jeu_id = ?");
    $stmt->execute([$_SESSION['user_id'], $id]);
} else {
    // Pour utilisateur non connecté : suppression en session
    if (isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array_values(
            array_filter($_SESSION['panier'], fn($item) => $item != $id)
        );
    }
}

header('Location: panier.php');
exit;