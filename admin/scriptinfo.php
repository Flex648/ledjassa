<?php

if (isset($_POST["submit"])) {

    include(__DIR__ . '/../config/bd.php');

    $info = $_POST["info"];

    $sql = "INSERT INTO t_info (info) VALUES (:info)";

    $req = $conn->prepare($sql);
    $req->execute([
        ':info' => $info
    ]);

    echo "Données enregistrées";
} else {
    echo "Données enregistrées";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>