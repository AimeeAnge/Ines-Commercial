<?php
require_once __DIR__ . '/init.php';
// login.php
if (isset($_SESSION['user_id'])) {
    header("Location: " . ($_SESSION['user_role'] == 'Admin' ? 'dashboard.php' : 'student_dashboard.php'));
    exit();
}
require_once 'db.php';
require_once 'mvc/controllers/AuthController.php';
$controller = new AuthController($conn);
$data = $controller->handleLogin();
$error = $data['error'];
require_once 'mvc/views/login_view.php';
?>
