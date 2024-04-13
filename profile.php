<?php
require_once("dbconnection.php");
require_once("function.php");

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style4.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <h2>USER PROFILE</h2>
                    </div>
                    <div class="card-body">
                        <form action="update_profile.php" method="post">
                            <div class="profilePic text-center">
                                <div class="image text-center">
                                    <img src="images\mypic.jpg" alt="Profile Picture" class="profile-img rounded-circle"
                                        style="width: 200px; height: 200px;">
                                </div>
                                <label for="profilepic"> Change Profile</label>
                            </div>
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" name="firstname" class="form-control"
                                    value="<?php echo $userData['firstname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" name="lastname" class="form-control"
                                    value="<?php echo $userData['lastname']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" class="form-control"
                                    value="<?php echo $userData['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo $userData['email']; ?>" required>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="password">New Password:</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm New Password:</label>
                                <input type="password" name="confirmpassword" class="form-control"
                                    placeholder="Confirm new password">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Update Profile</button>
                            <button type="button" class="btn btn-danger btn-block" onclick="window.location.href='index.php'">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>