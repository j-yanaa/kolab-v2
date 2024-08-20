<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="inquiry_section">
    <div class="container py-5">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">BOOKING FORM</h4>
                    </div><!-- end card header -->
                    <div class="card-body form-steps">
                        <form class="vertical-navs-step">
                            <div class="row gy-5">
                                <div class="col-lg-3">
                                    <div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
                                        <button class=" nav-link done text-start" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="true">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                Step 1
                                            </span>
                                            Booking Info
                                        </button>
                                        <button class="active nav-link text-start" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                Step 2
                                            </span>
                                            Client Info
                                        </button>
                                        <button class="nav-link text-start" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                Step 3
                                            </span>
                                            Payment
                                        </button>
                                        <button class="nav-link text-start" id="v-pills-finish-tab" data-bs-toggle="pill" data-bs-target="#v-pills-finish" type="button" role="tab" aria-controls="v-pills-finish" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                Step 4
                                            </span>
                                            Finish
                                        </button>
                                    </div>
                                    <!-- end nav -->
                                </div> <!-- end col-->
                                <div class="col-lg-6">
                                    <div class="px-lg-4">
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                                <div>
                                                    <h5>Booking Info</h5>
                                                    <p class="text-muted">Fill all information below</p>
                                                </div>

                                                <div>
                                                    <div class="card card-h-100">
                                                        <div class="card-body">
                                                            <div id="calendar"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Shipping</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade show active" id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                <div>
                                                    <h5>Client Info</h5>
                                                    <p class="text-muted">Fill all information below</p>
                                                </div>

                                                <div>
                                                    <div class="row g-3">
                                                        <div class="col-sm-6">
                                                            <label for="firstName" class="form-label">First name</label>
                                                            <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" value="">
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="lastName" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" value="">
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" placeholder="Enter Email">
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="contact" class="form-label">Contact Number</label>
                                                            <input type="tel" class="form-control" id="contact" placeholder="Enter Contact Number">
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="occupation" class="form-label">Occupation</label>
                                                            <input type="text" class="form-control" id="occupation" placeholder="Enter Occupation">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-gray btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Billing Info</button>
                                                    <button type="button" class="btn btn-default btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to Payment</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                <div>
                                                    <h5>Payment</h5>
                                                    <p class="text-muted">Fill all information below</p>
                                                </div>

                                                <div>
                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="pmethod" class="form-label">Payment Method</label>
                                                            <select class="form-select" id="pmethod">
                                                                <option value="">Choose...</option>
                                                                <option>Over the Counter</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <p>
                                                        Disclosure : By submitting this form, you acknowledge and agree to the collection, use, and storage of your personal data in accordance with our Privacy Policy. Your information will be used solely for processing your request and will not be disclosed to third parties without your consent.
                                                    </p>

                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" class="form-check-input" id="same-address">
                                                        <label class="form-check-label" for="same-address">I agree</label>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Client Info</button>
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-finish-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade" id="v-pills-finish" role="tabpanel" aria-labelledby="v-pills-finish-tab">
                                                <div class="text-center pt-4 pb-2">

                                                    <div class="mb-4">
                                                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                                    </div>
                                                    <h5>Your Booking is Submitted !</h5>
                                                    <p class="text-muted">You will receive a confirmation email with details of your booking.</p>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fs-14 text-primary mb-0">Your booking details</h5>
                                    </div>
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">August 23, 2024</h6>
                                                <small class="text-muted">Booking Date</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Solo</h6>
                                                <small class="text-muted">Rate</small>
                                            </div>
                                            <span class="text-muted">₱250</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">3 Hours</h6>
                                                <small class="text-muted">Duration</small>
                                            </div>
                                            <span class="text-muted">x 1</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Over the counter</h6>
                                            <small class="text-muted">Payment Method</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total</span>
                                            <strong>₱250</strong>
                                        </li>
                                        
                                </div>
                            </div>
                            <!-- end row -->
                        </form>
                    </div>
                </div>
                <!-- end -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php include '../layouts/base.php'; ?>
<!-- calendar min js -->
<script src="../assets/libs/fullcalendar/main.min.js"></script>

<!-- Calendar init -->
<script src="../assets/js/pages/calendar.init.js"></script>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>