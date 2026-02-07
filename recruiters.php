<?php include("includes/header.php"); ?>

<main>

<!-- HERO SECTION -->
<section class="hero-slide" style="background-image:url('assets/images/recruiters-banner.jpg')">
  <div class="hero-content">
    <h1>Our Recruiters</h1>
    <p>Top Companies Hiring EduNova Graduates</p>
  </div>
</section>

<!-- INTRO -->
<section class="section">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">Industry Connections That Matter</h2>
    <p class="mx-auto" style="max-width:900px;">
      EduNova University has strong industry tie-ups with leading national and
      multinational organizations. Our students are placed across IT,
      Management, Core Engineering, Consulting and Research domains.
    </p>
  </div>
</section>

<!-- RECRUITERS GRID -->
<section class="section bg-light">
  <div class="container">
    <div class="row g-4 justify-content-center">

      <?php
      $recruiters = [
        "tcs.png","infosys.png","wipro.png","accenture.png",
        "capgemini.png","cognizant.png","amazon.jpg","flipkart.png",
        "deloitte.png","ey.png","pwc.png","kpmg.png",
        "ibm.png","hcl.png","techmahindra.png","byjus.png"
      ];

      foreach($recruiters as $logo){
      ?>
      <div class="col-6 col-md-3 col-lg-2">
        <div class="card recruiter-card shadow-sm">
          <div class="card-body text-center">
            <img src="assets/images/recruiters/<?php echo $logo; ?>"
                 class="img-fluid recruiter-logo"
                 alt="Recruiter">
          </div>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</section>

<!-- PLACEMENT STATS -->
<section class="section">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Placement Highlights</h2>

    <div class="row justify-content-center">

      <div class="col-md-3 mb-4">
        <div class="card shadow h-100">
          <div class="card-body">
            <h3 class="fw-bold text-primary">500+</h3>
            <p>Recruiting Companies</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow h-100">
          <div class="card-body">
            <h3 class="fw-bold text-success">95%</h3>
            <p>Placement Rate</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow h-100">
          <div class="card-body">
            <h3 class="fw-bold text-warning">&#8377;12 LPA</h3>
            <p>Highest Package</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <div class="card shadow h-100">
          <div class="card-body">
            <h3 class="fw-bold text-danger">&#8377;6.5 LPA</h3>
            <p>Average Package</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA -->
<section class="section bg-primary text-white text-center">
  <div class="container">
    <h2 class="fw-bold mb-3">Ready to Join Our Success Story?</h2>
    <p class="mb-4">Apply now and build your future with EduNova University</p>
    <a href="apply-now.php" class="apply-btn bg-light text-primary px-4">
      Apply Now
    </a>
  </div>
</section>

</main>

<style>
.recruiter-card{
  border-radius:12px;
  transition:0.3s;
}
.recruiter-card:hover{
  transform:translateY(-6px);
}
.recruiter-logo{
  max-height:70px;
  object-fit:contain;
}
</style>

<?php include("includes/footer.php"); ?>
