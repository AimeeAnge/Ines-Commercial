<?php
// logout.php
require_once __DIR__ . '/init.php';
session_destroy();
// Clear session cookie for good measure
setcookie(session_name(), '', time() - 3600, '/');
header("Location: login.php");
exit();
?>
