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
    <link rel="stylesheet" href="styles/style3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Car Reservation</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">
                    <h2>Car Service Booking Form</h2>
                    <hr>
                </div>
                <div class="card-body">
                    <form action="process_form.php" method="POST">
                        <h2>Vehicle Information</h2>
                        <div class="form-group">
                            <label for="vehicle-type">Vehicle Type:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="vehicle-type" value="Sedan"> Sedan
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="vehicle-type" value="Sports Car"> Sports Car
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="vehicle-type" value="Coupe"> Coupe
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" name="vehicle-type" value="Wagon"> Wagon
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="radio" name="vehicle-type" value="Other"> Other
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vehicle-number">Vehicle Number:</label>
                            <input type="text" class="form-control" name="vehicle-number">
                        </div>
                        <div class="form-group">
                            <label for="vehicle-make">Make:</label>
                            <input type="text" class="form-control" name="vehicle-make">
                        </div>
                        <div class="form-group">
                            <label for="vehicle-model">Model:</label>
                            <input type="text" class="form-control" name="vehicle-model">
                        </div>
                        <label for="service-type">Service Type:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="checkbox" name="service-type[]" value="Check the engine oil"> Check the engine oil
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="service-type[]" value="Oil filter replacement"> Oil filter replacement
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="checkbox" name="service-type[]" value="Change the engine oil"> Change the engine oil
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Special Instructions:</label><br>
                            <textarea class="form-control" name="special-instruction" rows="4"></textarea>
                        </div>
                        <h2>Customer Information</h2>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="first-name" required>
                                    <p>First Name</p>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last-name" required>
                                    <p>Last Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" class="form-control" name="phone" placeholder="(000) 000-0000">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email">
                            <p>example@example.com</p>
                        </div>
                        <div class="form-group">
                            <label for="appointment-date">Appointment Date:</label>
                            <input type="date" class="form-control" name="appointment-date" style="text-transform: uppercase;">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
