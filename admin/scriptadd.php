<?php
include(__DIR__ . '/../config/bd.php');

if (isset($_POST["submit"])) {
    $nom = $_POST["nom"];
    $prix = $_POST["prix"];
    $photo = $_FILES["photo"]["name"];
    $categorie = $_POST["categorie"];
    $add = "upload/" . basename($photo);

    // Déplacement du fichier téléchargé
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $add)) {
        // Préparation de la requête SQL
        $sql = "INSERT INTO t_produit (nom, prix, photo, categorie) VALUES (:nom, :prix, :photo, :categorie)";
        $req = $conn->prepare($sql);

        // Exécution de la requête avec les paramètres
        $req->execute([
            ':nom' => $nom,
            ':prix' => $prix,
            ':photo' => $photo,
            ':categorie' => $categorie
        ]);

        echo "Données enregistrées <a href='ajoutproduit.php'>Retour...</a>";
    } else {
        echo "Échec de l'envoi <a href='ajoutproduit.php'>Réessayez...</a>";
    }
}
