<?php
session_start();

require_once("dbconnection.php");
 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($password !== $confirmpassword) {
        echo "Passwords do not match. Please try again.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username, email = :email, password = :password WHERE id = :user_id";
    $stmt = $conn->prepare($update_sql);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->bindParam(":email", $email);

    try {
        $stmt->execute();
        $_SESSION['formSubmittedSuccessfully'] = true;
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
