<?php 

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Course.php'; 

$dept_code = $_POST['dept_code'] ?? '';
$crs_title = $_POST['crs_title'] ?? '';
$crs_description = $_POST['crs_description'] ?? '';
$crs_credit = $_POST['crs_credit'] ?? '';


$course = new Course($pdo, -1, $dept_code, $crs_title, $crs_description, $crs_credit, $_FILES);
$course->create();



