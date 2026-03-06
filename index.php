<?php
// index.php - Public homepage entry
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] == 'Admin') {
        header("Location: dashboard.php");
    }
    else {
        header("Location: student_dashboard.php");
    }
    exit();
}
require_once 'db.php';
require_once 'mvc/models/GeneralModel.php';
require_once 'mvc/controllers/GeneralController.php';
$controller = new GeneralController($conn);
$data = $controller->handleIndex();
extract($data);
require_once 'mvc/views/index_view.php';
?>
