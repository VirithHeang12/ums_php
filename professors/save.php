<?php 

require_once __DIR__ . '/../database_connection.php';

$dept_code = $_POST['dept_code'] ?? '';
$prof_specialty = $_POST['prof_specialty'] ?? '';
$prof_rank = $_POST['prof_rank'] ?? '';
$prof_fname = $_POST['prof_fname'] ?? '';
$prof_initial = $_POST['prof_initial'] ?? '';
$prof_lname = $_POST['prof_lname'] ?? '';
$prof_email = $_POST['prof_email'] ?? '';

try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO professors (dept_code, prof_specialty, prof_rank, prof_fname, prof_initial, prof_lname, prof_email) VALUES (:dept_code, :prof_specialty, :prof_rank, :prof_fname, :prof_initial, :prof_lname, :prof_email)");

    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
    $statement->bindParam(':prof_specialty', $prof_specialty, PDO::PARAM_STR);
    $statement->bindParam(':prof_rank', $prof_rank, PDO::PARAM_INT);
    $statement->bindParam(':prof_fname', $prof_fname, PDO::PARAM_STR);
    $statement->bindParam(':prof_initial', $prof_initial, PDO::PARAM_STR);
    $statement->bindParam(':prof_lname', $prof_lname, PDO::PARAM_STR);
    $statement->bindParam(':prof_email', $prof_email, PDO::PARAM_STR);
    
    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
