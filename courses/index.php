<?php
require_once __DIR__ . '/../database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM courses");
    $statement->execute();
    $courses = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving courses: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
   
</head>
<body>
    <h1>Courses</h1>
    <a href="create.php">Create Course</a><br><br>
    <table border="1">
        <tr>
            <th>COURSE CODE</th>
            <th>DEPARTMENT CODE</th>
            <th>COURSE TITLE</th>
            <th>COURSE DESCRIPTION</th>
            <th>COURSE CREDIT</th>
            <th>ACTION</th>
        </tr>
        <?php foreach ($courses as $row) : ?>
            <tr>
                <td><?php echo $row['CRS_CODE'] ?></td>
                <td><?php echo $row['DEPT_CODE']; ?></td>
                <td><?php echo $row['CRS_TITLE']; ?></td>
                <td><?php echo $row['CRS_DESCRIPTION']; ?></td>
                <td><?php echo $row['CRS_CREDIT']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['CRS_CODE']; ?>">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['CRS_CODE']; ?>">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['CRS_CODE']; ?>">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
