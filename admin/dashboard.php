<?php

session_start();

include('../config/bd.php'); // si tu en as besoin

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Récupérer le nom d'utilisateur connecté
$username = $_SESSION['admin'];

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: rgb(244, 162, 48);
        }

        .sidebar {
            background-color: rgb(1, 41, 109);
            color: white;
            min-height: 100vh;
        }

        .sidebar a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 3px;
            text-align: center;
            display: block;
            padding: 12px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: rgb(0, 27, 62);
            transition: 0.3s;
        }

        .sidebar .dessin:hover {
            background-color: transparent;
        }

        .logout img {
            width: 40px;
            cursor: pointer;
        }

        iframe {
            width: 100%;
            height: calc(100vh - 56px);
            /* Adjust for header if needed */
            border: none;
            background-color: white;
            border-radius: 0 0 0 0;
            box-shadow: -4px 0 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body style="background-image: url(../img/bgdark.jpg);">

    <!-- Navbar pour mobile -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand">Dashboard Admin</span>
        </div>
    </nav>

    <div class="container-fluid" data-aos="fade-left">
        <div class="row">
            <!-- Sidebar : visible en desktop et offcanvas sur mobile -->
            <div class="col-md-3 col-lg-2 d-none d-md-block sidebar p-3">
                <div class="text-center mb-3">
                    <a href="dashboard.php" class="dessin"> <lord-icon
                            src="https://cdn.lordicon.com/jectmwqf.json"
                            trigger="loop"
                            colors="primary:#ffffff,secondary:#ffffff"
                            style="width:100px;height:100px">
                        </lord-icon></a>
                    <div class="text-center text-white mb-3 w-100 shadow" style="background-color:white; border-radius:15px">
                        <p style="color: black;">
                            Connecté en tant que : <br> <strong style="font-size: 23px;"><?php echo htmlspecialchars($username); ?></strong>
                        </p>
                    </div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="addadmin.php" target="contenuframe">Admin</a></li>
                    <li class="nav-item"><a href="ajoutproduit.php" target="contenuframe">Produits</a></li>
                    <li class="nav-item"><a href="ajoutinfo.php" target="contenuframe">Infos News</a></li>
                    <li class="nav-item"><a href="commandes.php" target="contenuframe">Commandes</a></li>
                    <li class="nav-item"><a href="messages.php" target="contenuframe">Messages</a></li>
                </ul>
                <div class="logout mt-auto pt-3 text-center">
                    <a href="logout.php"><img src="../img/logout.png" alt="Déconnexion"></a>
                </div>
            </div>

            <!-- Offcanvas sidebar pour mobile -->
            <div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="sidebarOffcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="text-center mb-3">
                        <lord-icon
                            src="https://cdn.lordicon.com/jectmwqf.json"
                            trigger="loop"
                            colors="primary:#ffffff,secondary:#ffffff"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="addadmin.php" target="contenuframe" data-bs-dismiss="offcanvas">Admin</a></li>
                        <li class="nav-item"><a href="ajoutproduit.php" target="contenuframe" data-bs-dismiss="offcanvas">Produits</a></li>
                        <li class="nav-item"><a href="ajoutinfo.php" target="contenuframe" data-bs-dismiss="offcanvas">Infos News</a></li>
                        <li class="nav-item"><a href="commandes.php" target="contenuframe" data-bs-dismiss="offcanvas">Commandes</a></li>
                    </ul>
                    <div class="logout mt-auto pt-3 text-center">
                        <a href="logout.php"><img src="../img/logout.png" alt="Déconnexion"></a>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <main class="col-md-9 col-lg-10 p-0">
                <iframe name="contenuframe"></iframe>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>