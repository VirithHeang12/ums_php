<?php

require_once __DIR__ . '/../database/database_connection.php';

$room_code = $_GET['id'];

try {
  // Fetch room details along with the associated building information
  $statement = $pdo->prepare("SELECT r.*, b.BLDG_NAME, b.BLDG_CODE FROM ROOMS r JOIN BUILDINGS b ON r.BLDG_CODE = b.BLDG_CODE WHERE r.ROOM_CODE = :room_code");
  $statement->bindParam(':room_code', $room_code);
  $statement->execute();
  $rooms = $statement->fetch();

  // Fetch all buildings for the dropdown
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
  <title>Show Room</title>
  <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
  <h1 class="text-center">Show Room</h1>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <form class="form" action="update.php" method="post">
          <div class="mb-3">
            <label for="room_code" class="form-label">Room Code</label>
            <input type="text" name="room_code" class="form-control" id="room_code" value="<?php echo htmlspecialchars($rooms['ROOM_CODE']); ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="room_type" class="form-label">Room Type</label>
            <input type="text" name="room_type" class="form-control" id="room_type" value="<?php echo htmlspecialchars($rooms['ROOM_TYPE']); ?>">
          </div>

          <div class="mb-3">
            <label for="bldg_code" class="form-label">Building</label>
            <select class="form-select" name="bldg_code" id="bldg_code" required>
              <?php foreach ($buildings as $row) : ?>
                <option value="<?php echo htmlspecialchars($row['BLDG_CODE']); ?>" <?php echo ($row['BLDG_CODE'] == $rooms['BLDG_CODE']) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($row['BLDG_NAME']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Update</button>
            <a href="index.php" class="btn btn-secondary ms-4 px-4">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>