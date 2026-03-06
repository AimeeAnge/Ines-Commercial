<?php
require_once __DIR__ . '/init.php';
// products.php - Admin Products
require_once 'db.php';
require_once 'mvc/controllers/ProductController.php';
$controller = new ProductController($conn);
$data = $controller->handleList();
extract($data);
require_once 'mvc/views/products_view.php';
?>
