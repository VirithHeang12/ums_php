<?php 

require_once __DIR__ . '/../database/database_connection.php';

$prof_num = $_POST['prof_num'] ?? '';
$dept_code = $_POST['dept_code'] ?? '';
$prof_specialty = $_POST['prof_specialty'] ?? '';    
$prof_rank= $_POST['prof_rank'] ?? '';
$prof_lname = $_POST['prof_lname'] ?? '';
$prof_fname = $_POST['prof_fname'] ?? '';
$prof_initial = $_POST['prof_initial'] ?? '';
$prof_email = $_POST['prof_email'] ?? '';


try {
    $statement = $pdo->prepare("UPDATE professors SET dept_code = :dept_code, prof_specialty = :prof_specialty,
     prof_rank = :prof_rank, prof_lname = :prof_lname, prof_fname = :prof_fname, prof_initial = :prof_initial, prof_email = :prof_email
      WHERE prof_num = :prof_num");
 
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_STR); 
    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
    $statement->bindParam(':prof_specialty', $prof_specialty, PDO::PARAM_STR);
    $statement->bindParam(':prof_rank', $prof_rank, PDO::PARAM_INT);
    $statement->bindParam(':prof_fname', $prof_fname, PDO::PARAM_STR);
    $statement->bindParam(':prof_initial', $prof_initial, PDO::PARAM_STR);
    $statement->bindParam(':prof_lname', $prof_lname, PDO::PARAM_STR);
    $statement->bindParam(':prof_email', $prof_email, PDO::PARAM_STR);
    

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
