<?php

session_start();

$isLoggedIn = false;

if (isset($_SESSION['user'])) {
    $isLoggedIn = true;
} else {
    header('Location: ../authentication/login.php');
    die();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/ums_php/public/styles.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>នាគខៀវ</h1>
            <nav>
                <ul>
                    <?php if (!$isLoggedIn) : ?>
                        <li><a href="./">ទំព័រ</a></li>
                        <li><a href="login">ចូល</a></li>
                        <li><a href="register">ចុះឈ្មោះ</a></li>
                    <?php else : ?>
                        <?php if ($_SESSION['user']['role'] == 1) : ?>
                            <li><a href="professors">គ្រូ</a></li>
                            <li><a href="students">និស្សិត</a></li>
                            <li><a href="rooms">បន្ទប់</a></li>
                            <li><a href="courses">វគ្គសិក្សា</a></li>
                            <li><a href="schools">សាលា</a></li>
                            <li><a href="classes">ថ្នាក់រៀន</a></li>
                            <li><a href="semesters">ឆមាស</a></li>
                            <li><a href="departments">ដេប៉ាតឺម៉ង់</a></li>
                        <?php elseif ($_SESSION['user']['role'] == 2) : ?>
                            <li><a href="students">និស្សិត</a></li>
                            <li><a href="courses">វគ្គសិក្សា</a></li>
                            <li><a href="classes">ថ្នាក់រៀន</a></li>
                            <li><a href="semesters">ឆមាស</a></li>
                        <?php endif; ?>
                        <?php if ($_SESSION['user']['role'] == 3) : ?>
                            <li><a href="courses">វគ្គសិក្សា</a></li>
                            <li><a href="classes">ថ្នាក់រៀន</a></li>
                        <?php endif; ?>
                        <li><a href="authentication/logout">ចេញ</a></li>
                    <?php endif; ?>              
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="main-content">
        <section class="welcome">
            <div class="container">
                <h2>You are not allowed to view this page!</h2>
                <a href="../index.php" class="btn btn-success">Go back to the home page</a>
            </div>
        </section>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 University Name. All rights reserved.</p>
        </div>
    </footer>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
