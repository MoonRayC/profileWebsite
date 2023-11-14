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
    <link rel="stylesheet" href="styles/style.css">
    <title>MY PERSONAL WEBSITE</title>
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

<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4 text-center">ABOUT RAYMOND D. CHAVEZ JR.</h1>
            <p class="lead text-center">Passionate, friendly, and kind.</p>
            <hr class="my-4">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>My Favorite Movies</h2>
            <ol>
                <li>Movies
                    <ul>
                        <li>Toy Stories (<a href="https://www.imdb.com/title/tt0114709/">IMDB</a>)</li>
                        <li>Avenger: Endgame (<a href="https://www.imdb.com/title/tt4154796/">IMDB</a>)</li>
                        <li>Chronicles of Narnia (<a href="https://www.imdb.com/title/tt0363771/">IMDB</a>)</li>
                    </ul>
                </li>
                <li>SitComs
                    <ul>
                        <li>FRIENDS (<a href="https://www.imdb.com/title/tt0108778/">IMDB</a>)</li>
                        <li>The Office (<a href="https://www.imdb.com/title/tt0386676/">IMDB</a>)</li>
                        <li>Brooklyn 99 (<a href="https://www.imdb.com/title/tt2467372/">IMDB</a>)</li>
                    </ul>
                </li>
                <li>Series
                    <ul>
                        <li>Arcane (<a href="https://www.imdb.com/title/tt11126994/">IMDB</a>)</li>
                        <li>One Piece (<a href="https://www.imdb.com/title/tt11737520/">IMDB</a>)</li>
                        <li>Suit (<a href="https://www.imdb.com/title/tt1632701/">IMDB</a>)</li>
                    </ul>
                </li>
            </ol>
        </div>
        
        <div class="col-md-6">
            <h2>My Classes this 1<sup>st</sup> Semester SY 2023 - 2024</h2>
            <ul>
                <li>CS 413B - Introduction to Artificial Intelligence</li>
                <li>CS 412B - Web Design and Development</li>
                <li>CS 411b - Data Mining and Warehousing</li>
                <li>CS 400 - Thesis Writing 1</li>
                <li>Lit 111A - Literatures of the Philippines</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>Fun Facts About My Neighbors</h2>
            <ul>
                <li>Sue Smith: <i>Effervescent</i> is a word that describes her.</li>
                <li>Bill Thompson: Loves playing <i>Yu-Gi-Oh</i>.</li>
            </ul>
        </div>
        
        <div class="col-md-6">
            <h2>My Moods</h2>
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-center">
                <img src="images/Happy.jpg" alt="Happy Dog" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                <p>Happy</p>
            </div>
            <div class="text-center">
                <img src="images/Sad.jpg" alt="Sad Dog" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                <p>Sad</p>
            </div>
        </div>
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
