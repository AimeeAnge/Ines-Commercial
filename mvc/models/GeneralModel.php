<?php
// mvc/models/GeneralModel.php
class GeneralModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFeaturedProducts($limit = 8) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE status = 'Published' LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getLatestAnnouncements($limit = 3) {
        $stmt = $this->conn->prepare("SELECT * FROM announcements ORDER BY date DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
