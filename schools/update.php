<?php 

    declare(strict_types=1);

    require_once __DIR__ . '/../database/database_connection.php';
    require_once __DIR__ . '/../models/School.php';

    $school_code = (int)($_POST['school_code'] ?? 0);
    $school_name = $_POST['school_name'] ?? '';
    $prof_num = (int)($_POST['prof_num'] ?? 0);

    $school = new School($pdo, $school_code, $school_name, $prof_num, $_FILES);

?>