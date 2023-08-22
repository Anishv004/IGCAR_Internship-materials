<!DOCTYPE html>
<html>

<head>
    <title>Student Information Form</title>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>

<body>
    <header>
        <div>
            <!-- <img src="Student_visualise\views\bg_image.jpg"> -->
            <div class="flex-container">
                <h1><b>Student Information Form</b></h1>
            </div>
    </header>
    <div class="inp">
        <form action="index.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <label for="reg_no">Registration Number:</label>
            <input type="text" id="reg_no" name="reg_no" required><br>

            <label for="mark1">Mark 1:</label>
            <input type="number" id="mark1" name="mark1" required><br>

            <label for="mark2">Mark 2:</label>
            <input type="number" id="mark2" name="mark2" required><br>

            <label for="mark3">Mark 3:</label>
            <input type="number" id="mark3" name="mark3" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>

    </div>
</body>

</html>