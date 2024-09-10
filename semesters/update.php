<?php 
require_once __DIR__ . '/../database/database_connection.php';

$semester_code = $_POST['semester_code'] ?? '';
$semester_year = $_POST['semester_year'] ?? '';
$semester_term = $_POST['semester_term'] ?? '';
$semester_start_date = $_POST['semester_start_date'] ?? '';
$semester_end_date = $_POST['semester_end_date'] ?? '';
try{
    $statement = $pdo->prepare("UPDATE semesters
        SET semester_year = :semester_year,
            semester_term = :semester_term,
            semester_start_date = TO_DATE(:semester_start_date, 'YYYY-MM-DD'),
            semester_end_date = TO_DATE(:semester_end_date, 'YYYY-MM-DD')
        WHERE semester_code = :semester_code");

    $statement->bindParam(':semester_code', $semester_code, PDO::PARAM_INT);
    $statement->bindParam(':semester_year', $semester_year, PDO::PARAM_INT);
    $statement->bindParam(':semester_term', $semester_term, PDO::PARAM_INT);
    $statement->bindParam(':semester_start_date', $semester_start_date, PDO::PARAM_STR);
    $statement->bindParam(':semester_end_date', $semester_end_date, PDO::PARAM_STR);

    $statement->execute();
    header('Location: index.php');
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>