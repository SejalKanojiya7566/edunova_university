<?php
session_start();

/* session data clear */
$_SESSION = [];

/* session destroy */
session_destroy();

/* browser cache clear */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* redirect to login */
header("Location: ../login.php");
exit();
