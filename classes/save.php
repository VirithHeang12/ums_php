<?php 

declare(strict_types=1);

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Class.php';

$class_section = (int) ($_POST['class_section'] ?? 1);
$class_time = $_POST['class_time'] ?? '';
$crs_code = (int) ($_POST['crs_code'] ?? 1);
$prof_num = (int) ($_POST['prof_num'] ?? 1);
$room_code = (int) ($_POST['room_code'] ?? 1);
$semester_code = (int) ($_POST['semester_code'] ?? 1);

$class = new Classes($pdo, -1, $class_section, $class_time, $crs_code, $prof_num, $room_code, $semester_code, $_FILES);
$class->create();

?>