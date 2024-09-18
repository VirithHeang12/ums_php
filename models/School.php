<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/CRUDable.php';
require_once __DIR__ . '/../models/Media.php';

class School implements CRUDable
{
    private PDO $pdo;
    private Media $media;
    private $file;

    private int $school_code;
    private string $school_name;
    private int $prof_num;

    public function __construct(PDO $pdo, int $school_code = 0, string $school_name = '', int $prof_num = 0, $file = null)
    {
        $this->pdo = $pdo;
        $this->media = new Media();
        $this->school_code = $school_code;
        $this->school_name = $school_name;
        $this->prof_num = $prof_num;
        $this->file = $file;
    }

    #region getter & setter
    public function getSchoolCode(): int
    {
        return $this->school_code;
    }
    public function setSchoolCode(int $school_code): void
    {
        $this->school_code = $school_code;
    }
    public function getSchoolName(): string
    {
        return $this->school_name;
    }
    public function setSchoolName(string $school_name): void
    {
        $this->school_name = $school_name;
    }
    public function getProfNum(): int
    {
        return $this->prof_num;
    }
    public function setProfNum(int $prof_num): void
    {
        $this->prof_num = $prof_num;
    }
    #endregion

    public function create(): void
    {
        try {
            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare("INSERT INTO schools (school_name, prof_num) VALUES (:school_name, :prof_num)");

            $statement->bindParam(':school_name', $this->school_name, PDO::PARAM_STR);
            $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);
            $statement->execute();

            $statement = $this->pdo->prepare("SELECT school_code FROM schools ORDER BY school_code DESC LIMIT 1 OFFSET 0;");
            $statement->execute();
            $this->school_code = (int) $statement->fetch()['school_code'];

            $this->media->save($this->file, $this->pdo, "image", $this->school_code, "school");

            $this->pdo->commit();
            header('Location: index.php');
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    public function read(): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM schools");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getSchool(int $school_code, string $entity_type): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM schools WHERE SCHOOL_code = :school_code");
            $statement->bindParam(':school_code', $school_code);
            $statement->execute();
            $school = $statement->fetch();

            $professor = [];
            if ($school) {
                $statement = $this->pdo->prepare("SELECT CONCAT(prof_fname, ' ', prof_lname)  AS full_name FROM professors WHERE prof_num = :prof_num");
                $statement->bindParam(':prof_num', $school['prof_num']);
                $statement->execute();
                $professor = $statement->fetch(PDO::FETCH_ASSOC);
            }

            $attachment = [];
            $statement = $this->pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
            $statement->bindParam(':entity_id', $school_code);
            $statement->bindParam(':entity_type', $entity_type);
            $statement->execute();
            $attachment = $statement->fetch(PDO::FETCH_ASSOC);

            return [
                'school' => $school,
                'professor' => $professor,
                'attachment' => $attachment
            ];
        } catch (PDOException $e) {
            echo "Error while retrieving school:" . $e->getMessage();
            return [];
        }
    }

    public function update(): void
    {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("UPDATE schools
                SET school_name = :school_name,
                    prof_num = :prof_num
                WHERE school_code = :school_code");

            $statement->bindParam(':school_code', $this->school_code, PDO::PARAM_INT);
            $statement->bindParam(':school_name', $this->school_name, PDO::PARAM_STR);
            $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);
            $statement->execute();

            $this->media->save($this->file, $this->pdo, "image", (int) $this->school_code, "school");

            $this->pdo->commit();
            header('Location: index.php');
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete(): void
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM schools WHERE school_code = :school_code");
            $statement->bindParam(':school_code', $this->school_code, PDO::PARAM_INT);
            $statement->execute();
            header('Location: index.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
