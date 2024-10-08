<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/CRUDable.php';
require_once __DIR__ . '/../models/Media.php';

class Semester implements CRUDable
{
    private PDO $pdo;
    private Media $media;
    private $file;

    private int $semester_code;
    private int $semester_year;
    private int $semester_term;
    private string $semester_start_date;
    private string $semester_end_date;

    public function __construct(PDO $pdo, int $semester_code, int $semester_year, int $semester_term, string $semester_start_date, string $semester_end_date, $file)
    {
        $this->pdo = $pdo;
        $this->media = new Media();
        $this->file = $file;
        $this->semester_code = $semester_code;
        $this->semester_year = $semester_year;
        $this->semester_term = $semester_term;
        $this->semester_start_date = $semester_start_date;
        $this->semester_end_date = $semester_end_date;
    }


    // generate getter and setter
    public function getSemesterCode(): int
    {
        return $this->semester_code;
    }

    public function setSemesterCode(int $semester_code): void
    {
        $this->semester_code = $semester_code;
    }

    public function getSemesterYear(): int
    {
        return $this->semester_year;
    }

    public function setSemesterYear(int $semester_year): void
    {
        $this->semester_year = $semester_year;
    }

    public function getSemesterTerm(): int
    {
        return $this->semester_term;
    }

    public function setSemesterTerm(int $semester_term): void
    {
        $this->semester_term = $semester_term;
    }

    public function getSemesterStartDate(): string
    {
        return $this->semester_start_date;
    }

    public function setSemesterStartDate(string $semester_start_date): void
    {
        $this->semester_start_date = $semester_start_date;
    }

    public function getSemesterEndDate(): string
    {
        return $this->semester_end_date;
    }

    public function setSemesterEndDate(string $semester_end_date): void
    {
        $this->semester_end_date = $semester_end_date;
    }


    public function create(): void
    {
        try {
            $this->pdo->beginTransaction();
             
            $statement = $this->pdo->prepare("INSERT INTO semesters (semester_year, semester_term, semester_start_date, semester_end_date) 
            VALUES (:semester_year, :semester_term, :semester_start_date, :semester_end_date)");

            $statement->bindParam(':semester_year', $this->semester_year, PDO::PARAM_INT);
            $statement->bindParam(':semester_term', $this->semester_term, PDO::PARAM_INT);
            $statement->bindParam(':semester_start_date', $this->semester_start_date, PDO::PARAM_STR);
            $statement->bindParam(':semester_end_date', $this->semester_end_date, PDO::PARAM_STR);

            $statement->execute();

            $statement = $this->pdo->prepare(
                "SELECT semester_code FROM semesters ORDER BY semester_code DESC LIMIT 1 OFFSET 0");

            $statement->execute();

            $this->semester_code = (int) $statement->fetch()['semester_code'];

            $this->media->save($this->file, $this->pdo, "attachment", $this->semester_code, "semester");

            $this->pdo->commit();

            header('Location: index.php');
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    public function update():void {
       try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("UPDATE semesters
                SET semester_year = :semester_year,
                    semester_term = :semester_term,
                    semester_start_date = :semester_start_date,
                    semester_end_date = :semester_end_date
                WHERE semester_code = :semester_code");

            $statement->bindParam(':semester_code', $this->semester_code, PDO::PARAM_INT);
            $statement->bindParam(':semester_year', $this->semester_year, PDO::PARAM_INT);
            $statement->bindParam(':semester_term', $this->semester_term, PDO::PARAM_INT);
            $statement->bindParam(':semester_start_date', $this->semester_start_date, PDO::PARAM_STR);
            $statement->bindParam(':semester_end_date', $this->semester_end_date, PDO::PARAM_STR);

            $statement->execute();

            $this->media->save($this->file, $this->pdo, "attachment", (int) $this->semester_code, "semester");

            $this->pdo->commit();
            header('Location: index.php');
        }catch(PDOException $e){
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    public function read(): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM semesters");
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];
    }

    public function delete(): void
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM semesters WHERE semester_code = :semester_code");
            $statement->bindParam(':semester_code', $this->semester_code, PDO::PARAM_INT);
            $statement->execute();
            header('Location: index.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getAllClasses(int $semester_code): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM classes WHERE semester_code = :semester_code");
            $statement->bindParam(':semester_code', $semester_code, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];

    }
}