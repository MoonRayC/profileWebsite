<?php
require_once("function.php");
require_once("logout.php");
require_once("dbconnection.php");

if (isset($_POST["logout"])) {
    logout();
}

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Welcome to My Profile</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-4">
        <div class="container">
            <a class="navbar-brand" href="profile.php">
                <img src="images/profilePic.png" alt="Logo" style="width: 50px; height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="background.php">Background</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">Dinner Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carReservation.php">Car Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservationlist.php">Car Reservation List</a>
                    </li>
                </ul>
            </div>
            <form method="post" class="ml-auto">
                <button type="submit" name="logout" class="btn btn-secondary">Log Out</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="content text-center">
            <div class="nameholder">
                <h1>Welcome to My Personal Space</h1>
                <h2>Hey, <?php echo $userData["firstname"] . " " . $userData["lastname"]; ?>!</h2>
                <p>
                    I'm Raymond D. Chavez Jr., and I'm thrilled to have you here on my website. This is where I share my
                    journey, experiences, and a little bit of my world with you.
                </p>
                <p>
                    Explore the different sections to learn more about my background, get to know me better, and visits
                    my project.
                </p>
                <p>
                    Thank you for visiting, and I hope you enjoy your time here!
                </p>
                <h3>♥ ♥ ♥</h3>
            </div>
        </div>
    </div>

    <div class="success-alert top-right-alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <?php 
    if (isset($_SESSION['formSubmittedSuccessfully']) && $_SESSION['formSubmittedSuccessfully']): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            Profile updated successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php 
      unset($_SESSION['formSubmittedSuccessfully']);
      ?>
        <?php endif; ?>
    </div>

    <footer class="footer text-center py-4">
        <p>Connect with me on social media:</p>
        <a href="https://twitter.com/Moon_RayC" class="btn btn-light">Twitter</a>
        <a href="https://www.Facebook.com/moonray" class="btn btn-light">Facebook</a>
        <a href="https://github.com/MoonRayC" class="btn btn-light">GitHub</a>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>