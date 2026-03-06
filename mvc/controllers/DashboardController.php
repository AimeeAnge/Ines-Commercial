<?php
// mvc/controllers/DashboardController.php
require_once __DIR__ . '/../models/DashboardModel.php';
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/ProductModel.php';

class DashboardController
{
    private $model;
    private $orderModel;
    private $productModel;

    public function __construct($db)
    {
        $this->model = new DashboardModel($db);
        $this->orderModel = new OrderModel($db);
        $this->productModel = new ProductModel($db);
    }

    public function handleAdminDashboard()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            if (isset($_SESSION['user_id'])) {
                header("Location: student_dashboard.php");
            }
            else {
                header("Location: login.php");
            }
            exit();
        }
        $stats = $this->model->getStats();
        $stats['pendingOrders'] = $this->orderModel->getPendingOrderCount();
        $stats['pendingRequests'] = $this->productModel->getPendingRequestCount();
        $recentRequests = $this->model->getRecentRequests();
        $pendingOrders = $this->orderModel->getPendingOrders();
        $pendingProductReqs = $this->productModel->getPendingRequests();
        return compact('stats', 'recentRequests', 'pendingOrders', 'pendingProductReqs');
    }
}
?>
