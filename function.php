<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION["username"]);
}
?>
