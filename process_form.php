<?php
require_once("dbConnection.php");

$formSubmittedSuccessfully = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleType = isset($_POST['vehicle-type']) && is_array($_POST['vehicle-type']) ? implode(", ", $_POST['vehicle-type']) : '';
    $vehicleNumber = $_POST['vehicle-number'];
    $vehicleMake = $_POST['vehicle-make'];
    $vehicleModel = $_POST['vehicle-model'];
    $serviceType = $_POST['service-type'];
    $specialInstruction = $_POST['special-instruction'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $appointmentDate = $_POST['appointment-date'];

    $sql = "INSERT INTO car_service_bookings (vehicle_type, vehicle_number, vehicle_make, vehicle_model, service_type, special_instruction, first_name, last_name, phone, email, appointment_date)
            VALUES (:vehicleType, :vehicleNumber, :vehicleMake, :vehicleModel, :serviceType, :specialInstruction, :firstName, :lastName, :phone, :email, :appointmentDate)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':vehicleNumber', $vehicleNumber);
    $stmt->bindParam(':vehicleMake', $vehicleMake);
    $stmt->bindParam(':vehicleModel', $vehicleModel);
    $stmt->bindParam(':serviceType', $serviceType);
    $stmt->bindParam(':specialInstruction', $specialInstruction);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':appointmentDate', $appointmentDate);

    try {
        $stmt->execute();
        $formSubmittedSuccessfully = true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center bg-dark text-white">
                        <h2>Thank You For Using Our Service</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <?php
include 'dbConnection.php';

try {
    $sql = "SELECT id, vehicle_type, vehicle_number, vehicle_make, vehicle_model, service_type, special_instruction, first_name, last_name, phone, email, appointment_date FROM car_service_bookings";

    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row["id"]. " " .
                $row["vehicle_type"]. " " .
                $row["vehicle_number"]. " " .
                $row["vehicle_make"]. " " .
                $row["vehicle_model"]. " " .
                $row["service_type"]. " " .
                $row["first_name"]. " " .
                $row["last_name"]. " " .
                $row["phone"]. " " .
                $row["email"]. " " .
                $row["appointment_date"]. "<br>";
        }
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

                        <form action="carReservation.php" method="POST">
                        <button type="button" class="btn btn-success"
                                onclick="window.location.href='reservationlist.php'">Reservation List</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="success-alert top-right-alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <?php if ($formSubmittedSuccessfully): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Your Reservation Have Been Book!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php 
                            unset($_SESSION['formSubmittedSuccessfully']);
                            ?>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>