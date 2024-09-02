<?php

$room_code = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Room</title>
  <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
  <a href="destroy.php?id=<?php echo $room_code ?>" class="btn btn-success">Confirm</a>
  <a href="index.php" class="btn btn-danger">Cancel</a>

  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>