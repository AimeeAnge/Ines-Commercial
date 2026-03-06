<?php
// mvc/models/ProductModel.php
class ProductModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        return $this->db->query("SELECT p.*, u.name as seller_name FROM products p LEFT JOIN users u ON p.seller_id = u.id ORDER BY p.created_at DESC");
    }

    public function getPublishedProducts($limit = null)
    {
        $sql = "SELECT * FROM products WHERE status = 'Published' ORDER BY created_at DESC";
        if ($limit)
            $sql .= " LIMIT $limit";
        return $this->db->query($sql);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addProduct($name, $desc, $price, $stock, $category, $imageUrl, $imagePath, $sellerId = null)
    {
        $status = 'Published';
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, stock_quantity, category, image_url, image_path, seller_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdisssis", $name, $desc, $price, $stock, $category, $imageUrl, $imagePath, $sellerId, $status);
        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        // Get image path first
        $stmt = $this->db->prepare("SELECT image_path FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        if ($row && $row['image_path'] && file_exists(__DIR__ . '/../../' . $row['image_path'])) {
            unlink(__DIR__ . '/../../' . $row['image_path']);
        }
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateProductStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE products SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    // Product Requests
    public function submitRequest($userId, $productName, $desc, $price, $category, $imagePath)
    {
        $stmt = $this->db->prepare("INSERT INTO product_requests (user_id, product_name, description, price, category, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdss", $userId, $productName, $desc, $price, $category, $imagePath);
        return $stmt->execute();
    }

    public function getAllRequests()
    {
        return $this->db->query("SELECT pr.*, u.name as user_name, u.avatar_url FROM product_requests pr JOIN users u ON pr.user_id = u.id ORDER BY pr.created_at DESC");
    }

    public function getPendingRequests()
    {
        return $this->db->query("SELECT pr.*, u.name as user_name, u.avatar_url FROM product_requests pr JOIN users u ON pr.user_id = u.id WHERE pr.status = 'Pending' ORDER BY pr.created_at DESC");
    }

    public function getUserRequests($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM product_requests WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function approveRequest($id)
    {
        // Get request data and create product
        $stmt = $this->db->prepare("SELECT * FROM product_requests WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $req = $stmt->get_result()->fetch_assoc();
        if ($req) {
            $this->addProduct($req['product_name'], $req['description'], $req['price'], 1, $req['category'], '', $req['image_path'], $req['user_id']);
            $stmt2 = $this->db->prepare("UPDATE product_requests SET status = 'Approved' WHERE id = ?");
            $stmt2->bind_param("i", $id);
            return $stmt2->execute();
        }
        return false;
    }

    public function rejectRequest($id, $note = '')
    {
        $stmt = $this->db->prepare("UPDATE product_requests SET status = 'Rejected', admin_note = ? WHERE id = ?");
        $stmt->bind_param("si", $note, $id);
        return $stmt->execute();
    }

    public function getPendingRequestCount()
    {
        $r = $this->db->query("SELECT COUNT(*) as cnt FROM product_requests WHERE status = 'Pending'");
        return $r->fetch_assoc()['cnt'];
    }
}
?>
