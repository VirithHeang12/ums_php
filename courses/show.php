<?php


require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/Course.php'; 


$crs_code = $_GET['id'] ?? null; 
$entity_type = 'course';

    $courseModel = new Course($pdo); 
    $result = $courseModel->getCourse((int)$crs_code, $entity_type); 

 
    $course = $result['course'] ?? []; 
    $classes = $result['classes'] ?? [];
    $attachment = $result['attachment'] ?? [];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <a href="index.php" class="btn btn-primary m-5">Back</a>
    <h1 class="text-center">Show Course</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <table class="table">
                    <tr>
                        <th>COURSE CODE</th>
                        <td><?php echo $course['crs_code'] ?></td>
                    </tr>
                    <tr>
                        <th>DEPARTMENT NAME</th>
                        <td><?php echo $course['dept_name']; ?></td>
                    </tr>
                    <tr>
                        <th>COURSE TITLE</th>
                        <td><?php echo $course['crs_title']; ?></td>
                    </tr>
                    <tr>
                        <th>COURSE DESCRIPTION</th>
                        <td><?php echo $course['crs_description'];  ?></td>
                    </tr>
                    <tr>
                        <th>COURSE CREDIT</th>
                        <td><?php echo $course['crs_credit'];  ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">ATTACHMENT</th>

                        <td>
                            <?php if ($attachment['media_type'] === 'attachment') : ?>
                                <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank" style="font-family: Kantumruy Pro;">មើល</a>
                            <?php else : ?>
                                No Attachment
                            <?php endif; ?>
                        </td>
                       
                    </tr>
                </table>
                <h2 class="text-center">Classes</h2>
                <table class="table">
                    <tr>
                        <th>CLASS CODE</th>
                        <th>CLASS SECTION</th>
                        <th>CLASS TIME</th>
                    </tr>
                    <?php foreach ($classes as $class) : ?>
                        <tr>
                            <td><?php echo $class['class_code']; ?></td>
                            <td><?php echo $class['class_section']; ?></td>
                            <td><?php echo $class['class_time']; ?></td>
                        </tr>
                    <?php endforeach; ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>