<?php
// student_dashboard.php - Student Dashboard Entry
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Admin should not see student dashboard
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin') {
    header("Location: dashboard.php");
    exit();
}

require_once 'db.php';
require_once 'mvc/models/ProductModel.php';
require_once 'mvc/models/OrderModel.php';
require_once 'mvc/models/MessageModel.php';
require_once 'mvc/controllers/OrderController.php';
require_once 'mvc/controllers/MessageController.php';
require_once 'mvc/controllers/ProductController.php';

$userId = $_SESSION['user_id'];
$activeTab = $_GET['tab'] ?? 'shop';

$success_msg = '';
$error_msg = '';

// Order/Cart controller
$orderController = new OrderController($conn);
$cartData = $orderController->handleCart();
$success_msg = $success_msg ?: $cartData['success_msg'];
$error_msg = $error_msg ?: $cartData['error_msg'];
$cartItems = $cartData['cartItems'];
$cartTotal = $cartData['cartTotal'];
$cartCount = $cartData['cartCount'];

// My orders
$myOrderData = $orderController->handleMyOrders();
$myOrders = $myOrderData['orders'];

// Message/Chat controller
$msgController = new MessageController($conn);
$chatData = $msgController->handleStudentMessages();
$success_msg = $success_msg ?: $chatData['success_msg'];
$error_msg = $error_msg ?: $chatData['error_msg'];
$chatMessages = $chatData['messages'];

// Product request controller
$productController = new ProductController($conn);
$reqData = $productController->handleStudentRequest();
$success_msg = $success_msg ?: $reqData['success_msg'];
$error_msg = $error_msg ?: $reqData['error_msg'];

// Get published products for shop
$productModel = new ProductModel($conn);
$productResult = $productModel->getPublishedProducts();
$products = [];
while ($p = $productResult->fetch_assoc()) {
    $products[] = $p;
}

// My product requests
$myRequests = $productModel->getUserRequests($userId);

require_once 'mvc/views/student_dashboard_view.php';
?>
