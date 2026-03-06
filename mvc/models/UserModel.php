<?php
// mvc/models/UserModel.php
class UserModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        return $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addUser($name, $email, $password, $role)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $avatar = 'https://i.pravatar.cc/150?u=' . urlencode($email);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, avatar_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hash, $role, $avatar);
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function updateRole($id, $role)
    {
        $stmt = $this->db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }

    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function getUserCount()
    {
        $r = $this->db->query("SELECT COUNT(*) as cnt FROM users");
        return $r->fetch_assoc()['cnt'];
    }
}
?>
