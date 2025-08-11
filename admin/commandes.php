<?php
include('../config/bd.php');
?>

<?php
try {
    $sql = "SELECT * FROM t_commande ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de récupération des commandes : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commandes</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th,
        td {
            font-size: 16px;
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: rgb(1, 41, 109);
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .email-cell {
            white-space: normal !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
            max-width: 100% !important;
        }

        img {
            max-width: 60px;
            height: auto;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <h2>Liste des Commandes</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Tél.</th>
                    <th>Local.</th>
                    <th>Produit</th>
                    <th>Photo</th>
                    <th>Taille</th>
                    <th>Quant.</th>
                    <th>Catég.</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Suivi commande</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?= $commande['id'] ?></td>
                        <td><?= htmlspecialchars($commande['nom']) ?></td>
                        <td><?= htmlspecialchars($commande['prenom']) ?></td>
                        <td class="email-cell"><?= htmlspecialchars($commande['email']) ?></td>
                        <td><?= htmlspecialchars($commande['telephone']) ?></td>
                        <td><?= htmlspecialchars($commande['localisation']) ?></td>
                        <td><?= htmlspecialchars($commande['product_name']) ?></td>
                        <td><img src="../admin/upload/<?= htmlspecialchars($commande['photo']); ?>" alt="Photo"></td>
                        <td><?= htmlspecialchars($commande['taille']) ?></td>
                        <td><?= $commande['quantite'] ?></td>
                        <td><?= ucfirst(htmlspecialchars($commande['categorie'])) ?></td>
                        <td><?= number_format($commande['prix'] * $commande['quantite'], 0, '', ' ') ?> FCFA</td>
                        <td><?= $commande['date_commande'] ?? '' ?></td>
                        <td><?= $commande['statut'] ?? '' ?></td>
                        <td>
                            <form action="update_suivi.php" method="post" style="display: flex; gap: 5px;">
                                <input type="hidden" name="id" value="<?= $commande['id'] ?>">
                                <select name="suivi" style="width: 170px;">
                                    <?php
                                    $options = [
                                        'En attente...',
                                        'Colis réceptionné...',
                                        'En cours de livraison',
                                        'Livraison reportée',
                                        'Colis livré',
                                        'Commande annulée'
                                    ];
                                    foreach ($options as $option):
                                        $selected = ($commande['suivi'] ?? '') === $option ? 'selected' : '';
                                    ?>
                                        <option value="<?= htmlspecialchars($option) ?>" <?= $selected ?>><?= htmlspecialchars($option) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">✔</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>