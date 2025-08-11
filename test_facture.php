<?php
ob_start();
require('./fpdf/fpdf.php');
require('./config/bd.php');

if (!isset($_GET['id'])) {
    die("Commande introuvable.");
}

$id_commande = $_GET['id'];

// Récupérer les infos de la commande
$sql = "SELECT * FROM t_commande WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id_commande]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande non trouvée.");
}

// ✅ Classe FPDF personnalisée avec image de fond
class PDF extends FPDF
{
    function Header()
    {
        // Image de fond plein format (A4 : 210x297mm)
        $this->Image('./fpdf/img/facture4.png', 0, 0, 210, 297);
    }
}

// ✅ Création du PDF à partir de la classe personnalisée
$pdf = new PDF();
$pdf->AddPage();

// ✅ Logo
$pdf->Image('./img/logo_new.png', 80, 10, 50);

// ✅ Saut après le logo
$pdf->SetY(50);

// ✅ Préparation des données
$prix = $commande['prix'] ?? 0;
$quantite = $commande['quantite'] ?? 0;

// ✅ En-tête
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Facture - LE DJASSA', 0, 1, 'C');
$pdf->Ln(10);

// ✅ Détails de la commande
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Date : ' . date('d/m/Y'), 0, 1);
$pdf->Cell(0, 10, 'Nom du client : ' . ($commande['nom'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Prénom : ' . ($commande['prenom'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Téléphone : ' . ($commande['telephone'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Adresse : ' . ($commande['localisation'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Latitude : ' . ($commande['latitude'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Longitude : ' . ($commande['longitude'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Email : ' . ($commande['email'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Nom du produit : ' . ($commande['product_name'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Taille : ' . ($commande['taille'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Quantité : ' . $quantite, 0, 1);
$pdf->Cell(0, 10, 'Categorie : ' . ($commande['categorie'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Code de livraison : ' . ($commande['code_commande'] ?? 'Non défini'), 0, 1);
$pdf->Cell(0, 10, 'Prix : ' . $prix . ' FCFA', 0, 1);
$pdf->Cell(0, 10, 'Prix total : ' . ($prix * $quantite) . ' FCFA', 0, 1);

// ✅ Photo du produit
$photo = $commande['photo'] ?? '';
$photo_path = __DIR__ . '/admin/upload/' . $photo;

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 14);

if ($photo && file_exists($photo_path)) {
    $x = 100;
    $y = 70;
    $pdf->Image($photo_path, $x, $y, 90);
    $pdf->SetY($y + 55);
} else {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Photo non disponible', 0, 1);
}


// ✅ Sortie PDF
$pdf->Output('I', 'facture_commande_' . $id_commande . '.pdf');
ob_end_flush();
exit;
