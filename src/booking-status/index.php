<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="booking_status_section container p-5 pt-4 mb-5">

	<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style">
			<li class="breadcrumb-item"><a href="#">INQUIRY</a></li>
			<li class="breadcrumb-item active active-style" aria-current="page">Check Status</li>
		</ol>
	</nav>

	<div class="row justify-content-center mt-5 change-flex" id="booking_information">
		<div class="col-7 first-column">
			<div class="card-body container-height bg-light p-5 rounded position-relative">
				<div class="d-flex align-items-center">
					<img src="../assets/img/booking-form/check-icon.svg" width="35" height="30" class="pe-2" alt="Image">
					<h2 class="style-confirmed text-uppercase">Booking Confirmed</h2>
				</div>
				<p class="reference-num mt-5">REFERENCE #: 456842</p>
				<div class="divider-line"></div>

				<p class="subheading-info mt-3 mb-3 change-align">Personal Information</p>
				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Name:</p>
					<p class="input-style m-0 change-align">Betty Shares</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Email Address:</p>
					<p class="input-style m-0">bettyshares@gmail.com</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Contact Number:</p>
					<p class="input-style m-0">(+63) 9876543210</p>
				</div>

				<p class="subheading-info mt-5 mb-3 change-align">Booking Information</p>
				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Number of Pax:</p>
					<p class="input-style m-0">1</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Term Rate:</p>
					<p class="input-style m-0">Hourly ₱75</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Booking Date:</p>
					<p class="input-style m-0">04/18/2024</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">Start Time:</p>
					<p class="input-style m-0">1:00PM</p>
				</div>

				<div class="d-flex align-items-center justify-content-between change-flex-info">
					<p class="chromaphobic m-0">End Time:</p>
					<p class="input-style m-0">5:00PM</p>
				</div>

				<p class="caution-style mt-5 mb-3">You can check the status, cancel, and re-schedule your booking at INQUIRY page under BOOKING and click “Check Booking Status”.</p>
				<p class="caution-style m-0 fst-italic">*Cancellation of booking shall be done 24 hours before your booking date and time. </p>
				<p class="caution-style fst-italic last-item">*Rescheduling of booking shall be done not later than 1 hour of your booking schedule.</p>

			</div>
		</div>
		<div class="col-5 text-center change-column">
			<div class="d-flex flex-row ">
				<div class="card-body container-height bg-light p-5 rounded position-relative d-flex flex-column justify-content-center">
					<div class="d-flex align-items-center">
						<h2 class="summary-heading text-uppercase mb-5">Payment Summary</h2>
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

					<div class="d-flex align-items-center justify-content-between mb-5 change-flex">
						<p class="chromaphobic mt-5">Amount to Pay</p>
						<p class="amount-style mt-5 change-margin">₱300</p>
					</div>

					<p class="caution-style m-0 text-start">Payment shall be done on-site via Cash, UnionBank, or GCash.</p>
					
				</div>
			</div>

			<div class="col text-center mt-4 change-column">
				<div class="card-body container-height-btn bg-light pe-5 ps-5 pb-4 rounded position-relative d-flex flex-row align-items-center change-flex">
					<button id="reschedule-btn" class="reschedule-btn" type="button">
						<span class="btn btn-style text-uppercase">Re-schedule</span>
					</button>

					<div class="col-1"></div>

					<button id="cancel-btn" class="cancel-btn" type="button">
						<span class="btn cancel-btn-style text-uppercase">Cancel</span>
					</button>
				</div>
			</div>
		</div>
		
	</div>

	<div class="mt-5"></div>

	<!-- Proof of Payment -->
	<div class="proof_section">
		<div class="card-body main-container bg-light p-5 rounded position-relative d-flex flex-column justify-content-center mx-auto">
			<div class="d-flex align-items-center">
				<h2 class="summary-heading text-uppercase mb-4">Proof of Payment</h2>
			</div>

			<div class="divider-line"></div>
			<p class="chromaphobic description mt-4">Upload the screenshot of your payment here.</p>
			<div class="mb-3">
				<input class="form-control" type="file" id="formFile">
			</div>

			<div class=" position-relative d-flex align-items-center mt-5">
				<button id="prevButton" class="prev-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
					<div class="d-flex align-items-center text-black">
						<span aria-hidden="true"><img src="../assets/img/booking-form/prev-icon.svg" class="pe-1" alt="Image"></span>
						<span class="prev-style" aria-hidden="true">Back</span>
					</div>
				</button>
				<button id="nextButton" class="next-button-position" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
					<span class="btn next-button text-uppercase" aria-hidden="true">Confirm</span>
				</button>
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
<script src="../assets/js/booking.js"></script>