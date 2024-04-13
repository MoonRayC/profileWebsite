<?php
require_once("function.php");
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
    <title>Welcome to My Profile</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark py-4">
    <div class="container">
        <a class="navbar-brand" href="profile.php">
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
                <li class="nav-item">
                    <a class="nav-link" href="carReservation.php">Car Reservation List</a>
                </li>
            </ul>
        </div>
        <form method="post" class="ml-auto">
            <button type="submit" name="logout" class="btn btn-secondary">Log Out</button>
        </form>
    </div>
</nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <h2>Reservation Details</h2>
                        <p>Please provide details as directed</p>
                    </div>
                    <div class="card-body">
                        <form action="reservation_display.php" method="post">
                            <div class="form-group">
                                <label for="dateRes">Date of Reservation</label>
                                <input type="date" name="dateRes" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="timeRes">Time for Reservation</label>
                                <input type="time" name="timeRes" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="numGuest">Number of Guests</label>
                                <input type="number" name="numGuest" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Dining Options:</label>
                                <div class="form-check">
                                    <input type="checkbox" name="diningOption[]" class="form-check-input" value="Fine Dining" checked>
                                    <label class="form-check-label">Fine Dining</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="diningOption[]" class="form-check-input" value="Casual Dining">
                                    <label class="form-check-label">Casual Dining</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="diningOption[]" class="form-check-input" value="Ghost Restaurant">
                                    <label class="form-check-label">Ghost Restaurant</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="diningOption[]" class="form-check-input" value="Fast Casual">
                                    <label class="form-check-label">Fast Casual</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Seating Preference:</label>
                                <div class="form-check">
                                    <input type="radio" name="seatingPreference" class="form-check-input" value="Family Style Seating" checked>
                                    <label class="form-check-label">Family Style Seating</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="seatingPreference" class="form-check-input" value="Cabaret Style Seating">
                                    <label class="form-check-label">Cabaret Style Seating</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="seatingPreference" class="form-check-input" value="Hollow Square Style Seating">
                                    <label class="form-check-label">Hollow Square Style Seating</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="seatingPreference" class="form-check-input" value="Banquet Style Seating">
                                    <label class="form-check-label">Banquet Style Seating</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="specialArrangements">Special Arrangements</label>
                                <input type="text" name="specialArrangements" class="form-control" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label for="additionalQuestions">Additional Questions/Inquiries</label>
                                <input type="text" name="additionalQuestions" class="form-control" maxlength="255">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
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
