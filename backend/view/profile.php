

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f0f0;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2vw;
            box-sizing: border-box;
            min-height: 100vh;
        }

        .profile-wrapper {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-header h1 {
            font-size: 2rem;
            color: #333;
            margin: 0 0 1rem;
        }

        .profile-header p {
            font-size: 1rem;
            color: #666;
            margin: 0.5rem 0;
            line-height: 1.5;
        }

        .profile-section {
            margin-top: 2rem;
            padding: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .profile-section h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .profile-section p {
            font-size: 1rem;
            color: #444;
            margin: 0.5rem 0;
            line-height: 1.6;
        }

        .profile-section button {
            padding: 0.8rem 1.5rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
            width: 100%;
            max-width: 200px;
            margin-top: 1rem;
        }

        .profile-section button:hover {
            background: #0056b3;
        }

        .profile-section button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.3);
        }

        /* Tablet and smaller */
        @media (max-width: 768px) {
            .main-content {
                padding: 3vw;
            }

            .profile-wrapper {
                padding: 1.5rem;
            }

            .profile-header h1 {
                font-size: 1.8rem;
            }

            .profile-header p {
                font-size: 0.9rem;
            }

            .profile-section h2 {
                font-size: 1.3rem;
            }

            .profile-section p {
                font-size: 0.9rem;
            }

            .profile-section button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .main-content {
                padding: 4vw;
            }

            .profile-wrapper {
                padding: 1rem;
            }

            .profile-header h1 {
                font-size: 1.5rem;
            }

            .profile-header p {
                font-size: 0.8rem;
            }

            .profile-section h2 {
                font-size: 1.2rem;
            }

            .profile-section p {
                font-size: 0.8rem;
            }

            .profile-section button {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="profile-wrapper">
            <div class="profile-header">
                <h1>Profile</h1>
                <p>Welcome to your profile page!</p>
                <p>Here you can view and edit your profile information.</p>

                <section class="profile-section">
                    <h2>User Profile</h2>
                    <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <p>Bio: <?php echo htmlspecialchars($user['bio']); ?></p>
                    <button onclick="window.location.href='edit_profile.php'">Edit Profile</button>
                </section>
            </div>
        </div>
    </div>
</body>
</html>