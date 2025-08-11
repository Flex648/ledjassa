<?php
include('../config/bd.php');

if (!isset($_GET['id'])) {
    header("Location: liste_info.php");
    exit;
}

$id = (int)$_GET['id'];

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newInfo = trim($_POST['info']);

    $stmt = $conn->prepare("UPDATE t_info SET info = :info WHERE id = :id");
    $stmt->bindParam(':info', $newInfo, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: liste_info.php");
    exit;
}

// Sinon, on récupère l'info pour l'afficher dans le formulaire
$stmt = $conn->prepare("SELECT * FROM t_info WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$info = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$info) {
    header("Location: liste_info.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>

    <title>Modifier une information</title>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight: 600;" data-aos="fade-in">Modifier l'information</h2>
        <form method="post" data-aos="fade-right">
            <div class="mb-3">
                <label class="form-label" style="font-size: 22px;">Information</label>
                <textarea name="info" class="form-control" rows="4" required><?php echo htmlspecialchars($info['info']); ?></textarea>
            </div>
            <button type="submit" class="btn" style="background-color: rgb(1, 41, 109 ); color:white">Enregistrer</button>
            <a href="liste_info.php" class="btn" style="background-color: rgba(1, 22, 59, 1); color:white">Annuler</a>
        </form>
    </div>


    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

</body>

</html>