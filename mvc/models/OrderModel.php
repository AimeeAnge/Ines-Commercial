<?php
// mvc/models/OrderModel.php
class OrderModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    // ---- CART ----
    public function getCartItems($userId)
    {
        $stmt = $this->db->prepare("SELECT ci.*, p.name, p.price, p.image_url, p.image_path, p.category, p.stock_quantity FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getCartCount($userId)
    {
        $stmt = $this->db->prepare("SELECT SUM(quantity) as cnt FROM cart_items WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row['cnt'] ?? 0;
    }

    public function addToCart($userId, $productId, $qty = 1)
    {
        // Check if already in cart
        $stmt = $this->db->prepare("SELECT id, quantity FROM cart_items WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $existing = $stmt->get_result()->fetch_assoc();
        if ($existing) {
            $newQty = $existing['quantity'] + $qty;
            $stmt2 = $this->db->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
            $stmt2->bind_param("ii", $newQty, $existing['id']);
            return $stmt2->execute();
        }
        else {
            $stmt2 = $this->db->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt2->bind_param("iii", $userId, $productId, $qty);
            return $stmt2->execute();
        }
    }

    public function removeFromCart($cartItemId, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cartItemId, $userId);
        return $stmt->execute();
    }

    public function clearCart($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function getCartTotal($userId)
    {
        $stmt = $this->db->prepare("SELECT SUM(ci.quantity * p.price) as total FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row['total'] ?? 0;
    }

    // ---- ORDERS ----
    public function placeOrder($userId, $notes = '')
    {
        $cartItems = $this->getCartItems($userId);
        if ($cartItems->num_rows == 0)
            return false;

        $total = $this->getCartTotal($userId);

        // Create order
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price, status, notes) VALUES (?, ?, 'Pending', ?)");
        $stmt->bind_param("ids", $userId, $total, $notes);
        $stmt->execute();
        $orderId = $this->db->insert_id;

        // Add order items
        $cartItems = $this->getCartItems($userId);
        $stmt2 = $this->db->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");
        while ($item = $cartItems->fetch_assoc()) {
            $stmt2->bind_param("iisid", $orderId, $item['product_id'], $item['name'], $item['quantity'], $item['price']);
            $stmt2->execute();
        }

        $this->clearCart($userId);
        return $orderId;
    }

    public function getAllOrders()
    {
        return $this->db->query("SELECT o.*, u.name as user_name, u.email, u.avatar_url FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC");
    }

    public function getPendingOrders()
    {
        return $this->db->query("SELECT o.*, u.name as user_name, u.avatar_url FROM orders o JOIN users u ON o.user_id = u.id WHERE o.status = 'Pending' ORDER BY o.created_at DESC");
    }

    public function getPendingOrderCount()
    {
        $r = $this->db->query("SELECT COUNT(*) as cnt FROM orders WHERE status = 'Pending'");
        return $r->fetch_assoc()['cnt'];
    }

    public function getUserOrders($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getOrderItems($orderId)
    {
        $stmt = $this->db->prepare("SELECT oi.*, p.image_url, p.image_path FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateOrderStatus($orderId, $status)
    {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }
}
?>
