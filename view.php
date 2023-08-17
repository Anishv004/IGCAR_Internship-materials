<!DOCTYPE html>
<html>

<head>
    <title>MVC Webpage</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <h1>Enter your information</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name"><br><br>
        <label for="age">Age:</label>
        <input type="text" name="age"><br><br>
        <label for="city">City:</label>
        <input type="text" name="city"><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php if (!empty($user)) : ?>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <h2>User Information</h2>
            <div id="display">
                <p>Name: <?php echo $user->name; ?></p>
                <p>Age: <?php echo $user->age; ?></p>
                <p>City: <?php echo $user->city; ?></p>
            </div>
            
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>