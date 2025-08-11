<?php
include './includes/header.php'; // Inclure le header
?>


<?php
include './config/bd.php';

$sql = "SELECT * FROM t_produit";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/aos.css">
    <script src="./js/aos.js"></script>


    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url(./img/bgg.png);
        }
    </style>


</head>

<body>

    <div class="container mt-5">
        <!-- Titre principal -->
        <h1 class="text-center mb-4" style="font-weight:700; color:white;" data-aos="fade-in"> <br> À propos du <span style="color: #c37807;">Djassa</span></h1>

        <!-- Paragraphe de présentation -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <p class="lead text-justify" style="color:rgb(172, 172, 172);text-align:center" data-aos="fade-left">
                    Le Djassa est née de la volonté de rendre la mode accessible à tous, en valorisant les vêtements de seconde main (friperie) de qualité.
                    Créée en [année de création], cette initiative vise à promouvoir un style original, abordable et éco-responsable.
                    Le Djassa, c’est plus qu’un simple commerce, c’est un mouvement qui redonne vie aux vêtements tout en respectant les réalités économiques de notre communauté.
                </p>
            </div>
        </div>

        <!-- Présentation des fondateurs -->
        <div class="mt-5">
            <h2 class="text-center mb-4" style="font-weight:600; color:white" data-aos="fade-in">Les Fondateurs</h2>
            <div class="row justify-content-center">

                <!-- Fondateur 1 -->
                <div class="col-md-4 text-center mb-4" data-aos="fade-right">
                    <img src="./img/fond1.jpg" class="rounded-circle mb-3" width="200" alt="Fondateur 1">
                    <h5 style="color: white;">KOUA Yves Olivier</h5>
                    <p class="text-muted">Co-fondateur & Responsable Marketing</p>
                </div>
                <!-- Fondateur 2 -->
                <div class="col-md-4 text-center mb-4" data-aos="fade-left">
                    <img src="./img/fond2.jpg" class="rounded-circle mb-3" width="200" alt="Fondateur 2">
                    <h5 style="color: white;">KAKOU Amoin Dolorès</h5>
                    <p class="text-muted" style="color:rgb(227, 106, 20);">Co-fondatrice & Directrice Générale</p>
                </div>

                <!-- Ajoute d'autres fondateurs si nécessaire -->
            </div>
        </div>
    </div>


    <?php include './includes/footer.php'; // Inclure le footer 
    ?>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>