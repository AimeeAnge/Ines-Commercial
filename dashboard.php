<?php
require_once __DIR__ . '/init.php';
// dashboard.php - Admin Dashboard
require_once 'db.php';
require_once 'mvc/controllers/DashboardController.php';
$controller = new DashboardController($conn);
$data = $controller->handleAdminDashboard();
extract($data);
require_once 'mvc/views/dashboard_view.php';
?>
