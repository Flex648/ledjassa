<?php
session_start();
include './config/bd.php';

// Vérifie si l'email a été enregistré dans la session
if (!isset($_SESSION['email_a_verifier'])) {
    echo "Aucune commande en attente de vérification.";
    exit;
}

$email = $_SESSION['email_a_verifier'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code_saisi = htmlspecialchars($_POST['code_verification']);

    // Rechercher la commande correspondante
    $sql = "SELECT * FROM t_commande WHERE email = :email ORDER BY date_commande DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($commande && $commande['code_verification'] == $code_saisi) {
        // Mettre à jour la commande comme validée
        $update = "UPDATE t_commande SET valide = 1 WHERE id = :id";
        $stmt = $conn->prepare($update);
        $stmt->execute(['id' => $commande['id']]);

        // Supprimer la session
        unset($_SESSION['email_a_verifier']);

        echo "<h2 style='color: green;'>✅ Votre commande a été validée avec succès !</h2>";
        echo "<p>Merci pour votre confiance.</p>";
    } else {
        echo "<h4 style='color: red;'>❌ Code incorrect. Veuillez réessayer.</h4>";
    }
}
?>

<?php
// Supposons que $email contient l'adresse e-mail à afficher
$email = htmlspecialchars($_POST['email'] ?? ''); // ou $_SESSION['email'] selon ton contexte
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vérification de commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2>Vérification de votre commande</h2>
    <p>Un code de vérification a été envoyé à votre adresse e-mail <strong><?= $email ?></strong>. Veuillez le saisir ci-dessous :</p>

    <form method="POST" action="valider_code.php">
        <div class="mb-3">
            <label for="code_verification" class="form-label">Code de vérification</label>
            <input type="text" name="code_verification" id="code_verification" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Valider le code</button>
    </form>

    <form method="POST" action="renvoyer_code.php" class="mt-3">
        <input type="hidden" name="email" value="<?= $email ?>">
        <button type="submit" class="btn btn-secondary">Renvoyer le code</button>
    </form>
</body>

</html>