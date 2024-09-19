<?php require_once __DIR__ . '/../database/database_connection.php';

$semester_code = $_GET['id'];
$entity_type = 'semester';
try {
    $statement = $pdo->prepare("SELECT * FROM semesters WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();
    $semester = $statement->fetch();

    $statement = $pdo->prepare("SELECT * FROM classes WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();

    $attachment = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
    $attachment->bindParam(':entity_id', $semester_code);
    $attachment->bindParam(':entity_type', $entity_type);
    $attachment->execute();
    $attachment = $attachment->fetch();

    $classes = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving semester:" . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Semester</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <!-- Semester -->
        <div class="row">
            <div class="col-6 m-auto">
                <h1 class="text-center fw-bold text-uppercase mb-4">Show Semester</h1>

                <table class="table">
                    <tr>
                        <th class="col-5">SEMESTER CODE</th>
                        <td><?php echo $semester['semester_code']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">SEMESTER YEAR</th>
                        <td><?php echo $semester['semester_year']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">SEMESTER TERM</th>
                        <td><?php echo $semester['semester_term']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">START DATE</th>
                        <td><?php echo date('F d, Y', strtotime($semester['semester_start_date'])); ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">END DATE</th>
                        <td><?php echo date('F d, Y', strtotime($semester['semester_end_date'])); ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">ATTACHMENT</th>
                        <td>
                            <?php if ($attachment) : ?>
                                <?php if ($attachment['media_type'] === 'image') : ?>
                                    <img src="./../images/<?php echo $attachment['media_url']; ?>" alt="Image" class="img-fluid">
                                <?php elseif ($attachment['media_type'] === 'attachment') : ?>
                                    <a href="./../images/<?php echo $attachment['media_url']; ?>" target="_blank">មើល</a>
                                <?php endif; ?>

                            <?php else : ?>
                                No attachment
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Classes -->
        <div class="row mt-3">
            <div class="col-7 m-auto">
                <h1 class="text-center fw-bold text-uppercase mb-4">Classes</h1>

                <table class="table table-bordered table-hover">
                    <thead align="center" class="table-light align-middle">
                        <tr>
                            <th style="padding-top: 12px; padding-bottom: 12px;">ClASS CODE</th>
                            <th>CLASS SECTION</th>
                            <th>CLASS TIME</th>
                            <th>ROOM CODE</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($classes as $row): ?>
                            <tr align="center" class="align-middle">
                                <td><?php echo $row['class_code']; ?></td>
                                <td><?php echo $row['class_section']; ?></td>
                                <td><?php echo $row['class_time']; ?></td>
                                <td><?php echo $row['room_code']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold mt-4">Back</a>
            </div>
        </div>
    </div>
</body>

</html>