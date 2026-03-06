<?php
// mvc/controllers/OrderController.php
require_once __DIR__ . '/../models/OrderModel.php';

class OrderController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new OrderModel($db);
    }

    public function handleCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        $userId = $_SESSION['user_id'];
        $success_msg = '';
        $error_msg = '';

        // Add to cart
        if (isset($_POST['add_to_cart'])) {
            $productId = intval($_POST['product_id']);
            $qty = max(1, intval($_POST['quantity'] ?? 1));
            $this->model->addToCart($userId, $productId, $qty);
            $success_msg = "Item added to cart!";
        }

        // Remove from cart
        if (isset($_GET['remove_cart'])) {
            $cartItemId = intval($_GET['remove_cart']);
            $this->model->removeFromCart($cartItemId, $userId);
        }

        // Place order
        if (isset($_POST['place_order'])) {
            $notes = trim($_POST['notes'] ?? '');
            $orderId = $this->model->placeOrder($userId, $notes);
            if ($orderId) {
                $success_msg = "Order #$orderId placed successfully! Waiting for admin approval.";
            }
            else {
                $error_msg = "Your cart is empty. Add products before placing an order.";
            }
        }

        $cartItems = $this->model->getCartItems($userId);
        $cartTotal = $this->model->getCartTotal($userId);
        $cartCount = $this->model->getCartCount($userId);
        return compact('cartItems', 'cartTotal', 'cartCount', 'success_msg', 'error_msg');
    }

    public function handleAdminOrders()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: login.php");
            exit();
        }
        $success_msg = '';

        if (isset($_GET['approve_order'])) {
            $this->model->updateOrderStatus(intval($_GET['approve_order']), 'Approved');
            $success_msg = "Order approved!";
        }
        if (isset($_GET['reject_order'])) {
            $this->model->updateOrderStatus(intval($_GET['reject_order']), 'Rejected');
            $success_msg = "Order rejected.";
        }

        $orders = $this->model->getAllOrders();
        return compact('orders', 'success_msg');
    }

    public function handleMyOrders()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        $userId = $_SESSION['user_id'];
        $orders = $this->model->getUserOrders($userId);
        return compact('orders');
    }

    public function getOrderItems($orderId)
    {
        return $this->model->getOrderItems($orderId);
    }
}
?>
