<?php
require_once 'config.php';
require_once 'models/StudentModel.php';
require_once 'controllers/StudentController.php';

$controller = new StudentController($db);
$controller->processForm();
?>
