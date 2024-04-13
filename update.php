<!-- update.php -->

<?php
require_once("dbConnection.php");

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    try {
        $sql = "SELECT * FROM car_service_bookings WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $reservationId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Extract data from the row
            $vehicleType = explode(", ", $row['vehicle_type']);
            $vehicleNumber = $row['vehicle_number'];
            $vehicleMake = $row['vehicle_make'];
            $vehicleModel = $row['vehicle_model'];
            $serviceType = $row['service_type'];
            $specialInstruction = $row['special_instruction'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $phone = $row['phone'];
            $email = $row['email'];
            $appointmentDate = $row['appointment_date'];
            $success = true;
        } else {
            $errorMessage = "No reservation found with the given ID.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
} else {
    $errorMessage = "ID not provided in the URL.";
}

// Display success or error message
if (isset($success) && $success === true) {
    $successMessage = "Reservation details retrieved successfully!";
} else {
    // You can use $errorMessage to display an error message in your HTML
    echo $errorMessage;
    exit; // exit the script if there's an error
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Update Reservation</title>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h2 class="card-title">Update Reservation</h2>
                    </div>
                    <div class="card-body">
                        <form action="process_update.php" method="POST">
                            <input type="hidden" name="reservation-id" value="<?php echo $reservationId; ?>" required>

                            <div class="form-group">
                                <label for="vehicle-type">Vehicle Type:</label>
                                <div class="row">
                                    <?php
                                    $vehicleTypes = array("Sedan", "Sports Car", "Coupe", "Wagon", "Other");
                                    foreach ($vehicleTypes as $type) {
                                        $checked = in_array($type, $vehicleType) ? 'checked' : '';
                                        echo "<div class='col-md-6'>
                                                <input type='checkbox' name='vehicle-type[]' value='$type' $checked> $type
                                              </div>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="vehicle-number">Vehicle Number:</label>
                                <input type="text" class="form-control" name="vehicle-number"
                                    value="<?php echo $vehicleNumber; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="vehicle-make">Make:</label>
                                <input type="text" class="form-control" name="vehicle-make"
                                    value="<?php echo $vehicleMake; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="vehicle-model">Model:</label>
                                <input type="text" class="form-control" name="vehicle-model"
                                    value="<?php echo $vehicleModel; ?>" required>
                            </div>

                            <div class=" form-group">
                                <label for="service-type">Service Type:</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="service-type" class="form-control">
                                            <option>~~SELECT~~</option>
                                            <option value="Check the engine oil"
                                                <?php echo ($serviceType == "Check the engine oil") ? 'selected' : ''; ?>>
                                                Check the engine oil</option>
                                            <option value="Oil filter replacement"
                                                <?php echo ($serviceType == "Oil filter replacement") ? 'selected' : ''; ?>>
                                                Oil filter replacement</option>
                                            <option value="Change the engine oil"
                                                <?php echo ($serviceType == "Change the engine oil") ? 'selected' : ''; ?>>
                                                Change the engine oil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <h2>Customer Information</h2>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="first-name"
                                            value="<?php echo $firstName; ?>" required>
                                        <p>First Name</p>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="last-name"
                                            value="<?php echo $lastName; ?>" required>
                                        <p>Last Name</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control" name="phone" placeholder="(000) 000-0000"
                                    value="<?php echo $phone; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                <p>example@example.com</p>
                            </div>
                            <div class="form-group">
                                <label for="appointment-date">Appointment Date:</label>
                                <input type="date" class="form-control" name="appointment-date"
                                    value="<?php echo $appointmentDate; ?>" style="text-transform: uppercase;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Reservation</button>
                            <button type="button" class="btn btn-danger"
                                onclick="window.location.href='reservationlist.php'">Cancel</button>
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