<?php
include './config/bd.php';

// Récupération et validation des données POST
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$size = isset($_POST['size']) ? trim($_POST['size']) : '';
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Validation des données
if ($product_id <= 0 || empty($size) || $quantity <= 0) {
    echo "Données invalides.";
    exit;
}

// Vérifier si la commande existe déjà
try {
    $checkSql = "SELECT COUNT(*) FROM commandes WHERE product_id = :product_id AND size = :size";
    $checkReq = $conn->prepare($checkSql);
    $checkReq->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $checkReq->bindParam(':size', $size, PDO::PARAM_STR);
    $checkReq->execute();
    $count = $checkReq->fetchColumn();

    if ($count > 0) {
        echo "Cette commande existe déjà.";
        exit;
    }

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO commandes (product_id, size, quantity) VALUES (:product_id, :size, :quantity)";
    $req = $conn->prepare($sql);
    $req->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $req->bindParam(':size', $size, PDO::PARAM_STR);
    $req->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $req->execute();

    echo "Commande reçue ! <a href='produits.php'>Retour </a>";
} catch (PDOException $e) {
    // Gestion des erreurs lors de l'exécution de la requête
    echo "Erreur lors de l'enregistrement de la commande : " . $e->getMessage();
}
