<?php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $suivi_commande = filter_input(INPUT_POST, 'suivi', FILTER_SANITIZE_STRING);

    // Liste des valeurs autorisées
    $options_autorisees = [
        'En attente...',
        'Colis réceptionné...',
        'En cours de livraison',
        'Livraison reportée',
        'Colis livré',
        'Commande annulée'
    ];

    if ($id && in_array($suivi_commande, $options_autorisees, true)) {
        try {
            $sql = "UPDATE t_commande SET suivi_commande = :suivi_commande WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['suivi_commande' => $suivi_commande, 'id' => $id]);
        } catch (PDOException $e) {
            echo "Erreur de mise à jour : " . $e->getMessage();
            exit; // arrête l'exécution en cas d'erreur
        }
    }
}

// Redirection vers la page précédente
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
