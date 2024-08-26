<?php

require_once __DIR__ . '/../database_connection.php';

$bldg_code = $_GET['id'];

try {
  $statement = $pdo->prepare("SELECT * FROM buildings WHERE BLDG_CODE = :bldg_code");
  $statement->bindParam(':bldg_code', $bldg_code);
  $statement->execute();
  $building = $statement->fetch();
} catch (PDOException $e) {
  echo "Error while retrieving building: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Student</title>
  <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
  <h1 class="text-center">Edit Building</h1>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <form class="form" action="update.php" method="post">
          <div class="mb-3">
            <label for="bldg_code" class="form-label">Building Code</label>
            <input type="text" name="bldg_code" class="form-control" id="bldg_code" value="<?php echo $building['BLDG_CODE']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="bldg_name" class="form-label">Building Name</label>
            <input type="text" name="bldg_name" class="form-control" id="bldg_name" value="<?php echo $building['BLDG_NAME']; ?>">
          </div>
          <div class="mb-3">
            <label for="bldg_location" class="form-label">Building Location</label>
            <input type="text" name="bldg_location" class="form-control" id="bldg_location" value="<?php echo $building['BLDG_LOCATION']; ?>">
          </div>
          <button class="btn btn-warning" type="submit">Update</button>
        </form>
        <a href="index.php" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>
  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>