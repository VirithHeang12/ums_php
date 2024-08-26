<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Building</title>
  <link rel="stylesheet" href="/ums_php/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
  <h1 class="text-center">Create Buidling</h1>
  <a href="index.php" class="btn btn-primary mb-5 mx-5">Back</a>
  <form action="save.php" method="post" class="row g-3 needs-validation" novalidate>
    <label for="bldg_name">Buidling Name</label>
    <input type="text" name="bldg_name" id="bldg_name">
    <br>
    <label for="bldg_location">Buidling Location</label>
    <input type="text" name="bldg_location" id="bldg_location">
    <br>
    <button type="submit" class="btn btn-success">Create</button>
  </form>
  <script src="/ums_php/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>