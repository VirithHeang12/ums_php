<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="save-employee.php" method="post">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" id="employee_id">
        <br>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name">
        <br>
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name">
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="job_id">Job ID:</label>
        <input type="text" name="job_id" id="job_id">
        <br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
