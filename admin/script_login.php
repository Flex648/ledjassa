<?php
/* session_start();
include(__DIR__ . '/../config/bd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Requête sécurisée avec paramètre
    $stmt = $conn->prepare("SELECT * FROM t_admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id']; // ou $admin['username'] selon ce que tu veux
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Identifiants incorrects.";
    } 
} */
