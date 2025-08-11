<?php
include '../config/bd.php';

// Récupération des messages
$sql = "SELECT * FROM t_message ORDER BY date DESC";
$req = $conn->prepare($sql);
$req->execute();
$messages = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Messages reçus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight:700;" data-aos="fade-in"> MESSAGES RECUS</h2>

        <?php if (count($messages) > 0): ?>
            <div class="table-responsive" data-aos="fade-up">
                <table class="table table-bordered table-striped">
                    <thead class="table" style="background-color: rgb(1, 41, 109); color:white">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $i => $msg): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars($msg['nom']); ?></td>
                                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($msg['message'])); ?></td>
                                <td><?php echo htmlspecialchars($msg['date']); ?></td>
                                <td>
                                    <a href="delete_message.php?id=<?php echo $msg['id']; ?>"
                                        class="btn btn-sm" style="background-color: rgba(1, 22, 59, 1); color:white"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info" data-aos="fade-up">Aucun message reçu pour le moment.</div>
        <?php endif; ?>

        <a href="contact.php" class="btn mt-3" style="background-color: rgba(1, 22, 59, 1); color:white; font-size:22px">⬅ Retour au formulaire de contact</a> <br><br>
    </div>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>