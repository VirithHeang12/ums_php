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
    <div class="container py-5 vstack align-items-center">
        <h1 class="text-center fw-bold text-uppercase mb-4">Show School</h1>
        <div class="col-9 border bg-body-tertiary rounded-3 mt-3">
            <div class="row p-4">
                <div class="col-4 vstack align-items-center ">
                    <?php if ($attachment && $attachment['media_type'] === 'image') : ?>
                        <a href="./../images/<?php echo htmlspecialchars($attachment['media_url']); ?>" target="_blank">
                            <img src="./../images/<?php echo htmlspecialchars($attachment['media_url']); ?>" id="logo" alt="Logo" style="width: 110px; height: 110px; border-radius: 50%; margin-right: 5px; outline-offset: 2px;" class="object-fit-cover border p-1 shadow-sm border-dark-subtle">
                        </a>
                    <?php else : ?>
                        <div id="default-logo" style="width: 110px; height: 110px; border-radius: 50%; outline-offset: 2px;" class="border p-1 border-dark-subtle shadow-sm bg-body-tertiary d-flex align-items-center justify-content-center">
                            <svg fill="#454545" width="65px" height="65px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" stroke="#454545">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>ionicons-v5-q</title>
                                    <path d="M256,368a16,16,0,0,1-7.94-2.11L108,285.84a8,8,0,0,0-12,6.94V368a16,16,0,0,0,8.23,14l144,80a16,16,0,0,0,15.54,0l144-80A16,16,0,0,0,416,368V292.78a8,8,0,0,0-12-6.94L263.94,365.89A16,16,0,0,1,256,368Z"></path>
                                    <path d="M495.92,190.5s0-.08,0-.11a16,16,0,0,0-8-12.28l-224-128a16,16,0,0,0-15.88,0l-224,128a16,16,0,0,0,0,27.78l224,128a16,16,0,0,0,15.88,0L461,221.28a2,2,0,0,1,3,1.74V367.55c0,8.61,6.62,16,15.23,16.43A16,16,0,0,0,496,368V192A14.76,14.76,0,0,0,495.92,190.5Z"></path>
                                </g>
                            </svg>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="col-8 pt-3">
                    <h1 class="fw-bold"><?= $school['school_name']; ?></h1>
                    <p>Dean: <span class="fw-semibold"><?= $professor['full_name']; ?></span></p>
                </div>
            </div>
        </div>

        <div class="col-9 hstack justify-content-between my-4 m-auto">
            <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Cancel</a>
            <a href="destroy.php?id=<?= $school['school_code']; ?>" class="btn btn-danger px-4 fw-semibold">Delete</a>
        </div>
    </div>
</body>

</html>