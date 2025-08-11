<?php
// ajax_recherche.php

// Affiche les erreurs PHP pour débug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion à la BDD (adapte le chemin)
include(__DIR__ . '/config/bd.php');

// Récupérer la query "q"
$q = $_GET['q'] ?? '';
$q = trim($q);

// Si la chaîne est trop courte, renvoyer tableau vide
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

// Préparer et exécuter la requête SQL
$sql = "SELECT id, nom, prix, photo FROM t_produit WHERE nom LIKE :q LIMIT 10";
$req = $conn->prepare($sql);
$req->execute(['q' => "%$q%"]);

// Récupérer les résultats
$produits = $req->fetchAll(PDO::FETCH_ASSOC);

// Ajouter un champ 'image' complet pour afficher la photo côté client (adapte le chemin)
foreach ($produits as &$prod) {
    $prod['image'] = 'img/' . $prod['photo'];
}

// Retourner les résultats JSON
header('Content-Type: application/json');
echo json_encode($produits);
