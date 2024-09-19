<?php

declare(strict_types=1);
class Building
{

  private PDO $pdo;

  private int $bldg_code;
  private string $bldg_name;
  private string $bldg_location;

  public function __construct(PDO $pdo, string $bldg_name, $bldg_location)
  {
    $this->$bldg_name = $bldg_name;
    $this->$bldg_location = $bldg_location;
  }


  public function create(): void
  {
    try {
      $this->pdo->beginTransaction();

      $statement = $this->pdo->prepare("INSERT INTO buildings (bldg_name, bldg_location) VALUES (:bldg_name, :bldg_location)");

      $statement->bindParam(':bldg_name', $this->bldg_name, PDO::PARAM_STR);
      $statement->bindParam(':bldg_location', $this->bldg_location, PDO::PARAM_STR);

      $statement->execute();
      $this->pdo->commit();

      header('Location: index.php');
    } catch (PDOException $e) {
      $this->pdo->rollBack();
      echo "Error: " . $e->getMessage();
    }
  }
}
