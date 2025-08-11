<?php
include './config/bd.php';

$commande = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'] ?? '';

    if (!empty($code)) {
        $sql = "SELECT * FROM t_commande WHERE code_verification = :code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        $commande = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($commande) {

            $code_commande = rand(100000, 999999);

            $update = $conn->prepare("UPDATE t_commande SET statut = 'Verifiee', code_commande = :code_commande WHERE id = :id");
            $update->bindParam(':code_commande', $code_commande);
            $update->bindParam(':id', $commande['id']);
            $update->execute();

            $code_verifie_avec_succes = true;

            $total = $commande['prix'] * $commande['quantite'];
        }
    }
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
    <title>Vérification de commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/aos.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .navseven {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 80vh;
        }

        .commande-info {
            width: 50%;
            padding: 30px 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin-top: 20px;
        }


        .container {
            max-width: 1400px;
            max-height: auto;
            margin: 0 auto;
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

        .categ {
            position: absolute;
            width: 100%;
            height: 20%;
            top: 25%;
            text-align: center;
        }

        .categ a {
            text-decoration: none;
            color: rgb(251, 117, 0);
            font-weight: 500;
        }

        .card-body .btn:hover {
            background-color: rgb(177, 98, 0);
        }

        .btn i {
            color: rgb(177, 98, 0)
        }

        .btn i:hover {
            color: white;
        }

        @keyframes clignoter {
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
            animation: clignoter 1s infinite;
        }

        footer {
            bottom: 0;
        }
    </style>
</head>

<body>
    <?php include './includes/header.php';
    ?>
    <main>
        <div class="navseven">
            <img src="./img/az.png" alt="" width="100%">
        </div>

        <div class="commande-info container flex-grow-1" style="position: relative; z-index: 10; padding-top: 20px; text-align:center">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <?php if ($commande): ?>
                    <p><br></p>
                    <h2 style="font-weight: BOLD;">RÉCAPITULATIF DE LA COMMANDE</h2>
                    <form method="POST" action="verifier_sms.php" class="d-inline-block">
                        <input type="hidden" name="telephone" value="<?= htmlspecialchars($commande['telephone']) ?>">
                        <button type="submit" name="envoyer_code" class="btn btn-dark clignote">📱 Vérifier le numéro par SMS</button>
                    </form>
                    <form method="POST" action="appeler_client.php" class="d-inline-block">
                        <input type="hidden" name="telephone" value="<?= htmlspecialchars($commande['telephone']) ?>">
                        <button type="submit" name="envoyer_code_appel" class="btn btn-dark clignote">📞 Vérifier par appel vocal</button>
                    </form>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($commande['nom']) ?></li>
                        <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($commande['email']) ?></li>
                        <li class="list-group-item"><strong>Téléphone :</strong> <?= htmlspecialchars($commande['telephone']) ?></li>
                        <li class="list-group-item"><strong>Localisation :</strong> <?= htmlspecialchars($commande['localisation']) ?></li>
                        <li class="list-group-item"><strong>Latitude :</strong> <?= htmlspecialchars($commande['latitude']) ?></li>
                        <li class="list-group-item"><strong>Longitude :</strong> <?= htmlspecialchars($commande['longitude']) ?></li>
                        <li class="list-group-item"><strong>Produit :</strong> <?= htmlspecialchars($commande['product_name']) ?></li>
                        <li class="list-group-item"><strong>Produit :</strong><img src="./admin/upload/<?= htmlspecialchars($commande['photo']) ?>" width="200" alt=""> </li>
                        <li class="list-group-item"><strong>Taille :</strong> <?= htmlspecialchars($commande['taille']) ?></li>
                        <li class="list-group-item"><strong>Quantité :</strong> <?= htmlspecialchars($commande['quantite']) ?></li>
                        <li class="list-group-item"><strong>Prix total :</strong> <?= number_format($total, 0, '', ' ') ?> FCFA</li>
                        <li class="list-group-item"><strong>Catégorie :</strong> <?= ucfirst(htmlspecialchars($commande['categorie'])) ?></li>
                    </ul>
                <?php else: ?>
                    <p class="text-danger">❌ Code incorrect ou inexistant.</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-warning">Veuillez saisir le code de vérification.</p>
            <?php endif; ?>
            <p><br><br></p>
        </div>

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

        <?php if (!empty($code_verifie_avec_succes)): ?>
            <!-- Modal Bootstrap -->
            <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-white" style="background: url('./img/8.png') no-repeat center center; background-size: cover;">
                        <div class="modal-header border-0" style="text-align: center;">
                            <h2 class="modal-title" id="codeModalLabel" style="color:rgb(153, 82, 0); font-weight: bolder; text-align:center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CODE DE LIVRAISON</h2>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p style="font-size: 21px ;color:black; font-weight:400">Conservez ce code pour la livraison ou <br> vous ne recevrez pas votre colis</p>
                            <dotlottie-player src="https://lottie.host/043ef191-b5fd-424d-a658-0fd5cde1c0de/Pw9p8Qxxc0.lottie" background="transparent" speed="1" style="width: 150px; height: auto; margin: 0 auto" loop autoplay></dotlottie-player>

                            <h2 style="font-size: 40px; background-color: rgba(255,255,255,0.85); color: black; padding: 10px 20px; display: inline-block; border-radius: 10px;">
                                <?= htmlspecialchars($code_commande) ?>
                            </h2>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="background-color:rgb(153, 82, 0); border : none; color : white; font-weight: bolder;">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <?php include("./includes/footer.php") ?>

    <?php if (!empty($code_verifie_avec_succes)): ?>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const myModal = new bootstrap.Modal(document.getElementById('codeModal'));
                myModal.show();
            });
        </script>
    <?php endif; ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>
</body>

</html>