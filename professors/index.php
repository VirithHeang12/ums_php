<?php
require_once __DIR__ . '/../config/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM professors");
    $statement->execute();
    $professors = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving professors: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>professors</title>
    <style>
        td, th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>God professors</h1>
    <a href="create.php">Create professors</a>
    <table>
        <tr>
            <th>PROFESSOR NUMBER</th>
            <th>DEPARTMENT CODE</th>
            <th>PROFESSOR SPECIALTY</th>
            <th>PROFESSOR NAME</th>
            <th>EMAIL</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($professors as $row) : ?>
            <tr>
                <td><?php echo $row['PROF_NUM'] ?></td>
                <td><?php echo $row['DEPT_CODE']; ?></td>
                <td><?php echo $row['PROF_SPECIALTY']; ?></td>
                <td><?php echo $row['PROF_FNAME'] . ' ' . $row['PROF_INITIAL'] . ' ' . $row['PROF_LNAME']; ?></td>
                <td><?php echo $row['PROF_EMAIL']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['PROF_NUM']; ?>">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['PROF_NUM']; ?>">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['PROF_NUM']; ?>">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>