<?php
// mvc/models/DashboardModel.php
class DashboardModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getStats() {
        $userCount = $this->conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
        $productCount = $this->conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
        $messageCount = $this->conn->query("SELECT COUNT(*) as count FROM messages WHERE status = 'Pending' AND type = 'Message'")->fetch_assoc()['count'];
        $requestCount = $this->conn->query("SELECT COUNT(*) as count FROM messages WHERE status = 'Pending' AND type = 'Request'")->fetch_assoc()['count'];
        
        return [
            'userCount' => $userCount,
            'productCount' => $productCount,
            'messageCount' => $messageCount,
            'requestCount' => $requestCount
        ];
    }

    public function getRecentRequests($limit = 5) {
        return $this->conn->query("SELECT m.*, u.name as sender_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.type = 'Request' ORDER BY m.timestamp DESC LIMIT $limit");
    }
}
?>
