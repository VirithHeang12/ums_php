<?php

class Media
{
    private PDO $pdo;

    public function save($file, PDO $pdo, string $mediaType, int $entityId, string $entityType): void {
        $this->pdo = $pdo;
    
        $fileNameToStore = null;
    
        // Only process the file if one was uploaded
        if (isset($file['file']) && $file['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = $file['file']['name'];
            $fileTmpName = $file['file']['tmp_name'];
    
            [$fileNameExact, $extension] = explode('.', $fileName);
    
            $fileNameToStore = $fileNameExact . '_' . time() . '.' . $extension;
            move_uploaded_file($fileTmpName, __DIR__ . '/../images/' . $fileNameToStore);
        }
    
        // If no new file is uploaded, keep the old one
        if ($fileNameToStore === null) {
            // Fetch the existing file
            $stmt = $this->pdo->prepare("SELECT media_url FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
            $stmt->bindParam(':entity_id', $entityId, PDO::PARAM_INT);
            $stmt->bindParam(':entity_type', $entityType, PDO::PARAM_STR);
            $stmt->execute();
            $existingAttachment = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Use the existing file name
            if ($existingAttachment) {
                $fileNameToStore = $existingAttachment['media_url'];
            }
        }else{
            // Proceed with deleting and inserting the attachment
            $stmt = $this->pdo->prepare("DELETE FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
            $stmt->bindParam(':entity_id', $entityId, PDO::PARAM_INT);
            $stmt->bindParam(':entity_type', $entityType, PDO::PARAM_STR);
            $stmt->execute();
        
            $stmt = $this->pdo->prepare("INSERT INTO medias (media_type, media_url, entity_id, entity_type) VALUES (:media_type, :media_url, :entity_id, :entity_type)");
            $stmt->bindParam(':media_type', $mediaType, PDO::PARAM_STR);
            $stmt->bindParam(':media_url', $fileNameToStore, PDO::PARAM_STR);
            $stmt->bindParam(':entity_id', $entityId, PDO::PARAM_INT);
            $stmt->bindParam(':entity_type', $entityType, PDO::PARAM_STR);
            $stmt->execute();

        }
    
    }
    
}