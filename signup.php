<?php
require_once("dbconnection.php");

$firstname_error = $lastname_error = $username_error = $email_error = $password_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if (empty($firstname)) {
        $firstname_error = "First Name is required.";
    }

    if (empty($lastname)) {
        $lastname_error = "Last Name is required.";
    }

    if (empty($username)) {
        $username_error = "Username is required.";
    }
    if (empty($email)) {
        $email_error = "Email is required.";
    }
    if (empty($password)) {
        $password_error = "Password is required.";
    } elseif ($password !== $confirmpassword) {
        $password_error = "Passwords do not match.";
    }

    if (empty($firstname_error) && empty($lastname_error) && empty($username_error) && empty($email_error) && empty($password_error)) {
        $check_username_sql = "SELECT COUNT(*) AS count FROM users WHERE username = :username";
        $check_email_sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        
        try {
            $stmt_username = $conn->prepare($check_username_sql);
            $stmt_username->bindParam(":username", $username);
            $stmt_username->execute();
            $stmt_email = $conn->prepare($check_email_sql);
            $stmt_email->bindParam(":email", $email);
            $stmt_email->execute();
            $row_username = $stmt_username->fetch(PDO::FETCH_ASSOC);
            $row_email = $stmt_email->fetch(PDO::FETCH_ASSOC);
            
            if ($row_username["count"] > 0) {
                $username_error = "Username is already taken. Please choose a different username.";
            } elseif ($row_email["count"] > 0) {
                $email_error = "Email address is already in use. Please use a different email.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $hashed_password);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                header("Location: login.php");
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style4.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Signup</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <h2>REGISTER ACCOUNT</h2>
                    </div>
                    <div class="card-body">
                        <form action="signup.php" method="post">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm Password" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Sign-up</button>
                            <button type="button" class="btn btn-danger btn-block" onclick="window.location.href='login.php'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

