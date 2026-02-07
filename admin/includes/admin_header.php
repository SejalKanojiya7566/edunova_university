<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* &#128274; AUTO LOGOUT AFTER 15 MINUTES */
$timeout = 15 * 60; // 15 minutes

if (isset($_SESSION['LAST_ACTIVITY']) &&
    (time() - $_SESSION['LAST_ACTIVITY']) > $timeout) {

    session_unset();
    session_destroy();
    header("Location: ../login.php?session=expired");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

/* &#128272; ADMIN LOGIN CHECK */
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel | EduNova University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="../assets/css/all.min.css" rel="stylesheet">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="admin-body">
