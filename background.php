<?php
require_once("logout.php");

if (isset($_POST["logout"])) {
    logout();
}

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>MY PERSONAL WEBSITE</title>
    <link rel="stylesheet" href="styles/style2.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark py-4">
    <div class="container">
        <a class="navbar-brand" href="images/profilePic.png">
            <img src="images/profilePic.png" alt="Logo" style="width: 50px; height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            </ul>
        </div>
        <form method="post" class="ml-auto">
            <button type="submit" name="logout" class="btn btn-light">Log Out</button>
        </form>
    </div>
</nav>

    <div class="container mt-5">
        <div class="content text-center">
            <div class="image">
                <img src="images\mypic.jpg" alt="Profile Picture" class="profile-img rounded-circle" style="width: 200px; height: 200px;">
            </div>
            <div class="nameholder">
                <h1>RAYMOND D. CHAVEZ JR.</h1>
            </div>
            <div class="bio my-4">
            <p class="mb-3">
            Hello, I'm Raymond D. Chavez Jr., a 21-year-old from Matanao, Davao del Sur. My educational journey 
            has largely been rooted in my hometown. I attended Matanao Central Elementary School for my primary 
            education and later continued my studies at Matanao National High School for my secondary education.
        </p>
        <p class="mb-3">
            Currently, I am in my 4th year of college at the University of Southern Mindanao (USM), pursuing a 
            Bachelor of Science in Computer Science. My passion for technology and computing has driven me to 
            explore this field further and acquire the skills necessary for a rewarding career in the world of 
            computer science.
        </p>
        <p>
            Beyond academics, I enjoy playing online games, watching movies, puzzle games, and I'm always eager to learn and 
            grow both personally and professionally. As I continue my academic journey and prepare for the future, 
            I look forward to the exciting opportunities and challenges that lie ahead. Feel free to reach out and 
            connect with me; I'm always open to meeting new people and expanding my network!
        </p>
            </div>
        </div>
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
