<?php
include './config/bd.php';

// Configuration de la pagination
$produitsParPage = 6;
$pageCourante = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$debut = ($pageCourante - 1) * $produitsParPage;

// Récupération du nombre total de produits HOMME
$sqlTotal = "SELECT COUNT(*) AS total FROM t_produit WHERE categorie = 'homme'";
$totalReq = $conn->prepare($sqlTotal);
$totalReq->execute();
$total = $totalReq->fetch(PDO::FETCH_ASSOC)['total'];
$pagesTotales = ceil($total / $produitsParPage);

// Récupération des produits HOMME pour la page courante
$sql = "SELECT * FROM t_produit WHERE categorie = 'homme' LIMIT :debut, :nb";
$req = $conn->prepare($sql);
$req->bindValue(':debut', $debut, PDO::PARAM_INT);
$req->bindValue(':nb', $produitsParPage, PDO::PARAM_INT);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Produits Homme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/aos.css">
    <script src="./js/aos.js"></script>
    <style>
        body {
            background-color: #EAEAEA;
            font-family: 'Montserrat', sans-serif;
        }

        .product-card {
            width: 400px;
            padding: 16px;
            background-color: #e8e8ea;
            text-align: center;
            border-radius: 8px;
            overflow: hidden;
            transition: background-color 0.3s ease;
        }

        .product-card img {
            width: 100%;
            height: auto;
            object-fit: contain;
            margin-bottom: 16px;
            transition: transform 0.8s ease;
        }

        .product-card:hover img {
            transform: scale(1.2);
        }

        .product-card a:hover {
            background-color: rgb(195, 118, 2);
        }

        .product-card .fas {
            color: rgb(195, 118, 2);
        }

        .product-card .fas:hover {
            color: white;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }


        .categ {
            text-align: center;
            margin: 40px 0;
        }

        .categ a {
            text-decoration: none;
            color: rgb(139, 83, 0);
            font-weight: 500;
            letter-spacing: 5px;
            margin: 0 10px;
        }

        .pagination .page-link {
            color: rgb(177, 98, 0);
            border: 1px solid rgb(177, 98, 0);
        }

        .pagination .active .page-link {
            background-color: rgb(177, 98, 0);
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <?php include './includes/header.php'; ?>

    <div class="categ">
        <a href="produits.php">TOUS</a> | <a href="produit_homme.php">HOMME</a> | <a href="produit_femme.php">FEMME</a>
    </div>

    <div class="container mt-5">
        <div class="row">
            <?php foreach ($prod as $prods): ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card" data-aos="fade-up">
                        <img src="admin/upload/<?php echo htmlspecialchars($prods['photo']); ?>" alt="Produit">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($prods['nom']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($prods['prix']); ?> FCFA</p>
                            <a href="produit_details.php?id=<?php echo htmlspecialchars($prods['id']); ?>" class="btn" style="border: 1px solid rgb(195, 118, 2);">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Navigation produits">
            <ul class="pagination justify-content-center mt-4">
                <?php if ($pageCourante > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $pageCourante - 1 ?>">&laquo;</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagesTotales; $i++): ?>
                    <li class="page-item <?= ($i == $pageCourante) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pageCourante < $pagesTotales): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $pageCourante + 1 ?>">&raquo;</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <?php include './includes/footer.php'; ?>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>