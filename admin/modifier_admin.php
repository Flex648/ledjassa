<?php
include(__DIR__ . '/../config/bd.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID invalide.";
    exit();
}

$id = (int) $_GET['id'];

// Récupération des données existantes
try {
    $stmt = $conn->prepare("SELECT * FROM t_admin WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        echo "Administrateur non trouvé.";
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // À hasher si besoin

    try {
        $stmt = $conn->prepare("UPDATE t_admin SET username = :username, password = :password WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'id' => $id
        ]);

        header("Location: liste_admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}
?>

<!-- Formulaire HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Administrateur</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body class="container mt-5">
    <h2>Modifier Administrateur</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="text" name="password" id="password" class="form-control" value="<?= htmlspecialchars($admin['password']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="liste_admin.php" class="btn btn-secondary">Annuler</a>
    </form>
</body>

</html>