<?php
session_start();

/* Sab session variables destroy */
session_unset();
session_destroy();

/* Login page par redirect */
header("Location: login.php");
exit();
?>
