<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create School</title>
</head>
<body>
    <h1>Create School</h1>
    <a href="index.php">Back</a>
    <form action="save.php" method="post">
        <label for="school_name">School Name</label>
        <input type="text" name="school_name" id="school_name">
        <br>
        <label for="prof_num">Professor Number:</label>
        <input type="number" name="prof_num" id="prof_num">
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>