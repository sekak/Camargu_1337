<style>
.footer {
  width: 100%;
  background-color: #333;
  color: #fff;
  padding: 20px 10px;
  text-align: center;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
}

.footer-links {
  margin-top: 10px;
}

.footer-links a {
  color: #fff;
  text-decoration: none;
  margin: 0 10px;
  transition: color 0.3s;
}

.footer-links a:hover {
  color: #ff7f7f;
}

@media (max-width: 600px) {
  .footer-links {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
}
</style>

<footer class="footer">
  <div class="footer-container">
    <p>&copy; <?php echo date("Y"); ?> Your Website Name. All rights reserved.</p>
    <div class="footer-links">
      <a href="/view/home.php">Camagru</a>
      <a href="/view/gallery.php">Camera</a>
      <a href="/view/profile.php">Profile</a>
    </div>
  </div>
</footer>

