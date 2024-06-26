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
                                        <input type="checkbox" name="vehicle-type[]" value="Sedan"> Sedan
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="vehicle-type[]" value="Sports Car"> Sports Car
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="vehicle-type[]" value="Coupe"> Coupe
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="vehicle-type[]" value="Wagon"> Wagon
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="vehicle-type[]" value="Other"> Other
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
                            <div class="form-group">
                                <label for="service-type">Service Type:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="service-type" class="form-control">
                                            <option value="Check the engine oil">Check the engine oil</option>
                                            <option value="Oil filter replacement">Oil filter replacement</option>
                                            <option value="Change the engine oil">Change the engine oil</option>
                                        </select>
                                    </div>
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
                                <input type="date" class="form-control" name="appointment-date"
                                    style="text-transform: uppercase;">
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