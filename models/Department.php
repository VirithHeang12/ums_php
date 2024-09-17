<?php

declare(strict_types=1);
require_once __DIR__ . '/../models/CRUDable.php';
require_once __DIR__ . '/../models/Media.php';

class Department implements CRUDable
{
    private PDO $pdo;
    private Media $media;
    private $file;

    private string $dept_name;
    private int $school_code;
    private int $prof_num;
    
   


    public function __construct(PDO $pdo, int $dept_code , string $dept_name , int $school_code , int $prof_num,$file)
    {
        $this->pdo = $pdo;
        $this->media = new Media();
        $this->file = $file;
        $this->dept_code = $dept_code;
        $this->dept_name = $dept_name;
        $this->school_code = $school_code;
        $this->prof_num = $prof_num;
      
    }

    //getter and setter
    public function getDepartmentCode(): int
    {
        return $this->dept_code;
    }

    public function setDepartmentCode(int $dept_code): void
    {
        $this->dept_code = $dept_code;
    }

    public function getDepartmentName(): string
    {
        return $this->dept_name;
    }

    public function setDepartmentName(string $dept_name): void
    {
        $this->dept_name = $dept_name;
    }

    public function getSchoolCode(): int
    {
        return $this->school_code;
    }

    public function setSchoolCode(int $school_code): void
    {
        $this->school_code = $school_code;
    }

    public function getProfessorNumber(): int
    {
        return $this->prof_num;
    }

    public function setProfessorNumber(int $prof_num): void
    {
        $this->prof_num = $prof_num;
    }
   


    public function create(): void
    {
       try {
           $this->pdo->beginTransaction();

           $statement = $this->pdo->prepare("INSERT INTO departments (dept_name, school_code , prof_num) VALUES (:dept_name, :school_code,:prof_num)");

           $statement->bindParam(':dept_name', $this->dept_name, PDO::PARAM_STR);
           $statement->bindParam(':school_code', $this->school_code, PDO::PARAM_INT);
           $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);

           $statement->execute();

        //    $statement = $this->pdo->prepare(
        //     "SELECT dept_code FROM departments ORDER BY dept_code DESC OFFSET 0 ROW FETCH NEXT 1 ROW ONLY");
        $statement = $this->pdo->prepare(
            "SELECT dept_code FROM departments ORDER BY dept_code DESC LIMIT 1 OFFSET 0"
        );

           $statement->execute();
           $this->dept_code = (int) $statement->fetch()['dept_code'];
           $this->media->save($this->file, $this->pdo, "attachment", $this->dept_code, "department");

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
            $statement = $this->pdo->prepare("UPDATE departments SET DEPT_NAME = :dept_name, SCHOOL_CODE = :school_code , PROF_NUM = :prof_num WHERE DEPT_CODE = :dept_code");
        
            $statement->bindParam(':dept_code', $this->dept_code, PDO::PARAM_INT);
            $statement->bindParam(':dept_name', $this->dept_name, PDO::PARAM_STR);
            $statement->bindParam(':school_code', $this->school_code ,PDO::PARAM_INT);
            $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);
            
        
            $statement->execute();
            $this->media->save($this->file, $this->pdo, "attachment", $this->dept_code, "department");
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
            $statement = $this->pdo->prepare("SELECT * FROM departments");
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
            $statement = $this->pdo->prepare("DELETE FROM departments WHERE dept_code = :dept_code");
            $statement->bindParam(':dept_code', $this->dept_code, PDO::PARAM_INT);
            $statement->execute();
            header('Location: index.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function getAllClasses(int $dept_code): array
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM classes WHERE dept_code = :dept_code");
            $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];

    }
}