<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION["username"]);
}

function logout() {
    unset($_SESSION["username"]);
    header("Location: login.php");
    exit;
}
?>
