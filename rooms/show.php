<?php 

require_once __DIR__ . '/../database/database_connection.php';

$room_code = $_GET['id'];

try {
    $statement = $pdo->prepare("select r.*, b.BLDG_NAME from ROOMS r join BUILDINGS b on r.BLDG_CODE = b.BLDG_CODE where r.ROOM_CODE = :room_code");
    $statement->bindParam(':room_code', $room_code);
    $statement->execute();
    $room = $statement->fetch();

    $statement = $pdo->prepare("select count(*) as num_classes from CLASSES where ROOM_CODE = :room_code");
    $statement->bindParam(':room_code', $room_code);
    $statement->execute();
    $classes = $statement->fetch();

} catch (PDOException $e) {
    echo "Error while retrieving course: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
<a href="index.php" class="btn btn-primary m-5">Back</a>
    <h1 class="text-center">Show Course</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>ROOM CODE</th>
                        <td><?php echo $room['ROOM_CODE'] ?></td>
                    </tr>
                    <tr>
                        <th>ROOM TYPE</th>
                        <td><?php echo $room['ROOM_TYPE']; ?></td>
                    </tr>
                    <tr>
                        <th>BUILDING NAME</th>
                        <td><?php echo $room['BLDG_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>CLASSES</th>
                        <td><?php echo $classes['NUM_CLASSES']  ?></td>
                    </tr>
                </table>      
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
