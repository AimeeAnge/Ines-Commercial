<?php
// mvc/models/MessageModel.php
class MessageModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllMessages()
    {
        return $this->db->query("SELECT m.*, u.name as sender_name, u.avatar_url as sender_avatar FROM messages m LEFT JOIN users u ON m.sender_id = u.id ORDER BY m.timestamp DESC");
    }

    public function getMessagesForUser($userId)
    {
        $stmt = $this->db->prepare("SELECT m.*, u.name as sender_name, u.avatar_url as sender_avatar FROM messages m LEFT JOIN users u ON m.sender_id = u.id WHERE m.sender_id = ? OR m.receiver_id = ? ORDER BY m.timestamp ASC");
        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getConversations()
    {
        // Get latest message per user (for admin chat overview)
        return $this->db->query("SELECT m.*, u.name as sender_name, u.avatar_url as sender_avatar FROM messages m JOIN users u ON (CASE WHEN m.sender_id != 1 THEN m.sender_id ELSE m.receiver_id END) = u.id WHERE u.role != 'Admin' GROUP BY LEAST(m.sender_id, m.receiver_id), GREATEST(m.sender_id, m.receiver_id) ORDER BY m.timestamp DESC");
    }

    public function getConversation($userId1, $userId2)
    {
        $stmt = $this->db->prepare("SELECT m.*, u.name as sender_name, u.avatar_url as sender_avatar FROM messages m LEFT JOIN users u ON m.sender_id = u.id WHERE (m.sender_id = ? AND m.receiver_id = ?) OR (m.sender_id = ? AND m.receiver_id = ?) ORDER BY m.timestamp ASC");
        $stmt->bind_param("iiii", $userId1, $userId2, $userId2, $userId1);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function sendMessage($senderId, $receiverId, $subject, $content, $type = 'Message')
    {
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, subject, content, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $senderId, $receiverId, $subject, $content, $type);
        return $stmt->execute();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE messages SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function deleteMessage($id)
    {
        $stmt = $this->db->prepare("DELETE FROM messages WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getPendingCount()
    {
        $r = $this->db->query("SELECT COUNT(*) as cnt FROM messages WHERE status = 'Pending' AND type = 'Message'");
        return $r->fetch_assoc()['cnt'];
    }

    public function getRecentRequests($limit = 5)
    {
        return $this->db->query("SELECT m.*, u.name as sender_name FROM messages m LEFT JOIN users u ON m.sender_id = u.id WHERE m.type = 'Request' ORDER BY m.timestamp DESC LIMIT $limit");
    }

    public function getAdminId()
    {
        $r = $this->db->query("SELECT id FROM users WHERE role = 'Admin' LIMIT 1");
        $row = $r->fetch_assoc();
        return $row ? $row['id'] : 1;
    }
}
?>
