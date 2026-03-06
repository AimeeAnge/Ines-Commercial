<?php
// mvc/controllers/UserController.php
require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new UserModel($db);
    }

    private function requireAdmin()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: login.php");
            exit();
        }
    }

    public function handleList()
    {
        $this->requireAdmin();
        $success_msg = '';
        $error_msg = '';

        // Add user
        if (isset($_POST['add_user'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role'];

            if ($this->model->emailExists($email)) {
                $error_msg = "Email already registered.";
            }
            elseif (empty($name) || empty($email) || empty($password)) {
                $error_msg = "All fields are required.";
            }
            else {
                if ($this->model->addUser($name, $email, $password, $role)) {
                    $success_msg = "User '$name' created successfully!";
                }
                else {
                    $error_msg = "Failed to create user.";
                }
            }
        }

        // Delete user
        if (isset($_GET['delete_id'])) {
            $id = intval($_GET['delete_id']);
            if ($id == $_SESSION['user_id']) {
                $error_msg = "You cannot delete your own account.";
            }
            else {
                $this->model->deleteUser($id);
                $success_msg = "User deleted.";
            }
        }

        // Suspend user
        if (isset($_GET['suspend_id'])) {
            $id = intval($_GET['suspend_id']);
            $this->model->updateStatus($id, 'Suspended');
            $success_msg = "User suspended.";
        }

        // Activate user
        if (isset($_GET['activate_id'])) {
            $id = intval($_GET['activate_id']);
            $this->model->updateStatus($id, 'Active');
            $success_msg = "User activated.";
        }

        // Change role
        if (isset($_POST['change_role'])) {
            $id = intval($_POST['user_id']);
            $role = $_POST['new_role'];
            $this->model->updateRole($id, $role);
            $success_msg = "User role updated.";
        }

        $users = $this->model->getAllUsers();
        return compact('users', 'success_msg', 'error_msg');
    }
}
?>
