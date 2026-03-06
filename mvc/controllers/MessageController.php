<?php
// mvc/controllers/MessageController.php
require_once __DIR__ . '/../models/MessageModel.php';

class MessageController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new MessageModel($db);
    }

    public function handleAdminMessages()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: login.php");
            exit();
        }
        $success_msg = '';

        // Reply to a message
        if (isset($_POST['send_reply'])) {
            $receiverId = intval($_POST['receiver_id']);
            $subject = 'Re: ' . trim($_POST['original_subject']);
            $content = trim($_POST['reply_content']);
            $this->model->sendMessage($_SESSION['user_id'], $receiverId, $subject, $content, 'Message');
            $success_msg = "Reply sent!";
        }

        // Mark as read
        if (isset($_GET['action']) && $_GET['action'] == 'read' && isset($_GET['id'])) {
            $this->model->updateStatus(intval($_GET['id']), 'Read');
        }

        // Archive/delete
        if (isset($_GET['action']) && $_GET['action'] == 'archive' && isset($_GET['id'])) {
            $this->model->deleteMessage(intval($_GET['id']));
            $success_msg = "Message archived.";
        }

        // Approve product request message
        if (isset($_GET['action']) && $_GET['action'] == 'approve' && isset($_GET['id'])) {
            $this->model->updateStatus(intval($_GET['id']), 'Approved');
            $success_msg = "Product request approved!";
        }

        $messages = $this->model->getAllMessages();
        return compact('messages', 'success_msg');
    }

    public function handleStudentMessages()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
        $userId = $_SESSION['user_id'];
        $adminId = $this->model->getAdminId();
        $success_msg = '';
        $error_msg = '';

        // Send new message to admin
        if (isset($_POST['send_message'])) {
            $subject = trim($_POST['subject']);
            $content = trim($_POST['content']);
            $type = $_POST['type'] ?? 'Message';
            if (empty($subject) || empty($content)) {
                $error_msg = "Subject and message are required.";
            }
            else {
                $this->model->sendMessage($userId, $adminId, $subject, $content, $type);
                $success_msg = "Message sent to admin!";
            }
        }

        // Reply
        if (isset($_POST['send_reply'])) {
            $receiverId = intval($_POST['receiver_id']);
            $subject = 'Re: ' . trim($_POST['original_subject']);
            $content = trim($_POST['reply_content']);
            $this->model->sendMessage($userId, $receiverId, $subject, $content, 'Message');
            $success_msg = "Reply sent!";
        }

        $messages = $this->model->getMessagesForUser($userId);
        return compact('messages', 'success_msg', 'error_msg', 'adminId');
    }
}
?>
