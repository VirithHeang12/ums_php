<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/CRUDable.php';
require_once __DIR__ . '/../models/Media.php';

class Course implements CRUDable
{
    private PDO $pdo;
    private Media $media;
    private $file;

    private $crs_code;
    private $dept_code;
    private $crs_title;
    private $crs_description;
    private $crs_credit;

    public function __construct(PDO $pdo, int $crs_code = 0, int $dept_code = 0, string $crs_title = '', string $crs_description = '', string $crs_credit = '', $file = null)
    {
        $this->pdo = $pdo;
        $this->media = new Media();
        $this->file = $file;
        $this->crs_code = $crs_code;
        $this->dept_code = $dept_code;
        $this->crs_title = $crs_title;
        $this->crs_description = $crs_description;
        $this->crs_credit = $crs_credit;
    }


    public function getCourseCode(): int
    {
        return $this->crs_code;
    }

    public function setCourseCode(int $crs_code): void
    {
        $this->crs_code = $crs_code;
    }

    public function getDepartmentCode(): int
    {
        return $this->dept_code;
    }

    public function setDepartmentCode(int $dept_code): void
    {
        $this->dept_code = $dept_code;
    }

    public function getCourseTitle(): string
    {
        return $this->crs_title;
    }

    public function setCourseTitle(string $crs_title): void
    {
        $this->crs_title = $crs_title;
    }

    public function getCourseDescription(): string
    {
        return $this->crs_description;
    }

    public function setCourseDescription(string $crs_description): void
    {
        $this->crs_description = $crs_description;
    }

    public function getCourseCredit(): string
    {
        return $this->crs_credit;
    }

    public function setCourseCredit(string $crs_credit): void
    {
        $this->crs_credit = $crs_credit;
    }
    public function create(): void
    {
        try {
            $this->pdo->beginTransaction();
            $statement = $this->pdo->prepare("INSERT INTO courses (dept_code, crs_title, crs_description, crs_credit) VALUES (:dept_code, :crs_title, :crs_description, :crs_credit)");

            $statement->bindParam(':dept_code', $this->dept_code, PDO::PARAM_INT);  // Assuming you meant to bind crs_code here
            $statement->bindParam(':crs_title', $this->crs_title, PDO::PARAM_STR);
            $statement->bindParam(':crs_description', $this->crs_description, PDO::PARAM_STR);
            $statement->bindParam(':crs_credit', $this->crs_credit, PDO::PARAM_STR);
            $statement->execute();

            $statement = $this->pdo->prepare("SELECT crs_code FROM courses ORDER BY crs_code DESC LIMIT 1");
            $statement->execute();
            $this->crs_code = (int) $statement->fetch()['crs_code'];

            $this->media->save($this->file, $this->pdo, "attachment", $this->crs_code, "course");

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
            $statement = $this->pdo->prepare("SELECT * FROM courses WHERE crs_code = :crs_code");
            $statement->bindParam(':crs_code', $this->crs_code, PDO::PARAM_INT);  // Use $this->crs_code
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }


    public function update(): void
    {
        try {
            $this->pdo->beginTransaction();
            
            // Prepare the update statement for the course
            $statement = $this->pdo->prepare("UPDATE courses SET dept_code = :dept_code, crs_title = :crs_title, crs_description = :crs_description, crs_credit = :crs_credit WHERE crs_code = :crs_code");
    
            // Bind parameters
            $statement->bindParam(':crs_code', $this->crs_code, PDO::PARAM_STR);
            $statement->bindParam(':dept_code', $this->dept_code, PDO::PARAM_INT);
            $statement->bindParam(':crs_title', $this->crs_title, PDO::PARAM_STR);
            $statement->bindParam(':crs_description', $this->crs_description, PDO::PARAM_STR);
            $statement->bindParam(':crs_credit', $this->crs_credit, PDO::PARAM_STR);
    
            // Execute the update statement
            $statement->execute();
    
            // Save the media file (ensure media class is properly handling the file)
            $this->media->save($this->file, $this->pdo, 'attachment', (int)$this->crs_code, 'course');
    
            // Commit the transaction
            $this->pdo->commit();
            header('Location: index.php');
        } catch (PDOException $e) {
            // Rollback transaction in case of an error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function delete(): void
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM courses WHERE crs_code = :crs_code");
            $statement->bindParam(':crs_code', $crs_code, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

   

    public function getCourse(int $crs_code, string $entity_type): array
    {
        try {
            // Fetch Course with Department Name
            $statement = $this->pdo->prepare("SELECT c.*, d.dept_name 
                FROM courses c 
                JOIN departments d ON c.dept_code = d.dept_code 
                WHERE crs_code = :crs_code");
            $statement->bindParam(':crs_code', $crs_code);
            $statement->execute();
            $course = $statement->fetch(PDO::FETCH_ASSOC);

            // Fetch all departments
            $statement = $this->pdo->prepare("SELECT dept_code, dept_name FROM departments");
            $statement->execute();
            $departments = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Fetch Classes
            $classes = [];
            if ($course) {
                $statement = $this->pdo->prepare("SELECT * FROM classes WHERE crs_code = :crs_code");
                $statement->bindParam(':crs_code', $crs_code);
                $statement->execute();
                $classes = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all classes as associative array
            }

            // Fetch Attachment
            $attachment = [];
            $statement = $this->pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
            $statement->bindParam(':entity_id', $crs_code);
            $statement->bindParam(':entity_type', $entity_type);
            $statement->execute();
            $attachment = $statement->fetch(PDO::FETCH_ASSOC); // Fetch attachment as associative array

            return [
                'course' => $course,
                'classes' => $classes,
                'attachment' => $attachment,
                'department' => $departments,
            ];
        } catch (PDOException $e) {
            echo "Error while retrieving course: " . $e->getMessage();
            return [];
        }
    }
}
