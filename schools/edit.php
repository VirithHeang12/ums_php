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

$statement = $pdo->prepare("SELECT prof_num, CONCAT(prof_fname, ' ', prof_lname) AS full_name FROM professors");
$statement->execute();
$professors = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Semester</title>
    <link rel="stylesheet" href="./../bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center fw-bold text-uppercase">Edit School</h1>
        <form action="update.php" method="POST" class="form col-12 col-md-7 mx-auto my-5" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="school_code" id="school_code" class="form-control mb-3" value="<?= $school['school_code'] ?>">
                <div class="col-4 vstack align-items-center ">
                    <label class="form-label fw-medium">School Logo</label>
                    <?php if ($attachment && $attachment['media_type'] === 'image') : ?>
                        <img src="./../images/<?php echo htmlspecialchars($attachment['media_url']); ?>" id="logo" alt="Logo" style="width: 110px; height: 110px; border-radius: 50%; margin-right: 5px; outline-offset: 2px;" class="object-fit-cover border p-1 border-dark-subtle">
                    <?php else : ?>
                        <div id="default-logo" style="width: 110px; height: 110px; border-radius: 50%; outline-offset: 2px;" class="border p-1 border-dark-subtle bg-body-tertiary d-flex align-items-center justify-content-center">
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
                        <img src="" id="logo" alt="Logo" style="width: 110px; height: 110px; border-radius: 50%; margin-right: 5px; outline-offset: 2px;" class="object-fit-cover border p-1 border-dark-subtle d-none">
                    <?php endif; ?>
                    <input type="file" name="file" id="file" class="form-control mb-3 d-none">

                    <button class="btn btn-sm btn-dark px-3 mt-2" id="btn-change" type="button">Choose</button>
                </div>

                <div class="col-8">
                    <label for="school_name" class="form-label fw-medium">School Name</label>
                    <input type="text" name="school_name" id="school_name" class="form-control mb-3" placeholder="Enter school name here" value="<?= $school['school_name']; ?>">

                    <label for="prof_num" class="form-label fw-medium">Professor Code (dean of school)</label>
                    <select name="prof_num" id="prof_num" class="form-select" value="<?= $school['prof_num']; ?>">
                        <?php foreach ($professors as $row): ?>
                            <option value="<?= $row['prof_num'] ?>" <?= $row['prof_num'] == $professor['prof_num'] ? 'selected' : '' ?>><?= $row['full_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="hstack justify-content-between my-5">
                <a href="index.php" class="btn btn-outline-dark px-4 fw-semibold">Back</a>
                <button type="submit" class="btn btn-dark px-4 fw-semibold">Save</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('btn-change').addEventListener('click', () => {
            document.getElementById('file').click();
        });
        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('logo').src = e.target.result;
                    if (document.getElementById('default-logo') && document.getElementById('logo').classList.contains('d-none')) {
                        document.getElementById('logo').classList.remove('d-none');
                        document.getElementById('default-logo').classList.add('d-none');
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>