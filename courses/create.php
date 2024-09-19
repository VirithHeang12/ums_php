<?php 

require_once __DIR__ . '/../database/database_connection.php';

try {
   
    $statement = $pdo->prepare("SELECT dept_code, dept_name FROM departments");
    $statement->execute();
    $departments = $statement->fetchAll(); 
} catch (PDOException $e) {
    echo "Error while retrieving departments: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
   <div class="container ">
   <h1 class="text-center mt-3">Create Course</h1>
    <a href="index.php" class="btn btn-danger mb-3" role="button">Back</a>
    <div class="col-6 mx-auto shadow-sm p-5">
    <form action="save.php" method="POST" class="form" enctype="multipart/form-data">
    <label for="dept_code" class="form-label">Department</label>
        <select class="form-control mb-2" id="dept_code" name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?php echo htmlspecialchars($department['dept_code']); ?>">
                    <?php echo htmlspecialchars($department['dept_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="crs_title" class="form-label">Course Title</label>
        <input type="text" name="crs_title" id="crs_title" class="form-control  mb-2">
        <label for="crs_description" class="form-label">Course Description</label>
        <input type="text" name="crs_description" id="crs_description" class="form-control  mb-2">
        <label for="crs_credit" class="form-label">Course Credit</label>
        <input type="text" name="crs_credit" id="crs_credit" class="form-control mb-4">
        <input type="file" name="file" id="file" class="form-control mb-3">
        <button class="btn btn-primary mt-3">Create</button>
    </form>
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
