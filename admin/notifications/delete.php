<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");

$id = intval($_GET['id']);

if ($id > 0) {
    mysqli_query($conn, "DELETE FROM notifications WHERE id = $id");
}

header("Location: view.php");
exit();
