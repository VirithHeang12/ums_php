<?php 

declare(strict_types=1);

require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Department.php';

$dept_name = $_POST['dept_name'] ?? '';
$school_code = (int)($_POST['school_code'] ?? 1);
$prof_num = (int)($_POST['prof_num'] ?? 1);

$department = new Department ($pdo , -1 , $dept_name, $school_code , $prof_num,$_FILES);
$department->create();