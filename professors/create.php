<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Professor</title>
</head>
<body>
    <h1>Create Professor</h1>
    <a href="index.php">Back</a>
    <form action="save.php" method="post">
        <label for="prof_specialty">Professor Specialty</label>
        <input type="text" name="prof_specialty" id="prof_specialty">
        <br>
        <label for="dept_code">Department Code</label>
        <input type="text" name="dept_code" id="dept_code">
        <br>
        <label for="prof_rank">Professor Rank</label>
        <input type="text" name="prof_rank" id="prof_rank">
        <br>
        <label for="prof_fname">Professor First Name</label>
        <input type="text" name="prof_fname" id="prof_fname">
        <br>
        <label for="prof_initial">Professor Initial</label>
        <input type="text" name="prof_initial" id="prof_initial">
        <br>
        <label for="prof_lname">Professor Last Name</label>
        <input type="text" name="prof_lname" id="prof_lname">
        <br>
        <label for="prof_email">Professor Email</label>
        <input type="email" name="prof_email" id="prof_email">
        <br>

        <button type="submit">Create</button>
    </form>
</body>
</html>