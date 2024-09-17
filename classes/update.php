<?php 

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Class.php';

$class_code = $_POST['class_code'] ?? '';
$class_section = $_POST['class_section'] ?? '';
$class_time = $_POST['class_time'] ?? '';
$crs_code = $_POST['crs_code'] ?? '';
$prof_num = $_POST['prof_num'] ?? '';
$room_code = $_POST['room_code'] ?? '';
$semester_code = $_POST['semester_code'] ?? '';

$class = new Classes($pdo, $class_code, $class_section, $class_time, $crs_code, $prof_num, $room_code, $semester_code, $_FILES);
$class->update();
?>