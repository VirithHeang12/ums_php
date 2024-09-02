<?php 
require_once __DIR__ . '/../database/database_connection.php';

$prof_num = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT p.*, d.dept_name
        FROM professors p 
        JOIN departments d ON p.dept_code = d.dept_code 
        WHERE p.PROF_NUM = :prof_num");
    $statement->bindParam(':prof_num', $prof_num);
    $statement->execute();
    $professor = $statement->fetch();

} catch (PDOException $e) {
    echo "Error while retrieving professor: " . $e->getMessage();
}
?>  
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <a href="index.php" class="btn btn-primary m-5">Back</a>
    <h1 class="text-center">Show Professor</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>PROFESSOR NUMBER</th>
                        <td><?php echo $professor['PROF_NUM']; ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT NAME</th>
                        <td><?php echo $professor['DEPT_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR SPECIALTY</th>
                        <td><?php echo $professor['PROF_SPECIALTY']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR RANK</th>
                        <td><?php echo $professor['PROF_RANK']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR NAME</th>
                        <td><?php echo $professor['PROF_FNAME'] . ' ' . $professor['PROF_INITIAL'] . ' ' . $professor['PROF_LNAME']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR EMAIL</th>
                        <td><?php echo $professor['PROF_EMAIL']; ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
