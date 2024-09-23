<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <button id="logoutButton" class="btn btn-danger">Logout</button>
    <a href="../index.php">Home</a>

  <script>
    document.getElementById("logoutButton").addEventListener("click", function() {
      // Display confirmation message
      if (confirm("Are you sure you want to log out?")) {
        // Redirect to the PHP logout script if confirmed
        window.location.href = "logout_handler.php";
      }
    });
  </script>
</body>
</html>


