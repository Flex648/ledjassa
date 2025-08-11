<?php
include(__DIR__ . '/../config/bd.php');

$sql = "SELECT * FROM t_info";
$req = $conn->prepare($sql);
$req->execute();
$message = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Le Djassa</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="./img/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#8B5300">


    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding-top: 100px;
        }

        .navbar {
            background-color: rgb(139, 83, 0);
        }

        .info {
            position: relative;
            width: 100%;
            height: 60px;
            overflow: hidden;
        }

        .info img {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .info marquee {
            position: relative;
            z-index: 2;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            line-height: 100px;
            background-color: rgb(92, 45, 0);
            text-shadow: 0px 1px 5px black;
        }

        .navbar .nav-item:hover {
            border-bottom: 3px solid white;
            transition: 0.1s;
        }

        .cart-icon {
            position: relative;
            z-index: 1000;
            color: white;
            font-size: 2rem;
            transition: 0.2s;
        }

        .cart-icon:hover {
            transform: scale(1.2);
            color: white;
            text-shadow: 0px 1px 5px rgba(0, 0, 0, 0.78);
        }

        .search-container {
            background-color: rgba(223, 223, 223, 0.8);
        }

        #resultats-recherche {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            z-index: 1000;
            max-height: 350px;
            overflow-y: auto;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #resultats-recherche .produit {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        #resultats-recherche .produit:hover {
            background-color: #f0f0f0;
        }

        #resultats-recherche img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light px-3 shadow fixed-top">
        <a class="navbar-brand ms-5" href="index.php">
            <img src="img/logo2.png" alt="Logo" width="200">
        </a>

        <!-- Bouton burger -->
        <button id="custom-toggler" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggler = document.getElementById('custom-toggler');
                const navbarContent = document.getElementById('navbarContent');

                // Clic sur le bouton pour afficher ou cacher
                toggler.addEventListener('click', function() {
                    navbarContent.classList.toggle('show'); // Ajoute/enlève la classe Bootstrap "show"
                });

                // Clic sur un lien : fermer le menu si ouvert
                const navLinks = document.querySelectorAll('.navbar-collapse .nav-link');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (navbarContent.classList.contains('show')) {
                            navbarContent.classList.remove('show');
                        }
                    });
                });
            });
        </script>


        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>