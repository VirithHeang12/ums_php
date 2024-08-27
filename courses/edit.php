<?php 

require_once __DIR__ . '/../database/database_connection.php';

$crs_code = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("SELECT crs_code, dept_code, crs_title, crs_description, crs_credit FROM courses WHERE crs_code = :crs_code");

    $statement->bindParam(':crs_code', $crs_code, PDO::PARAM_INT);

    $statement->execute();

    $course = $statement->fetch(PDO::FETCH_ASSOC);
    $dept_code = $course['DEPT_CODE'];
    $crs_title = $course['CRS_TITLE'];
    $crs_description = $course['CRS_DESCRIPTION'];
    $crs_credit = $course['CRS_CREDIT'];
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>n
   <div class="container">
    <div class="col-6 mx-auto">
    <form action="update.php" method="post" class="form mx-auto shadow-sm">
        <label for="dept_code" class="form-label">Course Code</label>
        <input type="text" class="form-control mb-2" name="crs_code" id="crs_code" value="<?php echo $crs_code ?>" readonly>
        
        <label for="dept_code" class="form-label">Department Code:</label>
        <input type="text" class="form-control mb-2" name="dept_code" id="dept_code" value="<?php echo $dept_code ?>"  >
        
        <label for="crs_title" class="form-label">Course Title</label>
        <input type="text" class="form-control mb-2" name="crs_title" id="crs_title" value="<?php echo $crs_title ?>">
        
        <label for="crs_description" class="form-label">Course Description</label>
        <input type="text" class="form-control mb-2" name="crs_description" id="crs_description" value="<?php echo $crs_description ?>">
        
        <label for="crs_credit" class="form-label">Course Credit</label>
        <input type="text" class="form-control mb-2" name="crs_credit" id="crs_credit" value="<?php echo $crs_credit ?>">
          
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


