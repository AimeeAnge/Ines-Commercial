<?php
require_once __DIR__ . '/init.php';
// orders.php - Admin Orders
require_once 'db.php';
require_once 'mvc/controllers/OrderController.php';
$controller = new OrderController($conn);
$data = $controller->handleAdminOrders();
extract($data);
require_once 'mvc/views/orders_view.php';
?>
