<?php

include(__DIR__ . '/../config/bd.php');

if (isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Hashage avec sha1
    $password = sha1($password);

    $stmt = $conn->prepare("INSERT INTO t_admin (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Nouvel admin ajouté avec succès !";
        echo '<a href="addadmin.php">Retour</a>';
    } else {
        echo "Erreur lors de l'ajout.";
    }
}
