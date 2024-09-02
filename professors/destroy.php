<?php 
require_once __DIR__ . '/../database/database_connection.php';

$prof_num = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("DELETE FROM professors WHERE prof_num = :prof_num");

    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
