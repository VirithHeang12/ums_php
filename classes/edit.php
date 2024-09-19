<?php

require_once __DIR__ . '/../database/database_connection.php';

$class_code = $_GET['id'] ?? '';
$entity_type = 'class';
try {
    $statement = $pdo->prepare("SELECT * FROM courses");
    $statement->execute();
    $courses = $statement->fetchAll();

    $statement = $pdo->prepare("SELECT * FROM rooms");
    $statement->execute();
    $rooms = $statement->fetchAll();

    $statement = $pdo->prepare("SELECT * FROM professors");
    $statement->execute();
    $professors = $statement->fetchAll();

    $statement = $pdo->prepare("SELECT * FROM semesters");
    $statement->execute();
    $semesters = $statement->fetchAll();


    $statement = $pdo->prepare("SELECT * FROM classes WHERE class_code = :class_code");
    $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);
    $statement->execute();

    $class = $statement->fetch(PDO::FETCH_ASSOC);
    $class_code = $class['class_code'];
    $class_section = $class['class_section'];
    $class_time = $class['class_time'];
    $crs_code = $class['crs_code'];
    $prof_num = $class['prof_num'];
    $room_code = $class['room_code'];
    $semester_code = $class['semester_code'];
    
    $attachment = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
    $attachment->bindParam(':entity_id', $class_code);
    $attachment->bindParam(':entity_type', $entity_type);
    $attachment->execute();
    $attachment = $attachment->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-6 m-auto">
                <h1 class="text-center mb-5">Update Class</h1>
                <form class="form" action="update.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="class_code" class="col-3">Class Code</label>
                        <div class="col-9">
                            <input type="text" name="class_code" class="form-control" id="class_code" value="<?php echo $class_code ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="class_section" class="col-3">Class Section</label>
                        <div class="col-9">
                            <input type="text" name="class_section" class="form-control" id="class_section" value="<?php echo $class_section ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="class_time" class="col-3">Class Time</label>
                        <div class="col-9">
                            <input type="text" name="class_time" class="form-control" id="class_time" value="<?php echo $class_time ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="crs_code" class="col-3">Course Title</label>
                        <div class="col-9">
                            <select class="form-select" name="crs_code" id="crs_code">
                                <?php foreach ($courses as $row) : ?>
                                    <option value="<?php echo $row['crs_code'] ?>"
                                        <?php echo ($row['crs_code'] == $crs_code) ? 'selected' : ''; ?>>
                                        <?php echo $row['crs_title']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="prof_name" class="col-3">Professor Name</label>
                        <div class="col-9">
                            <select class="form-select" name="prof_num" id="prof_num">
                                <?php foreach ($professors as $row) : ?>
                                    <option value="<?php echo $row['prof_num'] ?>"
                                        <?php echo ($row['prof_num'] == $prof_num) ? 'selected' : ''; ?>>
                                        <?php echo $row['prof_lname'] . " " . $row['prof_fname'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="room_code" class="col-3">Room Code</label>
                        <div class="col-9">
                            <select class="form-select" name="room_code" id="room_code">
                                <?php foreach ($rooms as $row) : ?>
                                    <option value="<?php echo $row['room_code'] ?>"<?php echo ($row['room_code'] == $room_code) ? 'selected' : ''; ?>>
                                        <?php echo $row['room_code']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="semester_code" class="col-3">Semester Code</label>
                        <div class="col-9">
                            <select class="form-select" name="semester_code" id="semester_code">
                                <?php foreach ($semesters as $row) : ?>
                                    <option value="<?php echo $row['semester_code'] ?>"<?php echo ($row['semester_code'] == $semester_code) ? 'selected' : ''; ?>>
                                        <?php echo $row['semester_code']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="file" class="col-3">Attachment</label>
                        <div class="col-7">
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="col-2">
                            <?php if ($attachment) : ?>
                                <?php if ($attachment['media_type'] === 'image') : ?>
                                    <img src="./../images/<?php echo $attachment['media_url']; ?>" alt="Image" class="img-fluid">
                                <?php elseif ($attachment['media_type'] === 'attachment') : ?>
                                    <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank">Open File</a>
                                <?php endif; ?>

                                <?php else : ?>
                                    No File
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                        <a href="index.php" class="btn btn-secondary ms-4 px-4">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>