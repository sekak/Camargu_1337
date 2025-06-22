<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Photo App</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .logo a {
            color: white;
            text-decoration: none;
            font-size: 24px;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        .nav-links a.btn {
            background-color: #007bff;
            padding: 8px 15px;
            border-radius: 5px;
        }
        main.container {
            padding: 20px;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .gallery p {
            width: 100%;
            text-align: center;
            color: #666;
        }
        .gallery img {
            width: 100%;
            max-width: 200px;
            border-radius: 5px;
        }
        .gallery .item {
            flex: 1 1 calc(33.333% - 10px);
            box-sizing: border-box;
        }

    </style>
    <header class="navbar">
        <div class="container">
            <div class="logo">
                <a href="/">📸 PhotoApp</a>
            </div>
            <div class="nav-links">
                <a href="/register.php" class="btn">Register</a>
                <a href="/login.php" class="btn">Login</a>
            </div>
        </div>
    </header>
    <main class="container">
        <h1>Welcome to My Photo App</h1>
        <p>Explore and share your favorite photos!</p>
        <div class="gallery">
            <!-- Gallery items will be dynamically loaded here -->
            <p>Gallery is under construction. Stay tuned!</p>
        </div>
        <footer>
            <p>&copy; 2023 My Photo App. All rights reserved.</p>
        </footer>
    </main>