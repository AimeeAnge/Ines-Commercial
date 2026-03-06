<?php
// mvc/controllers/GeneralController.php
require_once __DIR__ . '/../models/GeneralModel.php';

class GeneralController {
    private $model;

    public function __construct($db) {
        $this->model = new GeneralModel($db);
    }

    public function handleIndex() {
        $featured_products = $this->model->getFeaturedProducts();
        $announcements = $this->model->getLatestAnnouncements();
        return ['featured_products' => $featured_products, 'announcements' => $announcements];
    }
}
?>
