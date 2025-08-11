<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>

    <title>Document</title>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

</head>

<body>


    </form>

    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight: 600;" data-aos="fade-in">AJOUTER UN PRODUIT</h2>
        <form action="scriptadd.php" method="POST" enctype="multipart/form-data" data-aos="fade-right">
            <LAbel style="font-size: 22px;">Nom</LAbel><br>
            <input type="text" name="nom" style="width: 50%; border: 2px solid rgb(1, 41, 109)"> <BR><BR>

            <LAbel style="font-size: 22px;">Photo</LAbel><br>
            <input type="file" name="photo"> <BR><BR>

            <LAbel style="font-size: 22px;">Prix</LAbel><br>
            <input type="text" name="prix" style="width: 50%; border: 2px solid rgb(1, 41, 109)"> <BR><BR>

            <label for="categorie" class="form-label" style="font-size: 22px;">Catégorie</label><BR>
            <select class="form-select" name="categorie" id="categorie" style="width: 50%; border: 2px solid rgb(1, 41, 109)" required>
                <option value="" selected disabled>-- Choisissez une catégorie --</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select> <BR>

            <button type="submit" name="submit" class="btn" style="font-size: 22px; background-color: rgb(1, 41, 109); color : white">Ajouter</button>

        </form>
        <br>
        <a href="produit.php" target="contenuframe" class="btn btn-sm" style="font-size: 22px; background-color: rgba(1, 22, 59, 1); color:white">
            <i class="fas fa-add"></i> Liste des produits
        </a>

    </div>


    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>


</body>

</html>