<?php
session_start();

// Récupère l'ID du jeu à partir de l'URL (s'il est présent)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Vérifie si la variable de session 'panier' existe
if (isset($_SESSION['panier'])) {
    // On filtre le panier en retirant l'élément dont l'ID correspond à celui passé en paramètre
    $_SESSION['panier'] = array_filter($_SESSION['panier'], fn($item) => $item != $id);
}

// Redirige l'utilisateur vers la page du panier après avoir supprimé l'élément
header('Location: panier.php');
exit; // Termine le script immédiatement après la redirection