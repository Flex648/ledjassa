<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="../js/aos.js"></script>
    <script src="../js/scripts.js"></script>

    <title>Document</title>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>


    <div class="container mt-5">
        <h2 class="mb-4" style="font-weight: 600;" data-aos="fade-in">AJOUTER UN ADMINISTRATEUR</h2>
        <form method="post" action="scriptaddmin.php" data-aos="fade-left">
            <div class="mb-3">
                <label style="font-size: 22px; font-weight:400">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required style="width: 50%; border: 2px solid rgb(1, 41, 109)">
            </div>
            <div class="mb-3">
                <label style="font-size: 22px; font-weight:400">Mot de passe</label>
                <div class="input-group w-50">
                    <input type="password" name="password" class="form-control" id="password" style="width: 50%; border: 2px solid rgb(1, 41, 109)" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" style="background-color: rgb(1, 41, 109);">
                        <i id="toggleIcon" class="bi bi-eye"></i>
                    </button>
                </div>

            </div>
            <button type="submit" class="btn" name="submit" style="background-color:rgb(1, 41, 109); color:white; font-size:22px"> <i class="fas fa-add"></i>Ajouter</button>
        </form> <br>
        <a href="liste_admin.php" target="contenuframe" class="btn btn-sm" style="font-size: 22px; background-color: rgba(1, 22, 59, 1); color:white">
            <i class="fas fa-list"></i> Liste des administrateurs
        </a>

    </div>

    <script>
        AOS.init({
            offset: 200,
            duration: 900
        });
    </script>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var icon = document.getElementById("toggleIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>



</body>

</html>