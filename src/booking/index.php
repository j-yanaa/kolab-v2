<?php
include_once("../connect/session_check.php");
?>
<?php
$checker = false;
if (isset($_GET["reference"]) && $_GET["reference"] !== "") {
	$reference = $_GET["reference"];
	$sql = "SELECT * FROM bookings WHERE reference_number=?";

	// Prepare statement
	$stmt = $conn->prepare($sql);
	if (!$stmt) {
		die("Error preparing statement: " . $conn->error);
	}

	// Bind parameters
	$stmt->bind_param("s", $reference);

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
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$email = $row["email"];
			$dob = $row["dob"];
			$address = $row["address"];
			$number = $row["number"];
			$booking_date = $row["booking_date"];
			$reference_number = $row["reference_number"];
			$term_rate = $row["term_rate"];
			$pax = $row["pax"];
			$payment_method = $row["payment_method"];
			$start_time = $row["start_time"];
			$end_time = $row["end_time"];
			$end_date_label = $row["end_date_label"]; // Fetch end_date_label
		}
		$checker = true;
	} else {
		echo "No data found for reference number: $reference";
	}

	// Close statement
	$stmt->close();
}
?>
<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="booking_section container">
	<div class="mb-3">
		<span><a href="../inquiry" class="text-decoration-none ash">INQUIRY</a></span>
		<span aria-hidden="true" class="ms-3"><img src="../assets/img/booking-form/next-icon.svg" class="pe-1" alt="Image"></span>
		<span class="ms-3 calgar">Book Now</span>
	</div>
	<div id="carouselExample" class="carousel slide carousel-fade">
		<div class="carousel-inner">
			<!-- Personal Information -->
			<div class="carousel-item p-5 active">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded position-relative" id="card-body">
							<h2 class="booking-label text-uppercase">Booking Form</h2>
							<span>Personal Information</span>
							<form onsubmit="return false" id="persnalInfoForm">
								<div class="mb-3 mt-3">
									<label for="firstname" class="tag-style">First Name</label><br>
									<input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $firstname ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label for="lastname" class="tag-style">Last Name</label><br>
									<input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $lastname ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label for="email" class="tag-style">Email Address</label><br>
									<div class="input-group col-sm-9">
										<input type="email" id="email" name="email" class="form-control" value="<?php echo $email ?? "" ?>" onblur="validateEmail(this)" required>
									</div>
									<div class="input-group-append">
										<span id="emailError" class="p-2" style="color: red; display: none; font-size: smaller">Invalid format</span>
									</div>
								</div>
								<div class="mb-3">
									<label for="number" class="tag-style">Contact Number</label><br>
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
								<div class="mb-3">
									<label for="dob" class="tag-style">Date of Birth</label><br>
									<input type="date" id="dob" name="dob" class="form-control" value="<?php echo $dob ?? "" ?>" required>
								</div>
								<div class="form-address">
									<label for="address" class="tag-style">Address</label><br>
									<textarea name="address" id="address" class="form-control" required><?php echo $address ?? ""; ?></textarea>
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
			<!-- Details and Pricing -->
			<div class="carousel-item p-5">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">Booking Form</h2>
							<span>Details and Pricing</span>
							<form onsubmit="return false" id="detailsPriceForm">
								<div class="mb-3 mt-3">
									<label for="number" class="tag-style">Number of Pax</label><br>
									<input type="number" id="pax" name="pax" class="form-control" value="<?php echo $pax ?? "" ?>" required>
								</div>
								<div class="rate-style">
									<label for="term_rate" class="tag-style">Term Rate</label><br>
									<div>
										<select id="term_rate" name="term_rate" class="form-select bg-white" style="color: #8D97B0">
											<option value="0" <?php echo $checker && $term_rate === "0" ? "selected" : "" ?>>Hourly (P75)</option>
											<option value="1" <?php echo $checker && $term_rate === "1" ? "selected" : "" ?>>Daily (P249)</option>
											<option value="2" <?php echo $checker && $term_rate === "2" ? "selected" : "" ?>>Weekly (P995)</option>
											<option value="3" <?php echo $checker && $term_rate === "3" ? "selected" : "" ?>>Monthly (P3600)</option>
										</select>
									</div>
								</div>
								<div class="mb-3 mt-3">
									<label for="booking_date" class="tag-style">Desired Date</label><br>
									<input type="date" name="booking_date" id="booking_date" class="form-control" value="<?php echo $booking_date ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label for="start_time" class="tag-style">Start Time</label><br>
									<input type="time" id="start_time" name="start_time" class="form-control" value="<?php echo $start_time ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label for="end_time" class="tag-style">End Time</label><br>
									<input type="time" name="end_time" id="end_time" class="form-control" value="<?php echo $end_time ?? "" ?>" required>
								</div>
								<div for="end_date_label" class="mb-3">
									<label class="tag-style">End Date</label>
									<input type="date" name="end_date_label" id="end_date_label" class="form-control" value="<?php echo $end_date_label ?? "" ?>" >
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
			<!-- Details and Payments -->
			<div class="carousel-item p-5">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">Booking Form</h2>
							<span>Details and Payment</span>
							<form onsubmit="return false" id="detailsPaymentForm">
								<div class="mb-3 mt-3">
									<label for="payment_method" class="tag-style">Payment Method</label><br>
									<div>
										<select id="payment_method" name="payment_method" class="form-select">
											<option value="0" <?php echo $checker && $payment_method === "0" ? "selected" : "selected" ?>>Online Payment</option>
											<option value="1" <?php echo $checker && $payment_method === "1" ? "selected" : "" ?>>On-site Payment</option>
										</select>
									</div>
								</div>
								<div  for="voucher" class="mb-3 mt-3">
									<label class="tag-style">Voucher Code</label><br>
									<input type="text" id="voucher" name="voucher" class="form-control" value="<?php echo $voucher ?? "" ?>" required>
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
			<!-- Booking Review Form -->
			<div class="carousel-item bg-light p-5 rounded mb-5">
				<h2 class="calgar fw-bold text-uppercase p-1">Booking Review Form</h2>
				<div id="bookingReviewForm">
					<div class="row justify-content-center booking_review">
						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Personal Information</p>
							<div class="mb-3">
								<label for="firstname" class="chromaphobic fw-medium">First Name</label><br>
								<input type="text" id="firstname" name="firstname" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $firstname ?? "" ?>" disabled>
							</div>
							<div for="lastname" class="mb-3">
								<label class="chromaphobic fw-medium">Last Name</label><br>
								<input type="text" id="lastname" name="lastname" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $lastname ?? "" ?>" disabled>
							</div>
							<div for="email" class="mb-3">
								<label class="chromaphobic fw-medium">Email</label><br>
								<input type="email" id="email" name="email" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $email ?? "" ?>" disabled>
							</div>
							<div class="mb-3 input-container">
								<label for="number" class="chromaphobic fw-medium">Contact</label><br>
								<div class="input-group col-sm-9">
									<div class="input-group-prepend">
										<span class="input-group-text number-style">+63</span>
									</div>
									<input type="tel" id="number" name="number" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $number ?? "" ?>" disabled>
								</div>
							</div>
							<div class="mb-3 ">
								<div class="row p-0">
									<label for="dob" class="chromaphobic fw-medium col-md-6">Date of Birth</label>
									<span class="col-md-6 text-end">
										<span class="text-secondary">Optional</span>
									</span>
								</div>
								<input type="date" id="dob" name="dob" class="form-control bg-white" style="color: #8D97B0;" value="<?php echo $dob ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<div class="row p-0">
									<label for="address" class="chromaphobic fw-medium col-md-6">Address</label>
									<span class="col-md-6 text-end">
										<span class="text-secondary fs-6">Optional</span>
									</span>
								</div>
								<div class="">
									<textarea name="address" id="address" class="form-control" disabled required><?php echo $address ?? ""; ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Details and Pricing</p>
							<div class="mb-3">
								<label for="pax" class="chromaphobic fw-medium">Number of Pax</label><br>
								<input type="number" id="pax" name="pax" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $pax ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label for="term_rate" class="chromaphobic fw-medium">Term Rate</label><br>
								<div>
									<select id="term_rate" name="term_rate" class="form-select bg-white" style="color: #8D97B0" disabled>
										<option value="0" <?php echo $checker && $term_rate === "0" ? "selected" : "selected" ?>>Hourly (P75)</option>
										<option value="1" <?php echo $checker && $term_rate === "1" ? "selected" : "" ?>>Daily (P249)</option>
										<option value="2" <?php echo $checker && $term_rate === "2" ? "selected" : "" ?>>Weekly (P995)</option>
										<option value="3" <?php echo $checker && $term_rate === "3" ? "selected" : "" ?>>Monthly (P3600)</option>
									</select>
								</div>
							</div>
							<div class="mb-3">
								<label for="booking_date" class="tag-style">Desired Date</label><br>
								<input type="date" id="booking_date" name="booking_date" class="form-control bg-white" value="<?php echo $booking_date ?? "" ?>" style="color: #8D97B0" disabled>
							</div>
							<div class="mb-3">
								<label for="start_time" class="tag-style">Start Time</label><br>
								<input type="time" id="start_time" name="start_time" class="form-control bg-white" value="<?php echo $start_time ?? "" ?>" style="color: #8D97B0" disabled>
							</div>
							<div for="end_time" class="mb-3">
								<label class="tag-style">End Time</label><br>
								<input type="time" id="end_time" name="end_time" class="form-control bg-white" value="<?php echo $end_time ?? "" ?>" style="color: #8D97B0" disabled>
							</div>
							<div for="end_date_label" class="mb-3">
								<label class="tag-style">End Date</label><br>
								<input type="date" name="end_date_label" id="end_date_label" class="form-control bg-white" style="color: #8D97B0" disabled>
							</div>
						</div>
						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Details and Payment</p>
							<div class="mb-3">
								<label for="payment_method" class="chromaphobic fw-medium">Payment Method</label><br>
								<div>
									<select name="payment_method" id="payment_method" class="form-select bg-white" style="color: #8D97B0" disabled>
										<option value="0" <?php echo $checker && $payment_method === "0" ? "selected" : "selected" ?>>Online Payment</option>
										<option value="1" <?php echo $checker && $payment_method === "1" ? "selected" : "" ?>>On-site Payment</option>
									</select>
								</div>
							</div>
							<div class="mb-3">
								<label for="voucher" class="tag-style">Voucher Code</label><br>
								<input type="text" name="voucher" class="form-control bg-white" value="<?php echo $voucher ?? "" ?>" style="color: #8D97B0" disabled>
							</div>
							<div class="form-check mt-5">
								<input type="checkbox" class="form-check-input mt-4" id="agreementCheckbox" name="agreementCheckbox">
								<label class="form-check-label" for="agreementCheckbox">By selecting "Confirm", you are confirming that you have read and agree to KOLAB's <a href="#">Terms and Conditions</a>.</label>
							</div>
							<div style='color: red; font-size: smaller' class="mt-4" id="bookingMessage"></div>
							<div class="w-100 position-relative d-flex align-items-center mt-5">
								<button id="prevButton" class="prev-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
									<div class="d-flex align-items-center text-black">
										<span aria-hidden="true"><img src="../assets/img/booking-form/prev-icon.svg" class="pe-1" alt="Image"></span>
										<span class="prev-style" aria-hidden="true">Back</span>
									</div>
								</button>
								<button id="<?php echo $checker ? "updateButton" : "proceedButton"; ?>" class="next-button-position" type="button">
									<span class="btn next-button"><?php echo $checker ? "UPDATE" : "PROCEED"; ?></span>
								</button>
								<button class="next-button-position d-none booking-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="next"></button>
								<!-- <button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
									<span class="btn next-button" aria-hidden="true">Next</span>
								</button> -->
							</div>
						</div>
					</div>
					<input type="hidden" name="action" value="booking">
				</div>
			</div>
			<?php if (!$checker) { ?>
				<!-- Payment Summary -->
				<!-- <div class="carousel-item p-5">
					<div class="row justify-content-center">
						<div class="col-md-8 col-lg-6">
							<div class="card-body bg-light p-5 rounded position-relative" id="card-body">
								<div class="d-flex align-items-center">
									<h2 class="booking-label text-uppercase">Payment Summary</h2>
								</div>
								<div class="divider-line"></div>
								<div class="d-flex align-items-center justify-content-between mt-5">
									<p class="chromaphobic m-0">Term Rate:</p>
									<p class="input-style m-0">₱75</p>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="chromaphobic m-0">Total Hours:</p>
									<p class="input-style m-0">4</p>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<p class="chromaphobic m-0"># of Pax:</p>
									<p class="input-style m-0">1</p>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-5">
									<p class="chromaphobic m-0">Voucher:</p>
									<p class="input-style m-0">-</p>
								</div>
								<div class="divider-line"></div>
								<div class="d-flex align-items-center justify-content-between change-flex">
									<p class="chromaphobic mt-4">Amount to Pay</p>
									<p class="amount-style mt-4 change-margin">₱300</p>
								</div>
								<div class="w-100 position-relative d-flex align-items-center mt-5">
									<button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
										<span class="btn next-button" aria-hidden="true">Pay</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- Payment Proof -->
				<div class="carousel-item p-5">
					<div class="row justify-content-center">
						<div class="col-md-8 col-lg-6">
							<div class="proof_section">
								<div class="card-body main-container bg-light p-5 rounded position-relative d-flex flex-column justify-content-center mx-auto">
									<div class="d-flex align-items-center">
										<h2 class="summary-heading text-uppercase mb-4">Proof of Payment</h2>
									</div>
									<p class="text-danger description mt-4">Please check your email for payment instructions</p>
									<div class="divider-line"></div>
									<p class="chromaphobic description mt-4">Upload the screenshot of your payment here.</p>
									<div class="mb-3">
										<form onsubmit="return false" id="proofOfPaymentForm">
											<input class="form-control" name="payment_img" type="file" id="payment_img">
										</form>
										<div style='color: red; font-size: smaller' class="mt-4" id="bookingMessage2"></div>
									</div>
									<div class=" position-relative d-flex align-items-center mt-5">
										<button id="payment_proof_btn" class="next-button-position" type="button">
											<span class="btn next-button text-uppercase" aria-hidden="true">Confirm</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php include '../layouts/base.php'; ?>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>
<script src="../assets/js/booking.js"></script>