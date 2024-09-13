<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
    $statement = $pdo->prepare(" SELECT p.*, d.dept_name 
        FROM professors p 
        JOIN departments d ON p.dept_code = d.dept_code");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
</head>
<body>
<div class="container-fluid">
<h1 class="text-center">Professors</h1>
    <a href="create.php" class="btn btn-primary" role="button">Create Professor</a><br><br>
    <table class="table border table-hover table-responsive">
        <tr>
            <th>PROFESSOR NUMBER</th>
            <th>DEPARTMENT NAME</th>
            <th>PROFESSOR SPECIALTY</th>
            <th>PROFESSOR RANK</th>
            <th>PROFESSOR NAME</th>
            <th>PROFESSOR EMAIL</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($professors as $row) : ?>
            <tr>
                <td><?php echo $row['PROF_NUM'] ?></td>
                <td><?php echo $row['DEPT_NAME']; ?></td>
                <td><?php echo $row['PROF_SPECIALTY']; ?></td>
                <td><?php echo $row['PROF_RANK']; ?></td>
                <td><?php echo $row['PROF_FNAME'] . ' ' . $row['PROF_INITIAL'] . ' ' . $row['PROF_LNAME']; ?></td>
                <td><?php echo $row['PROF_EMAIL']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['PROF_NUM']; ?>" class="btn btn-success">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['PROF_NUM']; ?>" class="btn btn-primary">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['PROF_NUM']; ?>" class="btn btn-danger">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>