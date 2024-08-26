<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
</head>
<body>
    <h1>Create Course</h1>
    <a href="index.php">Back</a>
    <form action="save.php" method="POST">
        <label for="dept_code">Department Code</label>
        <input type="text" name="dept_code" id="dept_code"><br><br>
        <label for="crs_title">Course Title</label>
        <input type="text" name="crs_title" id="crs_title"><br><br>
        <label for="crs_description">Course Description</label>
        <input type="text" name="crs_description" id="crs_description"><br><br>
        <label for="crs_credit">Course Credit</label>
        <input type="text" name="crs_credit" id="crs_credit"><br><br>
        <button>Create</button>
    </form>
</body>
</html>
