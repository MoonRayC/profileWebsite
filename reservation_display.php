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
                        <h2>Reservation Details</h2>
                        <p>Your submitted reservation details</p>
                    </div>
                    <div class="card-body">
                        <p>Date of Reservation: <?php echo $_POST['dateRes']; ?></p>
                        <p>Time for Reservation: <?php echo $_POST['timeRes']; ?></p>
                        <p>Number of Guests: <?php echo $_POST['numGuest']; ?></p>
                        <p>Dining Options: <?php echo implode(", ", $_POST['diningOption']); ?></p>
                        <p>Seating Preference: <?php echo $_POST['seatingPreference']; ?></p>
                        <p>Special Arrangements: <?php echo empty($_POST['specialArrangements']) ? 'none' : $_POST['specialArrangements']; ?></p>
                        <p>Additional Questions/Inquiries: <?php echo empty($_POST['additionalQuestions']) ? 'none' : $_POST['additionalQuestions']; ?></p>
                    </div>
                    <div class="card-body text-center">
                        <form action="carReservation.php">
                            <button type="submit" class="btn btn-success">Book Again</button>
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
