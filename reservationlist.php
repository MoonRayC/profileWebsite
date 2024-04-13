<!-- reservationlist.php -->

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

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = urldecode($_GET['message']);
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert' style='position: fixed; top: 20px; right: 20px; z-index: 9999;'>
            $successMessage
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
}

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
                        <a class="nav-link" href="carReservation.php">Car Reservation List</a>
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
            <div class="">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h2 class="card-title">Car Service Bookings</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Number</th>
                                        <th>Vehicle Make</th>
                                        <th>Vehicle Model</th>
                                        <th>Service Type</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Appointment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $sql = "SELECT id, vehicle_type, vehicle_number, vehicle_make, vehicle_model, service_type, first_name, last_name, phone, email, appointment_date FROM car_service_bookings";
                                        $stmt = $conn->query($sql);

                                        if ($stmt->rowCount() > 0) {
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                echo "<tr>";
                                                echo "<td>{$row["id"]}</td>";
                                                echo "<td>{$row["vehicle_type"]}</td>";
                                                echo "<td>{$row["vehicle_number"]}</td>";
                                                echo "<td>{$row["vehicle_make"]}</td>";
                                                echo "<td>{$row["vehicle_model"]}</td>"; 
                                                echo "<td>{$row["service_type"]}</td>";
                                                echo "<td>{$row["first_name"]}</td>";
                                                echo "<td>{$row["last_name"]}</td>";
                                                echo "<td>{$row["phone"]}</td>";
                                                echo "<td>{$row["email"]}</td>";
                                                echo "<td>{$row["appointment_date"]}</td>";
                                                echo "<td>
                                                        <div class='btn-group' role='group'>
                                                            <a href='update.php?id={$row["id"]}' class='btn btn-primary'>
                                                                <img src='images/edit-5.svg' alt='Update' class='mr-2' style= 'width: 25px; height: 25px'>
                                                            </a>
                                                            <span style='width: 5px'></span>
                                                            <a href='delete_process.php?id={$row["id"]}' class='btn btn-danger' onclick='return confirmDelete();'>
                                                                <img src='images/delete1.svg' alt='Delete' class='mr-2' style= 'width: 25px; height: 25px'>
                                                            </a>
                                                        </div>
                                                    </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='12'>No results found</td></tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    $conn = null;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this reservation?");
    }
</script>


</body>

</html>