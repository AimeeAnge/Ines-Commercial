<?php
// mvc/models/AnnouncementModel.php
class AnnouncementModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllAnnouncements()
    {
        return $this->db->query("SELECT * FROM announcements ORDER BY date DESC");
    }

    public function createAnnouncement($title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO announcements (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $content);
        return $stmt->execute();
    }

    public function deleteAnnouncement($id)
    {
        $stmt = $this->db->prepare("DELETE FROM announcements WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
