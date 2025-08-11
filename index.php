<?php
include './includes/header.php';
include('./config/bd.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Le Djassa - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles & Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/aos.css">
    <script src="./js/aos.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            height: 50vh;
            overflow: hidden;
        }

        .carousel-inner img {
            height: 50vh;
            object-fit: cover;
        }

        #para {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            font-weight: bolder;
            color: white;
            font-size: 30px;
            letter-spacing: 3px;
            text-align: center;
            width: 100%;
            pointer-events: auto;
        }

        .shadow {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        #caro {
            background-color: white;
        }

        /* Popup de bienvenue */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('./img/popup-bg.jpg') center/cover no-repeat rgba(0, 0, 0, 0.1);
            background-blend-mode: darken;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 600px;
            height: auto;
            color: white;
            position: relative;
        }

        .btn-close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            color: white;
            cursor: pointer;
        }

        .clients-banner {
            background-image: url('./img/fg5.jpg');
            /* Remplace avec ton image */
            background-size: cover;
            background-position: center;
            height: 200px;
            width: 100%;
            position: relative;
            margin-top: 60px;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.4);
            /* assombrit légèrement */
        }

        .counter-badge {
            display: inline-block;
            padding: 5px 12px;
            border: 3px solid #8b4e00;
            text-shadow: 3px 2px 2px rgba(0, 0, 0, 0.76);
            /* jaune doré */
            border-radius: 12px;
            letter-spacing: 5px;
            color: white;
            font-weight: bold;
            background: #8b4e00;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>

    <!-- Popup de bienvenue -->
    <div id="popupBienvenue" class="popup-overlay">
        <div class="popup-content shadow-lg" style="background-image: url(./img/ph9.png);">
            <span class="btn-close-popup" onclick="fermerPopup()">×</span>
            <h2 class="text-white mb-3">Bienvenue sur Le Djassa !</h2>
            <p class="text-white">Profitez de nos meilleures offres sur les pantalons de qualité !</p>
            <a href="produits.php" class="btn mt-3" style="background-color:rgb(195, 118, 2); font-weight:bold; color:white">Voir les produits</a>
        </div>
    </div>

    <!-- Carousel -->
    <div class="carousel-container shadow">
        <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active">
                    <img src="./img/fd5.png" class="d-block w-100" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="./img/a6.png" class="d-block w-100" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="./img/a9.png" class="d-block w-100" alt="Image 3">
                </div>
            </div>
        </div>

        <!-- Overlay Text and Buttons -->
        <div id="para">
            <p class="fs-2 fw-semibold" style="text-shadow: 1px 3px 5px rgb(50, 23, 3);" data-aos="zoom-in">
                DÉCOUVREZ LES PRODUITS UNIQUES DU DJASSA !<br>
            </p>
            <a href="produits.php" class="btn shadow me-2" style="background-color:rgb(11, 55, 142); color:white; font-size:25px;letter-spacing:0px" data-aos="fade-left">
                <i class="fas fa-shopping-cart me-2"></i> Acheter maintenant
            </a>

            <a href="produits.php" class="btn shadow" style="border: 0.5px solid rgb(160, 88, 0); background-color: rgb(160, 88, 0); backdrop-filter:blur(5px);  color:white; font-size:25px;letter-spacing:0px" data-aos="fade-right">
                <i class="fas fa-phone-alt me-2"></i> Contactez-nous
            </a>
        </div>
    </div>

    <!-- Avantages -->
    <section class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded h-100 " id="caro" style="border-radius:45px;">
                    <dotlottie-player src="https://lottie.host/043ef191-b5fd-424d-a658-0fd5cde1c0de/Pw9p8Qxxc0.lottie" background="transparent" speed="1" style="width: 120px; height: auto; margin: 0 auto" loop autoplay></dotlottie-player>
                    <h5 class="mt-3" style="font-size: 25px; font-weight:bold; " data-aos="fade-in">Livraison rapide</h5>
                    <p data-aos="fade-in">Recevez vos commandes en un temps record partout où vous êtes.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded h-100 " id="caro" style="border-radius:55px;background-color:rgb(255, 255, 255)">
                    <dotlottie-player src="https://lottie.host/929fc1b7-4efc-4708-8ab1-d4e01c67bb62/ZGIWb8CmWd.lottie" background="transparent" speed="1" style="width: 120px; height: auto; margin: 0 auto" loop autoplay></dotlottie-player>
                    <h5 class="mt-3" style="font-size: 25px; font-weight:bold" data-aos="fade-in">Haute qualité</h5>
                    <p data-aos="fade-in">Nos pantalons sont soigneusement sélectionnés pour garantir durabilité et style.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 rounded h-100" id="caro" style="border-radius:55px;">
                    <dotlottie-player src="https://lottie.host/78c4a2cb-88d1-4082-ad7c-469d7c5fee00/bNgCYuRvv8.lottie" background="transparent" speed="1" style="width: 180px; height: auto; margin: 0 auto" loop autoplay></dotlottie-player>
                    <h5 class="mt-3" style="font-size: 25px; font-weight:bold" data-aos="fade-in">Paiement sécurisé</h5>
                    <p data-aos="fade-in">Payez en toute sécurité avec nos méthodes de paiement fiables et protégées.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="clients-banner d-flex align-items-center justify-content-center text-white">
        <div class="text-center">
            <h2 class="fw-bold" style="font-size: 2.2rem;">
                + <span id="counter" data-target="250" class="counter-badge">0</span> clients satisfaits...
            </h2>
            <p style="font-size: rem; letter-spacing:10px">Merci pour votre confiance !</p>
            <a href="contact.php" class="btn" style="background-color:rgb(0, 69, 118); color:white; font-weight:bold; letter-spacing:5px">Avez-vous des suggestions ?</a>
        </div>

    </section>


    <!-- Footer -->
    <?php include './includes/footer.php'; ?>

    <!-- Bootstrap & AOS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counter = document.getElementById('counter');
            const target = parseInt(counter.getAttribute('data-target'), 10);
            let animationFrame;

            function startCounting() {
                let count = 0;
                const increment = target / 100;
                cancelAnimationFrame(animationFrame); // stop old loop if any

                function updateCounter() {
                    count += increment;
                    if (count < target) {
                        counter.textContent = Math.floor(count);
                        animationFrame = requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                }

                counter.textContent = '0';
                updateCounter();
            }

            // Premier lancement
            startCounting();

            // Répéter toutes les 5 secondes
            setInterval(() => {
                startCounting();
            }, 10000);
        });
    </script>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });

        // Popup de bienvenue après 3 secondes
        function fermerPopup() {
            document.getElementById("popupBienvenue").style.display = "none";
        }

        window.onload = function() {
            setTimeout(function() {
                document.getElementById("popupBienvenue").style.display = "flex";
            }, 2000); // 3 secondes
        };
    </script>

</body>

</html>