<?php
// announcements.php - Web entry point for admin announcements
session_start();
require_once 'db.php';
require_once 'mvc/controllers/AnnouncementController.php';

$controller = new AnnouncementController($conn);
$data = $controller->handleAnnouncements();

extract($data);
include 'mvc/views/announcements_view.php';
?>
