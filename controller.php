<?php
require 'model.php';

class UserController {
    public function index() {
        $user = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->name = $_POST['name'];
            $user->age = $_POST['age'];
            $user->city = $_POST['city'];
        }

        include 'view.php';
    }
}

$controller = new UserController();
$controller->index();
?>
