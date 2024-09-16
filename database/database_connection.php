<?php

$config = require_once __DIR__ . '/../config/db_config.php';

$host                   = $config['db_host'];
$port                   = $config['db_port'];
$databasename           = $config['db_name'];
$username               = $config['db_username'];
$password               = $config['db_password'];

try {

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$databasename", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(0);
}

?>

