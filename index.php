<?php

session_start();

$isLoggedIn = false;

if (isset($_SESSION['user'])) {
    $isLoggedIn = true;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Welcome Page</title>
    <link rel="stylesheet" href="public/styles.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>នាគខៀវ</h1>
            <nav>
                <ul>
                    <?php if (!$isLoggedIn) : ?>
                        <li><a href="./">ទំព័រ</a></li>
                        <li><a href="authentication/login.php">ចូល</a></li>
                        <li><a href="authentication/register.php">ចុះឈ្មោះ</a></li>
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
                        <li><a href="authentication/logout.php">ចេញ</a></li>
                    <?php endif; ?>              
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="main-content">
        <section class="welcome">
            <div class="container">
                <h2>Welcome to Our University</h2>
                <p>We are thrilled to have you join our academic community. At our university, we strive to provide an enriching experience with world-class education and vibrant campus life.</p>
                <a href="#" class="cta-button">Learn More</a>
            </div>
        </section>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 University Name. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
