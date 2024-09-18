<?php
require_once __DIR__ . '/../database/database_connection.php';

try {

    $statement = $pdo->prepare("SELECT d.* , d.dept_name,s.school_code,p.prof_num
    from departments d
    JOIN schools s ON d.school_code = s.school_code
    JOIN professors p ON d.prof_num = p.prof_num ");
    $statement->execute();
    $departments = $statement->fetchAll();
    
} catch (PDOException $e) {
    echo "Error while retrieving professors: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
</head>
<body>
<div class="container-fluid">
<h1 class="text-center">Departments</h1>
    <a href="create.php" class="btn btn-primary" role="button">Create Department</a><br><br>
    <table class="table border table-hover table-responsive">
        <tr>
            <th>DEPARTMENT CODE</th>
            <th>DEPARTMENT NAME</th>
            <th>SCHOOL CODE</th>
            <th>PROFESSOR NUMBER</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($departments as $row) : ?>
            <tr>
                <td><?php echo $row['dept_code'] ?></td>
                <td><?php echo $row['dept_name']; ?></td>
                <td><?php echo $row['school_code']; ?></td>
                <td><?php echo $row['prof_num']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['dept_code']; ?>" class="btn btn-success">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['dept_code']; ?>" class="btn btn-primary">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['dept_code']; ?>" class="btn btn-danger">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>