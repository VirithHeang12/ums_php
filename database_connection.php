<?php

$config = require_once __DIR__ . '/config/db_config.php';

$host                   = $config['db_host'];
$port                   = $config['db_port'];
$service_name           = $config['db_service_name'];
$username               = $config['db_username'];
$password               = $config['db_password'];

try {
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port)))(CONNECT_DATA=(SERVICE_NAME=$service_name)))";
    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(0);
}
