<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>
    <a href="index.php">Back</a>
    <form action="save.php" method="post">
        <label for="dept_code">Department Code</label>
        <input type="number" name="dept_code" id="dept_code">
        <br>
        <label for="stu_fname">First Name</label>
        <input type="text" name="stu_fname" id="stu_fname">
        <br>
        <label for="stu_lname">Last Name</label>
        <input type="text" name="stu_lname" id="stu_lname">
        <br>
        <label for="stu_initial">Initial:</label>
        <input type="text" name="stu_initial" id="stu_initial">
        <br>
        <label for="stu_email">Email:</label>
        <input type="email" name="stu_email" id="stu_email">
        <br>
        <label for="prof_num">Professor Number:</label>
        <input type="number" name="prof_num" id="prof_num">
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>