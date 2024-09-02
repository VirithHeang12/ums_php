<?php require_once __DIR__ . '/../database/database_connection.php';
try {
    $statement = $pdo->prepare("SELECT * FROM semesters");
    $statement->execute();
    $semesters = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error while retrieving buidlings:" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semesters</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center fw-bold text-uppercase">Semesters</h1>
        <a href="create.php" class="btn btn-dark px-4 fw-semibold float-end mb-3">Create Semester</a>
        <table class="table table-bordered table-hover">
            <thead align="center" class="table-light align-middle">
                <tr>
                    <th style="padding-top: 12px; padding-bottom: 12px;">SEMESTER CODE</th>
                    <th>SEMESTER YEAR</th>
                    <th>SEMESTER TERM</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($semesters as $row): ?>
                    <tr align="center" class="align-middle">
                        <td><?php echo $row['SEMESTER_CODE']; ?></td>
                        <td><?php echo $row['SEMESTER_YEAR']; ?></td>
                        <td><?php echo $row['SEMESTER_TERM']; ?></td>
                        <td class="px-5">
                            <?php
                            $semesterStartDate = $row['SEMESTER_START_DATE'];
                            $formattedDate = date('F d, Y', strtotime($semesterStartDate));
                            echo $formattedDate;
                            ?>
                        </td>
                        <td class="px-5">
                            <?php 
                            $semesterEndDate = $row['SEMESTER_END_DATE']; 
                            echo date('F d, Y', strtotime($semesterEndDate));
                            ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="show.php?id=<?php echo $row['SEMESTER_CODE']; ?>" class="btn btn-success py-1 px-3" style="font-size: 15px;">Show</a>
                                <a href="edit.php?id=<?php echo $row['SEMESTER_CODE']; ?>" class="btn btn-primary py-1 px-3" style="font-size: 15px;">Edit</a>
                                <a href="delete.php?id=<?php echo $row['SEMESTER_CODE']; ?>" class="btn btn-danger py-1 px-3" style="font-size: 15px;">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
    </div>
</body>

</html>