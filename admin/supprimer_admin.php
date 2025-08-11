<?php
include(__DIR__ . '/../config/bd.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM t_admin WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Rediriger vers la page de liste après suppression
        header("Location: liste_admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID invalide.";
}
