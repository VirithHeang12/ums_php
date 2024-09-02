<?php

require_once __DIR__ . '/../database/database_connection.php';

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

} catch (PDOException $e) {
    echo "Error while retrieving data: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Department</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">Show Department</h1>
    <a href="index.php" class="btn btn-primary m-5">Back</a>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <form class="form" action="update.php" method="post">
                    <div class="mb-3">
                        <label for="dept_code" class="form-label">Department Code</label>
                        <input type="text" name="dept_code" class="form-control" id="dept_code" value="<?php echo $department['DEPT_CODE']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dept_name" class="form-label">Department Name</label>
                        <input type="text" name="dept_name" class="form-control" id="dept_name" value="<?php echo $department['DEPT_NAME']; ?>">
                    </div>

                    <label for="dept_code" class="form-label">School Code</label>
                    <select class="form-control" id="school_code" name="school_code" required>
                        <option value="">Select School</option>
                        <?php foreach ($schools as $school): ?>
                            <option value="<?php echo htmlspecialchars($school['SCHOOL_CODE']); ?>">
                                <?php echo htmlspecialchars($school['SCHOOL_CODE']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="prof_num" class="form-label mt-3">Professor Number</label>
                    <select class="form-control" id="prof_num" name="prof_num" required>
                        <option value="">Select Professor</option>
                        <?php foreach ($professors as $professor): ?>
                            <option value="<?php echo htmlspecialchars($professor['PROF_NUM']); ?>">
                                <?php echo htmlspecialchars($professor['PROF_NUM']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>