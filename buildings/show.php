<?php

require_once __DIR__ . '/../database_connection.php';

$bldg_code = $_GET['id'];

try {
  $statement = $pdo->prepare("SELECT * FROM buildings WHERE BLDG_CODE = :bldg_code");
  $statement->bindParam(':bldg_code', $bldg_code);
  $statement->execute();
  $building = $statement->fetch();
} catch (PDOException $e) {
  echo "Error while retrieving student: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Building</title>
  <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
  <h1 class="text-center">Show Buidling</h1>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <table class="table">
          <tr>
            <th>BUILDING CODE</th>
            <td><?php echo $building['BLDG_CODE']; ?></td>
          </tr>
          <tr>
            <th>BUILDING NAME</th>
            <td><?php echo $building['BLDG_NAME']; ?></td>
          </tr>
          <tr>
            <th>BUILDING LOCATION</th>
            <td><?php echo $building['BLDG_LOCATION']; ?></td>
          </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>
  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>