<?php require_once __DIR__ . '/../database/database_connection.php';

$semester_code = $_GET['id'];
try {
    $statement = $pdo->prepare("SELECT * FROM semesters WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();
    $semester = $statement->fetch();
} catch (PDOException $e) {
    echo "Error while retrieving semester:" . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Semester</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-6 m-auto">
                <h1 class="text-center fw-bold text-uppercase mb-4">Delete Semester</h1>

                <table class="table">
                    <tr>
                        <th class="col-5">SEMESTER CODE</th>
                        <td><?php echo $semester['SEMESTER_CODE']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">SEMESTER YEAR</th>
                        <td><?php echo $semester['SEMESTER_YEAR']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">SEMESTER TERM</th>
                        <td><?php echo $semester['SEMESTER_TERM']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">START DATE</th>
                        <td><?php echo date('F d, Y', strtotime($semester['SEMESTER_START_DATE'])); ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">END DATE</th>
                        <td><?php echo date('F d, Y', strtotime($semester['SEMESTER_END_DATE'])); ?></td>
                    </tr>
                </table>
                <div class="hstack justify-content-between my-4">
                    <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Cancel</a>
                    <a href="destroy.php?id=<?= $semester_code ?>" class="btn btn-danger px-4 fw-semibold">Delete</a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>