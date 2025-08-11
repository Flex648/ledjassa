<?php
require './config/bd.php'; // Connexion à la BD
require 'vendor/autoload.php';

use Twilio\Rest\Client;

$telephone = $_POST['telephone'] ?? '';
$code = rand(100000, 999999);

// Enregistrement dans la BD
// 4. Met à jour la commande avec le code
$stmt = $conn->prepare("UPDATE t_commande SET code_sms = ?, sms_verifie = 0 WHERE telephone = ?");
$stmt->execute([$code, $telephone]);

// 5. Récupérer l'ID de la commande mise à jour
$stmt2 = $conn->prepare("SELECT id FROM t_commande WHERE telephone = ? AND code_sms = ? ORDER BY id DESC LIMIT 1");
$stmt2->execute([$telephone, $code]);
$id_commande = $stmt2->fetchColumn();

if (!$id_commande) {
    die("Aucune commande trouvée pour ce numéro.");
}

// Envoi du SMS
$sid = 'AC50b7286a2bc3b3c2122327e55bb0a949';
$token = '02c59c4798116420e9ea5fa789c5418c';
$twilio_number = '+19182330391';
$client = new Client($sid, $token);

try {
    $client->messages->create(
        $telephone,
        [
            'from' => $twilio_number,
            'body' => "Votre code de vérification est : $code"
        ]
    );
    header("Location: valider_code.php?id=$id_commande");
    exit;
} catch (Exception $e) {
    echo "Erreur SMS : " . $e->getMessage();
}
