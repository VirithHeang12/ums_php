<?php
require_once __DIR__ . '/../database/database_connection.php';

try {
  $statement = $pdo->prepare("SELECT * FROM buildings");
  $statement->execute();
  $buildings = $statement->fetchAll();
} catch (PDOException $e) {
  echo "Error while retrieving data: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Room</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-6 m-auto">
        <h1 class="text-center">Create Room</h1>
        <form class="form" action="save.php" method="post">
          <div class="row mb-3">
            <label for="room_type" class="col-3">Room Type</label>
            <div class="col-9">
              <input type="text" name="room_type" class="form-control" id="room_type" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="building_code" class="col-3">Building Name</label>
            <div class="col-9">
              <select class="form-select" name="bldg_code" id="bldg_code" required>
                <?php foreach ($buildings as $row) : ?>
                  <option value="<?php echo $row['BLDG_CODE'] ?>"><?php echo $row['BLDG_NAME'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Create</button>
            <a href="index.php" class="btn btn-secondary ms-4 px-4">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>