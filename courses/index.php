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
            <th>DEPARTMENT CODE</th>
            <th>COURSE TITLE</th>
            <th>COURSE DESCRIPTION</th>
            <th>COURSE CREDIT</th>
            <th>ACTION</th>
        </tr>
      </thead>
        <?php foreach ($courses as $row) : ?>
            <tr>
                <td><?php echo $row['CRS_CODE'] ?></td>
                <td><?php echo $row['DEPT_CODE']; ?></td>
                <td><?php echo $row['CRS_TITLE']; ?></td>
                <td><?php echo $row['CRS_DESCRIPTION']; ?></td>
                <td><?php echo $row['CRS_CREDIT']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['CRS_CODE']; ?>" class="btn btn-success" role="button">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['CRS_CODE']; ?>" class="btn btn-primary" role="button">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['CRS_CODE']; ?>" class="btn btn-danger" role="button">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
