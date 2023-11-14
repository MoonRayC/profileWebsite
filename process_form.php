<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'projectdb';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$formSubmittedSuccessfully = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleType = $_POST['vehicle-type'];
    $vehicleNumber = $_POST['vehicle-number'];
    $vehicleMake = $_POST['vehicle-make'];
    $vehicleModel = $_POST['vehicle-model'];
    $serviceType = isset($_POST['service-type']) && is_array($_POST['service-type']) ? implode(", ", $_POST['service-type']) : '';
    $specialInstruction = $_POST['special-instruction'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $appointmentDate = $_POST['appointment-date'];

    $sql = "INSERT INTO car_service_bookings (vehicle_type, vehicle_number, vehicle_make, vehicle_model, service_type, special_instruction, first_name, last_name, phone, email, appointment_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $vehicleType, $vehicleNumber, $vehicleMake, $vehicleModel, $serviceType, $specialInstruction, $firstName, $lastName, $phone, $email, $appointmentDate);

    if ($stmt->execute()) {
        $formSubmittedSuccessfully = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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
                    <h2>Thank You For Using Our Service</h2>
                    <hr>
                </div>
                <div class="card-body">
                    <?php if ($formSubmittedSuccessfully): ?>
                        <div class="alert alert-success" role="alert">
                            Form submitted successfully!
                        </div>
                    <?php endif; ?>

                    <form action="process_form.php" method="POST">
                        <button type="submit" class="btn btn-success btn-block">Book Again</button>
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