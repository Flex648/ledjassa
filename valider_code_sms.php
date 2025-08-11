<?php
require './config/bd.php';

$id = $_POST['id_commande'] ?? '';
$code = $_POST['code'] ?? '';

$stmt = $conn->prepare("SELECT * FROM t_commande WHERE id = ? AND code_sms = ?");
$stmt->execute([$id, $code]);
$commande = $stmt->fetch();

if ($commande) {
    // Mettre à jour comme vérifié
    $update = $conn->prepare("UPDATE t_commande SET sms_verifie = 1 WHERE id = ?");
    $update->execute([$id]);
    echo "✅ Vérification réussie.";
} else {
    echo "❌ Code invalide.";
}
