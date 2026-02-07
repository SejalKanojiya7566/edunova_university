<!-- FOOTER -->
<footer class="edu-footer">
  <div class="container-fluid px-5 py-5">
    <div class="row">

      <!-- ABOUT -->
      <div class="col-md-3">
        <h5>EduNova University</h5>
        <p>
          A premier institution focused on academic excellence,
          research, innovation and placements.
        </p>
      </div>

      <!-- QUICK LINKS -->
      <div class="col-md-3">
        <h5>Quick Links</h5>
        <ul class="footer-links">
          <li><a href="about.php">About Us</a></li>
          <li><a href="undergraduate.php">Programs</a></li>
          <li><a href="placements.php">Placements</a></li>
          <li><a href="recruiters.php">Recruiters</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- IMPORTANT -->
      <div class="col-md-3">
        <h5>Important</h5>
        <ul class="footer-links">
          <li><a href="login.php">Login</a></li>
          <li><a href="apply-now.php">Apply Now</a></li>
          <li><a href="scholarship.php">Scholarship</a></li>
          </ul>
      </div>

      <!-- SUBSCRIBE -->
      <div class="col-md-3">
        <h5>Subscribe</h5>

        <?php if(isset($_GET['success'])) { ?>
          <p class="success-msg">âœ” Subscribed successfully!</p>
          <script>
            if (window.history.replaceState) {
              const url = new URL(window.location);
              url.searchParams.delete('success');
              window.history.replaceState({}, document.title, url.pathname);
            }
          </script>
        <?php } ?>

        <?php if(isset($_GET['error'])) { ?>
          <p class="error-msg"> Something went wrong. Try again.</p>
        <?php } ?>

        <form action="subscribe.php" method="POST">
          <input type="email" name="email" class="footer-input"
                 placeholder="Enter your email" required>

          <input type="text" name="mobile" class="footer-input mt-2"
                 placeholder="Enter mobile number" required>

          <button type="submit" name="subscribe"
                  class="subscribe-btn mt-2">
            SUBSCRIBE
          </button>
        </form>

        <!-- SOCIAL ICONS -->
        <div class="social-icons mt-3">
          <a href="https://linkedin.com" target="_blank" title="LinkedIn">
            <i class="bi bi-linkedin"></i>
          </a>

          <a href="mailto:sejalkanojiya890@gmail.com" title="Email">
            <i class="bi bi-envelope-fill"></i>
          </a>
        </div>

      </div>
    </div>

    <hr>

    <p class="text-center small mb-0">
      &copy; 2026 EduNova University | All Rights Reserved
    </p>
  </div>
</footer>

<!-- WHATSAPP FLOAT -->
<a href="https://wa.me/917566565105" class="whatsapp-float" target="_blank">
  <img src="assets/images/whatsapp.png" alt="WhatsApp" width="55">
</a>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
