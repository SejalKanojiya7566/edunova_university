<?php
include("config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $email  = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');

    // ---------- VALIDATION ----------
    if ($email == "" || $mobile == "") {
        header("Location: index.php?error=empty");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=invalid_email");
        exit();
    }

    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        header("Location: index.php?error=invalid_mobile");
        exit();
    }

    // ---------- DUPLICATE CHECK ----------
    $check = mysqli_query(
        $conn,
        "SELECT id FROM subscribers WHERE email='$email' OR mobile='$mobile'"
    );

    if (mysqli_num_rows($check) > 0) {
        header("Location: index.php?error=duplicate");
        exit();
    }

    // ---------- INSERT ----------
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO subscribers (email, mobile) VALUES (?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "ss", $email, $mobile);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "DB Error: " . mysqli_error($conn);
    }
}