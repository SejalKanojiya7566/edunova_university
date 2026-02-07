<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php"); exit();
}
include("../../config/db.php");

$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM programs WHERE id=$id");

header("Location: view.php");
exit();
