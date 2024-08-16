<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container mb-3">
  <span><a href="../inquiry/" class="text-decoration-none ash">INQUIRY</a></span>
  <span aria-hidden="true" class="ms-3"><img src="../assets/img/booking-form/next-icon.svg" class="pe-1" alt="Image"></span>
  <span class="ms-3 calgar">Check Booking Status</span>
</div>

<main class="container check-status" >
  

  <div class="align-items-center" id="check_status_container">
    <div class="col-sm-12 col-lg-6 col-md-6 col-12 mx-auto container-fluid">
      <h2 class="pt-5 ps-5 fw-bold calgar">CHECK STATUS</h2>
      <p class="ps-5">Booking</p>

      <div class="ps-5 pe-5 pt-3">
        <div class="mb-3">
          <label class="chromaphobic fw-medium">Email Address</label><br>
          <input type="text" name="email" class="form-control bg-white" style="color: #8D97B0" id="emailInput">
        </div>
        <div class="mb-2">
          <label class="chromaphobic fw-medium">Reference Number</label><br>
          <input type="text" name="reference_number" class="form-control bg-white" style="color: #8D97B0" id="referenceNumberInput">
        </div>
        <div>
          <p class="p">Please check your email. A reference number has been sent after completing the form.</p>
        </div>

        <div class="container">
        </div>
        <div class="row p-0 mt-5">
          <label class="chromaphobic fw-medium col-md-6"></label>
          <span class="col-md-6 text-end">
            <button id="checkBookingStatus" class="next-button-position mb-5 p-1" type="button">
              <span class="btn next-button" id="checkBookingStatus">PROCEED</span>
            </button>
          </span>
        </div>

      </div>
    </div>
  </div>

  <!-- Custom Alert Modal HTML -->
  <div id="customAlertModal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <p id="modalMessage"></p>
    </div>
  </div>

  <!-- Payment Modal -->
  <div id="paymentModal" class="PaymentModal">
    <div class="PaymentModal-content">
      <span class="close-btn">&times;</span>
      <h2>Payment Page</h2>
      <p>You are now on the GCash payment page.</p>
      <button id="confirmPaymentBtn" class="btn btn-primary">Confirm</button>
      <button id="cancelPaymentBtn" class="btn btn-secondary">Cancel</button>
    </div>
  </div>

  <!-- Payment Result Modal -->
  <div id="paymentResultModal" class="PaymentModal">
    <div class="PaymentModal-content">
      <span class="close-btn">&times;</span>
      <h2 id="paymentResultTitle"></h2>
      <p id="paymentResultMessage"></p>
      <button id="closeResultBtn" class="btn btn-primary">Close</button>
    </div>
  </div>

  <!-- Custom Alert Modal CSS -->
  <style>
    main.container.check-status {
      margin-top: 100px;
      /* Adjust the value as needed */
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      position: relative;
      /* Add this */
    }

    .close-btn {
      color: #aaa;
      position: absolute;
      /* Change this */
      top: 10px;
      /* Adjust as needed */
      right: 10px;
      /* Adjust as needed */
      font-size: 28px;
      font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    /* Payment Modal */
    .PaymentModal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .PaymentModal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      height: auto;
    }
  </style>

</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>
<script>
  function getCookie(name) {
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i <script cookieArr.length; i++) {
      let cookiePair = cookieArr[i].split("=");
      if (name == cookiePair[0].trim()) {
        return decodeURIComponent(cookiePair[1]);
      }
    }
    return null;
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('emailInput').value = getCookie("email") || "";
    document.getElementById('referenceNumberInput').value = getCookie("referenceNumber") || "";
  });
</script>

<?php include '../layouts/base.php'; ?>
<script src="../assets/js/global.js?=<?php echo $randomNumber; ?>"></script>
<script src="../assets/js/check_status.js"></script>