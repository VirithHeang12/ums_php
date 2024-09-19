<?php

require_once __DIR__ . '/../database/database_connection.php';


$crs_code = $_GET['id'] ?? null;
$prof_num = $_GET['id'] ?? null;
$room_code = $_GET['id'] ?? null;
$semester_code = $_GET['id'] ?? null;

// get all roles

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

} catch (PDOException $e) {
    echo "Error while retrieving datas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-6 m-auto">
                <h1 class="text-center">Create Class</h1>
                <form class="form" action="save.php" method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="class_section" class="col-3">Class Section</label>
                        <div class="col-9">
                            <input type="text" name="class_section" class="form-control" id="class_section">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="class_time" class="col-3">Class Time</label>
                        <div class="col-9">
                            <input type="text" name="class_time" class="form-control" id="class_time">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="crs_code" class="col-3">Course Title</label>
                        <div class="col-9">
                            <select class="form-select" name="crs_code" id="crs_code">
                                <?php foreach ($courses as $row) : ?>
                                    <option value="<?php echo $row['crs_code'] ?>"><?php echo $row['crs_title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="prof_name" class="col-3">Professor Name</label>
                        <div class="col-9">
                            <select class="form-select" name="prof_num" id="prof_num">
                                <?php foreach ($professors as $row) : ?>
                                    <option value="<?php echo $row['prof_num'] ?>"><?php echo $row['prof_lname'] . " " . $row['prof_fname'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="room_code" class="col-3">Room Code</label>
                        <div class="col-9">
                            <select class="form-select" name="room_code" id="room_code">
                                <?php foreach ($rooms as $row) : ?>
                                    <option value="<?php echo $row['room_code'] ?>"><?php echo $row['room_code'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="semester_code" class="col-3">Semester Code</label>
                        <div class="col-9">
                            <select class="form-select" name="semester_code" id="semester_code">
                                <?php foreach ($semesters as $row) : ?>
                                    <option value="<?php echo $row['semester_code'] ?>"><?php echo $row['semester_code'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="file" class="col-3">Attachment</label>
                        <div class="col-9">
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">Create</button>
                        <a href="index.php" class="btn btn-secondary ms-4 px-4">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>