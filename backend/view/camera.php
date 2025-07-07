<?php 
require_once __DIR__ .'/../utils/authMiddleware.php';

redirectIfNotAuthenticated();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
        }

        .home {
            display: flex;
            min-height: 100vh;
        }

        .sidebar_home {
            width: 250px;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #ffe5e5;
            margin-top: 80px;
        }

        @media (max-width: 920px) {
            .sidebar_home {
                width: 150px;
            }
        }

        @media (max-width: 624px) {
            .sidebar_home {
                width: 50px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include_once("./navbar.php"); ?>

    <!-- Page Layout -->
    <main class="home">
        <!-- Sidebar -->
        <div class="sidebar_home">
            <?php include_once("./sidebar.php"); ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            Camera content here
        </div>
    </main>

    <!-- Footer -->
    <footer style="text-align:center; padding:1rem; background:#eee;">Footer</footer>

</body>

</html>