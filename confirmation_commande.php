<?php
include('./config/bd.php');

$code = $_GET['code'] ?? '';
$message = '';
$commande = null;

if (!empty($code)) {
    $sql = "SELECT * FROM t_commande WHERE code_sms = :code AND statut = 'Verifiee' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':code' => $code]);
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        $message = "❌ Aucune commande vérifiée avec ce code.";
    }
} else {
    $message = "❌ Code manquant.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de la commande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles & Scripts -->
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/aos.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-5">

    <div class="container">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <?php if ($commande): ?>
                    <h3 class="text-success text-center mb-4">✅ Commande vérifiée avec succès !</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></li>
                        <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($commande['prenom']) ?></li>
                        <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($commande['telephone']) ?></li>
                        <li class="list-group-item"><strong>Statut :</strong> <?= htmlspecialchars($commande['statut']) ?></li>
                        <li class="list-group-item"><strong>Date :</strong> <?= htmlspecialchars($commande['date_commande'] ?? 'N/A') ?></li>
                    </ul>
                <?php else: ?>
                    <h4 class="text-danger text-center"><?= htmlspecialchars($message) ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>


</body>

</html>