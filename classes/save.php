<?php 

require_once __DIR__ . '/../database/database_connection.php';

$class_section = $_POST['class_section'] ?? '';
$class_time = $_POST['class_time'] ?? '';
$crs_code = $_POST['crs_code'] ?? '';
$prof_num = $_POST['prof_num'] ?? '';
$room_code = $_POST['room_code'] ?? '';
$semester_code = $_POST['semester_code'] ?? '';

try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO classes (class_section, class_time, crs_code, prof_num, room_code, semester_code) 
                                VALUES (:class_section, :class_time, :crs_code, :prof_num, :room_code, :semester_code)");

    $statement->bindParam(':class_section', $class_section, PDO::PARAM_INT);
    $statement->bindParam(':class_time', $class_time, PDO::PARAM_STR);
    $statement->bindParam(':crs_code', $crs_code, PDO::PARAM_INT);
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);
    $statement->bindParam(':room_code', $room_code, PDO::PARAM_INT);
    $statement->bindParam(':semester_code', $semester_code, PDO::PARAM_INT);

    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>