<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../models/CRUDable.php';
    require_once __DIR__ . '/../models/Media.php';

    class Classes implements CRUDable
    {
        private PDO $pdo;
        private Media $media;
        private $file;

        private int $class_code;
        private int $class_section;
        private string $class_time;
        private int $crs_code;
        private int $prof_num;
        private int $room_code;
        private int $semester_code;

        public function __construct(PDO $pdo, int $class_code, int $class_section, string $class_time, int $crs_code, int $prof_num, int $room_code, int $semester_code, $file)
        {
            $this->pdo = $pdo;
            $this->media = new Media();
            $this->file = $file;
            $this->class_code = $class_code;
            $this->class_section = $class_section;
            $this->class_time = $class_time;
            $this->crs_code = $crs_code;
            $this->prof_num = $prof_num;
            $this->room_code = $room_code;
            $this->semester_code = $semester_code;
        }

        public function getClassCode(): int
        {
            return $this->class_code;
        }
        public function getClassSection(): int{
            return $this->class_section;
        }
        public function getClassTime(): string{
            return $this->class_time;
        }
        public function getCourseCode(): int{
            return $this->crs_code;
        }
        public function getProfessorNumber(): int{
            return $this->prof_num;
        }
        public function getRoomCode(): int{
            return $this->room_code;
        }
        public function getSemesterCode(): int{
            return $this->semester_code;
        }

        public function setClassCode(int $class_code): void{
            $this->class_code = $class_code;
        }
        public function setClassSection(int $class_section) : void {
            $this->class_section = $class_section;
        }
        public function setClassTime(string $class_time): void{
            $this->class_time = $class_time;
        }
        public function setCourseCode(int $crs_code) : void {
            $this->crs_code = $crs_code;
        }
        public function setProfessorNumber(int $prof_num): void{
            $this->prof_num = $prof_num;
        }
        public function setRoomCode(int $room_code) : void {
            $this->room_code = $room_code;
        }
        public function setSemesterCode(int $semester_code): void{
            $this->semester_code = $semester_code;
        }

        public function create(): void{
            try {
                $this->pdo->beginTransaction();
            
                $statement = $this->pdo->prepare("INSERT INTO classes (class_section, class_time, crs_code, prof_num, room_code, semester_code) 
                                            VALUES (:class_section, :class_time, :crs_code, :prof_num, :room_code, :semester_code)");
            
                $statement->bindParam(':class_section', $this->class_section, PDO::PARAM_INT);
                $statement->bindParam(':class_time', $this->class_time, PDO::PARAM_STR);
                $statement->bindParam(':crs_code', $this->crs_code, PDO::PARAM_INT);
                $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);
                $statement->bindParam(':room_code', $this->room_code, PDO::PARAM_INT);
                $statement->bindParam(':semester_code', $this->semester_code, PDO::PARAM_INT);
            
                $statement->execute();

                $statement = $this->pdo->prepare(
                    "SELECT class_code FROM classes ORDER BY class_code DESC LIMIT 1 OFFSET 0;
                ");
    
                $statement->execute();
    
                $this->class_code = (int) $statement->fetch()['class_code'];
    
                $this->media->save($this->file, $this->pdo, "attachment", (int) $this->class_code, "class");
    
                $this->pdo->commit();
            
                header('Location: index.php');
            } catch (PDOException $e) {
                $this->pdo->rollBack();
                echo "Error: " . $e->getMessage();
            }
        }

        public function update(): void {
            try {
                $this->pdo->beginTransaction();
        
                // Update the class information
                $statement = $this->pdo->prepare(
                    "UPDATE classes 
                     SET class_section = :class_section, class_time = :class_time, crs_code = :crs_code, 
                         prof_num = :prof_num, room_code = :room_code, semester_code = :semester_code
                     WHERE class_code = :class_code"
                );
        
                $statement->bindParam(':class_section', $this->class_section, PDO::PARAM_INT);
                $statement->bindParam(':class_time', $this->class_time, PDO::PARAM_STR);
                $statement->bindParam(':crs_code', $this->crs_code, PDO::PARAM_INT);
                $statement->bindParam(':prof_num', $this->prof_num, PDO::PARAM_INT);
                $statement->bindParam(':room_code', $this->room_code, PDO::PARAM_INT);
                $statement->bindParam(':semester_code', $this->semester_code, PDO::PARAM_INT);
                $statement->bindParam(':class_code', $this->class_code, PDO::PARAM_INT);
        
                $statement->execute();
    
                $this->media->save($this->file, $this->pdo, "attachment", (int) $this->class_code, "class");
        
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
                $statement = $this->pdo->prepare("SELECT * FROM classes");
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
                $statement = $this->pdo->prepare("DELETE FROM classes WHERE class_code = :class_code");
                $statement->bindParam(':class_code', $this->class_code, PDO::PARAM_INT);
                $statement->execute();
                header('Location: index.php');
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>