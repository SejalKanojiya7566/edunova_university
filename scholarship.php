<?php
include("includes/header.php");
include("config/db.php");

$errors = [];
$success = "";
?>

<style>
body{
  background:#f7f7f7;
  overflow-x:hidden;
}
main{ padding-top:50px; }
.scholarship-wrapper{ padding:20px 15px 50px; }

.form-card{
  max-width:950px;
  margin:auto;
  border-radius:12px;
  border:none;
}
.form-card .card-header{
  background:linear-gradient(135deg,#c9a227,#f2d16b);
  color:#1f1f1f;
}
.form-control{
  border-radius:8px;
  height:45px;
}
textarea.form-control{ height:auto; }
label{
  font-weight:600;
  font-size:14px;
}
.apply-btn{
  background:linear-gradient(135deg,#c9a227,#f2d16b);
  border:none;
  font-weight:600;
  padding:12px;
  border-radius:30px;
}
.apply-btn:hover{
  background:linear-gradient(135deg,#b8961f,#e6c65c);
}
</style>

<main>
<div class="scholarship-wrapper">
<div class="container">

<div class="card form-card shadow-lg">
<div class="card-header text-center">
  <h4 class="mb-0">Scholarship Application Form</h4>
  <small>EduNova University</small>
</div>

<div class="card-body p-4">

<form method="POST" enctype="multipart/form-data" novalidate>

<div class="row">

<div class="col-md-6 mb-3">
<label>Full Name </label>
<input type="text" name="name" class="form-control" required
       pattern="[A-Za-z ]{3,}" title="Only alphabets allowed">
</div>

<div class="col-md-6 mb-3">
<label>Email </label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Mobile Number </label>
<input type="text" name="phone" class="form-control" required
       pattern="[0-9]{10}" title="Enter valid 10 digit number">
</div>

<div class="col-md-6 mb-3">
<label>Nationality </label>
<input type="text" name="nationality" class="form-control" required
       pattern="[A-Za-z ]{3,}">
</div>

<div class="col-md-6 mb-3">
<label>Category </label>
<select name="category" id="category" class="form-control" required>
  <option value="">Select</option>
  <option>General</option>
  <option>OBC</option>
  <option>SC</option>
  <option>ST</option>
  <option>Minority</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Course </label>
<input type="text" name="course" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Annual Family Income (&#8377;) </label>
<input type="number" name="income" class="form-control" required min="1">
</div>

<div class="col-md-6 mb-3">
<label>State </label>
<input type="text" name="state" class="form-control" required>
</div>

<div class="col-md-12 mb-3">
<label>Full Address </label>
<textarea name="address" class="form-control" rows="3"
          minlength="10" required></textarea>
</div>

<div class="col-md-6 mb-3">
<label>Income Certificate (PDF)</label>
<input type="file" name="income_certificate" class="form-control"
       accept="application/pdf" required>
</div>

<div class="col-md-6 mb-3">
<label>Caste Certificate (PDF)</label>
<input type="file" name="caste_certificate" id="caste_certificate"
       class="form-control" accept="application/pdf">
</div>

</div>

<button type="submit" name="apply" class="apply-btn w-100">
Apply for Scholarship
</button>

</form>

<?php
/* ================= BACKEND VALIDATION ================= */
if(isset($_POST['apply'])){

  $name  = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);

  if(!preg_match("/^[A-Za-z ]{3,}$/",$name))
    $errors[]="Invalid name";

  if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    $errors[]="Invalid email";

  if(!preg_match("/^[0-9]{10}$/",$phone))
    $errors[]="Invalid mobile number";

  // DUPLICATE CHECK
  $check = mysqli_query($conn,
    "SELECT id FROM scholarships WHERE email='$email' OR phone='$phone'"
  );
  if(mysqli_num_rows($check)>0)
    $errors[]="You already applied using this Email or Phone";

  // FILE VALIDATION
  if($_FILES['income_certificate']['type']!="application/pdf")
    $errors[]="Income certificate must be PDF";

  if(empty($errors)){

    $dir="uploads/scholarship/";
    if(!is_dir($dir)) mkdir($dir,0777,true);

    $incomeFile=time()."_income.pdf";
    move_uploaded_file($_FILES['income_certificate']['tmp_name'],$dir.$incomeFile);

    $casteFile=NULL;
    if(!empty($_FILES['caste_certificate']['name'])){
      if($_FILES['caste_certificate']['type']=="application/pdf"){
        $casteFile=time()."_caste.pdf";
        move_uploaded_file($_FILES['caste_certificate']['tmp_name'],$dir.$casteFile);
      }
    }

    mysqli_query($conn,"
      INSERT INTO scholarships
      (name,email,phone,nationality,category,course,income,state,address,
       income_certificate,caste_certificate,status,apply_date)
      VALUES(
        '$name','$email','$phone',
        '{$_POST['nationality']}','{$_POST['category']}','{$_POST['course']}',
        '{$_POST['income']}','{$_POST['state']}','{$_POST['address']}',
        '$incomeFile',
        ".($casteFile?"'$casteFile'":"NULL").",
        'Pending',CURDATE()
      )
    ");

    $success="&#10004; Scholarship Application Submitted Successfully";
  }
}
?>

<?php if(!empty($errors)){ ?>
<div class="alert alert-danger mt-3">
<ul><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
</div>
<?php } ?>

<?php if($success){ ?>
<div class="alert alert-success mt-3 text-center"><?= $success ?></div>
<?php } ?>

</div>
</div>
</div>
</div>
</main>

<script>
document.getElementById("category").addEventListener("change",function(){
  const caste=document.getElementById("caste_certificate");
  caste.disabled=(this.value==="General");
  if(this.value==="General") caste.value="";
});
</script>

<?php include("includes/footer.php"); ?>