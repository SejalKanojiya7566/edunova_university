<?php
session_start();
include("config/db.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $check = mysqli_query($conn,
        "SELECT * FROM admins 
         WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($check) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard/dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login | EduNova University</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    margin:0;
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Segoe UI',sans-serif;
}

/* Login Card */
.login-box{
    background:#fff;
    width:380px;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 20px 40px rgba(0,0,0,0.25);
}

/* Header */
.login-header{
    background:#0d6efd;
    color:#fff;
    padding:25px 20px;
    text-align:center;
}

.login-header i{
    font-size:42px;
    margin-bottom:10px;
    display:block;
}

.login-header h4{
    margin:0;
    font-weight:600;
}

/* Body */
.login-body{
    padding:30px 25px;
}

/* Input fields */
.form-control{
    height:45px;
    font-size:14px;
    border-radius:8px;
}

/* Button */
.login-btn{
    height:45px;
    font-weight:600;
    border-radius:8px;
}

/* Footer text */
.footer-text{
    text-align:center;
    font-size:13px;
    margin-top:15px;
    color:#666;
}
}
</style>
</head>

<body>

<div class="login-box">

    <div class="login-header">
        <i class="fas fa-university"></i>
        <h5 class="mb-0">EduNova University</h5>
        <small>Admin Panel Login</small>
    </div>

    <div class="login-body">

        <?php if(isset($error)){ ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php } ?>

        <form method="POST" autocomplete="off">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 login-btn">
                <i class="fas fa-lock me-1"></i> Login
            </button>
        </form>

        <div class="footer-text">
            © <?= date('Y'); ?> EduNova University
        </div>

    </div>
</div>

</body>
</html>
