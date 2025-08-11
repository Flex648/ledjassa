<?php
include(__DIR__ . '/../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Optionnel : supprimer l'image du serveur si souhaité
    $stmt = $conn->prepare("SELECT photo FROM t_produit WHERE id = ?");
    $stmt->execute([$id]);
    $photo = $stmt->fetchColumn();
    if ($photo && file_exists("upload/$photo")) {
        unlink("upload/$photo");
    }

    // Supprimer le produit
    $stmt = $conn->prepare("DELETE FROM t_produit WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: produit.php");
    exit;
}
