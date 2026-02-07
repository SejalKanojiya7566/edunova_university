<?php 
include("includes/header.php"); 
include("config/db.php"); 

$errors = [];
$success = "";
?>

<style>
.contact-section{
  padding:100px 0;
  background:#f4f6f9;
}
.map-wrapper iframe{
  width:100%;
  height:100%;
  min-height:350px;
  border:0;
  border-radius:10px;
}
</style>

<main>

<!-- HERO -->
<section class="hero-slide" style="background-image:url('assets/images/contact-banner.jpg')">
  <div class="hero-content">
    <h1>Contact Us</h1>
    <p>We are here to help you</p>
  </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">
  <div class="container">
    <div class="row g-4">

      <!-- CONTACT FORM -->
      <div class="col-md-6">
        <div class="card shadow h-100">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">Send Us a Message</h4>

            <form method="POST" novalidate>

              <!-- FULL NAME -->
              <div class="mb-3">
                <label>Full Name </label>
                <input type="text" name="name" class="form-control" required
                       pattern="[A-Za-z ]{3,}"
                       title="Only alphabets allowed (min 3 letters)">
              </div>

              <!-- EMAIL -->
              <div class="mb-3">
                <label>Email Address </label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <!-- MOBILE -->
              <div class="mb-3">
                <label>Mobile Number </label>
                <input type="text" name="phone" class="form-control" required
                       pattern="[0-9]{10}"
                       title="Enter valid 10-digit mobile number">
              </div>

              <!-- MESSAGE -->
              <div class="mb-3">
                <label>Message </label>
                <textarea name="message" class="form-control" rows="4" required
                          minlength="10"
                          title="Message must be at least 10 characters"></textarea>
              </div>

              <button type="submit" name="send" class="apply-btn w-100">
                Send Message
              </button>
            </form>

            <!-- ================= PHP VALIDATION ================= -->
            <?php
            if(isset($_POST['send'])){

              $name    = trim($_POST['name']);
              $email   = trim($_POST['email']);
              $phone   = trim($_POST['phone']);
              $message = trim($_POST['message']);

              // NAME
              if(!preg_match("/^[A-Za-z ]{3,}$/", $name)){
                $errors[] = "Invalid name (only letters allowed)";
              }

              // EMAIL
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Invalid email address";
              }

              // MOBILE
              if(!preg_match("/^[0-9]{10}$/", $phone)){
                $errors[] = "Invalid mobile number";
              }

              // MESSAGE
              if(strlen($message) < 10){
                $errors[] = "Message must be at least 10 characters";
              }

              // INSERT IF NO ERROR
              if(empty($errors)){
                $name    = mysqli_real_escape_string($conn,$name);
                $email   = mysqli_real_escape_string($conn,$email);
                $phone   = mysqli_real_escape_string($conn,$phone);
                $message = mysqli_real_escape_string($conn,$message);

                mysqli_query($conn,"
                  INSERT INTO enquiries (name,email,phone,message)
                  VALUES ('$name','$email','$phone','$message')
                ");

                $success = "&#10004; Message sent successfully";
              }
            }
            ?>

            <!-- ERROR DISPLAY -->
            <?php if(!empty($errors)){ ?>
              <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                  <?php foreach($errors as $e){ echo "<li>$e</li>"; } ?>
                </ul>
              </div>
            <?php } ?>

            <!-- SUCCESS -->
            <?php if($success){ ?>
              <div class="alert alert-success mt-3 text-center">
                <?= $success ?>
              </div>
            <?php } ?>

          </div>
        </div>
      </div>

      <!-- ADDRESS + MAP -->
      <div class="col-md-6">
        <div class="card shadow h-100">
          <div class="card-body">

            <h4 class="fw-bold mb-3">Our Address</h4>

            <p>
              5XW3+GG4, Neta Colony,<br>
              Adhartal, Jabalpur,<br>
              Madhya Pradesh &minus; 482004
            </p>

            <p><b>Email:</b> info@edunova.edu</p>
            <p><b>Phone:</b> +91 75665 65105</p>

            <p>
              <b>Working Hours:</b><br>
              Monday &minus; Saturday | 9:00 AM &minus; 5:00 PM
            </p>

            <div class="map-wrapper mt-3">
              <iframe
                src="https://www.google.com/maps?q=5XW3%2BGG4%2C%20Neta%20Colony%2C%20Adhartal%2C%20Jabalpur%2C%20Madhya%20Pradesh%20482004&output=embed"
                loading="lazy">
              </iframe>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

</main>

<?php include("includes/footer.php"); ?>