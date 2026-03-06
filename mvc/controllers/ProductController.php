<?php
// mvc/controllers/ProductController.php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ProductModel($db);
    }

    private function requireAdmin()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: login.php");
            exit();
        }
    }

    private function handleImageUpload($fieldName)
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK)
            return '';
        $file = $_FILES[$fieldName];
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowed))
            return '';
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('prod_') . '.' . $ext;
        $uploadDir = __DIR__ . '/../../assets/uploads/products/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0755, true);
        $dest = $uploadDir . $filename;
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return 'assets/uploads/products/' . $filename;
        }
        return '';
    }

    public function handleList()
    {
        $this->requireAdmin();
        $success_msg = '';
        $error_msg = '';

        // Add product
        if (isset($_POST['add_product'])) {
            $name = trim($_POST['name']);
            $desc = trim($_POST['description']);
            $price = floatval($_POST['price']);
            $stock = intval($_POST['stock']);
            $category = trim($_POST['category']);
            $imageUrl = trim($_POST['image_url'] ?? '');
            $imagePath = $this->handleImageUpload('product_image');

            if (empty($name) || $price <= 0) {
                $error_msg = "Product name and valid price are required.";
            }
            else {
                if ($this->model->addProduct($name, $desc, $price, $stock, $category, $imageUrl, $imagePath)) {
                    $success_msg = "Product '$name' added successfully!";
                }
                else {
                    $error_msg = "Failed to add product.";
                }
            }
        }

        // Delete product
        if (isset($_GET['delete_id'])) {
            $id = intval($_GET['delete_id']);
            if ($this->model->deleteProduct($id)) {
                $success_msg = "Product deleted successfully.";
            }
        }

        // Toggle status
        if (isset($_GET['toggle_id'])) {
            $id = intval($_GET['toggle_id']);
            $product = $this->model->getProductById($id);
            if ($product) {
                $newStatus = $product['status'] == 'Published' ? 'Draft' : 'Published';
                $this->model->updateProductStatus($id, $newStatus);
                $success_msg = "Product status updated.";
            }
        }

        // Approve request
        if (isset($_GET['approve_req'])) {
            $id = intval($_GET['approve_req']);
            if ($this->model->approveRequest($id)) {
                $success_msg = "Product request approved and listed!";
            }
        }

        // Reject request
        if (isset($_GET['reject_req'])) {
            $id = intval($_GET['reject_req']);
            $note = $_GET['note'] ?? 'Not suitable for the marketplace.';
            if ($this->model->rejectRequest($id, $note)) {
                $success_msg = "Product request rejected.";
            }
        }

        $products = $this->model->getAllProducts();
        $requests = $this->model->getAllRequests();
        return compact('products', 'requests', 'success_msg', 'error_msg');
    }

    // For student product request submission
    public function handleStudentRequest()
    {
        $success_msg = '';
        $error_msg = '';

        if (isset($_POST['submit_request'])) {
            $userId = $_SESSION['user_id'];
            $productName = trim($_POST['product_name']);
            $desc = trim($_POST['description']);
            $price = floatval($_POST['price']);
            $category = trim($_POST['category']);
            $imagePath = $this->handleImageUpload('product_image');

            if (empty($productName)) {
                $error_msg = "Product name is required.";
            }
            else {
                if ($this->model->submitRequest($userId, $productName, $desc, $price, $category, $imagePath)) {
                    $success_msg = "Your product request has been submitted for admin review!";
                }
                else {
                    $error_msg = "Failed to submit request.";
                }
            }
        }
        return compact('success_msg', 'error_msg');
    }
}
?>
