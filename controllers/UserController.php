<?php
class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showUser($id) {
        $user = $this->model->getUserById($id);
        include 'views/user.php';
    }
}
?>