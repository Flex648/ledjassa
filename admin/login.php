<?php
session_start();
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = sha1(trim($_POST['password']));

    $stmt = $conn->prepare("SELECT * FROM t_admin WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    /* var_dump($username, $password, $admin);
    exit; */


    if ($admin) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?error=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url(../img/adn-01.png);
        }
    </style>

</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-3" style="font-weight: 600;">CONNEXION ADMIN</h3>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Pseudo ou mot de passe incorrect</div>
        <?php endif; ?>
        <form method="post" action="login.php" class="text-center">
            <div class="mb-3 text-center">
                <label for="Username" class="form-label" style="font-size: 22px;">Username</label>
                <input type="text" name="username" class="form-control" required autofocus style="border: 2px solid rgb(1, 44, 109);">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="font-size: 22px;">Mot de passe</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required style="border: 2px solid rgb(1, 44, 109);">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                        <i id="toggleIcon" class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn w-50" style="background-color :rgb(1, 44, 109); color : white; font-size: 22px;">Se connecter</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var icon = document.getElementById("toggleIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

</body>

</html>