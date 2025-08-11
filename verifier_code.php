<?php
include './includes/header.php'; // Inclure le header
?>

<?php
include './config/bd.php'; // Connexion à la base de données

$message = "";

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
    <title>Vérification de Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/aos.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/aos.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
        }

        .main-content {
            top: 10%;
            left: 40%;
            flex: 1;
            text-align: center;
        }

        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px 0;
            border-top: 1px solid #ccc;
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

        .navno {
            position: relative;
            width: 100%;
            height: 40vh;
        }

        .navno img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navno" style="background-image: url(./img/fdpe.png); height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="main-content" data-aos="fade-right" style="width: 100%;">
            <div class="container" style="text-align: center;">
                <br><br><br>
                <h2 class="mb-4" style="font-weight: bold;">Vérifiez votre commande par mail</h2>
                <h3 class="mb-4">Saisissez le code reçu :</h3>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-info"><?= $message ?></div>
                <?php endif; ?>
                <form method="post" action="recap.php" style="margin: 0 auto;">
                    <div class="mb-3">
                        <input type="text" name="code" class="form-control mx-auto" placeholder="Ex: 123456" required style="width: 300px; border:2px solid #8b5300; text-align:center;font-weight:bolder;color:black;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-size:25px; background-color:rgb(177, 98, 0); border:none; text-shadow:0px 2px 5px black">Vérifier</button>
                </form>
            </div>
            <br>
        </div>
    </nav>
    <nav>

        <h2 style="text-align: center; color: #b16200; margin-top: 40px; font-weight: bold; letter-spacing: 10px;">~ ACHETEZ D'AUTRES PRODUITS ~</h2>

        <div class="product-container">
            <?php foreach ($prod as $prods): ?>
                <div class="product-card">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
        type="module"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>


    <?php include './includes/footer.php'; ?>
</body>


</html>