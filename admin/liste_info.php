<?php
include('../config/bd.php');

// Requête pour récupérer les infos
$stmt = $conn->query("SELECT * FROM t_info ORDER BY id DESC");
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des informations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>
</head>

<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }
</style>

<body>
    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight: 600;" data-aos="fade-in">LISTE DES INFORMATIONS</h2>

        <?php if (count($infos) > 0): ?>
            <table class="table table-bordered table-striped" data-aos="fade-up">
                <thead class="table" style="background-color: rgb(1, 41, 109); color: white">
                    <tr>
                        <th>#</th>
                        <th>Information</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($infos as $info): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($info['id']); ?></td>
                            <td><?php echo htmlspecialchars($info['info']); ?></td>
                            <td> <a href="edit_info.php?id=<?php echo $info['id']; ?>" class="btn btn-sm" style="background-color:rgb(1, 41, 109);color:white; font-size:22px;">Modifier</a>
                            <td> <a href="delete_info.php?id=<?php echo $info['id']; ?>" class="btn btn-sm" style="background-color: rgba(1, 22, 59, 1); color:white; font-size:22px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette info ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" data-aos="fade-up">Aucune information trouvée.</div>
        <?php endif; ?>

        <a href="ajoutinfo.php" class="btn btn-sm mt-3" style="background-color: rgb(1, 41, 109); color:white;font-size:22px" data-aos="zoom-out">
            Ajouter une nouvelle information
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