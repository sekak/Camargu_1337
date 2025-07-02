<style>
  /* Sidebar */
  .sidebar {
    flex: 1;
  }

  /* Sidebar Container */
  .sidebar-header {
    width: 250px;
    height: 100vh;
    background-color: #ffffff;
    color: #000000;
    position: fixed;
    top: 80px;
    left: 0;
    display: flex;
    flex-direction: column;
    border-right: 1px solid rgba(197, 197, 197, 0.28);
  }

  /* Sidebar Links */
  .sidebar-header a {
    padding: 15px 20px;
    color: #000000;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: background-color 0.3s;
    border-bottom: 1px solid rgba(197, 197, 197, 0.28);
  }

  /* Hover & Active Styles */
  .sidebar-header a:hover {
    background-color: #e6f3ff;
  }

  .sidebar-header a.active {
    background-color: rgba(141, 141, 141, 0.86);
    color: #ffffff;
  }

  .sidebar-header a .fas {
    font-size: 20px;
    color: #000000;
  }

  .sidebar-header a.active .fas {
    color: #ffffff;
  }

  @media (max-width: 920px) {
    .sidebar-header {
      width: 150px;
    }

    .sidebar-header a {
      font-size: 14px;
    }
  }

  @media (max-width: 624px) {
    .sidebar-header a span {
      display: none;
    }

    .sidebar-header {
      overflow: hidden;
      width: 50px;
      display: flex;
      align-items: center;
    }

    .sidebar-header a.active .fas {
      color: rgba(141, 141, 141, 0.86);
    }

    .sidebar-header a.active {
      background-color: transparent;
    }
  }
</style>

<div class="sidebar">
  <div class="sidebar-header">
    <a href="/view/home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">
      <i class="fas fa-home"></i> <span>Home</span></a>
    <a href="/view/gallery.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">
    <i class="fas fa-image"></i><span>Gallery</span>
    </a>
    <a href="/view/camera.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'camera.php' ? 'active' : ''; ?>">
    <i class="fas fa-camera"></i><span>Camera</span>
    </a>
    <a href="/view/profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
      <i class="fas fa-user"></i> <span>Profile</span></a>
  </div>
</div>