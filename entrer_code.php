<?php
include('./config/bd.php');
$telephone = $_GET['telephone'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vérification du code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">

    <div class="card p-4 shadow" style="width: 400px;">
        <h4 class="text-center mb-3">🔐 Entrez le code de vérification</h4>

        <form method="POST" action="valider_code_sms.php">
            <input type="hidden" name="telephone" value="<?= htmlspecialchars($telephone) ?>">

            <div class="mb-3">
                <label for="code" class="form-label">Code reçu par SMS :</label>
                <input type="text" name="code" id="code" required maxlength="6" pattern="\d{6}" class="form-control" placeholder="Ex: 123456">
            </div>

            <button type="submit" class="btn btn-success w-100">Vérifier le code</button>
        </form>
    </div>

</body>

</html>