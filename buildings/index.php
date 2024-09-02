<?php
require_once __DIR__ . '/../database/database_connection.php';


try {
  $statement = $pdo->prepare("SELECT * FROM buildings");
  $statement->execute();
  $buildings = $statement->fetchAll();
} catch (PDOException $e) {
  echo "Error while retrieving buidlings:" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buildings</title>
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
  <h1 class="text-center">God Buildings</h1>
  <a href="create.php" class="btn btn-primary mb-5 mx-5">Create Buidling</a>
  <table class="table">
    <tr>
      <th>BUILDINGS CODE</th>
      <th>BUILDING NAME</th>
      <th>BUILDING LOCATION</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($buildings as $row) : ?>
      <tr>
        <td><?php echo $row['BLDG_CODE'] ?></td>
        <td><?php echo $row['BLDG_NAME']; ?></td>
        <td><?php echo $row['BLDG_LOCATION']; ?></td>
        <td>
          <a href="show.php?id=<?php echo $row['BLDG_CODE']; ?>">SHOW</a>
          <a href="edit.php?id=<?php echo $row['BLDG_CODE']; ?>">EDIT</a>
          <a href="delete.php?id=<?php echo $row['BLDG_CODE']; ?>">DELETE</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>