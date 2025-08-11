<?php
include './includes/header.php';
include('./config/bd.php'); // Connexion à la base de données

$commande = null;
$code = $_POST['code'] ?? '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($code)) {
    $sql = "SELECT * FROM t_commande WHERE code_commande = :code";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        $message = "❌ Code incorrect. Veuillez réessayer.";
    }
}

$suivi = $commande['suivi'] ?? '';

switch ($suivi) {
    case 'En attente...':
        $affichage = '<i class="bi bi-hourglass-split text-secondary"></i> <strong>En attente de traitement</strong>';
        break;
    case 'Colis réceptionné...':
        $affichage = '<i class="bi bi-box-seam text-success"></i> <strong>Colis réceptionné</strong>';
        break;
    case 'En cours de livraison':
        $affichage = '<i class="bi bi-truck text-primary"></i> <strong>En cours de livraison</strong>';
        break;
    case 'Livraison reportée':
        $affichage = '<i class="bi bi-exclamation-circle text-warning"></i> <strong>Livraison reportée</strong>';
        break;
    case 'Commande annulée':
        $affichage = '<i class="bi bi-x-circle text-danger"></i> <strong>Commande annulée</strong>';
        break;
    default:
        $affichage = '<i class="bi bi-question-circle"></i> <strong>Statut inconnu</strong>';
        break;
}


// Récupérer 4 produits au hasard pour la section "voir d'autres produits"
$sql = "SELECT * FROM t_produit ORDER BY RAND() LIMIT 4";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Suivi de Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/aos.css">
    <script src="./js/aos.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
        body {
            font-family: 'Montserrat', sans-serif;

        }

        .card {
            border-radius: 12px;
        }

        .btn {
            font-weight: 600;
        }

        .alert {
            border-radius: 8px;
        }

        img {
            max-height: 250px;
            object-fit: contain;
        }

        @keyframes clignotement {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        .clignote {
            animation: clignotement 1s infinite;
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

        .boutique-auvent {
            position: relative;
            background: #0046a3;
            color: white;
            padding: 20px 10px 60px 10px;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            font-weight: bold;
            letter-spacing: 5px;
            font-size: 18px;
            overflow: hidden;
        }

        /* effet "ondulé" en bas */
        .boutique-auvent::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 50px;
            background: radial-gradient(circle at 25% 0%, white 30%, transparent 31%),
                radial-gradient(circle at 50% 0%, white 30%, transparent 31%),
                radial-gradient(circle at 75% 0%, white 30%, transparent 31%);
            background-repeat: repeat-x;
            background-size: 100px 50px;
        }
    </style>
</head>

<body class="bg-light" style="background-image: url(./img/panier9.png);">

    <div class="container py-5">

        <!-- Formulaire -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 col-lg-6">
                <div class="container text-center" data-aos="fade-down">
                    <i class="bi bi-shield-check" style="color: black;font-size:25px;font-style:normal; font-weight:bolder; letter-spacing:3px;">VERIFIEZ VOTRE COMMANDE</i>
                    <br>
                    <h2 class="text-center mb-4" style="color: rgb(0, 0, 0); font-weight:medium;  letter-spacing:2px; font-size:23px;">Saisissez le code de livraison : </h2>
                </div>

                <form method="POST" class="card shadow-sm p-4 text-center" style=" backdrop-filter: blur(1px); transition:0.1s;" data-aos="zoom-in">
                    <div class="mb-3">
                        <label for="code" class="form-label" style="font-size: 25px; color:white; "></label>
                        <input type="text" name="code" id="code" class="form-control text-center w-50 mx-auto" style="border: 2px solid #0046a3; font-weight:bolder" required value="<?= htmlspecialchars($code) ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-30" style="background-color: rgb(0, 69, 154); font-size:21px;"><i class="fa-solid fa-magnifying-glass"></i> </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Message d'erreur -->
        <?php if ($message): ?>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="alert alert-danger text-center"><?= htmlspecialchars($message) ?></div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Résultat -->
        <?php if ($commande): ?>
            <div class="row justify-content-center" style="text-align: center;">
                <div class="col-md-10 col-lg-8" data-aos="flip-up">
                    <div class="card shadow-sm p-4 mb-5" style="border : 2px solid rgb(9, 47, 118); background-color:none">
                        <h2 class="mb-3 text-center" style="font-weight : bolder">📦 Détails de votre commande</h2>
                        <ul class="list-group list-group-flush" style="font-size: 22px;">
                            <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></li>
                            <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($commande['email']) ?></li>
                            <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($commande['telephone']) ?></li>
                            <li class="list-group-item text-center">
                                <form method="POST" action="verifier_sms.php" class="d-inline-block">
                                    <input type="hidden" name="telephone" value="<?= htmlspecialchars($commande['telephone']) ?>">
                                    <button type="submit" name="envoyer_code" class="btn btn-dark clignote">📱 Vérifier le numéro par SMS</button>
                                </form>
                                <form method="POST" action="appeler_client.php" class="d-inline-block">
                                    <input type="hidden" name="telephone" value="<?= htmlspecialchars($commande['telephone']) ?>">
                                    <button type="submit" name="envoyer_code_appel" class="btn btn-dark clignote">📞 Vérifier par appel vocal</button>
                                </form>
                            </li>
                            <li class="list-group-item"><strong>Localisation :</strong> <?= htmlspecialchars($commande['localisation']) ?></li>
                            <li class="list-group-item"><strong>Produit :</strong> <?= htmlspecialchars($commande['product_name']) ?></li>
                            <li class="list-group-item text-center">
                                <strong>Photo :</strong><br>
                                <img src="./admin/upload/<?= htmlspecialchars($commande['photo']) ?>" class="img-fluid rounded mt-2" style="max-width: 200px;" alt="Photo du produit">
                            </li>
                            <li class="list-group-item"><strong>Prix unitaire :</strong> <?= htmlspecialchars($commande['prix']) ?> FCFA</li>
                            <li class="list-group-item"><strong>Taille :</strong> <?= htmlspecialchars($commande['taille']) ?></li>
                            <li class="list-group-item"><strong>Quantité :</strong> <?= htmlspecialchars($commande['quantite']) ?></li>
                            <li class="list-group-item"><strong>Prix total :</strong> <?= htmlspecialchars($commande['prix'] * $commande['quantite']) ?> FCFA</li>
                            <li class="list-group-item">
                                <strong>Statut :</strong>
                                <span class="badge bg-<?= $commande['statut'] === 'Verifiee' ? 'success' : 'warning' ?>">
                                    <?= htmlspecialchars($commande['statut']) ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <nav>

        <h2 style="text-align: center; color:rgb(147, 82, 9); margin-top: 40px; font-weight: bolder; letter-spacing: 10px;" data-aos="zoom-in">~ ACHETEZ D'AUTRES PRODUITS ~</h2>

        <div class="product-container">
            <?php foreach ($prod as $prods): ?>
                <div class="product-card" data-aos="fade-up">
                    <img src="admin/upload/<?= htmlspecialchars($prods["photo"]) ?>" alt="<?= htmlspecialchars($prods["nom"]) ?>" />
                    <h5><?= htmlspecialchars($prods['nom']) ?></h5>
                    <p><?= htmlspecialchars($prods['prix']) ?> FCFA</p>
                    <a href="produit_details.php?id=<?php echo htmlspecialchars($prods['id']); ?>" class="btn" style="border: 1px solid rgb(195, 118, 2);">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </nav>


    <?php include './includes/footer.php'; ?>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
        type="module"></script>
</body>

</html>