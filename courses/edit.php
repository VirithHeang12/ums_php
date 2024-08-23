<?php 

require_once __DIR__ . '/../database_connection.php';

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
</head>
<body>
    <form action="update.php" method="post">
    <label for="dept_code">Course Code</label>
        <input type="text" name="crs_code" id="crs_code" value="<?php echo $crs_code ?>" readonly>
        <br><br>
        <label for="dept_code">Department Code:</label>
        <input type="text" name="dept_code" id="dept_code" value="<?php echo $dept_code ?>"  >
        <br><br>
        <label for="crs_title">Course Title</label>
        <input type="text" name="crs_title" id="crs_title" value="<?php echo $crs_title ?>">
        <br><br>
        <label for="crs_description">Course Description</label>
        <input type="text" name="crs_description" id="crs_description" value="<?php echo $crs_description ?>">
        <br><br>
        <label for="crs_credit">Course Credit</label>
        <input type="text" name="crs_credit" id="crs_credit" value="<?php echo $crs_credit ?>">
        <br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
