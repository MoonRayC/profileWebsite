<!-- process_update.php-->

<?php
require_once("dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $reservationId = $_POST['reservation-id'];
    $vehicleType = isset($_POST['vehicle-type']) && is_array($_POST['vehicle-type']) ? implode(", ", $_POST['vehicle-type']) : '';
    $vehicleNumber = $_POST['vehicle-number'];
    $vehicleMake = $_POST ['vehicle-make'];
    $vehicleModel = $_POST ['vehicle-model'];
    $serviceType = $_POST ['service-type'];
    $vehicleMake = $_POST ['vehicle-make'];
    $firstName = $_POST ['first-name'];
    $lastName = $_POST ['last-name'];
    $phone = $_POST ['phone'];
    $email = $_POST ['email'];
    $appointmentDate = $_POST ['appointment-date'];

    // Update query
    $sql = "UPDATE car_service_bookings SET 
            vehicle_type = :vehicleType, 
            vehicle_number = :vehicleNumber, 
            vehicle_make = :vehicleMake, 
            vehicle_model = :vehicleModel, 
            service_type = :serviceType, 
            first_name = :firstName, 
            last_name = :lastName, 
            phone = :phone, 
            email = :email, 
            appointment_date = :appointmentDate
            WHERE id = :reservationId";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':vehicleType', $vehicleType);
    $stmt->bindParam(':vehicleNumber', $vehicleNumber);
    $stmt->bindParam(':vehicleMake', $vehicleMake); 
    $stmt->bindParam(':vehicleModel', $vehicleModel);
    $stmt->bindParam(':serviceType', $serviceType);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':appointmentDate', $appointmentDate);
    $stmt->bindParam(':reservationId', $reservationId);

    try {
        $stmt->execute();
        // Add success message or redirect to a confirmation page
        header("Location: reservationlist.php?id=$reservationId&success=1");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "Invalid request.";
}
?>
