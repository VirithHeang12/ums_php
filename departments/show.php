<?php 
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Department.php';
require_once __DIR__ . '/../authentication/admin_authorization_check.php';

$dept_code = $_GET['id'];
$entity_type = 'department';

try {
    $statement = $pdo->prepare("SELECT d.* , d.dept_name,s.school_code,p.prof_num
    from departments d
    JOIN schools s ON d.school_code = s.school_code
    JOIN professors p ON d.prof_num = p.prof_num 
        WHERE d.DEPT_CODE = :dept_code");
    $statement->bindParam(':dept_code', $dept_code);
    $statement->execute();
    $department = $statement->fetch();


    $attachment = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
    $attachment->bindParam(':entity_id', $dept_code);
    $attachment->bindParam(':entity_type', $entity_type);
    $attachment->execute();
    $attachments = $attachment->fetchAll();

} catch (PDOException $e) {
    echo "Error while retrieving professor: " . $e->getMessage();
}
?>  
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <a href="index.php" class="btn btn-primary m-5">Back</a>
    <h1 class="text-center">Show Departements</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>DEPARTMENT CODE</th>
                        <td><?php echo $department['dept_code']; ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT NAME</th>
                        <td><?php echo $department['dept_name']; ?></td>
                    </tr>
                    <tr>
                        <th>SCHOOL CODE</th>
                        <td><?php echo $department['school_code']; ?></td>
                    </tr>
                    <tr>
                        <th>PROFESSOR NUMBER</th>
                        <td><?php echo $department['prof_num']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">ATTACHMENT</th>
                        <td>
                            <?php if ($attachments) : ?>
                                <?php foreach ($attachments as $attachment) : ?>
                                <?php if ($attachment['media_type'] === 'image') : ?>
                                    <img src="./../images/<?php echo $attachment['media_url']; ?>" alt="Image" class="img-fluid">
                                <?php elseif ($attachment['media_type'] === 'attachment') : ?>
                                    <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank">មើល</a>
                                <?php endif; ?>
                                <?php endforeach; ?>

                            <?php else : ?>
                                No attachment
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
