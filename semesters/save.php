<?php

declare(strict_types=1);

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Semester.php';

$semester_year = (int) ($_POST['semester_year'] ?? date("Y"));
$semester_term = (int) ($_POST['semester_term'] ?? 1);
$semester_start_date = $_POST['semester_start_date'] ?? '';
$semester_end_date = $_POST['semester_end_date'] ?? '';


$semester = new Semester($pdo, -1, $semester_year, $semester_term, $semester_start_date, $semester_end_date, $_FILES);
$semester->create();

?>