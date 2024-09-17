<?php 

require_once __DIR__ . '/../database/database_connection.php';

try {
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
    <title>Create Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
   <h1 class="text-center">Create Department</h1>
    <a href="index.php" class="btn btn-danger mb-3" role="button">Back</a>
    <div class="col-6 mx-auto">
    <form action="save.php" method="post" class="form mx-auto shadow-sm p-3" enctype="multipart/form-data">

        <label for="dept_name" class="form-label">Department Name</label>
        <input type="text" name="dept_name" id="dept_name" class="form-control mb-2">
       
        <label for="dept_code" class="form-label mb-2">School Code</label>
        <select class="form-control mb-2" id="school_code" name="school_code" required>
            <option value="">Select School</option>
            <?php foreach ($schools as $school): ?>
                <option value="<?php echo htmlspecialchars($school['school_code']); ?>">
                    <?php echo htmlspecialchars($school['school_code']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="prof_num" class="form-label mb-2">Professor Number</label>
        <select class="form-control mb-2" id="prof_num" name="prof_num" required>
            <option value="">Select Professor</option>
            <?php foreach ($professors as $professor): ?>
                <option value="<?php echo htmlspecialchars($professor['prof_num']); ?>">
                    <?php echo htmlspecialchars($professor['prof_num']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="file" name="file" id="file" class="form-control mb-2">

        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
