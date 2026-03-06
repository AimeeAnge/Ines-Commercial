<?php
// users.php - Admin Users
session_start();
require_once 'db.php';
require_once 'mvc/controllers/UserController.php';
$controller = new UserController($conn);
$data = $controller->handleList();
extract($data);
require_once 'mvc/views/users_view.php';
?>
