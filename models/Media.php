<?php

class Media
{
    private PDO $pdo;

    public function save($file, PDO $pdo, string $mediaType, int $entityId, string $entityType): void {
        $this->pdo = $pdo;

        $fileName = null;

        if ($file && $file['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = $file['file']['name'];
            $fileTmpName = $file['file']['tmp_name'];

            [$fileNameExact, $extention] = explode('.', $fileName);

            $fileNameToStore = $fileNameExact . '_' . time() . '.' . $extention;
            move_uploaded_file($fileTmpName, __DIR__ . '/../images/' . $fileNameToStore);
        }

        try {
            $statement = $this->pdo->prepare("INSERT INTO medias (media_type, media_url, entity_id, entity_type) VALUES (:media_type, :media_url, :entity_id, :entity_type)");

            $statement->bindParam(':media_type', $mediaType, PDO::PARAM_STR);
            $statement->bindParam(':media_url', $fileNameToStore, PDO::PARAM_STR);
            $statement->bindParam(':entity_id', $entityId, PDO::PARAM_INT);
            $statement->bindParam(':entity_type', $entityType, PDO::PARAM_STR);

            $statement->execute();         
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}