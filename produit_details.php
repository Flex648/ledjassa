<?php


include './config/bd.php';

// Récupérer l'identifiant du produit depuis l'URL
$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$product_id) {
    echo "Identifiant de produit invalide.";
    exit;
}

try {
    // Préparer la requête SQL pour récupérer les détails du produit
    $sql = "SELECT * FROM t_produit WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Produit non trouvé.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur de requête SQL : " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/aos.css">
    <script src="./js/aos.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

</head>


<body style="background-image: url(./img/fdpu.png);">
    <?php include './includes/header.php'; ?>

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-5 mt-1" data-aos="fade-up">
                <img src="admin/upload/<?php echo htmlspecialchars($product['photo']); ?>" width='700' class="img-fluid" alt="<?php echo htmlspecialchars($product['nom']); ?>">
            </div>
            <div class="col-md-5 mt-5">
                <h1 style="font-size: 50px; font-style:italic" data-aos="fade-left"><?php echo htmlspecialchars($product['nom']); ?></h1>
                <p id="prix-produit" style="font-size: 35px; font-weight:bold" data-aos="fade-left">
                    Prix : <span id="prix-total"><?php echo htmlspecialchars($product['prix']); ?></span> FCFA
                </p>
                <p style="font-size: 25px; color: rgb(205, 103, 2)" data-aos="fade-left">Catégorie : <?php echo ucfirst(htmlspecialchars($product['categorie'])); ?></p>

                <form action="suite_produit_detail.php" method="get" data-aos="zoom-in">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">

                    <div class="mb-3">
                        <label for="size" class="form-label" style="font-weight: 500; font-size:25px">Taille</label>
                        <select id="size" name="size" class="form-select" style="border: 2px solid rgb(208, 105, 1);">
                            <option value="30">30</option>
                            <option value="32">32</option>
                            <option value="34">34</option>
                            <option value="36">36</option>
                            <option value="38">38</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label" style="font-weight: 500; font-size:25px; ">Quantité</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1"
                            style="border: 2px solid rgb(208, 105, 1); outline : none;"
                            data-prix="<?php echo htmlspecialchars($product['prix']); ?>">
                    </div>

                    <button type="submit" class="btn btn-primary shadow" style="background-color:rgb(25, 48, 98); border:none; font-size:25px; font-weight:500">Commander</button>
                </form>
            </div>
        </div>
        <p><br><br></p>
    </div>

    <?php include './includes/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const prixTotal = document.getElementById('prix-total');

            const prixUnitaire = parseFloat(quantityInput.dataset.prix);

            quantityInput.addEventListener('input', function() {
                let quantite = parseInt(this.value);
                if (isNaN(quantite) || quantite < 1) quantite = 1;
                const total = prixUnitaire * quantite;
                prixTotal.textContent = total.toLocaleString(); // format "1 000"
            });
        });
    </script>


</body>


</html>