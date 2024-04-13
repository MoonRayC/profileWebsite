<?php

function logout() {
    unset($_SESSION["username"]);
    header("Location: login.php");
    exit;
}
?>
