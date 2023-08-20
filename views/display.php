<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Student Information</h1>
        <div class="student-info">
            <div class="left-column">
                <h2>Personal Details</h2>
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
                <p><strong>Age:</strong> <?php echo $age; ?></p>
                <p><strong>Registration Number:</strong> <?php echo $regNo; ?></p>
            </div>
            <div class="right-column">
                <h2>Marks Details</h2>
                <p><strong>Mark 1:</strong> <?php echo $mark1; ?></p>
                <p><strong>Mark 2:</strong> <?php echo $mark2; ?></p>
                <p><strong>Mark 3:</strong> <?php echo $mark3; ?></p>
                <h2>Percentile</h2>
                <p><strong>Percentile:</strong> <?php echo $percentile; ?></p>
            </div>
        </div>
    </div>
    <canvas id="marksChart"></canvas>
    <script>
    var marksChart = new Chart(document.getElementById("marksChart"), {
        type: 'bar',
        data: {
            labels: ['Subject 1', 'Subject 2', 'Subject 3'],
            datasets: [
                {
                    label: 'Your Marks',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: [<?php echo $mark1; ?>, <?php echo $mark2; ?>, <?php echo $mark3; ?>]
                },
                {
                    label: 'Max Marks',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: [
                        <?php echo $maxMarksBySubject['max_mark1']; ?>,
                        <?php echo $maxMarksBySubject['max_mark2']; ?>,
                        <?php echo $maxMarksBySubject['max_mark3']; ?>
                    ]
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
