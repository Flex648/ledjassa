<?php
session_start();
include './config/bd.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($username && $password) {
        try {
            // Préparer la requête SQL pour récupérer l'utilisateur
            $sql = "SELECT id_user, username, password FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':username' => $username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user['password'])) {
                // Authentifier l'utilisateur
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username']; // Stocker également le nom d'utilisateur si nécessaire
                $_SESSION['loggedin'] = true; // Marquer l'utilisateur comme connecté

                $redirectUrl = 'produit_details.php';
                if (isset($_GET['id_user'])) {
                    $redirectUrl .= '?id=' . urlencode($_GET['id_user']);
                }
                header('Location: ' . $redirectUrl);
                exit; // Assurez-vous de l'appel de exit pour éviter toute exécution de code après la redirection
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion : " . htmlspecialchars($e->getMessage());
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Connexion</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="login.php<?php echo isset($_GET['id_user']) ? '?id=' . urlencode($_GET['id_user']) : ''; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
            <a href="register.php" class="btn btn-secondary">S'inscrire</a>
        </form>
    </div>
</body>

</html>