<?php 

    declare(strict_types=1);

    require_once __DIR__ . '/../database/database_connection.php';
    require_once __DIR__ . '/../models/School.php';

    $school_code = (int)($_GET['id'] ?? 0);

    $school = new School($pdo, $school_code);
    $school->delete();