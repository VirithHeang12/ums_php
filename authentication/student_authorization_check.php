<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../authentication/login.php');
    die();
} else {
    if ($_SESSION['user']['role'] != 1) {
        header('Location: ../authentication/authorization_error.php');
        die();
    }
}