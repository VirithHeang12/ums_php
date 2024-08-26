<?php

require_once  __DIR__ . '/../database_connection.php';

$users = [];

if(isset($_GET['search']) && isset($_GET['type'])){
    $search = $_GET['search'];
    $type = $_GET['type'];
    $prefix = $type == 'professors' ? 'prof_' : 'stu_';
    $sql = "SELECT * FROM $type WHERE " . $prefix . "lname LIKE :search";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':search', $search, PDO::PARAM_STR);
    $statement->execute();
    $users = $statement->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="register.php" method="get">
        <h1>Search</h1>
        <select name="type" id="type">
            <option value="professors">Professor</option>
            <option value="students">Student</option>
        </select>
        <label for="search">Enter last name:</label>
        <input type="text" name="search" id="search">
        <br>
        <button type="submit">Search</button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $row) : ?>
                <tr>
                    <?php 
                        $prefix = $type == 'professors' ? 'PROF_' : 'STU_';
                        echo "<td>" . $row[$prefix . 'FNAME'] . "</td>";
                        echo "<td>" . $row[$prefix . 'LNAME'] . "</td>";
                        echo "<td><a href='register.php?id=" . $row[$prefix . 'NUM'] . "'>Choose</a></td>";
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>


    </table>
    <form action="signup.php" method="post">
        
        <label for="lname">Last name</label>
        <input type="text" name="lname" id="lname">
        <br>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="userable_type">Type</label>
        <select name="userable_type" id="userable_type">
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select>
        <br>
        <label for="userable_id">ID</label>
        <input type="number" name="userable_id" id="userable_id" value="<?php echo isset($_GET['id']) ?>">
        <br>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>