<?php
require_once '../config/bd.php';

$username = 'myadmin';
$raw_password = 'admin12345';
$hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO t_admin (username, password) VALUES (?, ?)");
$stmt->execute([$username, $hashed_password]);

echo "Admin créé avec succès.";
