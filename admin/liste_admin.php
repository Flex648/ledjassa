<?php

include(__DIR__ . '/../config/bd.php');

try {
    $sql = "SELECT * FROM t_admin ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pro = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de récupération des administrateurs : " . $e->getMessage();
}


?>


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

        .table-container {
            width: 80%;
            overflow-x: auto;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th,
        td {
            font-size: 16px;
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: rgb(1, 41, 109);
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <div class="table-container align-items-center mt-5 ms-5 ">
        <h2 style="font-weight: 600;" data-aos="fade-in">LISTE DES COMMANDES</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom d'utilisateur</th>
                    <th>Mot de passe</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pro as $pros): ?>
                    <tr>
                        <td><?= $pros['id'] ?></td>
                        <td><?= htmlspecialchars($pros['username']) ?></td>
                        <td><?= htmlspecialchars($pros['password']) ?></td>
                        <td>
                            <a href="modifier_admin.php?id=<?= $pros['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </td>
                        <td>
                            <a href="supprimer_admin.php?id=<?= $pros['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <a href="addadmin.php" target="contenuframe" class="btn btn-sm" style="font-size: 21px; background-color: rgb(1, 41, 109);color:white">
            <i class="fas fa-add"></i> Ajouter un adminstrateur
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