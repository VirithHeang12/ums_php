<?php
require_once __DIR__ . '/../config/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM schools");
    $statement->execute();
    $schools = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving schools: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schools</title>
    <style>
        td, th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>God Schools</h1>
    <a href="create.php">Create Schools</a>
    <table>
        <tr>
            <th>SCHOOL CODE</th>
            <th>SCHOOL NAME</th>
            <th>PROFESSOR NUMBER</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($schools as $row) : ?>
            <tr>
                <td><?php echo $row['SCHOOL_CODE'] ?></td>
                <td><?php echo $row['SCHOOL_NAME']; ?></td>
                <td><?php echo $row['PROF_NUM']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['SCHOOL_CODE']; ?>">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['SCHOOL_CODE']; ?>">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['SCHOOL_CODE']; ?>">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>