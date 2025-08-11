<?php
include(__DIR__ . '/../config/bd.php');

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">

    <title>Produits</title>
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            /* Espace entre les éléments */
        }

        .product-card {
            flex: 1 1 calc(33.333% - 16px);
            /* 3 éléments par ligne avec un écart de 16px */
            box-sizing: border-box;
            border-radius: 8px;
            overflow: hidden;
            padding: 16px;
            background-color: #fff;
            text-align: center;
        }

        .product-card img {
            max-width: 80%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .product-card .card-body {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="product-container">
        <?php foreach ($prod as $prods): ?>
            <div class="product-card">
                <img src="upload/<?php echo htmlspecialchars($prods["photo"]); ?>" alt="Card image">
                <div class="card-body">
                    <h4 class="card-title"><?php echo htmlspecialchars($prods["nom"]); ?></h4>
                    <p class="card-text"><?php echo htmlspecialchars($prods["prix"]); ?>FCFA</p>
                    <button class="btn" style="background-color: rgb(1, 41, 109);color:white; font-weight:600" onclick="document.getElementById('modif-<?php echo $prods['id']; ?>').style.display = 'block'">Modifier</button>
                    <button class="btn" style="background-color: rgb(1, 22, 59, 1);color:white; font-weight:600" onclick="document.getElementById('delete-<?php echo $prods['id']; ?>').style.display = 'block'">Supprimer</button>

                    <div id="modif-<?php echo $prods['id']; ?>" style="display:none">
                        <form action="edit-produit.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="id-<?php echo $prods['id']; ?>" name="id" value="<?php echo $prods["id"]; ?>">
                            <input type="text" name="nom" value="<?php echo $prods["nom"]; ?>" id="<?php echo $prods['id']; ?>" placeholder="Entrez nouveau nom">
                            <input type="text" name="prix" value="<?php echo $prods["prix"]; ?>" id="<?php echo $prods['id']; ?>" placeholder="Entrez nouveau prix">
                            <input type="file" name="photo" id="<?php echo $prods['id']; ?>">
                            <button type="submit" name="submit">Modifier</button>
                        </form>

                    </div>
                    <div id="delete-<?php echo $prods['id']; ?>" style="display:none">
                        <form action="delete-produit.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $prods["id"]; ?>">
                            <input type="submit" name="delete" class="btn btn-danger mt-2" value="Confirmer la suppression">
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>