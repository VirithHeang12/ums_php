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
    <title>Create Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
   <h1 class="text-center">Create Professor</h1>
    <a href="index.php" class="btn btn-danger mb-3" role="button">Back</a>
    <div class="col-6 mx-auto">
    <form action="save.php" method="post" class="form mx-auto shadow-sm p-3">
        <label for="prof_specialty" class="form-label">Professor Specialty</label>
        <input type="text" name="prof_specialty" id="prof_specialty" class="form-control mb-2">
       
        <label for="dept_code" class="form-label">Department</label>
        <select class="form-control" id="dept_code" name="dept_code" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?php echo htmlspecialchars($department['DEPT_CODE']); ?>">
                    <?php echo htmlspecialchars($department['DEPT_NAME']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="prof_rank" class="form-label">Professor Rank</label>
        <input type="text" name="prof_rank" id="prof_rank" class="form-control mb-2">
       
        <label for="prof_fname" class="form-label">Professor First Name</label>
        <input type="text" name="prof_fname" id="prof_fname" class="form-control mb-2">

        <label for="prof_initial" class="form-label">Professor Initial</label>
        <input type="text" name="prof_initial" id="prof_initial" class="form-control mb-2">
       
        <label for="prof_lname" class="form-label">Professor Last Name</label>
        <input type="text" name="prof_lname" id="prof_lname" class="form-control mb-2">
      
        <label for="prof_email" class="form-label">Professor Email</label>
        <input type="email" name="prof_email" id="prof_email" class="form-control mb-2">
      
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
