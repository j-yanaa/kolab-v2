<?php
include_once("../connect/session_check.php");
?>
<?php
function checkBookingStatus($conn) {
    // Check if email and reference number are provided
    if (!isset($_POST['email']) || !isset($_POST['reference_number'])) {
        echo json_encode(['success' => false, 'message' => 'Email and reference number are required.']);
        exit;
    }

    $email = $_POST['email'];
    $referenceNumber = $_POST['reference_number'];

    // Prepare and execute the SQL statement securely with prepared statements
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE email = ? AND reference_number = ?");
    $stmt->bind_param("ss", $email, $referenceNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a booking was found and respond accordingly
    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        
        // Check if the booking status is 'Deleted'
        if ($booking['status'] === 'deleted') {
            echo json_encode(['success' => false, 'message' => 'The booking has been deleted by the Master Admin. Please create a new booking.']);
        } else {
            echo json_encode([
                'success' => true, 
                'fullname' => $booking['firstname'] . " " . $booking['lastname'],
                'email' => $booking['email'],
                'number' => $booking['number'],
                'booking_date' =>  date("d F Y", strtotime($booking['booking_date'])),
                'reference_number' => $booking['reference_number'],
                'term_rate' => $booking['term_rate'],
                'term_rate_desc' => term_rate($booking['term_rate']),
                'pax' => $booking['pax'],   
                'status' => $booking['status'],
                'voucher' => $booking['voucher'],
                'start_time' => date('h:i A', strtotime($booking['start_time'])),
                'end_time' => date('h:i A', strtotime($booking['end_time'])),
                'end_date_label' => date('d F Y', strtotime($booking['end_date_label'])),
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No matching booking found. Please re-check the details you have entered or make a new booking.']);
    }

    $stmt->close();
}

function cancelBooking($conn) {
    // Check if reference number is provided
    if (!isset($_POST['reference_number'])) {
        echo json_encode(['success' => false, 'message' => 'Reference number is required.']);
        exit;
    }

    $referenceNumber = $_POST['reference_number'];

    // Prepare and execute the SQL statement securely with prepared statements
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE reference_number = ?");
    $stmt->bind_param("s", $referenceNumber);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Booking cancelled successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No matching booking found or booking already cancelled.']);
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'checkBookingStatus':
                checkBookingStatus($conn);
                break;
            case 'cancelBooking':
                cancelBooking($conn);
                break;
            default:
                jsonResponse(false, "Invalid action.");
                break;
        }
    }
}
?>