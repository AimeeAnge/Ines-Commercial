<?php
// mvc/controllers/AnnouncementController.php
require_once __DIR__ . '/../models/AnnouncementModel.php';
require_once __DIR__ . '/../models/MessageModel.php';

class AnnouncementController
{
    private $model;
    private $messageModel;

    public function __construct($db)
    {
        $this->model = new AnnouncementModel($db);
        $this->messageModel = new MessageModel($db);
    }

    public function handleAnnouncements()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: login.php");
            exit();
        }

        $success_msg = '';

        // Create new announcement
        if (isset($_POST['create_announcement'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            if ($this->model->createAnnouncement($title, $content)) {
                $success_msg = "Announcement posted successfully!";
            }
        }

        // Delete announcement
        if (isset($_GET['delete_announcement'])) {
            $id = intval($_GET['delete_announcement']);
            if ($this->model->deleteAnnouncement($id)) {
                $success_msg = "Announcement deleted.";
            }
        }

        // Approve and post an announcement request
        if (isset($_GET['approve_request'])) {
            $requestId = intval($_GET['approve_request']);
            // First we need to get the request details from messages
            $msgRes = $this->messageModel->getAllMessages();
            $title = "";
            $content = "";
            while ($msg = $msgRes->fetch_assoc()) {
                if ($msg['id'] == $requestId && $msg['type'] == 'AnnouncementRequest') {
                    $title = $msg['subject'];
                    $content = $msg['content'];
                    break;
                }
            }

            if (!empty($title) && !empty($content)) {
                if ($this->model->createAnnouncement($title, $content)) {
                    $this->messageModel->updateStatus($requestId, 'Approved');
                    $success_msg = "Announcement request approved and posted!";
                }
            }
        }

        // Reject an announcement request
        if (isset($_GET['reject_request'])) {
            $requestId = intval($_GET['reject_request']);
            $this->messageModel->updateStatus($requestId, 'Rejected');
            $success_msg = "Announcement request rejected.";
        }

        // Get all active announcements
        $announcements = $this->model->getAllAnnouncements();

        // Get all announcement requests
        $allMessages = $this->messageModel->getAllMessages();
        $announcementRequests = [];
        while ($msg = $allMessages->fetch_assoc()) {
            if ($msg['type'] == 'AnnouncementRequest' && $msg['status'] == 'Pending') {
                $announcementRequests[] = $msg;
            }
        }

        return compact('announcements', 'announcementRequests', 'success_msg');
    }
}
?>
