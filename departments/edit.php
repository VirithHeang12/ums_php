<?php

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../authentication/student_authorization_check.php';

$dept_code = $_GET['id'];

try {
    $statement = $pdo->prepare("SELECT * FROM departments WHERE DEPT_CODE = :dept_code");
    $statement->bindParam(':dept_code', $dept_code);
    $statement->execute();
    $department = $statement->fetch();

    // Fetch school codes
    $statement1 = $pdo->prepare("SELECT school_code FROM schools");
    $statement1->execute();
    $schools = $statement1->fetchAll(PDO::FETCH_ASSOC);
  
    // Fetch professor numbers
    $statement2 = $pdo->prepare("SELECT prof_num FROM professors");
    $statement2->execute();
    $professors = $statement2->fetchAll(PDO::FETCH_ASSOC);

    $attachment = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
    $attachment->bindParam(':entity_id', $dept_code);
    $attachment->bindParam(':entity_type', $entity_type);
    $attachment->execute();
    $attachment = $attachment->fetch();

} catch (PDOException $e) {
    echo "Error while retrieving data: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">Edit Department</h1>
    <a href="index.php" class="btn btn-primary m-5">Back</a>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <form class="form " action="update.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="dept_code" class="form-label">Department Code</label>
                        <input type="text" name="dept_code" class="form-control" id="dept_code" value="<?php echo $department['dept_code']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dept_name" class="form-label">Department Name</label>
                        <input type="text" name="dept_name" class="form-control" id="dept_name" value="<?php echo $department['dept_name']; ?>">
                    </div>

                    <label for="dept_code" class="form-label">School Code</label>
                    <select class="form-control" id="school_code" name="school_code" required>
                        <option value="">Select School</option>
                        <?php foreach ($schools as $school): ?>
                            <option value="<?php echo htmlspecialchars($school['school_code']); ?>">
                                <?php echo htmlspecialchars($school['school_code']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="prof_num" class="form-label mt-3">Professor Number</label>
                    <select class="form-control" id="prof_num" name="prof_num" required>
                        <option value="">Select Professor</option>
                        <?php foreach ($professors as $professor): ?>
                            <option value="<?php echo htmlspecialchars($professor['prof_num']); ?>">
                                <?php echo htmlspecialchars($professor['prof_num']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="file" name="file" id="file" class="form-control mb-3 form-label mt-3">

            <?php if ($attachment) : ?>
                <?php if ($attachment['media_type'] === 'image') : ?>
                    <img src="./../images/<?php echo $attachment['MEDIA_URL']; ?>" alt="Image" class="img-fluid">
                <?php elseif ($attachment['media_type'] === 'attachment') : ?>
                    <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank">មើល</a>
                 <?php endif; ?>

                <?php else : ?>
                    <!-- No attachment -->
            <?php endif; ?>

            <div class="hstack justify-content-between my-4">
               
                <button type="submit" class="btn btn-dark px-4 fw-semibold">Update</button>
            </div>
        </form>
            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>