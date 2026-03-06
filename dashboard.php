<?php
// dashboard.php - Admin Dashboard
session_start();
require_once 'db.php';
require_once 'mvc/controllers/DashboardController.php';
$controller = new DashboardController($conn);
$data = $controller->handleAdminDashboard();
extract($data);
require_once 'mvc/views/dashboard_view.php';
?>
