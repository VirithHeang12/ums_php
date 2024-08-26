<?php

require_once 'database_connection.php';

$employeeId = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("SELECT employee_id, first_name, last_name, email, job_id FROM employees_copy WHERE employee_id = :employee_id");

    $statement->bindParam(':employee_id', $employeeId, PDO::PARAM_INT);

    $statement->execute();

    $employee = $statement->fetch(PDO::FETCH_ASSOC);
    $employeeId = $employee['EMPLOYEE_ID'];
    $firstName = $employee['FIRST_NAME'];
    $lastName = $employee['LAST_NAME'];
    $email = $employee['EMAIL'];
    $jobId = $employee['JOB_ID'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="update-employee.php" method="post">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" value="<?php echo $employeeId ?>" id="employee_id" readonly>
        <br>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $firstName ?>">
        <br>
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $lastName ?>">
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email ?>">
        <br>
        <label for="job_id">Job ID:</label>
        <input type="text" name="job_id" id="job_id" value="<?php echo $jobId ?>">
        <br>
        <button type="submit">Update</button>
    </form>
</body>

</html>