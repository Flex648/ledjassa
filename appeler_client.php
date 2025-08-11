<?php
require_once 'vendor/autoload.php'; // Composer doit être installé
include('./config/bd.php');

use Twilio\Rest\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['telephone'])) {

    // 1. Paramètres Twilio
    $sid = 'AC50b7286a2bc3b3c2122327e55bb0a949';
    $token = '02c59c4798116420e9ea5fa789c5418c';
    $twilio_number = '+14173732810';

    $client = new Client($sid, $token);

    // 2. Récupération du téléphone
    $telephone_client = $_POST['telephone'];
    $code = rand(100000, 999999);

    // 3. Connexion à la base de données - déjà incluse

    // 4. Met à jour la commande avec le code
    $stmt = $conn->prepare("UPDATE t_commande SET code_appel = ?, code_appel_verif = 0 WHERE telephone = ?");
    $stmt->execute([$code, $telephone_client]);

    // 5. Récupérer l'ID de la commande mise à jour
    $stmt2 = $conn->prepare("SELECT id FROM t_commande WHERE telephone = ? AND code_appel = ? ORDER BY id DESC LIMIT 1");
    $stmt2->execute([$telephone_client, $code]);
    $id_commande = $stmt2->fetchColumn();

    if (!$id_commande) {
        die("Aucune commande trouvée pour ce numéro.");
    }

    // 6. Génère l'URL TwiML avec le code
    $url_twiml = "https://213e-160-120-54-174.ngrok-free.app/ledjassa/vocal_code.php?code=$code";

    // 7. Lance l'appel vocal
    $call = $client->calls->create(
        $telephone_client,
        $twilio_number,
        ['url' => $url_twiml]
    );

    // 8. Redirection avec ID et téléphone
    header("Location: verifier_appel.php?id=" . urlencode($id_commande) . "&telephone=" . urlencode($telephone_client));
    exit;
} else {
    echo "Numéro de téléphone manquant.";
}
