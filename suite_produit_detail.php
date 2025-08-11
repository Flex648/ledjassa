<?php
include './includes/header.php'; // Inclure le header
?>


<?php
// Récupération des données du produit via GET
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
$size = filter_input(INPUT_GET, 'size', FILTER_SANITIZE_STRING);
$quantity = filter_input(INPUT_GET, 'quantity', FILTER_VALIDATE_INT);
$prix = filter_input(INPUT_GET, 'prix', FILTER_VALIDATE_INT);

// Connexion BDD
include './config/bd.php';

if (!$product_id) {
    echo "Produit introuvable.";
    exit;
}

$sql = "SELECT * FROM t_produit WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Produit introuvable.";
    exit;
}

$categorie = $product['categorie'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="./css/aos.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/aos.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        LABEL {
            font-size: 20px;
            font-weight: bold;
        }

        #map {
            height: 300px;
            width: 100%;
            margin-bottom: 10px;
        }
    </style>


</head>

<body style="background-image: url(./img/fdpu.png);">

    <div class="container mt-5">
        <div class="row">
            <!-- Colonne gauche : infos client -->
            <div class="col-md-6">
                <h2 class="mb-4" data-aos="fade-right" style="font-weight: bold;">INSEREZ VOS INFORMATIONS</h2>

                <form action="valider_commande.php" method="post" data-aos="fade-up">
                    <!-- Infos client -->
                    <div class="row mb-3">
                        <div class="col">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control" required style="background-color: #f5f5f5; border: 1px solid rgb(208, 105, 1)">
                        </div>
                        <div class="col">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control" required style="background-color: #f5f5f5; border: 1px solid rgb(208, 105, 1)">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            title="Entrez une adresse email valide" style="background-color: #f5f5f5; border: 1px solid rgb(208, 105, 1)" />
                    </div>
                    <div class="mb-3">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" class="form-control" required
                            pattern="^\+2250[1-9]\d{7,8}$"
                            placeholder="+225102030405"
                            title="Entrez un numéro ivoirien au format +225 suivi de 8 ou 9 chiffres, sans zéro après +225"
                            style=" background-color: #f5f5f5; border: 1px solid rgb(208, 105, 1) ">
                    </div>
                    <div class="mb-3">
                        <label>Localisation</label>
                        <input type="text" name="localisation" class="form-control" style="background-color: #f5f5f5; border: 1px solid rgb(208, 105, 1)">
                    </div>
                    <div class="mb-3">
                        <h3>Localisation</h3>
                        <div id="map" style="border:3px solid rgb(208, 105, 1);"></div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <p id="coordonnees"></p>
                    </div>

                    <!-- Infos produit -->
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="product_name" value="<?= $product['nom'] ?>">
                    <input type="hidden" name="prix" value="<?= $product['prix'] ?>">
                    <input type="hidden" name="photo" value="<?= $product['photo'] ?>">
                    <input type="hidden" name="categorie" value="<?= $product['categorie'] ?>">
                    <input type="hidden" name="taille" value="<?= htmlspecialchars($size) ?>">
                    <input type="hidden" name="quantite" value="<?= htmlspecialchars($quantity) ?>">
                    <input type="hidden" name="categorie" value="<?= htmlspecialchars($categorie) ?>">

                    <div class="mb-3" style="background-color:rgb(175, 88, 1); border-radius:10px;color:white; text-shadow:0px 3px 5px black; border: 1px solid rgb(208, 105, 1)">
                        <strong>&nbsp;&nbsp;&nbsp; Produit :</strong> <?= $product['nom'] ?>
                        <strong>&nbsp;&nbsp;&nbsp; Prix :</strong> <?= $product['prix'] * $quantity ?> FCFA
                        <strong>&nbsp;&nbsp;&nbsp; Taille :</strong> <?= htmlspecialchars($size) ?><br>
                        <strong>&nbsp;&nbsp;&nbsp; Quantité :</strong> <?= htmlspecialchars($quantity) ?>
                        <strong>&nbsp;&nbsp;&nbsp; Catégorie :</strong> <?= htmlspecialchars($categorie) ?>
                    </div>

                    <button type="submit" class="btn btn-success" style="background-color:rgb(25, 48, 98); border:none;font-size:25px">Valider la commande</button>
                </form>
            </div>

            <!-- Colonne droite : image du produit -->
            <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: none;">
                <img src="admin/upload/<?= htmlspecialchars($product['photo']) ?>" class="img-fluid rounded " alt="<?= htmlspecialchars($product['nom']) ?>" style="max-height: auto;">
            </div>
        </div>
    </div>

</body>

</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([5.35, -4.02], 13); // Ex : Abidjan
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Affiche la position
        document.getElementById('coordonnees').textContent = "Latitude : " + lat.toFixed(6) + ", Longitude : " + lng.toFixed(6);

        // Remplit les champs cachés
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // Place ou remplace le marqueur
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
<?php
include './includes/footer.php'; // Inclure le footer
?>