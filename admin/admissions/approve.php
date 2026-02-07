<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");

$id = $_GET['id'];
$status = $_GET['status'];

if ($status == 'Approved' || $status == 'Rejected') {
    mysqli_query(
        $conn,
        "UPDATE admissions SET status='$status' WHERE id='$id'"
    );
}

header("Location: view.php");
exit();
