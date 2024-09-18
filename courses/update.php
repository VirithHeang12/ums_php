<?php 
declare(strict_types=1);

require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../database/database_connection.php';


$crs_code = (int)$_POST['crs_code'] ?? 0;
$dept_code = (int)$_POST['dept_code'] ?? 0;
$crs_title = $_POST['crs_title'] ?? '';    
$crs_description= $_POST['crs_description'] ?? '';
$crs_credit = $_POST['crs_credit'] ?? ''; 


$course = new Course($pdo, $crs_code, $dept_code, $crs_title, $crs_description, $crs_credit, $_FILES);

$course->update();