<?php
require_once 'models/StudentModel.php';

class StudentController {
    private $model;

    public function __construct($db) {
        $this->model = new StudentModel($db);
    }

    public function addStudent($name, $dob, $age, $regNo, $mark1, $mark2, $mark3) {
        // Add student data to the database
        return $this->model->addStudent($name, $dob, $age, $regNo, $mark1, $mark2, $mark3);
    }

    public function processForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $dob = $_POST['dob'];
            $age = $_POST['age'];
            $regNo = $_POST['reg_no'];
            $mark1 = $_POST['mark1'];
            $mark2 = $_POST['mark2'];
            $mark3 = $_POST['mark3'];

            $result = $this->addStudent($name, $dob, $age, $regNo, $mark1, $mark2, $mark3);

            if ($result) {
                // Calculate percentile
                $totalMarks = $mark1 + $mark2 + $mark3;
                $maxMarks = $this->model->getMaxMarks();

                if ($maxMarks == 0) {
                    $percentile = 100;
                } else {
                    $percentile = ($totalMarks / $maxMarks) * 100;
                }

                $maxMarksBySubject = $this->model->getMaxMarksBySubject();

            include 'views/display.php';
            } else {
                echo "Failed to add student data.";
            }
        } else {
            include 'views/home.php';
        }
    }
}
?>
