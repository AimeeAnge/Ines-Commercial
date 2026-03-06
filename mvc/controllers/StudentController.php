<?php
// mvc/controllers/StudentController.php
require_once __DIR__ . '/../models/StudentModel.php';

class StudentController {
    private $model;

    public function __construct($db) {
        $this->model = new StudentModel($db);
    }

    public function handleRequest($user_id) {
        $success_msg = "";
        $error_msg = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['send_request'])) {
                $subject = $_POST['subject'];
                $content = $_POST['content'];
                if ($this->model->sendRequest($user_id, $subject, $content)) {
                    $success_msg = "Your request has been sent to the admin.";
                } else {
                    $error_msg = "Failed to send request.";
                }
            } elseif (isset($_POST['send_reply'])) {
                $receiver_id = $_POST['receiver_id'];
                $subject = "RE: " . $_POST['original_subject'];
                $content = $_POST['reply_content'];
                if ($this->model->sendReply($user_id, $receiver_id, $subject, $content)) {
                    $success_msg = "Your reply has been sent.";
                } else {
                    $error_msg = "Failed to send reply.";
                }
            }
        }

        $messages = $this->model->getMessagesForStudent($user_id);
        return ['messages' => $messages, 'success_msg' => $success_msg, 'error_msg' => $error_msg];
    }
}
?>
