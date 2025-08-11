<?php
// Informations de connexion
$host = 'localhost'; // Hôte de la base de données
$dbname = 'bd_djassa'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe

// DSN (Data Source Name) pour PDO
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Création de l'objet PDO
    $conn = new PDO($dsn, $username, $password);

    // Configuration du mode d'erreur de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "";
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Échec de la connexion : " . $e->getMessage();
}
