<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'student_db';

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Create the students table if it doesn't exist
$createTableQuery = "
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    age INT NOT NULL,
    reg_no VARCHAR(20) NOT NULL,
    mark1 INT NOT NULL,
    mark2 INT NOT NULL,
    mark3 INT NOT NULL
)
";
$db->exec($createTableQuery);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
