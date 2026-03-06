<?php
require_once __DIR__ . '/init.php';
// signup.php
if (isset($_SESSION['user_id'])) {
    header("Location: student_dashboard.php");
    exit();
}
require_once 'db.php';
require_once 'mvc/controllers/AuthController.php';
$controller = new AuthController($conn);
$data = $controller->handleSignup();
$error = $data['error'];
$success = $data['success'];
require_once 'mvc/views/signup_view.php';
?>
