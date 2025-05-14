<?php
session_start();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (!in_array($id, $_SESSION['panier'])) {
    $_SESSION['panier'][] = $id;
}

header('Location: index.php');
exit;
