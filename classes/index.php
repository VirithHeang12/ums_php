<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
    $statement = $pdo->prepare(
        "select c.*, crs.CRS_TITLE, (p.PROF_LNAME || ' ' || p.PROF_FNAME) PROF_NAME from CLASSES c 
            join COURSES crs ON c.CRS_CODE = crs.CRS_CODE 
            join PROFESSORS p ON c.PROF_NUM = p.PROF_NUM 
            join ROOMS r ON c.ROOM_CODE = r.ROOM_CODE 
            join SEMESTERS s ON c.SEMESTER_CODE = s.SEMESTER_CODE"
    );
    $statement->execute();
    $classes = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving classes: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center">God Classes</h1>
        <div class="mb-5">
            <a href="create.php" class="btn btn-primary mx-5">Create Class</a>
            <a href="../index.php" class="btn btn-secondary px-4">Back</a>
        </div>
        <table class="table border table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>ClASS CODE</th>
                    <th>CLASS SECTION</th>
                    <th>CLASS TIME</th>
                    <th>COURSE TITLE</th>
                    <th>PROFESSOR NAME</th>
                    <th>ROOM CODE</th>
                    <th>SEMESTER CODE</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php foreach ($classes as $row) : ?>
                <tr>
                    <td><?php echo $row['CLASS_CODE'] ?></td>
                    <td><?php echo $row['CLASS_SECTION']; ?></td>
                    <td><?php echo $row['CLASS_TIME']; ?></td>
                    <td><?php echo $row['CRS_TITLE'] ?></td>
                    <td><?php echo $row['PROF_NAME']; ?></td>
                    <td><?php echo $row['ROOM_CODE']; ?></td>
                    <td><?php echo $row['SEMESTER_CODE']; ?></td>
                    <td>
                        <a href="show.php?id=<?php echo $row['CLASS_CODE']; ?>" class="btn btn-info">SHOW</a>
                        <a href="edit.php?id=<?php echo $row['CLASS_CODE']; ?>" class="btn btn-warning">EDIT</a>
                        <a data-bs-toggle="modal" data-bs-target="#classModal<?php echo $row['CLASS_CODE']; ?>" role="button" class="btn btn-danger">DELETE</a>

                        <!-- Modal -->
                        <div class="modal fade" id="classModal<?php echo $row['CLASS_CODE']; ?>" tabindex="-1" aria-labelledby="classModalLabel<?php echo $row['CLASS_CODE']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="classModalLabel<?php echo $row['CLASS_CODE']; ?>">Delete Class</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to delete this class information?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="delete.php?id=<?php echo $row['CLASS_CODE']; ?>" class="btn btn-success ms-5">Confirm</a>
                                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger ms-5">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>