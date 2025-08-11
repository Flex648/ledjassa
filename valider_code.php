<?php
include('./config/bd.php');

$telephone = $_GET['telephone'] ?? '';
// Récupération sécurisée de l'ID de commande
$id_commande = isset($_GET['id']) ? intval($_GET['id']) : 0;
$erreur = "";


if ($id_commande <= 0) {
    die("Commande introuvable ou ID invalide.");
}
// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code_enter = trim($_POST['code_enter'] ?? '');

    if (!preg_match('/^\d{6}$/', $code_enter)) {
        $erreur = "⚠️ Le code doit être numérique et comporter 6 chiffres.";
    } else {
        // Récupération du code enregistré en base
        $stmt = $conn->prepare("SELECT code_sms FROM t_commande WHERE id = ?");
        $stmt->execute([$id_commande]);
        $code_enregistre = $stmt->fetchColumn();

        if ($code_enregistre && $code_enter === $code_enregistre) {
            // Mise à jour du statut de vérification
            $stmt = $conn->prepare("UPDATE t_commande SET sms_verifie = 1 WHERE id = ?");
            $stmt->execute([$id_commande]);

            // Redirection vers page de confirmation
            header("Location: commande_validee.php?id=" . urlencode($id_commande));
            exit;
        } else {
            $erreur = "❌ Code incorrect. Veuillez réessayer.";
        }
    }
}

// Récupérer le numéro de téléphone lié à la commande pour l'afficher
$stmt = $conn->prepare("SELECT telephone FROM t_commande WHERE id = ?");
$stmt->execute([$id_commande]);
$telephone = $stmt->fetchColumn() ?: "";

// Récupérer 4 produits au hasard pour la section "voir d'autres produits"
$sql = "SELECT * FROM t_produit ORDER BY RAND() LIMIT 4";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vérification de l'appel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/aos.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .main-content {
            flex: 1;
            text-align: center;
            padding: 50px 20px;
            background-image: url('./img/ouio.png');
            background-size: cover;
            background-position: center;
        }



        #button:hover {
            background-color: rgb(112, 67, 0);
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }

        .product-container {
            max-width: 1400px;
            margin: 40px auto;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-card {
            background: #e8e8ea;
            padding: 16px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            transition: 0.3s;
        }

        .product-card img {
            width: 100%;
            height: auto;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card h5,
        .product-card p {
            margin: 0;
        }

        .product-card a.btn {
            margin-top: 10px;
            display: inline-block;
            font-size: 20px;
            padding: 10px 20px;
            border: 2px solid #b16200;
            color: #b16200;
            text-decoration: none;
            border-radius: 4px;
        }

        .product-card a.btn:hover {
            background-color: #b16200;
            color: white;
        }

        .search-container {
            background-color: rgb(139, 83, 0);
            max-width: 200px;
            top: 0;
        }

        .search-container .d-flex {
            background-color: rgb(139, 83, 0);
            box-shadow: none;
            width: 320px;
        }



        footer.footer {
            background-color: #eee;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
    </style>



</head>

<body>
    <?php include './includes/header.php'; ?>

    <div class="main-content">
        <h2 style="font-weight: bolder; color:white;">📞 VÉRIFICATION DE VOTRE COMMANDE PAR SMS</h2>

        <?php if ($telephone): ?>
            <p style="font-size: 18px; color : white;">📱 Entrez le code envoyé au numéro : <strong><?= htmlspecialchars($telephone) ?></strong> </p>
        <?php endif; ?>

        <?php if ($erreur): ?>
            <p class="error-message"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="telephone" value="<?= htmlspecialchars($telephone) ?>">
            <input class="w-20 shadow" type="text" name="code_enter" pattern="\d{6}" style="font-weight: bolder; outline:none;text-align:center; border:none" required>
            <button class="btn" type="submit" style="background-color: #b16200; color : white; font-size : 21px; font-weight:bold">Vérifier</button>
        </form>

    </div>

    <h2 style="text-align: center; color: #b16200; margin-top: 40px; font-weight: bold; letter-spacing: 10px;">~ VOIR D'AUTRES PRODUITS ~</h2>

    <div class="product-container">
        <?php foreach ($prod as $prods): ?>
            <div class="product-card">
                <img src="admin/upload/<?= htmlspecialchars($prods["photo"]) ?>" alt="<?= htmlspecialchars($prods["nom"]) ?>" />
                <h5><?= htmlspecialchars($prods['nom']) ?></h5>
                <p><?= htmlspecialchars($prods['prix']) ?> FCFA</p>
                <a href="produit_details.php?id=<?= htmlspecialchars($prods['id']) ?>" class="btn"> <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <?php include('./includes/footer.php'); ?>


</body>

</html>