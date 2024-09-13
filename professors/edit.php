<?php 

require_once __DIR__ . '/../database/database_connection.php';

$prof_num = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("SELECT * FROM professors WHERE prof_num = :prof_num");
    $statement->bindParam(':prof_num', $prof_num);
    $statement->execute();
    $professor = $statement->fetch();
    
    $dept_code = $professor['DEPT_CODE'];
    $prof_specialty = $professor['PROF_SPECIALTY'];
    $prof_rank = $professor['PROF_RANK'];
    $prof_fname = $professor['PROF_FNAME'];
    $prof_initial = $professor['PROF_INITIAL'];
    $prof_lname = $professor['PROF_LNAME'];
    $prof_email = $professor['PROF_EMAIL'];

    $deptStmt = $pdo->prepare("SELECT dept_code, dept_name FROM departments");
    $deptStmt->execute();
    $departments = $deptStmt->fetchAll();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   <div class="container">
   <a href="index.php" class="btn btn-primary mx-5 my-2">Back</a>
    <div class="col-6 mx-auto">
        <form action="update.php" method="post" class="form mx-auto shadow-sm p-3">
            <label for="prof_num" class="form-label">Professor Number</label>
            <input type="text" class="form-control mb-2" name="prof_num" id="prof_num" value="<?php echo htmlspecialchars($prof_num); ?>" readonly>
            
            <label for="dept_code" class="form-label">Department</label>
            <select class="form-control" id="dept_code" name="dept_code" required>
                <option value="">Select Department</option>
                <?php foreach ($departments as $department): ?>
                    <option value="<?php echo htmlspecialchars($department['DEPT_CODE']); ?>" <?php echo $department['DEPT_CODE'] == $dept_code ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($department['DEPT_NAME']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="prof_specialty" class="form-label">Professor Specialty</label>
            <input type="text" name="prof_specialty" id="prof_specialty" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_specialty); ?>">

            <label for="prof_rank" class="form-label">Professor Rank</label>
            <input type="text" name="prof_rank" id="prof_rank" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_rank); ?>">
           
            <label for="prof_fname" class="form-label">Professor First Name</label>
            <input type="text" name="prof_fname" id="prof_fname" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_fname); ?>">

            <label for="prof_initial" class="form-label">Professor Initial</label>
            <input type="text" name="prof_initial" id="prof_initial" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_initial); ?>">
           
            <label for="prof_lname" class="form-label">Professor Last Name</label>
            <input type="text" name="prof_lname" id="prof_lname" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_lname); ?>">
          
            <label for="prof_email" class="form-label">Professor Email</label>
            <input type="email" name="prof_email" id="prof_email" class="form-control mb-2" value="<?php echo htmlspecialchars($prof_email); ?>">    
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
