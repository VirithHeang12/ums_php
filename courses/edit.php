<?php
require_once __DIR__ . '/../database/database_connection.php'; 
require_once __DIR__ . '/../models/Course.php'; 


$crs_code = $_GET['id'] ?? ''; 
$entity_type = 'course'; 

$courseModel = new Course($pdo);

$courseData = $courseModel->getCourse((int)$crs_code, $entity_type);

if (!empty($courseData)) {
    $course = $courseData['course'];
    $classes = $courseData['classes'];
    $attachment = $courseData['attachment'];
    $departments = $courseData['department'];

    $dept_code = $course['dept_code'];
    $crs_title = $course['crs_title'];
    $crs_description = $course['crs_description'];
    $crs_credit = $course['crs_credit'];
} else {
    echo "No course found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-6 mx-auto">
            <form action="update.php" method="post" class="form mx-auto shadow-sm p-3" enctype="multipart/form-data">
                <label for="crs_code" class="form-label">Course Code</label>
                <input type="text" class="form-control mb-2" name="crs_code" id="crs_code" value="<?php echo htmlspecialchars($crs_code); ?>" readonly>

                <label for="dept_code" class="form-label">Department</label>
                <select class="form-control mb-2" id="dept_code" name="dept_code" required>
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo htmlspecialchars($department['dept_code']); ?>" <?php echo $department['dept_code'] == $dept_code ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($department['dept_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="crs_title" class="form-label">Course Title</label>
                <input type="text" class="form-control mb-2" name="crs_title" id="crs_title" value="<?php echo htmlspecialchars($crs_title); ?>">

                <label for="crs_description" class="form-label">Course Description</label>
                <input type="text" class="form-control mb-2" name="crs_description" id="crs_description" value="<?php echo htmlspecialchars($crs_description); ?>">

                <label for="crs_credit" class="form-label">Course Credit</label>
                <input type="text" class="form-control mb-3" name="crs_credit" id="crs_credit" value="<?php echo htmlspecialchars($crs_credit); ?>">

                <input type="file" name="file" id="file" class="form-control mb-3">

                <?php if ($attachment): ?>
                    <?php if ($attachment['media_type'] === 'attachment'): ?>
                        <a href="./../images/<?php echo htmlspecialchars($attachment['media_url']); ?>" target="_blank">មេីល</a>
                    <?php else: ?>
                        <p>No Attachment</p>
                    <?php endif; ?>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
