<?php
include("../connect/session_check.php");
?>
<?php
$checker = false;
if (isset($_GET["inquiry"]) && $_GET["inquiry"] !== "") {
	$inquiry = $_GET["inquiry"];
	$sql = "SELECT * FROM inquiries WHERE inquiryid=?";

	// Prepare statement
	$stmt = $conn->prepare($sql);
	if (!$stmt) {
		die("Error preparing statement: " . $conn->error);
	}

	// Bind parameters
	$stmt->bind_param("s", $inquiry);

	// Execute statement
	if (!$stmt->execute()) {
		die("Error executing statement: " . $stmt->error);
	}

	// Get result
	$result = $stmt->get_result();

	// Check if there are rows returned
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			// Assign fetched values to variables
			$inquiryid = $row["inquiryid"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$email = $row["email"];
			$number = $row["number"];
			$event_name = $row["event_name"];
			$event_type = $row["event_type"];
			$event_date = $row["event_date"];
			$start_time = $row["start_time"];
			$end_time = $row["end_time"];
			$num_attendees = $row["num_attendees"];
			$request = $row["request"];
		}
		$checker = true;
	} else {
		echo "No data found for inquiries number: $inquiry";
	}

	// Close statement
	$stmt->close();
}
?>


<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="host_event container">
	<div class="mb-3">
        <span><a href="../inquiry/" class="text-decoration-none ash">INQUIRY</a></span>
        <span aria-hidden="true" class="ms-3"><img src="../assets/img/booking-form/next-icon.svg" class="pe-1" alt="Image"></span>
        <span class="ms-3 calgar">Host an Event</span>
    </div>
	<div id="carouselExample" class="carousel slide carousel-fade">
		<div class="carousel-inner">
			<!-- Personal Information -->
			<div class="carousel-item p-5 active">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded position-relative" id="card-body">
							<h2 class="booking-label text-uppercase">EVENT RENTAL INQUIRY</h2>
							<span>Personal Information</span>
							<form onsubmit="return false" id="persnalInfoForm">
								<div class="mb-3 mt-3">
									<label class="tag-style">First Name</label><br>
									<input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label class="tag-style">Last Name</label><br>
									<input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label class="tag-style">Email Address</label><br>
									<div class="input-group col-sm-9">
										<input type="email" id="email" name="email" class="form-control" onblur="validateEmail(this)" required>
									</div>
									<div class="input-group-append">
										<span id="emailError" class="p-2" style="color: red; display: none; font-size: smaller">Invalid format</span>
									</div>
								</div>
								<div class="mb-3">
									<label class="tag-style">Contact Number</label><br>
									<div class="input-group col-sm-9">
										<div class="input-group-prepend">
											<span class="input-group-text number-style">+63</span>
										</div>
										<input type="tel" id="number" name="number" class="form-control" pattern="^\+63\d{10}$" maxlength="10" minlength="10" onKeyPress="validateNumber(this)" value="<?php echo $number ?? ""; ?>" required>
									</div>
									<div class="input-group-append">
										<span id="numberError" class="p-2" style="color: red; display: none; font-size: smaller">Invalid format</span>
									</div>
								</div>
							</form>
							<div class="button-container w-100 position-relative">
								<button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
									<span class="btn next-button" aria-hidden="true">Next</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Event Details -->
			<div class="carousel-item p-5">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">Event Rental Inquiry</h2>
							<span>Event Details</span>
							<form onsubmit="return false" id="detailsEventForm">
								<div class="mb-3 mt-3">
										<label class="tag-style">Event Name</label><br>
										<input type="text" name="event_name" class="form-control" required>
								</div>
								<div class="mb-3 mt-3">
										<label class="tag-style">Event Type</label><br>
										<input type="text" name="event_type" class="form-control" required>
								</div>
								<div class="mb-3 mt-3">
									<label class="tag-style">Desired Date</label><br>
									<input type="date" name="event_date" class="form-control" required>
								</div>
								<div class="mb-3">
									<label class="tag-style">Start Time</label><br>
									<input type="time" name="start_time" class="form-control" required>
								</div>
								<div class="mb-3">
									<label class="tag-style">End Time</label><br>
									<input type="time" name="end_time" class="form-control">
								</div>
								<div class="mb-3 mt-3">
									<label class="tag-style">Estimated Number of Attendees</label><br>
									<input type="number" name="num_attendees" class="form-control" required>
								</div>
							</form>
							<div class="w-100 position-relative d-flex align-items-center mt-5">
								<button id="prevButton" class="prev-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
									<div class="d-flex align-items-center text-black">
										<span aria-hidden="true"><img src="../assets/img/booking-form/prev-icon.svg" class="pe-1" alt="Image"></span>
										<span class="prev-style" aria-hidden="true">Back</span>
									</div>
								</button>
								<button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
									<span class="btn next-button" aria-hidden="true">Next</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Additional Details -->
			<div class="carousel-item p-5 mb-5">
				<div class="row justify-content-center mb-5 pb-3">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">EVENT RENTAL INQUIRY</h2>
							<span>Additional Details</span>
							<form onsubmit="return false" id="addDetailsForm">
								<div class="form-address mt-3">
									<label class="tag-style">Special Request or Additional Information</label><br>
									<textarea name="request" class="form-control h-50" required></textarea>
								</div>

							</form>
							<div class="w-100 position-relative d-flex align-items-center mt-5">
								<button id="prevButton" class="prev-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
									<div class="d-flex align-items-center text-black">
										<span aria-hidden="true"><img src="../assets/img/booking-form/prev-icon.svg" class="pe-1" alt="Image"></span>
										<span class="prev-style" aria-hidden="true">Back</span>
									</div>
								</button>
								<button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
									<span class="btn next-button" aria-hidden="true">Next</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Inquiry Review Form -->
			<div class="carousel-item bg-light p-5 rounded mb-5">
				<h2 class="calgar fw-bold text-uppercase p-1">Review Inquiry</h2>
				<div id="inquiryReviewForm">
					<div class="row justify-content-center booking_review">

						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Personal Information</p>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">First Name</label><br>
								<input type="text" name="firstname" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $firstname ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Last Name</label><br>
								<input type="text" name="lastname" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $lastname ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Email</label><br>
								<input type="email" name="email" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $email ?? "" ?>" disabled>
							</div>
							<div class="mb-3 input-container">
								<label class="chromaphobic fw-medium">Contact</label><br>
								<div class="input-group col-sm-9">
									<div class="input-group-prepend">
										<span class="input-group-text number-style">+63</span>
									</div>
									<input type="tel" id="number" name="number" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $number ?? "" ?>" disabled>
								</div>
							</div>
						</div>

						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Event Details</p>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Event Name</label><br>
								<input type="text" name="event_name" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $event_name ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Event Type</label><br>
								<input type="text" name="event_type" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $event_type ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Desired Date</label><br>
								<input type="date" name="event_date" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $event_date ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Start Time</label><br>
								<input type="time" name="start_time" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $start_time ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">End Time</label><br>
								<input type="time" name="end_time" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $end_time ?? "" ?>" disabled>
							</div>
							<div class="mb-3 mt-3">
								<label class="tag-style">Estimated Number of Attendees</label><br>
								<input type="number" name="num_attendees" class="form-control bg-white" value="<?php echo $num_attendees ?? "" ?>" style="color: #8D97B0" disabled>
							</div>
						</div>

						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Additional Information</p>
							<div class="form-address mt-3">
								<label class="tag-style">Special Request or Additional Information</label><br>
								<textarea name="request" class="form-control h-50 bg-white" value="<?php echo $request ?? "" ?>" style="color: #8D97B0" disabled></textarea>
							</div>

							<div class="form-check mt-5">
								<input type="checkbox" class="form-check-input mt-4" id="agreementCheckbox" name="agreementCheckbox">
								<label class="form-check-label" for="agreementCheckbox">By selecting “Confirm”, you are confirming that you have read and agree to KOLAB’s <span><a href="#">Terms and Conditions</a></span>.</label>
							</div>
							<div style='color: red; font-size: smaller' class="mt-4" id="inquiryMessage"></div>
							<div class="w-100 position-relative d-flex align-items-center mt-5">
								<button id="prevButton" class="prev-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
									<div class="d-flex align-items-center text-black">
										<span aria-hidden="true"><img src="../assets/img/booking-form/prev-icon.svg" class="pe-1" alt="Image"></span>
										<span class="prev-style" aria-hidden="true">Back</span>
									</div>
								</button>
								<button id="proceedButton" class="next-button-position" type="button">
									<span class="btn next-button">CONFIRM</span>
								</button>
								<button class="next-button-position d-none inquiry-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="next"></button>
							</div>
						</div>
					</div>
					<input type="hidden" name="action" value="inquiry">
				</div>
			</div>
		</div>
	</div>
</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>
<script>

</script>

<?php include '../layouts/base.php'; ?>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>
<script src="../assets/js/inquiry.js"></script>