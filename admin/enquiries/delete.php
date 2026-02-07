<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    mysqli_query($conn, "DELETE FROM enquiries WHERE id=$id");
}

header("Location: view.php");
exit();
