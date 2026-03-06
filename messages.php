<?php
require_once __DIR__ . '/init.php';
// messages.php - Admin Messages
require_once 'db.php';
require_once 'mvc/controllers/MessageController.php';
$controller = new MessageController($conn);
$data = $controller->handleAdminMessages();
extract($data);
require_once 'mvc/views/messages_view.php';
?>
