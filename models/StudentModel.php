<?php
class StudentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addStudent($name, $dob, $age, $regNo, $mark1, $mark2, $mark3) {
        $query = "INSERT INTO students (name, dob, age, reg_no, mark1, mark2, mark3) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $dob, $age, $regNo, $mark1, $mark2, $mark3]);
    }

    public function getMaxMarks() {
        $query = "SELECT MAX(mark1 + mark2 + mark3) AS max_marks FROM students";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['max_marks'];
    }
    public function getMaxMarksBySubject() {
        $query = "
            SELECT 
                MAX(mark1) AS max_mark1,
                MAX(mark2) AS max_mark2,
                MAX(mark3) AS max_mark3
            FROM students
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // public function createStudentsTable() {
    //     $query = "CREATE TABLE IF NOT EXISTS students (
    //                 id INT AUTO_INCREMENT PRIMARY KEY,
    //                 name VARCHAR(255) NOT NULL,
    //                 dob DATE NOT NULL,
    //                 age INT NOT NULL,
    //                 reg_no VARCHAR(20) NOT NULL,
    //                 mark1 INT NOT NULL,
    //                 mark2 INT NOT NULL,
    //                 mark3 INT NOT NULL
    //             )";
    //     $this->db->exec($query);
    // }   

}
?>
