
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // ou les includes manuels si pas de Composer
include './config/bd.php'; // connexion BDD


// Récupération des données POST
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$localisation = $_POST['localisation'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$product_id = $_POST['product_id'];
$nom_produit = $_POST['product_name'];
$photo = $_POST['photo'];
$prix = $_POST['prix'];
$taille = $_POST['taille'];
$quantite = $_POST['quantite'];
$categorie = $_POST['categorie'];
$statut = "En attente";

$code_commande = 0;


// Générer le code de vérification
$code_verification = rand(100000, 999999);
$date_commande = date('Y-m-d H:i:s');


$telephone = trim($_POST['telephone'] ?? '');
// Suppression de tout ce qui n'est pas chiffre ni +
$telephone = preg_replace('/\s+/', '', $telephone); // retire les espaces

// Vérification format E.164 ivoirien (ex: +225712345678)
if (!preg_match('/^\+2250[1-9]\d{7,8}$/', $telephone)) {
    die("❌ Numéro invalide pour envoi SMS.");
} // Enregistrer la commande
$sql = "INSERT INTO t_commande (nom, prenom, email, telephone, localisation, latitude, longitude, product_id, product_name, photo, prix, taille, quantite, categorie,code_commande, code_verification, statut, date_commande)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$nom, $prenom, $email, $telephone, $localisation, $latitude, $longitude, $product_id, $nom_produit, $photo, $prix, $taille, $quantite, $categorie, $code_commande, $code_verification, $statut, $date_commande]);

// Vérifier si le client existe déjà
$sql_check_client = "SELECT COUNT(*) FROM t_client WHERE email = ?";
$stmt_check = $conn->prepare($sql_check_client);
$stmt_check->execute([$email]);
$client_exists = $stmt_check->fetchColumn();

if (!$client_exists) {
    // Insérer le nouveau client
    $sql_insert_client = "INSERT INTO t_client (nom, prenom, email, telephone, localisation, latitude, longitude)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_client = $conn->prepare($sql_insert_client);
    $stmt_client->execute([$nom, $prenom, $email, $telephone, $localisation, $latitude, $longitude]);
}
// Envoi de l'e-mail avec PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'elinguessan10@gmail.com'; // Ton email
    $mail->Password = 'qjga jshk icwn myin'; // Mot de passe d'application
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('elinguessan10@gmail.com', 'Boutique Le Djassa');
    $mail->addAddress($email, "$prenom $nom");

    // Image intégrée depuis le dossier local (par ex : admin/upload/)
    $mail->AddEmbeddedImage('admin/upload/' . $photo, 'img_produit');

    $mail->isHTML(true);
    $mail->Subject = 'Code de vérification de votre commande';
    $mail->Body = "
  Bonjour $prenom,<br><br>
        Merci pour votre commande du produit <strong>$nom_produit</strong>.<br>
        Voici le produit :<br>
        <img src=\"cid:img_produit\" alt=\"Produit\" style=\"max-width: 500px;\" /><br><br>
        Votre code de vérification est : <h2>$code_verification</h2><br>
        Entrez ce code sur notre site pour confirmer votre commande.<br><br>
        Cordialement,<br>
        <strong>L'équipe Le Djassa</strong>.  ";

    $mail->send();
    echo "Commande enregistrée ! Un e-mail de vérification vous a été envoyé.";
} catch (Exception $e) {
    echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
}

header("Location: verifier_code.php");
exit;
