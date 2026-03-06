<?php
// mvc/models/AuthModel.php
class AuthModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, name, password, role, avatar_url FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function signup($name, $email, $password, $role = 'Student') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $avatar_url = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random";
        
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role, avatar_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $role, $avatar_url);
        return $stmt->execute();
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>
