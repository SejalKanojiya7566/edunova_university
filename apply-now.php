<?php
include("includes/header.php");
include("config/db.php");

$errors = [];
$success = "";
?>

<main>

<section class="hero-slide" style="background-image:url('assets/images/slider1.jpg')">
  <div class="hero-content text-center">
    <h1>Apply Now</h1>
    <p>Admissions Open for 2026</p>
  </div>
</section>

<section class="section bg-light">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-9">

<div class="card shadow border-0">
<div class="card-body p-4">

<h3 class="fw-bold mb-4 text-center">Application Form</h3>

<!-- ================= FORM ================= -->
<form method="POST" id="applyForm" novalidate>

<!-- NAME + EMAIL -->
<div class="row">
  <div class="col-md-6 mb-3">
    <label>Full Name *</label>
    <input type="text" name="student_name" class="form-control" required
           pattern="[A-Za-z ]{3,}"
           title="Only alphabets allowed (min 3 letters)">
  </div>

  <div class="col-md-6 mb-3">
    <label>Email *</label>
    <input type="email" name="email" class="form-control" required>
  </div>
</div>

<!-- MOBILE + QUALIFICATION -->
<div class="row">
  <div class="col-md-6 mb-3">
    <label>Mobile *</label>
    <input type="text" name="mobile" class="form-control" required
           pattern="[0-9]{10}"
           title="Enter valid 10-digit mobile number">
  </div>

  <div class="col-md-6 mb-3">
    <label>Highest Qualification *</label>
    <input type="text" name="qualification" class="form-control" required
           pattern="[A-Za-z .]{2,}"
           title="Qualification should contain letters only">
  </div>
</div>

<!-- PROGRAM + COURSE -->
<div class="row">
  <div class="col-md-6 mb-3">
    <label>Program *</label>
    <select name="program" id="program" class="form-select" required onchange="loadCourses()">
      <option value="">Select Program</option>
      <option value="UG">Undergraduate</option>
      <option value="PG">Postgraduate</option>
      <option value="PHD">Doctoral</option>
    </select>
  </div>

  <div class="col-md-6 mb-3">
    <label>Course / Specialization *</label>
    <select name="course" id="course" class="form-select" required onchange="setFees()">
      <option value="">Select Course</option>
    </select>
  </div>
</div>

<!-- FEES AUTO -->
<div class="row">
  <div class="col-md-4 mb-3">
    <label>Total Semesters / Years</label>
    <input type="text" name="total_semesters" id="semesters" class="form-control" readonly>
  </div>

  <div class="col-md-4 mb-3">
    <label>Fees Type</label>
    <input type="text" name="fees_type" id="fees_type" class="form-control" readonly>
  </div>

  <div class="col-md-4 mb-3">
    <label>Total Fees (&#8377;)</label>
    <input type="text" name="total_fees" id="total_fees" class="form-control" readonly>
  </div>
</div>

<!-- MESSAGE -->
<div class="mb-3">
  <label>Message *</label>
  <textarea name="message" class="form-control" rows="3" required
            minlength="10"
            title="Message should be at least 10 characters"></textarea>
</div>

<div class="text-center">
  <button type="submit" name="apply" class="btn btn-primary px-5">
    Submit Application
  </button>
</div>

</form>

<!-- ================= PHP VALIDATION ================= -->
<?php
if(isset($_POST['apply'])){

  $name  = trim($_POST['student_name']);
  $email = trim($_POST['email']);
  $mobile = trim($_POST['mobile']);
  $qualification = trim($_POST['qualification']);
  $program = $_POST['program'];
  $course  = $_POST['course'];
  $message = trim($_POST['message']);

  if(!preg_match("/^[A-Za-z ]{3,}$/", $name)){
    $errors[] = "Invalid Name";
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[] = "Invalid Email";
  }

  if(!preg_match("/^[0-9]{10}$/", $mobile)){
    $errors[] = "Invalid Mobile Number";
  }

  if(!preg_match("/^[A-Za-z .]{2,}$/", $qualification)){
    $errors[] = "Invalid Qualification";
  }

  if(strlen($message) < 10){
    $errors[] = "Message too short";
  }

  if(empty($errors)){
    mysqli_query($conn,"
      INSERT INTO admissions
      (student_name,email,mobile,program,course,
       fees_type,total_semesters,annual_fees,
       qualification,message,status)
      VALUES(
       '$name','$email','$mobile','$program','$course',
       '{$_POST['fees_type']}','{$_POST['total_semesters']}',
       '{$_POST['total_fees']}','$qualification','$message','Pending'
      )
    ");

    $success = "&#10004; Application submitted successfully!";
  }
}
?>

<?php if(!empty($errors)){ ?>
<div class="alert alert-danger mt-3">
  <ul class="mb-0">
    <?php foreach($errors as $e){ echo "<li>$e</li>"; } ?>
  </ul>
</div>
<?php } ?>

<?php if($success){ ?>
<div class="alert alert-success mt-3 text-center">
  <?= $success ?>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</section>

</main>

<!-- ================= JS ================= -->
<script>
const data = {
  UG:{
    "B.Tech (CSE)":[8,"Semester",480000],
    "B.Tech (AI & DS)":[8,"Semester",520000],
    "BCA":[6,"Semester",270000],
    "BBA":[6,"Semester",240000],
    "BA":[6,"Semester",180000]
  },
  PG:{
    "MBA (HR)":[4,"Semester",320000],
    "MBA (Finance)":[4,"Semester",340000],
    "MCA":[4,"Semester",280000],
    "M.Tech":[4,"Semester",360000]
  },
  PHD:{
    "PhD Engineering":[3,"Annual",360000],
    "PhD Management":[3,"Annual",300000]
  }
};

function loadCourses(){
  let p=document.getElementById("program").value;
  let c=document.getElementById("course");
  c.innerHTML="<option value=''>Select Course</option>";
  if(data[p]){
    Object.keys(data[p]).forEach(x=>{
      c.innerHTML+=`<option>${x}</option>`;
    });
  }
}

function setFees(){
  let p=program.value;
  let c=course.value;
  let info=data[p][c];
  semesters.value=info[0];
  fees_type.value=info[1];
  total_fees.value=info[2];
}
</script>

<?php include("includes/footer.php"); ?>