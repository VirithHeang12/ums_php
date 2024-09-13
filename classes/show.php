<?php 

require_once __DIR__ . '/../database/database_connection.php';

$class_code = $_GET['id'];

try {
    $statement = $pdo->prepare("
        SELECT c.*, (p.PROF_LNAME || ' ' || p.PROF_FNAME) PROF_NAME, crs.CRS_TITLE 
        FROM classes c
        JOIN professors p ON c.PROF_NUM = p.PROF_NUM
        JOIN courses crs ON c.CRS_CODE = crs.CRS_CODE
        WHERE c.CLASS_CODE = :class_code
    ");
    $statement->bindParam(':class_code', $class_code);
    $statement->execute();
    $classes = $statement->fetch();

    $statement = $pdo->prepare("select count(*) as num_enroll from ENROLLS where CLASS_CODE = :class_code");
    $statement->bindParam(':class_code', $class_code);
    $statement->execute();
    $enrolls = $statement->fetch();

} catch (PDOException $e) {
    echo "Error while retrieving classes: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="text-center">Show classes</h1>
                <a href="index.php" class="btn btn-primary px-4 my-4">Back</a>
                <table class="table">
                    <tr>
                        <th>CLASS CODE</th>
                        <td><?php echo $classes['CLASS_CODE'] ?></td>
                    </tr>
                    <tr>
                        <th>CLASS SECTION</th>
                        <td><?php echo $classes['CLASS_SECTION']; ?></td>
                    </tr>
                    <tr>
                        <th>CLASS TIME</th>
                        <td><?php echo $classes['CLASS_TIME'] ?></td>
                    </tr>
                    <tr>
                        <th>COURSES TITLE</th>
                        <td><?php echo $classes['CRS_TITLE']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR NAME</th>
                        <td><?php echo $classes['PROF_NAME'];  ?></td>
                    </tr>
                    <tr>
                        <th>ROOM CODE</th>
                        <td><?php echo $classes['ROOM_CODE']; ?></td>
                    </tr>
                    <tr>
                        <th>SEMESTER CODE</th>
                        <td><?php echo $classes['SEMESTER_CODE'];  ?></td>
                    </tr>
                    <tr>
                        <th>ENROLLS</th>
                        <td><?php echo $enrolls['NUM_ENROLL'];  ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
