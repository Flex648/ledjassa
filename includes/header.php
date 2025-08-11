<?php
include(__DIR__ . '/../config/bd.php');

$sql = "SELECT * FROM t_info";
$req = $conn->prepare($sql);
$req->execute();
$message = $req->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Le Djassa</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="./img/logo_new.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">




    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding-top: 100px;
            /* pour ne pas que le contenu soit masqué sous la navbar */
            background-image: url(./img/bgi.png);
        }


        .navbar {
            background-color: rgb(139, 83, 0);
        }

        .info {
            position: relative;
            width: 100%;
            height: 60px;
            /* Hauteur de la barre */
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
            font-style: italic;
            font-weight: medium;
            line-height: 100px;
            background-color: rgb(42, 23, 2);
            text-shadow: 0px 1px 5px black;
            /* Optionnel : fonce légèrement le fond pour lisibilité */
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
            background-color: rgb(0, 57, 144);
        }

        #resultats-recherche {
            position: absolute;
            top: 140px;
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

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light  px-3 shadow fixed-top">

        <a class="navbar-brand ms-5" href="index.php">
            <img src="img/logo_new.png" alt="Logo" width="200">
        </a>

        <!-- Bouton burger -->
        <button id="custom-toggler" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">

            <!-- Liens -->
            <ul class="navbar-nav mb-1 ms-5 mb-lg-0 me-3 fs-5">
                <li class="nav-item me-5">
                    <a class="nav-link" style="color:white; font-weight:500; font-weight:500;text-shadow: 0px 2px 5px black;" href="index.php"><i class="fas fa-store" style="color:rgb(228, 228, 228);"></i> LE DJASSA</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link" href="produits.php" style="color:white;font-weight:500;text-shadow: 0px 2px 5px black;"><i class="fas fa-shirt" style="color:rgb(228, 228, 228);"></i> &nbsp;Produits</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link " href="apropos.php" style="color:white;font-weight:500;text-shadow: 0px 2px 5px black;"><i class="fas fa-info-circle" style="color:rgb(228, 228, 228);"></i> &nbsp;À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contact.php" style="color:white;font-weight:500;text-shadow: 0px 2px 5px black;"><i class="fas fa-envelope" style="color:rgb(228, 228, 228);"></i>&nbsp;Contact</a>
                </li>
            </ul>

            <!-- Recherche -->
            <div class="search-container ms-2" style="position: relative; max-width: 250px; margin-right : 50px">
                <form class="d-flex" onsubmit="return false;">
                    <input class="form-control me-2" id="search-input" type="search" placeholder="Rechercher un produit..." name="q">
                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass" style="color:rgb(255, 255, 255);"></i></button>
                </form>
            </div>

            <div class="card-icon">
                <a href="panier_end.php" style="color:rgb(255, 255, 255); font-size:35px; margin-right : 50px;">
                    <i class="fas fa-shopping-cart"></i>
                </a>

            </div>


            <!-- Résultats de recherche (masqué par défaut) -->
            <div id="resultats-recherche" style="display:none;">
                <span id="close-search" style="position:absolute;top:5px;right:10px;font-size:20px;cursor:pointer;">&times;</span>
                <div id="contenu-resultats"></div>



            </div>

    </nav>

    <!-- ZONE INFO juste en dessous de la navbar -->
    <nav class="info mt-2 fixed">
        <img src="../img/des.png" alt="fond">
        <marquee scrollamount="20">
            <?php foreach ($message as $messages): ?>
                <?php echo $messages["info"]; ?> —
            <?php endforeach; ?>
        </marquee>
    </nav>
    <!-- Script de clignotement -->
    <script>
        const div = document.querySelector('.d-flex.me-5');

        setInterval(() => {
            div.style.visibility = 'hidden';
            setTimeout(() => {
                div.style.visibility = 'visible';
            }, 500);
        }, 5000);
    </script>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('search-input');
            const resultatsDiv = document.getElementById('resultats-recherche');
            const contenuResultats = document.getElementById('contenu-resultats');
            const closeBtn = document.getElementById('close-search');

            // Masquer au départ
            resultatsDiv.style.display = 'none';

            input.addEventListener('input', function() {
                const query = this.value.trim();

                if (query.length < 2) {
                    resultatsDiv.style.display = 'none';
                    contenuResultats.innerHTML = '';
                    return;
                }

                fetch('ajax_recherche.php?q=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        contenuResultats.innerHTML = '';
                        if (data.length === 0) {
                            contenuResultats.innerHTML = '<p class="p-2">Aucun résultat trouvé</p>';
                        } else {
                            data.forEach(produit => {
                                const produitHtml = `
  <div class="produit" onclick="window.location.href='produit_details.php?id=${produit.id}'">
      <img src="./admin/upload/${produit.photo}" alt="${produit.nom}">
      <strong>${produit.nom}</strong> - ${produit.prix} F
  </div>`;
                                contenuResultats.innerHTML += produitHtml;
                            });
                        }
                        resultatsDiv.style.display = 'block';
                    })
                    .catch(error => {
                        contenuResultats.innerHTML = '<p class="p-2">Erreur de chargement</p>';
                        resultatsDiv.style.display = 'block';
                    });
            });

            // Bouton de fermeture
            closeBtn.addEventListener('click', () => {
                resultatsDiv.style.display = 'none';
                contenuResultats.innerHTML = '';
                input.value = '';
            });
        });
    </script>

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


</body>

</html>