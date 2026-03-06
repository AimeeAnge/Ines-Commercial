<?php
// mvc/controllers/AuthController.php
require_once __DIR__ . '/../models/AuthModel.php';

class AuthController {
    private $model;

    public function __construct($db) {
        $this->model = new AuthModel($db);
    }

    public function handleLogin() {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_avatar'] = $user['avatar_url'];
                
                if ($user['role'] == 'Student') {
                    header("Location: student_dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        }
        return ['error' => $error];
    }

    public function handleSignup() {
        $error = "";
        $success = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->model->emailExists($email)) {
                $error = "Email already registered.";
            } else {
                if ($this->model->signup($name, $email, $password)) {
                    $success = "Account created successfully. You can now login.";
                } else {
                    $error = "Failed to create account.";
                }
            }
        }
        return ['error' => $error, 'success' => $success];
    }
}
?>
