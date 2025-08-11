<?php
include '../config/bd.php';

$sql = "SELECT * FROM t_produit";
$req = $conn->prepare($sql);
$req->execute();
$prod = $req->fetchAll(PDO::FETCH_ASSOC);
