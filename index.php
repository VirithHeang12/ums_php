<?php 
require_once 'database_connection.php';

try {
    $firstName = $_GET['first_name'] ?? '';
    $firstName = '%' . $firstName . '%';

    $statement = $pdo->prepare("SELECT first_name, last_name, phone_number, email FROM employees WHERE first_name like :name");

    $statement->bindParam(':name', $firstName, PDO::PARAM_STR);

    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
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
    <h1>Oracle Database Connection</h1>
    <table>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Email</th>
        </tr>
        <?php foreach ($results as $rowNum => $row) : ?>
            <tr>
                <td><?php echo $rowNum + 1 ?></td>
                <td><?php echo $row['FIRST_NAME']; ?></td>
                <td><?php echo $row['LAST_NAME']; ?></td>
                <td><?php echo $row['PHONE_NUMBER']; ?></td>
                <td><?php echo $row['EMAIL']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>