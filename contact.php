<?php
include './includes/header.php';
include './config/bd.php';

// Récupération des produits
$sql = "SELECT * FROM t_produit";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
$success = false;

if (isset($_POST["envoyer"])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO t_message (nom, email, message, date) 
            VALUES (:nom, :email, :message, :date)";
    $req = $conn->prepare($sql);
    if ($req->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':message' => $message,
        ':date' => $date
    ])) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/aos.css" />
    <script src="./js/aos.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>


    <style>
        body {
            background-color: #EAEAEA;
            font-family: 'Montserrat', sans-serif;
            background-image: url(./img/bggg.png);

        }

        .alert-centered {
            z-index: 1055;
            max-width: 400px;
        }
    </style>
</head>

<body>

    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed top-50 start-50 translate-middle text-center alert-centered shadow" role="alert">
            <dotlottie-player
                src="https://lottie.host/c2fd7326-d2ba-4d88-9aac-d9d88558f6e2/WcykUy84At.lottie"
                background="transparent"
                speed="1"
                style="width: 200px; height: auto"
                loop
                autoplay></dotlottie-player>

            ✅ Votre message a bien été envoyé !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php endif; ?>

    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4" style="font-weight:700; color:rgb(255, 255, 255); text-shadow : 0px 3px 5px black" data-aos="fade-in"> <br> Contactez-nous</h1>
        <p class="text-center mb-5 fs-5" style="color:white;" data-aos="fade-up">Une idée, une remarque, une suggestion ? N'hésitez pas à nous écrire !</p>

        <div class="row justify-content-center">
            <!-- Formulaire de contact -->
            <div class="col-md-7">
                <form method="POST" action="" data-aos="fade-left">
                    <div class="mb-3">
                        <label for="nom" class="form-label" style="font-size: 23px; font-weight:500; color:rgb(198, 198, 198)">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required style="background-color:rgb(255, 255, 255);">

                    </div>

                    <div class=" mb-3">
                        <label for="email" class="form-label" style="font-size: 23px; font-weight:500; color:rgb(198, 198, 198)">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required style="background-color:rgb(255, 255, 255);">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label" style="font-size: 23px; font-weight:500; color:rgb(198, 198, 198)">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required style="background-color:rgb(255, 255, 255);"> </textarea>
                    </div>

                    <button type="submit" name="envoyer" class="btn btn-primary w-100" style="background-color:#c37807; border:none; font-size:25px; font-weight:bold;">Envoyer</button>
                </form>
            </div>

            <!-- Carte de contact -->
            <div class="col-md-4 mt-4 mt-md-0" data-aos="zoom-out">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Nos coordonnées</h5>
                        <p><strong>📍 Adresse :</strong> Abidjan, Côte d’Ivoire</p>
                        <p><strong>📞 Téléphone :</strong> +225 07 47 39 79 57</p>
                        <p><strong>📧 Email :</strong> contact@ledjassa.ci</p>
                        <p><strong>⏰ Heures :</strong> Lun - Sam, 8h à 18h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });

        // Fermeture automatique de l'alerte après 5 secondes
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 1000);
            }
        }, 5000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>