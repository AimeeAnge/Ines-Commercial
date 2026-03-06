<?php
require_once __DIR__ . '/init.php';
// announcements.php - Web entry point for admin announcements
require_once 'db.php';
require_once 'mvc/controllers/AnnouncementController.php';

$controller = new AnnouncementController($conn);
$data = $controller->handleAnnouncements();

extract($data);
include 'mvc/views/announcements_view.php';
?>
