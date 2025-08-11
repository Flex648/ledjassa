<?php
if (isset($_GET['annulation']) && $_GET['annulation'] === 'success') {
    echo '<div class="alert alert-success text-center">✅ Votre commande a été annulée avec succès.</div>';
} elseif (isset($_GET['annulation']) && $_GET['annulation'] === 'error') {
    echo '<div class="alert alert-danger text-center">❌ Une erreur est survenue lors de l\'annulation.</div>';
}
?>
<?php
include('./config/bd.php'); // connexion à ta base

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['code_commande'])) {
    $code = $_POST['code_commande'];

    // Supprimer la commande
    $sql = "DELETE FROM t_commande WHERE code_commande = :code";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['code' => $code]);

    // Rediriger vers la page de vérification (par exemple verifier_code.php)
    header("Location: panier_end.php?annulation=success");
    exit;
} else {
    header("Location: panier_end.php?annulation=error");
    exit;
}

if (!$commande) {
    echo '<div class="alert alert-warning text-center">❌ Ce code ne correspond à aucune commande. Veuillez passer une nouvelle commande.</div>';
}
