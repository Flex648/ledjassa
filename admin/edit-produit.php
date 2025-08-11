<?php
include(__DIR__ . '/../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    // Gestion de la nouvelle image si envoyée
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];
        $destination = 'upload/' . basename($photo);
        move_uploaded_file($tmp, $destination);

        $sql = "UPDATE t_produit SET nom = ?, prix = ?, photo = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom, $prix, $photo, $id]);
    } else {
        $sql = "UPDATE t_produit SET nom = ?, prix = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom, $prix, $id]);
    }

    header("Location: produit.php");
    exit;
}
