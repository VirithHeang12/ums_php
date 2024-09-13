<?php 

declare(strict_types=1);

require_once __DIR__ . '/../models/Semester.php';
require_once __DIR__ . '/../database/database_connection.php';

$semester_code = (int) ($_POST['semester_code'] ?? 0);
$semester_year = (int) ($_POST['semester_year'] ?? date("Y"));
$semester_term = (int) ($_POST['semester_term'] ?? 1);
$semester_start_date = $_POST['semester_start_date'] ?? '';
$semester_end_date = $_POST['semester_end_date'] ?? '';

$semester = new Semester($pdo, $semester_code, $semester_year, $semester_term, $semester_start_date, $semester_end_date, $_FILES);

$semester->update();

?>