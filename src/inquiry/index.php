<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="inquiry_section ">
    <div class="container mb-5 pb-5 ">
        <span class="calgar">INQUIRY</span>
    </div>
    <div class="container p-5 pt-4 mb-5">
        <div class="">
            <div class="row justify-content-center main-container-inquiry">
                <div class="col-lg-4 text-center col-gap">
                    <div class="card-body container-height bg-light p-5 pt-lg-5 rounded position-relative d-flex flex-column justify-content-center">
                        <div class="label barberry_bg position-absolute top-0 start-50 translate-middle">MEMBERSHIP</div>
                        <p class="text-gap-booking chromaphobic text-height pt-md-3">Get your brand in the spotlight! Host web3 events! Be seen on social media posts, websites, and decks. Get featured in newsletters, magazines, and receive an exclusive certificate, enjoy exclusive RSVPs, networking, and discounts, the BLINC way!</p>
                        <div class="pt-md-2 image-container">
                            <img src="../assets/img/temp-img.avif" class="img-fluid">
                        </div>
                        <div class="d-flex justify-content-center pt-sm-0 pt-lg-5">
                            <div class="p-lg-2 pt-md-5"></div>
                            <a href="../membership/" class="btn btn-primary rounded-0 px-3 btn-size position-absolute bottom-1 start-50 translate-middle-x ">Become a Member</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center col-gap">
                    <div class="card-body container-height bg-light p-5 pt-1 pt-lg-5 rounded position-relative d-flex flex-column justify-content-center">
                        <div class="label pumpkin_bg position-absolute top-0 start-50 translate-middle">BOOKING</div>
                        <p class="text-gap-booking chromaphobic text-height pt-md-3">Work at Your Tempo — Choose hourly, daily, weekly, and monthly rates for the Boss in You! Our flexible pricing structure guarantees that you have the freedom and control to maximize your productivity and reach your maximum potential.</p>
                        <div class="pt-md-2 image-container">
                            <img src="../assets/img/temp-img.avif" class="img-fluid">
                        </div>
                        <p class="booking-status-link position-absolute top-100 start-50 translate-middle pt-lg-0 mb-lg-2 "><a href="../check-status" class="status">Check Booking Status</a></p>
                        <div class="pt-lg-5 pt-md-5">
                            <div class="p-lg-2 pt-md-3"></div>
                            <a href="../booking/" class="btn btn-primary rounded-0 px-3 btn-size position-absolute bottom-1 start-50 translate-middle-x ">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center col-gap">
                    <div class="card-body container-height bg-light p-5 pt-1 pt-lg-5  rounded position-relative d-flex flex-column justify-content-center">
                        <div class="label candy-apple_bg position-absolute top-0 start-50 translate-middle">HOSTING</div>
                        <p class="chromaphobic text-height pt-md-3">Ideal for small-scale gatherings, intimate community meet-ups, casual discussions, and start-up meetings. Suitable for small presentations and functions.</p>
                        <div class="image-container">
                            <img src="../assets/img/temp-img.avif" class="img-fluid">
                        </div>
                        <div class="pt-lg-5">
                            <div class="p-lg-2"></div>
                            <a href="../host-event/" class="btn btn-primary rounded-0 px-3 btn-size position-absolute bottom-1 start-50 translate-middle-x">Host an event</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php include '../layouts/base.php'; ?>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>