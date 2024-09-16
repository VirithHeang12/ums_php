<?php 
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/School.php';


$school_code = $_GET['id'];
$entity_type = 'school';

$school = new School($pdo);
$result = $school->getSchool($school_code, $entity_type);

// Access the returned data
$school = $result['school'] ?? [];
$professor = $result['professor'] ?? [];
$attachment = $result['attachment'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show School</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <!-- school -->
        <div class="row">
            <div class="col-6 m-auto">
                <h1 class="text-center fw-bold text-uppercase mb-4">Show School</h1>
                <table class="table">
                    <tr>
                        <th class="col-5">SCHOOL CODE</th>
                        <td><?php echo $school['SCHOOL_CODE']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">SCHOOL NAME</th>
                        <td><?php echo $school['SCHOOL_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th class="col-5">DEAN</th>
                        <td><?php echo $professor['FULL_NAME']; ?></td>
                    </tr>
                    <?php if ($attachment) : ?>
                        <tr>
                            <th class="col-5">LOGO</th>
                            <td>
                                <?php if ($attachment['MEDIA_TYPE'] === 'image') : ?>
                                    <img src="./../images/<?php echo htmlspecialchars($attachment['MEDIA_URL']); ?>" alt="Logo" style="width: 100px; height: 100px; border-radius: 50%; margin-right: 5px;" class="object-fit-cover">
                                <?php else : ?>
                                    No Logo
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endif; ?>
                </table>
                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold mt-4">Back</a>
            </div>
        </div>
    </div>
</body>

</html>