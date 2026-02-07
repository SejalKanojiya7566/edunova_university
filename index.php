<?php include("includes/header.php"); ?>
<?php include("config/db.php"); ?>

<main>

<!-- ================= HERO SLIDER ================= -->
<div id="eduSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">

    <div class="carousel-item active hero-slide"
      style="background-image:url('assets/images/slider1.jpg')">
      <div class="hero-content text-center">
        <h1>Shaping Future Leaders</h1>
        <p>World Class Education & Placements</p>
      </div>
    </div>

    <div class="carousel-item hero-slide"
      style="background-image:url('assets/images/slider2.png')">
      <div class="hero-content text-center">
        <h1>Ranked Among Top Universities</h1>
        <p>Global Standards &bull; Industry Focus</p>
      </div>
    </div>

    <div class="carousel-item hero-slide"
      style="background-image:url('assets/images/slider3.jpg')">
      <div class="hero-content text-center">
        <h1>Innovation & Research Excellence</h1>
        <p>Learning Beyond Classrooms</p>
      </div>
    </div>

  </div>
</div>

<!-- ================= NOTICE POPUP ================= -->
<?php
$noticeQ = mysqli_query($conn,
  "SELECT * FROM notifications ORDER BY id DESC LIMIT 1"
);
$notice = mysqli_fetch_assoc($noticeQ);
?>

<?php if($notice) { ?>
<div id="noticePopup" class="notice-popup">
  <div class="notice-box">

    <!-- CLOSE BUTTON -->
    <span class="notice-close" onclick="closeNotice()">&#10006;</span>

    <h4><?= $notice['title']; ?></h4>
    <small>
      <?= date("d M Y", strtotime($notice['created_at'])); ?>
      | <?= $notice['type']; ?>
    </small>

    <p><?= $notice['description']; ?></p>

  </div>
</div>
<?php } ?>

<!-- ================= WHY EDUNOVA ================= -->
<section class="section bg-light">
  <div class="container">
    <h2 class="fw-bold text-center mb-5">Why EduNova University?</h2>

    <div class="row g-4">
      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center">
          <div class="card-body">
            <h5>Industry Curriculum</h5>
            <p>Industry-focused & practical learning.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center">
          <div class="card-body">
            <h5>Placements</h5>
            <p>Top recruiters & career support.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center">
          <div class="card-body">
            <h5>Infrastructure</h5>
            <p>Smart campus & modern labs.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card h-100 shadow-sm text-center">
          <div class="card-body">
            <h5>Skill Building</h5>
            <p>Internships & real projects.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

<!-- ================= NOTICE STYLES ================= -->
<style>
.notice-popup{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.6);
  display:flex;
  align-items:center;
  justify-content:center;
  z-index:9999;
}

.notice-box{
  position:relative;
  background:#fff;
  width:90%;
  max-width:500px;
  padding:30px 25px;
  border-radius:14px;
  text-align:center;
  animation:popup 0.35s ease;
}

.notice-box h4{
  font-weight:700;
  margin-bottom:5px;
}

.notice-box small{
  color:#777;
  font-size:13px;
}

.notice-box p{
  margin-top:15px;
  font-size:15px;
  line-height:1.6;
}

.notice-close{
  position:absolute;
  top:12px;
  right:15px;
  font-size:20px;
  color:#555;
  cursor:pointer;
  font-weight:bold;
}

.notice-close:hover{
  color:#dc3545;
}

@keyframes popup{
  from{transform:scale(0.85);opacity:0}
  to{transform:scale(1);opacity:1}
}
</style>

<!-- ================= NOTICE SCRIPT ================= -->
<script>
function closeNotice(){
  document.getElementById("noticePopup").style.display="none";
}
</script>

<?php include("includes/footer.php"); ?>
