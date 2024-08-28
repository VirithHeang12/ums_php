<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
    $statement = $pdo->prepare("select r.*, b.BLDG_NAME from ROOMS r join BUILDINGS b on r.BLDG_CODE = b.BLDG_CODE");
    $statement->execute();
    $rooms = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving rooms: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        td,
        th {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">God rooms</h1>
    <a href="create.php" class="btn btn-primary mb-5 mx-5">Create Student</a>
    <table class="table">
        <tr>
            <th>ROOM CODE</th>
            <th>ROOM TYPE</th>
            <th>BUILDING NAME</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($rooms as $row) : ?>
            <tr>
                <td><?php echo $row['ROOM_CODE'] ?></td>
                <td><?php echo $row['ROOM_TYPE']; ?></td>
                <td><?php echo $row['BLDG_NAME']; ?></td>
                <td>
                    <a href="show.php?id=<?php echo $row['ROOM_CODE']; ?>">SHOW</a>
                    <a href="edit.php?id=<?php echo $row['ROOM_CODE']; ?>">EDIT</a>
                    <a href="delete.php?id=<?php echo $row['ROOM_CODE']; ?>">DELETE</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>