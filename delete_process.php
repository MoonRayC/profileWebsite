<?php
require_once("dbconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Delete query
    $deleteSql = "DELETE FROM car_service_bookings WHERE id = :reservationId";

    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bindParam(':reservationId', $reservationId);

    try {
        $deleteStmt->execute();
        $successMessage = "Reservation deleted successfully.";
        header("Location: reservationlist.php?success=1&message=" . urlencode($successMessage));
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
