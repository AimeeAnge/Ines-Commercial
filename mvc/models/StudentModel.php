<?php
// mvc/models/StudentModel.php
class StudentModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMessagesForStudent($user_id) {
        $stmt = $this->conn->prepare("
            SELECT m.*, u.name as other_user_name 
            FROM messages m 
            LEFT JOIN users u ON (m.sender_id = u.id OR m.receiver_id = u.id) AND u.id != ?
            WHERE m.sender_id = ? OR m.receiver_id = ?
            ORDER BY m.timestamp DESC
        ");
        $stmt->bind_param("iii", $user_id, $user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function sendRequest($sender_id, $subject, $content) {
        $type = 'Request';
        $admin_res = $this->conn->query("SELECT id FROM users WHERE role = 'Admin' LIMIT 1");
        if ($admin_res->num_rows > 0) {
            $admin = $admin_res->fetch_assoc();
            $admin_id = $admin['id'];
            
            $stmt = $this->conn->prepare("INSERT INTO messages (sender_id, receiver_id, subject, content, type) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $sender_id, $admin_id, $subject, $content, $type);
            return $stmt->execute();
        }
        return false;
    }

    public function sendReply($sender_id, $receiver_id, $subject, $content) {
        $type = 'Message';
        $stmt = $this->conn->prepare("INSERT INTO messages (sender_id, receiver_id, subject, content, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $sender_id, $receiver_id, $subject, $content, $type);
        return $stmt->execute();
    }
}
?>
