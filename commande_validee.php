<?php
// verifier_appel.php

include("./config/bd.php");
// Vérifie si l'id est passé en paramètre GET
$id_commande = $_GET['id'] ?? null;

// Récupérer 4 produits au hasard pour la section "voir d'autres produits"
$sql = "SELECT * FROM t_produit ORDER BY RAND() LIMIT 4";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);

// Inclusion du header ici (après toute redirection possible)
include('./includes/header.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vérification de l'appel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/aos.css" />
    <script src="./js/aos.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-image: url('./img/bgggg.png');
            background-size: cover;
            background-position: center;
        }

        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(230, 130, 130, 0.1);
        }


        button {
            padding: 10px 25px;
            font-size: 16px;
            background-color: rgb(255, 255, 255);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(255, 255, 255);
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

        .navbar-toggler {
            background-color: rgb(198, 128, 43) !important;
            /* Pas de fond */
            border: 2px solid rgb(139, 83, 0) !important;
            /* Pas de bordure */
            box-shadow: none !important;
            /* Pas d’ombre */
        }

        .navbar-toggler:hover,
        .navbar-toggler:focus,
        .navbar-toggler:active {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            color: inherit !important;
            /* garde la couleur du texte actuelle */

        }
    </style>
</head>

<body>
    <nav class="main-content">
        <dotlottie-player
            src="https://lottie.host/641c816e-4ae6-433d-a995-5e60b197c7a4/xdn3t0tfYE.lottie"
            background="transparent"
            speed="1"
            style="width: 100px; height: auto;"
            loop
            autoplay></dotlottie-player>
        <h1 style="font-weight: bolder; color:white; text-shadow:0px 3px 8px rgba(0, 0, 0, 0.88);">Votre commande a été vérifiée avec succès !</h1>
        <dotlottie-player
            src="https://lottie.host/a76bcb60-380e-413b-af85-eb14aa1bad9a/L49f6Qgges.lottie"
            background="transparent"
            speed="1"
            style="width: 200px; height: auto"
            loop
            autoplay></dotlottie-player>
        <p style="font-size: 21px; color:rgb(210, 116, 0); font-weight:bolder; font-style:italic; letter-spacing:5px;">Vous serez livrer dans les plus bref délais...</p>

        <?php if ($id_commande): ?>
            <a href="panier_end.php" class="btn shadow" style="background-color :rgb(255, 255, 255); color:black">Suivre la commande</a> <br>
            <a href="test_facture.php?id=<?= htmlspecialchars($id_commande) ?>" class="btn shadow" style="background-color :rgb(255, 162, 0)" target="_blank" download>
                Télécharger la facture
            </a>
        <?php else: ?>
            <p>Impossible de récupérer votre facture pour le moment.</p>
        <?php endif; ?>
        <p><br></p>

    </nav>

    <nav>

        <h2 style="text-align: center; color: #b16200; margin-top: 40px; font-weight: bold; letter-spacing: 10px;">~ ACHETEZ D'AUTRES PRODUITS ~</h2>

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

    <?php include("./includes/footer.php"); ?>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>