<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>

    <title>Document</title>

    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight: 600;" data-aos="fade-in">AJOUTER UNE INFORMATION</h2>
        <form action="scriptinfo.php" method="POST" enctype="multipart/form-data" data-aos="fade-left">
            <label for="" style="font-size:22px">AJOUTER UNE INFO</label> <BR>
            <textarea name="info" type="text" placeholder="Saisissez nouvelle information" style="width: 50%; border: 2px solid rgb(1, 41, 109)"> </textarea> <br>
            <button type="submit" name="submit" class="btn" style="background-color: rgb(1, 41, 109); color : white">Ajouter</button>
        </form>


        <br><a href="liste_info.php" target="contenuframe" class="btn btn-sm" data-aos="zoom-in" style="font-size: 21px; background-color: rgba(1, 22, 59, 1); color:white">
            <i class="fas fa-list"></i> Liste des informations
        </a>

    </div>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>



</body>

</html>