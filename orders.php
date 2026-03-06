<?php
// orders.php - Admin Orders
session_start();
require_once 'db.php';
require_once 'mvc/controllers/OrderController.php';
$controller = new OrderController($conn);
$data = $controller->handleAdminOrders();
extract($data);
require_once 'mvc/views/orders_view.php';
?>
