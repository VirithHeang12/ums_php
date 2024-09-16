<?php
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/School.php';

$schools = new School($pdo);
$schools = $schools->read();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semesters</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center fw-bold text-uppercase">Semesters</h1>
        <a href="create.php" class="btn btn-dark px-4 fw-semibold float-end mb-3">Create School</a>
        <table class="table table-bordered table-hover">
            <thead align="center" class="table-light align-middle">
                <tr>
                    <th style="padding-top: 12px; padding-bottom: 12px;">SCHOOL CODE</th>
                    <th>SCHOOL NAME</th>
                    <th>DEAN OF SCHOOL</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($schools as $row): ?>
                    <tr align="center" class="align-middle">
                        <td><?php echo $row['SCHOOL_CODE'] ?></td>
                        <td align="left">
                            <!-- logo -->
                            <?php
                            $school_code = $row['SCHOOL_CODE'];
                            $entity_type = 'school';
                            $attachmentQuery = $pdo->prepare("SELECT * FROM medias WHERE entity_id = :entity_id AND entity_type = :entity_type");
                            $attachmentQuery->bindParam(':entity_id', $school_code);
                            $attachmentQuery->bindParam(':entity_type', $entity_type);
                            $attachmentQuery->execute();
                            $attachments = $attachmentQuery->fetchAll();

                            if (!empty($attachments)):
                                foreach ($attachments as $attachment):
                                    echo '<img src="./../images/' . htmlspecialchars($attachment['MEDIA_URL']) . '" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 5px;" class="object-fit-cover"/>';
                                endforeach;
                            else:
                                echo '';
                            endif;
                            ?>

                            <!-- school name -->
                            <?php echo $row['SCHOOL_NAME']; ?>
                        </td>
                        <td>
                            
                            <?php
                                $statement = $pdo->prepare("SELECT prof_fname || ' ' || prof_lname AS full_name FROM professors WHERE prof_num = :prof_num");
                                $statement->bindParam(':prof_num', $row['PROF_NUM']);
                                $statement->execute();
                                $professor = $statement->fetch();

                                echo $professor['FULL_NAME'];
                            ?>
                        </td>
                        <td style="max-width: 150px;">
                            <div class="d-flex justify-content-around">
                                <a href="show.php?id=<?php echo $row['SCHOOL_CODE']; ?>" class="btn btn-success py-1 px-3" style="font-size: 15px;">Show</a>
                                <a href="edit.php?id=<?php echo $row['SCHOOL_CODE']; ?>" class="btn btn-primary py-1 px-3" style="font-size: 15px;">Edit</a>
                                <a href="delete.php?id=<?php echo $row['SCHOOL_CODE']; ?>" class="btn btn-danger py-1 px-3" style="font-size: 15px;">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
    </div>
</body>

</html>