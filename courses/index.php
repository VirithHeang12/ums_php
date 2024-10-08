<?php
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Course.php'; 

try {
    $statement = $pdo->prepare("
        SELECT c.*, d.dept_name 
        FROM courses c 
        JOIN departments d ON c.dept_code = d.dept_code
    ");

    $statement->execute();
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error while retrieving courses: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="text-center">Courses</h1>
    <a href="create.php" class="btn btn-primary">Create Course</a><br><br>
    <table class="table border table-hover">
      <thead>
      <tr>
            <th>COURSE CODE</th>
            <th>DEPARTMENT NAME</th>
            <th>COURSE TITLE</th>
            <th>COURSE DESCRIPTION</th>
            <th>COURSE CREDIT</th>
            <th>ACTION</th>
        </tr>
      </thead>
       
            <?php foreach ($courses as $row): ?>
                <tr>
                    <td><?php echo $row['crs_code']; ?></td>
                    <td><?php echo $row['dept_name']; ?></td>
                    <td><?php echo $row['crs_title']; ?></td>
                    <td><?php echo $row['crs_description']; ?></td>
                    <td><?php echo $row['crs_credit']; ?></td>
                    <td style="width: 300px;">
                        <a href="show.php?id=<?php echo $row['crs_code']; ?>" class="btn btn-success">SHOW</a>
                        <a href="edit.php?id=<?php echo $row['crs_code']; ?>" class="btn btn-primary">EDIT</a>
                        <a href="delete.php?id=<?php echo $row['crs_code']; ?>" class="btn btn-danger">DELETE</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
