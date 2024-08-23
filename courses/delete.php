<?php 

$crs_code = $_GET['id'] ?? '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="destroy.php?id=<?php echo $crs_code ?>">Confirm</a>
    <a href="index.php">Cancel</a>
</body>
</html>
