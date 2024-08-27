<?php 

require_once __DIR__ . '/../database/database_connection.php';

$crs_code = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT c.*, d.dept_name 
        FROM courses c 
         JOIN departments d ON c.dept_code = d.dept_code WHERE CRS_CODE = :crs_code");
    $statement->bindParam(':crs_code', $crs_code);
    $statement->execute();
    $course = $statement->fetch();

    $statement = $pdo->prepare("SELECT * FROM classes WHERE CRS_CODE = :crs_code");
    $statement->bindParam(':crs_code', $crs_code);
    $statement->execute();
    $classes = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving course: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
<a href="index.php" class="btn btn-primary m-5">Back</a>
    <h1 class="text-center">Show Course</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>COURSE CODE</th>
                        <td><?php echo $course['CRS_CODE'] ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT NAME</th>
                        <td><?php echo $course['DEPT_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>COURSE TITLE</th>
                        <td><?php echo $course['CRS_TITLE']; ?></td>
                    </tr>
                    <tr>
                        <th>COURSE DESCRIPTION</th>
                        <td><?php echo $course['CRS_DESCRIPTION'];  ?></td>
                    </tr>
                    <tr>
                        <th>COURSE CREDIT</th>
                        <td><?php echo $course['CRS_CREDIT'];  ?></td>
                    </tr>
                </table>
                <h2 class="text-center">Classes</h2>
                <table class="table">
                    <tr>
                        <th>CLASS CODE</th>
                        <th>CLASS SECTION</th>
                        <th>CLASS TIME</th>
                    </tr>
                    <?php foreach ($classes as $class) : ?>
                        <tr>
                            <td><?php echo $class['CLASS_CODE']; ?></td>
                            <td><?php echo $class['CLASS_SECTION']; ?></td>
                            <td><?php echo $class['CLASS_TIME']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                  
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
