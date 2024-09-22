<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/Building.php';
require_once __DIR__ . '/../database/database_connection.php';

$bldg_name = $_POST['bldg_name'] ?? '';
$bldg_location = $_POST['bldg_location'] ?? '';

$building = new Building($pdo, $bldg_name, $bldg_location);
$building->create();

?>
// try {
// $pdo->beginTransaction();

// $statement = $pdo->prepare("INSERT INTO buildings (bldg_name, bldg_location) VALUES (:bldg_name, :bldg_location)");

// $statement->bindParam(':bldg_name', $bldg_name, PDO::PARAM_STR);
// $statement->bindParam(':bldg_location', $bldg_location, PDO::PARAM_STR);

// $statement->execute();

// $pdo->commit();

// header('Location: index.php');
// } catch (PDOException $e) {
// $pdo->rollBack();
// echo "Error: " . $e->getMessage();
// }