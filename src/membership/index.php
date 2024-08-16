<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="membership_modal_section container">
	<div class="mb-3">
        <span><a href="../inquiry" class="text-decoration-none ash">INQUIRY</a></span>
        <span aria-hidden="true" class="ms-3"><img src="../assets/img/booking-form/next-icon.svg" class="pe-1" alt="Image"></span>
        <span class="ms-3 calgar">Become a Member</span>
    </div>
	<div id="carouselExample" class="carousel slide carousel-fade">
		<div class="carousel-inner">
			<div class="carousel-item p-5 active">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded position-relative" id="card-body">
							<h2 class="booking-label text-uppercase">MEMBERSHIP form</h2>
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
									<input type="email" name="email" class="form-control" value="<?php echo $email ?? "" ?>" required>
								</div>
								<div class="mb-3">
									<label class="tag-style">Contact Number</label><br>
									<div class="input-group col-sm-9">
										<div class="input-group-prepend">
											<span class="input-group-text number-style">+63</span>
										</div>
										<input type="tel" name="number" class="form-control" value="<?php echo $number ?? "" ?>" required>
									</div>
								</div>
								<div class="mb-3">
									<label class="tag-style">Date of Birth</label><br>
									<input type="date" name="dob" class="form-control" value="<?php echo $dob ?? "" ?>" required>
								</div>
								<div class="form-address">
									<label class="tag-style">Address</label><br>
									<textarea name="address" class="form-control" required><?php echo $address ?? ""; ?></textarea>
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

			
			<div class="carousel-item p-5">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">MEMBERSHIP form</h2>
							<span>Professional Infromation</span>
							<form onsubmit="return false" id="detailsPriceForm">
								<div class="mb-3 mt-3">
									<label class="tag-style">Position/Occupation</label><br>
									<input type="text" name="occu" class="form-control" value="<?php echo $pax ?? "" ?>" required>
								</div>
								<div class="mb-3 mt-3">
									<label class="tag-style">Business/Organization</label><br>
									<input type="text" name="org" class="form-control" value="<?php echo $pax ?? "" ?>" required>
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

			<div class="carousel-item p-5">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6">
						<div class="card-body bg-light p-5 rounded" id="card-body">
							<h2 class="booking-label text-uppercase">MEMBERSHIP form</h2>
							<span>Details and Payment</span>
							<form onsubmit="return false" id="detailsPaymentForm">
								<div class="mb-3 mt-3">
									<label class="tag-style">Payment Method</label><br>
									<div>
										<select id="membership" name="membership" class="form-select" required>
											<option value="0">Maharlika $1500</option>
											<option value="1">Malaya $999</option>
											<option value="2">Uno $500</option>
										</select>
									</div>

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



			<div class="carousel-item bg-light p-5 rounded mb-5">
				<h2 class="calgar fw-bold text-uppercase p-1">MEMBERSHIP REVIEW FORM</h2>
				<div id="bookingReviewForm">
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
									<input type="tel" name="contact" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $number ?? "" ?>" disabled>
								</div>
							</div>
							<div class="mb-3 ">
								<div class="row p-0">
									<label class="chromaphobic fw-medium col-md-6">Date of Birth</label>
									<span class="col-md-6 text-end">
										<!-- <span class="text-secondary">Optional</span> -->
									</span>
								</div>
								<input type="date" name="dob" class="form-control bg-white" style="color: #8D97B0;" value="<?php echo $dob ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<div class="row p-0">
									<label class="chromaphobic fw-medium col-md-6">Address</label>
									<span class="col-md-6 text-end">
										<!-- <span class="text-secondary fs-6">Optional</span> -->
									</span>
								</div>
								<div class="">
									<textarea name="address" class="form-control" style="color: #8D97B0" required><?php echo $address ?? ""; ?></textarea>
								</div>
							</div>
						</div>




						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Professional Infromation</p>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Position/Occupation</label><br>
								<input type="text" name="pax" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $pax ?? "" ?>" disabled>
							</div>
							<div class="mb-3">
								<label class="chromaphobic fw-medium">Business/Organization</label><br>
								<input type="text" name="pax" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $pax ?? "" ?>" disabled>
							</div>
						</div>



						<div class="col-lg-3 card-body ps-3 rounded">
							<p class="chromaphobic pb-3">Details and Payment</p>
							<label class="chromaphobic fw-medium">Membership Level Section</label><br>
							<div class="mb-3">
								<select id="membership" name="membership" class="form-select bg-white" style="color: #8D97B0" disabled>
									<option value="0">Maharlika $1500</option>
									<option value="1">Malaya $999</option>
									<option value="2">Uno $500</option>
								</select>
							</div>
							<div class="mb-5">
								<label class="chromaphobic fw-medium">Voucher Code</label><br>
								<input type="text" name="voucher" class="form-control bg-white" style="color: #8D97B0" value="<?php echo $voucher ?? "" ?>" disabled>
							</div>


							<div class="form-check">
								<input type="checkbox" class="form-check-input mt-4" id="agreementCheckbox">
								<label class="form-check-label" for="agreementCheckbox">By selecting “Confirm”, you are confirming that you have read and agree to KOLAB’s <span><a href="#">Terms and Conditions</a></span>.</label>
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
									<span class="btn next-button"><?php echo $checker ? "UPDATE" : "CONFIRM"; ?></span>
								</button>
							</div>
						</div>
					</div>
					<input type="hidden" name="action" value="booking">
				</div>
			</div>
		</div>
	</div>
</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var myCarousel = document.getElementById('carouselExample');
		var prevButton = document.getElementById('prevButton');
		var nextButton = document.getElementById('nextButton');

		if (myCarousel && prevButton && nextButton) {
			myCarousel.addEventListener('slid.bs.carousel', function() {
				var carouselInner = this.querySelector('.carousel-inner');
				var activeItem = carouselInner.querySelector('.carousel-item.active');

				// Check if the active item is the first item
				if (activeItem === carouselInner.firstElementChild) {
					// Hide previous button
					prevButton.style.display = 'none';
				} else {
					// Show previous button
					prevButton.style.display = 'block';
					nextButton.innerHTML = `<span class="btn next-button" aria-hidden="true">Next</span>`;
				}

				// Check if the active item is the third item
				if (activeItem.nextElementSibling === null) {
					// Disable next button
					nextButton.innerHTML = `<button type="submit" class="btn next-button">Proceed</button>`;
				} else {
					// Enable next button
					nextButton.disabled = false;
				}
			});
		}

		// Function to update the booking review form with data from the first three carousels
		function updateBookingReviewForm() {
			// Get the form and input fields
			var bookingReviewForm = document.getElementById('bookingReviewForm');
			var inputs = bookingReviewForm.querySelectorAll('input, textarea, select');

			// Get input fields from the first three carousels
			var carouselItems = document.querySelectorAll('.carousel-item input, .carousel-item textarea, .carousel-item select');

			// Iterate over input fields and update their values
			inputs.forEach(function(input, index) {
				var value = carouselItems[index].value;
				input.value = value;
			});
		}

		// Listen for input events on input fields in the first three carousels
		var carouselItems = document.querySelectorAll('.carousel-item input, .carousel-item textarea, .carousel-item select');
		carouselItems.forEach(function(input) {
			input.addEventListener('input', updateBookingReviewForm);
		});
	});
</script>

<?php include '../layouts/base.php'; ?>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>