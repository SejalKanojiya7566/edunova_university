<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");

if (isset($_GET['id'], $_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    if (in_array($status, ['Approved','Rejected','Pending'])) {
        mysqli_query($conn,
            "UPDATE scholarships SET status='$status' WHERE id=$id"
        );
    }
}

header("Location: view.php");
exit();
