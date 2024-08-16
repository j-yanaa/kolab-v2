<?php
include_once("../connect/session_check.php");

function jsonResponse($status, $message, $additionalData = [])
{
    header('Content-Type: application/json'); // Ensure JSON content type
    echo json_encode(array_merge([
        'status' => $status,
        'message' => $message
    ], $additionalData));
    exit;
}

function processBooking($conn)
{
    // Define base required fields
    $requiredFields = ['firstname', 'lastname', 'email', 'number', 'booking_date', 'term_rate', 'dob', 'address', 'pax', 'start_time', 'end_time', 'payment_method'];

    // Add 'end_time' to required fields only if term_rate is hourly
    if (isset($_POST['term_rate']) && $_POST['term_rate'] === '0') {
        $requiredFields[] = 'end_time';
    }

    // Check for the presence of all required fields
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            jsonResponse(false, "All necessary fields are required.");
            return;
        }
    }

    // Sanitize and prepare the inputs
    $voucher = isset($_POST['voucher']) ? filter_var($_POST['voucher'], FILTER_SANITIZE_STRING) : null;
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $booking_date = filter_var($_POST['booking_date'], FILTER_SANITIZE_STRING);
    $end_date_label = filter_var($_POST['end_date_label'], FILTER_SANITIZE_STRING);
    $term_rate = filter_var($_POST['term_rate'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $pax = filter_var($_POST['pax'], FILTER_SANITIZE_NUMBER_INT);
    $start_time = date('H:i:s', strtotime($_POST['start_time']));
    $end_time = isset($_POST['end_time']) ? date('H:i:s', strtotime($_POST['end_time'])) : null;  // Default to null if not set
    $payment_method = filter_var($_POST['payment_method'], FILTER_SANITIZE_NUMBER_INT); // Default to 0 if not found

    $price = "";
    // Generate a reference number and manage transaction
    $referenceNumber = generateReferenceNumber();
    setcookie("email", $email, strtotime('+1 day'), "/", "", false, false);
    setcookie("referenceNumber", $referenceNumber, strtotime('+1 day'), "/", "", false, false);

    // Start transaction
    $conn->begin_transaction();
    try {
        // Insert booking with initial status, reference number, and date created
        $initialStatus = 'Pending';
        $bookingStmt = $conn->prepare("INSERT INTO bookings (firstname, lastname, email, number, booking_date, status, reference_number, term_rate, dob, address, pax, start_time, end_time, payment_method, voucher, end_date_label, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $bookingStmt->bind_param("ssssssssssssssss", $firstname, $lastname, $email, $number, $booking_date, $initialStatus, $referenceNumber, $term_rate, $dob, $address, $pax, $start_time, $end_time, $payment_method, $voucher, $end_date_label);
        $bookingStmt->execute();
        $bookingid = $conn->insert_id;

        // if (payment_method($payment_method) === "Online") {
        //     sendOnlineEmail($referenceNumber, $email, $booking_date, $pax, $start_time);
        // } else {
        //     sendOnsiteEmail($referenceNumber, $email, $booking_date, $pax, $start_time);
        // }

        // Commit the transaction
        $conn->commit();
        jsonResponse(true, "Booking processed successfully.");
    } catch (Exception $e) {
        $conn->rollback();
        jsonResponse(false, "An error occurred: " . $e->getMessage());
        exit();
    }
}

function sendOnsiteEmail($referenceNumber, $email, $booking_date, $pax, $start_time)
{
    $to = $email;
    $subject = "Email Confirmation";
    $message = '
    <div style="width: 100%; padding: 45px; background-color: #F8F9FA;">
		<img src="../assets/img/logo/kolab.avif" style="width: 105px; height: 105px; object-fit: cover;"  alt="Image">
		<div style="display: flex; align-items:center; margin-top: 20px;">
			<img src="../assets/img/booking-form/check-icon.svg" width="35" height="35" style="padding-right: 10px;"  alt="Image">
			<h3 style="color: #5BB752; font-weight: bold; margin-bottom: 0; font-size:1.5rem;">Booking Confirmed</h3>
		</div>

		
		<p class="reference-num" style="color: #0683D7; font-weight: 500; margin-bottom: 5px; margin-top:20px; font-size:1rem;">REFERENCE #: '.$referenceNumber.'</p>
		<div style="height: 1.5px; background-color: #717998;"></div>

		<div style="display: flex; align-items:center; margin-top: 20px;">
			<img src="../assets/img/email/calendar.svg" width="35" height="35" style="padding-right: 10px;"  alt="Image">
			<p style="color: #292929; font-size:1rem; margin: 0px;">'.$booking_date.'</p>
		</div>

		<div style="display: flex; align-items:center; margin-top: 20px;">
			<img src="../assets/img/email/clock.svg" width="35" height="35" style="padding-right: 10px;"  alt="Image">
			<p style="color: #292929; font-size:1rem; margin: 0px">'.$start_time.'</p>
		</div>

		<div style="display: flex; align-items:center; margin-top: 20px;">
			<img src="../assets/img/email/person.svg" width="35" height="35" style="padding-right: 10px;"  alt="Image">
			<p style="color: #292929; font-size:1rem; margin: 0px;">'.$pax.' Person/s</p>
		</div>

		<div style="height: 1.5px; background-color: #717998; margin-top:20px;"></div>

		<p style=" color: #717998; font-size:1rem; margin-top:48px;">You can check the status, cancel, and re-schedule your booking at INQUIRY page under BOOKING and click "Check Booking Status".</p>
		<p style=" color: #717998; font-size:1rem; margin-top:20px; margin-bottom: 0; font-style: italic;">*Cancellation of booking shall be done 24 hours before your booking date and time.</p>
		<p style=" color: #717998; font-size:1rem; margin:0; font-style: italic;">*Re-scheduling of booking shall be done not later than 1 hour of your booking schedule.</p>

		<p style="color: #292929; font-size:1rem; margin-top: 40px; font-weight: 500;">Payment Summary</p>
		<div style="height: 1.5px; background-color: #717998;"></div>

		<div style="display: flex; justify-content:space-between; margin-top: 20px;">
			<p style="color: #292929; font-size:1rem; margin: 0px;">Term Rate:</p>
			<p style="color: #717998; font-size:1rem; margin: 0px;">₱75</p>
		</div>

		<div style="display: flex; justify-content:space-between; margin-top: 0px;">
			<p style="color: #292929; font-size:1rem; margin: 0px;">Total Hours:</p>
			<p style="color: #717998; font-size:1rem; margin: 0px;">4</p>
		</div>

		<div style="display: flex; justify-content:space-between; margin-top: 0px;">
			<p style="color: #292929; font-size:1rem; margin: 0px;"># of Pax:</p>
			<p style="color: #717998; font-size:1rem; margin: 0px;">1</p>
		</div>

		<div style="display: flex; justify-content:space-between; margin-top: 0px;">
			<p style="color: #292929; font-size:1rem; margin: 0px;">Voucher:</p>
			<p style="color: #717998; font-size:1rem; margin: 0px;">-</p>
		</div>

		<div style="height: 1.5px; background-color: #717998; margin-top:20px;"></div>

		<div style="display: flex; align-items:center; justify-content:space-between; margin-top: 48px;">
			<p style="color: #0683D7; font-size:1.5rem; margin: 0px; font-weight: 500; ">Amount to Pay:</p>
			<p style="color: #0683D7; font-size:1.5rem; margin: 0px; font-weight: 600;">₱300</p>
		</div>

		<p style="color: #FE0600; font-size:1rem; margin-top: 40px;">You have selected on-site payment. Kindly proceed to our office at your scheduled booking time to complete your payment stated above in person. We look forward to seeing you then!</p>

		<button style="border: 0; background-color: #ffffff00; " type="button">
			<span aria-hidden="true" style="font-size: 1rem; background-color: #0683D7; color: white; height:50px; display: block; border-radius: 0; width:250px; display:flex; align-items:center; justify-content:center; margin-top: 40px; margin-bottom:20px;">Check Booking Status</span>
		</button>

	</div>';

    $headers = "From: noreply@kolabspace.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Attempt to send the email
    if (mail($email, $subject, $message, $headers)) {
        return true; // Email sent successfully
    } else {
        return false; // Failed to send email
    }
}
function sendOnlineEmail($referenceNumber, $email, $pax, $term_rate)
{
    $to = $email;
    $subject = "Email Confirmation";
    $message = '
    <div style="width: 100%; padding: 45px; background-color: #F8F9FA;">
        <img src="../assets/img/logo/kolab.avif" style="width: 105px; height: 105px; object-fit: cover;" alt="Image">
        <div style="display: flex; align-items:center; margin-top: 20px;">
            <img src="../assets/img/booking-form/exclamation.svg" width="45" height="45" style="padding-right: 10px;" alt="Image">
            <h3 style="color: #0683D7; font-weight: bold; margin-bottom: 0; font-size:1.5rem;">Booking Instructions</h3>
        </div>

        <p class="reference-num" style="color: #0683D7; font-weight: 500; margin-top:20px; font-size:1rem;">REFERENCE #: '.$referenceNumber.'</p>
        <p style="color: #292929; font-size:1rem; margin-top: 40px; font-weight: 500;">Payment Summary</p>
        <div style="height: 1.5px; background-color: #717998;"></div>

        <div style="display: flex; justify-content:space-between; margin-top: 20px;">
            <p style="color: #292929; font-size:1rem; margin: 0px;">Term Rate:</p>
            <p style="color: #717998; font-size:1rem; margin: 0px;">' . term_rate($term_rate) . '</p>
        </div>

        <div style="display: flex; justify-content:space-between; margin-top: 0px;">
            <p style="color: #292929; font-size:1rem; margin: 0px;"># of Pax:</p>
            <p style="color: #717998; font-size:1rem; margin: 0px;">' . $pax . '</p>
        </div>

        <div style="height: 1.5px; background-color: #717998; margin-top:20px;"></div>

        <div style="display: flex; align-items:center; justify-content:space-between; margin-top: 48px;">
            <p style="color: #0683D7; font-size:1.5rem; margin: 0px; font-weight: 500; ">Amount to Pay:</p>
            <p style="color: #0683D7; font-size:1.5rem; margin: 0px; font-weight: 600;">₱300</p>
        </div>

        <!-- Payment instructions -->
        <p style="color: #0683D7; font-size:1rem; margin-top:40px;">You will be directed to app.bux.ph/BITSHARESLABSINC, make sure it is the correct URL.</p>
        <p style="color: #0683D7; font-size:1rem; margin-top:20px; margin-bottom: 0; font-style: italic;">1. Enter Amount stated above.</p>
        <p style="color: #0683D7; font-size:1rem; margin-top:0px; margin-bottom: 0; font-style: italic;">2. Enter the same Customer Information you provided on KOLAB.</p>
        <p style="color: #0683D7; font-size:1rem; margin-top:0px; margin-bottom: 0; font-style: italic;">3. Choose your online payment method.</p>
        <p style="color: #0683D7; font-size:1rem; margin-top:0px; margin-bottom: 0; font-style: italic;">4. Leave a note: "KOLAB"</p>
        <p style="color: #0683D7; font-size:1rem; margin-top:0px; margin-bottom: 0; font-style: italic;">5. Screenshot successful payment and upload it on the KOLAB website.</p>
        <p style="color: #FE0600; font-size:1rem; margin-top:20px; font-style: italic;">*You will receive a booking confirmation through your email.</p>

        <!-- Pay Here button -->
        <button style="border: 0; background-color: #ffffff00; " type="button">
            <a href="https://app.bux.ph/BITSHARESLABSINC" style="text-decoration: none;">
                <span aria-hidden="true" style="font-size: 1rem; background-color: #0683D7; color: white; height:50px; display: block; border-radius: 0; width:250px; display:flex; align-items:center; justify-content:center; margin-top: 40px; margin-bottom:20px;">Pay Here</span>
            </a>
        </button>
    </div>';

    $headers = "From: noreply@kolabspace.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Attempt to send the email
    if (mail($email, $subject, $message, $headers)) {
        return true; // Email sent successfully
    } else {
        return false; // Failed to send email
    }
}

function updateBooking($conn)
{
    // Define base required fields
    $requiredFields = ['firstname', 'lastname', 'email', 'number', 'booking_date', 'term_rate', 'dob', 'address', 'pax', 'start_time', 'payment_method', 'referenceNumber'];

    // Add 'end_time' to required fields only if term_rate is hourly
    if (isset($_POST['term_rate']) && $_POST['term_rate'] === '0') {
        $requiredFields[] = 'end_time';
    }

    // Check for the presence of all required fields
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            jsonResponse(false, "All necessary fields are required.");
            return;
        }
    }

    // Sanitize and prepare the inputs
    $voucher = isset($_POST['voucher']) ? filter_var($_POST['voucher'], FILTER_SANITIZE_STRING) : null;
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $booking_date = filter_var($_POST['booking_date'], FILTER_SANITIZE_STRING);
    $end_date_label = filter_var($_POST['end_date_label'], FILTER_SANITIZE_STRING);
    $term_rate = filter_var($_POST['term_rate'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $pax = filter_var($_POST['pax'], FILTER_SANITIZE_NUMBER_INT);
    $start_time = date('H:i:s', strtotime($_POST['start_time']));
    $end_time = isset($_POST['end_time']) ? date('H:i:s', strtotime($_POST['end_time'])) : null;  // Default to null if not set
    $payment_method = filter_var($_POST['payment_method'], FILTER_SANITIZE_NUMBER_INT); // Default to 0 if not found
    $referenceNumber = filter_var($_POST['referenceNumber'], FILTER_SANITIZE_STRING); // Sanitize the reference number

    // Start transaction
    $conn->begin_transaction();
    try {
        // Update booking based on reference number
        $updateStmt = $conn->prepare("UPDATE bookings SET firstname=?, lastname=?, email=?, number=?, booking_date=?, term_rate=?, dob=?, address=?, pax=?, start_time=?, end_time=?, payment_method=?, voucher=?, end_date_label=? WHERE reference_number=?");
        $updateStmt->bind_param("sssssisssississ", $firstname, $lastname, $email, $number, $booking_date, $term_rate, $dob, $address, $pax, $start_time, $end_time, $payment_method, $voucher, $end_date_label, $referenceNumber);
        $updateStmt->execute();

        if ($updateStmt->affected_rows === 0) {
            jsonResponse(false, "No booking found with that reference number or no data changed.");
            $conn->rollback();
            return;
        }

        // Commit the transaction
        $conn->commit();
        jsonResponse(true, "Booking updated successfully.");
    } catch (Exception $e) {
        $conn->rollback();
        jsonResponse(false, "An error occurred: " . $e->getMessage());
        exit();
    }
}
function processPoP($conn)
{
    // Define base required fields
    // $requiredFields = ['payment_img'];
    $fileName = basename($_FILES['payment_img']['name']);
    $fileTmpLoc = $_FILES["payment_img"]["tmp_name"];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $userFolder = "../assets/img/user/payment/";
    $allowedExtensions = ['jpeg', 'jpg', 'png', 'webp'];

    // Check for the presence of all required fields
    if (!file_exists($userFolder)) {
        mkdir($userFolder, 0777, true);
    }

    // Check if the "referenceNumber" cookie is set
    if (!isset($_COOKIE["referenceNumber"])) {
        jsonResponse(false, "Something went wrong. Please contact support.");
        return;
    }

    $referenceNumber = $_COOKIE["referenceNumber"];

    if (!in_array(strtolower($fileExt), $allowedExtensions)) {
        jsonResponse(false, "Your image file must be of type: " . implode(', ', $allowedExtensions));
        return;
    }

    $img = $referenceNumber . ".webp";
    $initialFile = pathinfo($img, PATHINFO_FILENAME) . "." . $fileExt;
    $targetPath = $userFolder . $initialFile;

    // Start transaction
    $conn->begin_transaction();
    try {
        if (move_uploaded_file($fileTmpLoc, $targetPath)) {
            // Update booking based on reference number
            $updateStmt = $conn->prepare("UPDATE bookings SET payment_img=? WHERE reference_number=?");
            $updateStmt->bind_param("ss", $initialFile, $referenceNumber);
            $updateStmt->execute();

            if ($updateStmt->affected_rows === 0) {
                jsonResponse(false, "No booking found with that reference number or no data changed.");
                $conn->rollback();
                return;
            }

            // Commit the transaction
            $conn->commit();
            jsonResponse(true, "Booking updated successfully.");
        } else {
            jsonResponse(false, "An error occurred: Failed to upload image");
        }
    } catch (Exception $e) {
        $conn->rollback();
        jsonResponse(false, "An error occurred: " . $e->getMessage());
    }
}

function choosePackage($conn)
{
    // Retrieve reference number from cookie
    $referenceNumber = isset($_COOKIE['referenceNumber']) ? $_COOKIE['referenceNumber'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : (isset($_COOKIE['email']) ? $_COOKIE['email'] : null);

    if (!$referenceNumber || !$email) {
        jsonResponse(false, "Missing email or reference number.");
        return;
    }

    // Fetch booking ID from the database using the reference number
    $stmt = $conn->prepare("SELECT bookingid FROM bookings WHERE reference_number = ?");
    $stmt->bind_param("s", $referenceNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $bookingId = $row['bookingid'];
    } else {
        jsonResponse(false, "Invalid or missing booking ID.");
        return;
    }

    // Validate package ID from POST data
    $packageId = filter_var($_POST['packageid'], FILTER_VALIDATE_INT);
    if (!in_array($packageId, [1, 2, 3])) {
        jsonResponse(false, "Invalid package selected.");
        return;
    }

    // Transaction to update the booking in the database
    $conn->begin_transaction();
    try {
        $updateStmt = $conn->prepare("UPDATE bookings SET term_rate = ? WHERE bookingid = ?");
        $updateStmt->bind_param("ii", $packageId, $bookingId);
        if ($updateStmt->execute()) {
            $conn->commit();
            jsonResponse(true, "Package updated successfully.", ['bookingId' => $bookingId, 'packageId' => $packageId]);
        } else {
            throw new Exception("Unable to update package.");
        }
    } catch (Exception $e) {
        $conn->rollback();
        jsonResponse(false, "An error occurred during package update: " . $e->getMessage());
    }
}
function processPayment($conn)
{
    if (!isset($_COOKIES['email'], $_COOKIES['referenceNumber'])) {
        jsonResponse(false, "All necessary payment fields are required.");
        return;
    }

    $packageid = filter_var($_POST['packageid'], FILTER_VALIDATE_INT);


    // Map packageid to package name and price
    $packages = [
        1 => ['name' => 'Basic', 'price' => 10.00],
        2 => ['name' => 'Standard', 'price' => 20.00],
        3 => ['name' => 'Premium', 'price' => 30.00],
    ];

    if (!isset($packages[$packageid])) {
        jsonResponse(false, "Invalid package selected.");
        return;
    }

    $packageName = $packages[$packageid]['name'];
    $package_price = $packages[$packageid]['price'];

    $conn->begin_transaction();
    try {
        $paymentStmt = $conn->prepare("INSERT INTO payments (bookingid, packageid, package_name, package_price, payment_date, payment_status) VALUES (?, ?, ?, ?, NOW(), 'Pending')");
        $paymentStmt->bind_param("iisd", $packageid, $packageName, $package_price);
        if ($paymentStmt->execute()) {
            $conn->commit();
            jsonResponse(true, "Payment processed successfully.", ['paymentid' => $conn->insert_id, 'packageName' => $packageName, 'packagePrice' => $package_price]);
        } else {
            throw new Exception("Unable to execute payment insertion.");
        }
    } catch (Exception $e) {
        $conn->rollback();
        jsonResponse(false, "An error occurred during payment processing: " . $e->getMessage());
    }
}

function generateReferenceNumber()
{
    return sprintf('%010d', mt_rand(1000000000, 9999999999));  // Generates a random number and ensures it is 10 digits long
}

function checkBookingStatus($conn)
{
    // Check if email and reference number are provided
    if (!isset($_POST['email']) || !isset($_POST['reference_number'])) {
        echo json_encode(['success' => false, 'message' => 'Email and reference number are required.']);
        exit;
    }

    $email = $_POST['email'];
    $referenceNumber = $_POST['reference_number'];

    // Prepare and execute the SQL statement securely with prepared statements
    $stmt = $conn->prepare("SELECT status, end_date_label FROM bookings WHERE email = ? AND reference_number = ?");
    $stmt->bind_param("ss", $email, $referenceNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a booking was found and respond accordingly
    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        echo json_encode(['success' => true, 'status' => $booking['status'], 'end_date_label' => $booking['end_date_label']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No matching booking found.']);
    }

    $stmt->close();
}

function fetchDisabledDates($conn)
{
    $disabledDates = [];
    $query = "SELECT DISTINCT booking_date FROM bookings";
    $result = $conn->query($query);

    if ($result->num_rows > 40) {
        while ($row = $result->fetch_assoc()) {
            $disabledDates[] = $row['booking_date'];
        }
    }

    jsonResponse(true, "Disabled dates fetched successfully.", ['disabledDates' => $disabledDates]);
}

function processInquiry($conn)
{
    // Define base required fields
    $requiredFields = ['firstname', 'lastname', 'email', 'number', 'event_name', 'event_type', 'event_date', 'start_time', 'end_time', 'num_attendees', 'request'];

    // Check for the presence of all required fields
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            jsonResponse(false, "All necessary fields are required.");
            return;
        }
    }

    // Sanitize and prepare the inputs
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $event_name = filter_var($_POST['event_name'], FILTER_SANITIZE_STRING);
    $event_type = filter_var($_POST['event_type'], FILTER_SANITIZE_STRING);
    $event_date = filter_var($_POST['event_date'], FILTER_SANITIZE_STRING);
    $start_time = date('H:i:s', strtotime($_POST['start_time']));
    $end_time = isset($_POST['end_time']) ? date('H:i:s', strtotime($_POST['end_time'])) : null;  // Default to null if not set
    $num_attendees = filter_var($_POST['num_attendees'], FILTER_SANITIZE_STRING);
    $request = filter_var($_POST['request'], FILTER_SANITIZE_STRING);


    // Insert the booking data directly into the database
    try {
        // Insert booking with initial status and date created
        $initialStatus = "Pending";
        $inquiryStmt = $conn->prepare("INSERT INTO inquiries (firstname, lastname, email, number, event_name, event_type, event_date, status, start_time, end_time, num_attendees, request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $inquiryStmt->bind_param("ssssssssssss", $firstname, $lastname, $email, $number, $event_name, $event_type, $event_date, $initialStatus, $start_time, $end_time, $num_attendees, $request);
        $inquiryStmt->execute();
        $inquiryid = $conn->insert_id;

        jsonResponse(true, "Inquiry sent successfully.");
    } catch (Exception $e) {
        jsonResponse(false, "An error occurred: " . $e->getMessage());
        exit();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'fetchDisabledDates':
                fetchDisabledDates($conn);
                break;
            case 'choosePackage':
                choosePackage($conn);
                break;
            case 'processBooking':
                processBooking($conn);
                break;
            case 'updateBooking':
                updateBooking($conn);
                break;
            case 'processPayment':
                processPayment($conn);
                break;
            case 'processPoP':
                processPoP($conn);
                break;
            case 'checkBookingStatus':
                checkBookingStatus($conn);
                break;
            case 'processInquiry':
                processInquiry($conn);
                break;
            default:
                jsonResponse(false, "Invalid action.");
                break;
        }
    }
}
?>