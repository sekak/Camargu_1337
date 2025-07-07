<?php
require_once __DIR__ .'/../utils/authMiddleware.php';

redirectIfNotAuthenticated();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
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
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .profile-container {
      width: 100%;
      background: #fff;
      padding: 75px 20px;
      margin: 50px 15px 150px 15px;
    }

    .profile-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 600;
      color: #333;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      transition: border 0.3s;
    }

    .form-group input:focus {
      outline: none;
      border-color: #ff7f7f;
    }

    .btn-save-change {
      width: 100%;
      padding: 12px;
      background: #ff7f7f;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      transition: background 0.3s;
    }

    .btn-save-change:disabled {
      background: #ccc;
      cursor: not-allowed;
    }

    .btn-save-change:hover:not(:disabled) {
      background: #ff5c5c;
    }

    @media (max-width: 920px) {

      .sidebar_home {
        width: 150px;
      }

      .main-content {
        width: calc(100% - 150px);
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

  <?php include_once("./includes/navbar.php"); ?>

  <main class="home">
    <div class="sidebar_home">
      <?php include_once("./includes/sidebar.php"); ?>
    </div>

    <div class="main-content">
      <div class="profile-container">
        <h2>User Profile</h2>
        <form id="profileForm">
          <div class="form-group">
            <label for="username">Name</label>
            <input type="text" id="username" name="username" value="">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="">
          </div>
          <div class="form-group">
            <label for="password">New Password (leave empty if no change)</label>
            <input type="password" id="password" name="password" placeholder="********">
          </div>
          <div class="form-group">
            <label>
              <input type="checkbox" id="notify_comments" name="notify_comments">
              Enable notifications for new comments
            </label>
          </div>
          <button class="btn-save-change" type="submit" id="saveBtn" disabled>Save Changes</button>
        </form>
      </div>
      <!-- Footer -->
      <?php include_once __DIR__ . "/includes/footer.php" ?>
    </div>
  </main>

  <script>
    const profileForm = document.getElementById('profileForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const notify_comments = document.getElementById('notify_comments');
    const saveBtn = document.getElementById('saveBtn');

    const originalData = {
      username: "<?php echo htmlspecialchars($_SESSION['user_profile']['username'] ?? '') ?>",
      email: "<?php echo htmlspecialchars($_SESSION['user_profile']['email'] ?? '') ?>",
      notify_comments: <?php echo htmlspecialchars($_SESSION['user_profile']['notify_comments']) ? 'true' : 'false'; ?>
    };

    window.addEventListener('DOMContentLoaded', () => {
      username.value = originalData.username;
      email.value = originalData.email;
      notify_comments.checked = originalData.notify_comments;

      username.addEventListener('input', detect_changes);
      email.addEventListener('input', detect_changes);
      password.addEventListener('input', detect_changes);
      notify_comments.addEventListener('change', detect_changes);
    });

    function detect_changes() {
      const isChanged =
        username.value !== originalData.username ||
        email.value !== originalData.email ||
        notify_comments.checked !== originalData.notify_comments ||
        password.value.length > 0;

      saveBtn.disabled = !isChanged;
    }

    profileForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const formData = new FormData();
      formData.append('username', username.value);
      formData.append('email', email.value);
      formData.append('password', password.value);
      formData.append('notify_comments', notify_comments.checked ? 1 : 0);

      const xhr = new XMLHttpRequest();
      xhr.open('POST', '/actions/updateProfile.actions.php', true);

      xhr.onload = function () {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          if (response.success) {
            alert("Profile updated successfully!");
            // Update local original data
            originalData.username = username.value;
            originalData.email = email.value;
            originalData.notify_comments = notify_comments.checked;

            // Clear password field after successful update
            password.value = '';
            saveBtn.disabled = true;
            location.reload();
          } else {
            alert("Update failed: " + (response.message || "Unknown error"));
          }
        } else {
          alert("Request failed with status " + xhr.status);
        }
      };

      xhr.onerror = function () {
        alert("Request error occurred");
      };

      xhr.send(formData);
    });
  </script>

</body>

</html>