// Custom alert for error handling
function showCustomAlert(message, callback) {
  const modal = document.getElementById("customAlertModal");
  const modalMessage = document.getElementById("modalMessage");
  const closeBtn = document.getElementsByClassName("close-btn")[0];

  modalMessage.textContent = message;
  modal.style.display = "block";

  closeBtn.onclick = function () {
    modal.style.display = "none";
    if (callback) callback(); // Execute the callback if provided
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
      if (callback) callback(); // Execute the callback if provided
    }
  };
}

// document.addEventListener("DOMContentLoaded", function () {
//   insertTotalRate();
// });

function calculateTotalAmount(
  termDescription,
  termRateAmount,
  totalHoursDecimal,
  daysCount
) {
  if (termDescription === 0) {
    return "₱" + (Number(termRateAmount) * totalHoursDecimal).toFixed(2);
  } else if (termDescription === 1){
    return "₱" + (Number(termRateAmount) *daysCount).toFixed(2);
  }
  else {
    return "₱" + Number(termRateAmount).toFixed(2);
  }
}

async function checkBookingStatus(event) {
  event.preventDefault(); // Prevent default form submission behavior

  const email = document.querySelector('input[name="email"]').value;
  const referenceNumber = document.querySelector(
    'input[name="reference_number"]'
  ).value;

  const formData = new FormData();
  formData.append("email", email);
  formData.append("reference_number", referenceNumber);
  formData.append("action", "checkBookingStatus"); // This line specifies the action for the backend to execute

  try {
    const response = await fetch("../data/load.php", {
      method: "POST",
      body: formData,
      headers: {
        Accept: "application/json", // Specifies that the client expects a JSON response
      },
    });
    const result = await response.json();

    // Output the result to the console or handle it in another way
    if (result.success) {
      console.log("Booking:", result); // Outputs to the console
      loadBookingInformation(result);
      // Optionally, update the UI here or handle data in another way
    } else {
      console.log(
        "No booking found with the provided details:",
        result.message
      );
      showCustomAlert(result.message); // Outputs error to the console
    }
  } catch (error) {
    console.error("Error checking booking status:", error);
    // Optionally, handle errors in your UI here
  }
}

// Attach the event listener for the 'checkBookingStatus' button
let checkBookingStatusButton = document.getElementById("checkBookingStatus");
if (checkBookingStatusButton) {
  checkBookingStatusButton.addEventListener("click", checkBookingStatus);
} else {
  console.error("Button with ID 'checkBookingStatus' not found.");
}

function loadBookingInformation(data) {
  const bookingInfo = document.getElementById("check_status_container");

  // Calculate total hours and minutes between start time and end time
  var startTime = new Date("1970/01/01 " + data.start_time);
  var endTime = new Date("1970/01/01 " + data.end_time);
  if (endTime < startTime) {
    endTime.setDate(endTime.getDate() + 1);
  }
  var diffMs = endTime - startTime;
  var totalHours = Math.floor(diffMs / 3600000);
  var totalMinutes = Math.floor((diffMs % 3600000) / 60000);
  var totalHoursDecimal = totalHours + totalMinutes / 60; // Decimal total hours

  var startDate = new Date(data.booking_date);
  var endDate = new Date(data.end_date_label);
  let daysCount = 0;
  let currentDate = new Date(startDate);

  while (currentDate <= endDate) {
    const dayOfWeek = currentDate.getDay();
    if (dayOfWeek !== 0 && dayOfWeek !== 6) {
      daysCount++;
    }
    currentDate.setDate(currentDate.getDate() + 1);
  }

  // Construct time text string
  var totalHoursText = "";
  if (totalHours > 0) {
    totalHoursText += totalHours + " hour" + (totalHours > 1 ? "s" : "");
  }
  if (totalMinutes > 0 && totalHours > 0) {
    totalHoursText += " and ";
  }
  if (totalMinutes > 0) {
    totalHoursText += totalMinutes + " minute" + (totalMinutes > 1 ? "s" : "");
  }

  var termRateAmount = getTermRateAmount(data.term_rate); // Assuming term_rate is descriptive like "hourly"
  // This should be a descriptive term like "Hourly"
  var termDescription = data.term_rate;

  var totalAmount = calculateTotalAmount(
    termDescription,
    termRateAmount,
    totalHoursDecimal,
    daysCount
  );

  let endTimeHtml = '';
  if (data.term_rate === "0") {
    endTimeHtml = `
      <div class="d-flex align-items-center justify-content-between">
        <p class="chromaphobic m-0">End Time:</p>
        <p class="input-style m-0">${data.end_date_label}</p>
      </div>`;
  }


  const htmlOutput =
      data.status === "Approved"
          ? `<div class="mb-5">
      <div class="row">
        <div class="col-12 col-lg-7 mb-4">
          <div class="card-body bg-light p-4 rounded position-relative h-100">
            <div class="d-flex align-items-center">
              <img src="../assets/img/booking-form/check-icon.svg" width="35" height="30" class="pe-2" alt="Image">
              <h2 class="style-confirmed text-uppercase text-success fw-bold">BOOKING ${data.status}</h2>
            </div>
            <p class="reference-num mt-5 border-bottom border-black text-primary">REFERENCE #: ${data.reference_number}</p>
            <div class="divider-line"></div>
            <p class="subheading-info mt-3 mb-3 text-primary h4">Personal Information</p>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Name:</p>
              <p class="input-style m-0">${data.fullname}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Email Address:</p>
              <p class="input-style m-0">${data.email}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Contact Number:</p>
              <p class="input-style m-0">(+63) ${data.number}</p>
            </div>
            <p class="subheading-info mt-5 mb-3 h4 text-primary">Booking Information</p>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Number of Pax:</p>
              <p class="input-style m-0">${data.pax}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Term Rate:</p>
              <p class="input-style m-0">${data.term_rate_desc}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Booking Start Date:</p>
              <p class="input-style m-0">${data.booking_date}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Booking End Date:</p>
              <p class="input-style m-0">${data.end_date_label}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Start Time:</p>
              <p class="input-style m-0">${data.start_time}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">End Time:</p>
              <p class="input-style m-0">${data.end_time}</p>
            </div>
            ${endTimeHtml}
            <div class="d-flex align-items-center justify-content-between mb-5">
              <p class="chromaphobic mt-5">Estimated Total Amount:</p>
              <p id="totalRate" class="amount-style mt-5">${totalAmount}</p>
            </div>
            <div class="mt-5">
              <p class="caution-style mt-5 mb-3">You can check the status, cancel, and re-schedule your booking at INQUIRY page under BOOKING and click "Check Booking Status".</p>
              <p class="caution-style m-0 fst-italic">*Cancellation of booking shall be done 24 hours before your booking date and time. </p>
              <p class="caution-style m-0 fst-italic">*Rescheduling of booking shall be done not later than 1 hour of your booking schedule.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-5 text-center">
          <div class="card-body bg-light p-4 rounded d-flex flex-column justify-content-center">
            <div class="d-flex align-items-center border-bottom border-black">
              <h2 class="summary-heading text-uppercase mb-5 fw-bold text-primary">Payment Summary</h2>
            </div>
            <div class="divider-line"></div>
            <div class="d-flex align-items-center justify-content-between mt-5">
              <p class="chromaphobic m-0">Term Rate:</p>
              <p class="input-style m-0">${data.term_rate_desc}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Total Hours:</p>
              <p class="input-style m-0">${totalHoursText}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0"># of Pax:</p>
              <p class="input-style m-0">${data.pax}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-5 border-bottom border-black pb-5">
              <p class="chromaphobic m-0">Voucher:</p>
              <p class="input-style m-0">${data.voucher}</p>
            </div>
            <div class="divider-line"></div>
            <div class="d-flex align-items-center justify-content-between mb-5">
              <p class="chromaphobic mt-5">Amount to Pay</p>
              <p class="amount-style mt-5 text-primary">${totalAmount}</p>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center mt-3">
              <button id="reschedule-btn" class="reschedule-btn btn-warning col-12 col-sm-8 col-md-6 mt-3 mb-2 btn-fluid" type="button" data-reference="${data.reference_number}">
                <span class="btn btn-style text-uppercase">Re-schedule</span>
              </button>     
            </div>
          </div>
        </div>
      </div>
    </div>`
      :
    data.status === "Cancelled"
      ? `<div class="container-fluid mb-3">
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="card-body bg-light p-4 rounded position-relative d-flex flex-column h-100">
            <div class="d-flex align-items-center">
              <img src="../assets/img/booking-form/check-icon.svg" width="35" height="30" class="pe-2" alt="Image">
              <h2 class="style-confirmed text-uppercase">BOOKING ${data.status}</h2>
            </div>
            <p class="reference-num">REFERENCE #: ${data.reference_number}</p>
            <div class="divider-line"></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p class="caution-style mb-3">Your booking has been cancelled.</p>
            <p class="caution-style m-0 fst-italic">You can reschedule your booking by clicking the reschedule button.</p>
          </div>
        </div>
        <div class="col-12 col-md-5 text-center">
          <div class="card-body bg-light p-4 rounded position-relative btn-container d-flex flex-column justify-content-center h-100">
            <button id="reschedule-btn" class="reschedule-btn col-12 col-sm-8 col-md-10 mx-auto" type="button" data-reference="${data.reference_number}">
              <span class="btn btn-style text-uppercase">Re-schedule</span>
            </button>
          </div>
        </div>
      </div>
    </div>`
      : `<div class="mb-5">
      <div class="row">
        <div class="col-12 col-lg-7 mb-4"> 
          <div class="card-body bg-light p-4 rounded position-relative h-100" >
            <div class="d-flex align-items-center">
              <img src="../assets/img/booking-form/check-icon.svg" width="35" height="30" class="pe-2" alt="Image">
              <h2 class="style-confirmed text-uppercase text-success fw-bold">BOOKING ${data.status}</h2>
            </div>
            <p class="reference-num border-bottom border-black text-primary">REFERENCE #: ${data.reference_number}</p>
            <div class="divider-line"></div>
            <p class="subheading-info mt-3 mb-3 text-primary h4">Personal Information</p>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Name:</p>
              <p class="input-style m-0">${data.fullname}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Email Address:</p>
              <p class="input-style m-0">${data.email}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Contact Number:</p>
              <p class="input-style m-0">(+63) ${data.number}</p>
            </div>
            <p class="subheading-info mt-4 mb-3 h4 text-primary">Booking Information</p>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Number of Pax:</p>
              <p class="input-style m-0">${data.pax}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Term Rate:</p>
              <p class="input-style m-0">${data.term_rate_desc}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Booking Start Date:</p>
              <p class="input-style m-0">${data.booking_date}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Booking End Date:</p>
              <p class="input-style m-0">${data.end_date_label}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">Start Time:</p>
              <p class="input-style m-0">${data.start_time}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic m-0">End Time:</p>
              <p class="input-style m-0">${data.end_time}</p>
            </div>
            ${endTimeHtml}
            <div class="d-flex align-items-center justify-content-between">
              <p class="chromaphobic mt-2">Estimated Total Amount:</p>
              <p id="totalRate" class="amount-style mt-2">${totalAmount}</p>
            </div>
            <div>
              <p class="caution-style">You can check the status, cancel, and re-schedule your booking at INQUIRY page under BOOKING and click "Check Booking Status".</p>
              <p class="caution-style m-0 fst-italic">*Cancellation of booking shall be done 24 hours before your booking date and time. </p>
              <p class="caution-style m-0 fst-italic">*Rescheduling of booking shall be done not later than 1 hour of your booking schedule.</p>
            </div>
          </div>
        </div>
        
<div class="col-12 col-lg-5 mb-4">
  <div class="card-body bg-light p-4 rounded mb-4 d-flex flex-column justify-content-between">
    <div>
      <div class="d-flex align-items-center border-bottom border-black">
        <h2 class="summary-heading text-uppercase mb-5 fw-bold text-primary">Payment Summary</h2>
      </div>
      <div class="divider-line"></div>
      <div class="d-flex align-items-center justify-content-between mt-5">
        <p class="chromaphobic m-0">Term Rate:</p>
        <p class="input-style m-0">${data.term_rate_desc}</p>
      </div>
      <div class="d-flex align-items-center justify-content-between">
        <p class="chromaphobic m-0">Total Hours:</p>
        <p class="input-style m-0">${totalHoursText}</p>
      </div>
      <div class="d-flex align-items-center justify-content-between">
        <p class="chromaphobic m-0"># of Pax:</p>
        <p class="input-style m-0">${data.pax}</p>
      </div>
      <div class="d-flex align-items-center justify-content-between mb-5 border-bottom border-black pb-5">
        <p class="chromaphobic m-0">Voucher:</p>
        <p class="input-style m-0">${data.voucher}</p>
      </div>
      <div class="divider-line"></div>
      <div class="d-flex align-items-center justify-content-between">
        <p class="chromaphobic mt-5">Amount to Pay</p>
        <p class="amount-style mt-5 text-primary">${totalAmount}</p>
      </div>
    </div>
    <div class="grid gap-3 d-flex justify-content-center flex-row mt-3">
      <button type="button" class="text-white btn-style text-uppercase g-col-6 p-2" onclick="handleOverTheCounterClick()">Over the Counter</button>
      <button type="button" class="text-white btn-style text-uppercase g-col-6 p-2" onclick="handleGCashClick()">GCash</button>
    </div>
  </div>
  
  <div class="card-body bg-light p-4 rounded d-flex flex-column justify-content-center">
    <div class="grid gap-3 d-flex flex-row justify-content-center">
      <button id="reschedule-btn" class="text-uppercase reschedule-btn btn-warning text-white g-col-6 p-2" type="button" data-reference="${data.reference_number}">
        Re-schedule
      </button>
      <button id="cancel-btn" class="text-uppercase cancel-btn btn-danger g-col-6 p-2" onclick="cancelBooking(${data.reference_number})" type="button">
        Cancel
      </button>
    </div>
  </div>
</div>`;

  bookingInfo.innerHTML = htmlOutput;
  console.log(termRateAmount);
  console.log(daysCount);
  console.log(totalAmount);

  document
    .getElementById("reschedule-btn")
    .addEventListener("click", function () {
      var referenceNumber = this.getAttribute("data-reference");

      window.location.href = "../booking/?reference=" + referenceNumber;
    });
}

async function handleGCashClick() {
  const paymentModal = document.getElementById("paymentModal");
  const paymentResultModal = document.getElementById("paymentResultModal");
  const closeBtns = document.getElementsByClassName("close-btn");
  const confirmPaymentBtn = document.getElementById("confirmPaymentBtn");
  const cancelPaymentBtn = document.getElementById("cancelPaymentBtn");
  const closeResultBtn = document.getElementById("closeResultBtn");
  const paymentResultTitle = document.getElementById("paymentResultTitle");
  const paymentResultMessage = document.getElementById("paymentResultMessage");

  paymentModal.style.display = "block";

  for (let i = 0; i < closeBtns.length; i++) {
    closeBtns[i].onclick = function() {
      paymentModal.style.display = "none";
      paymentResultModal.style.display = "none";
    };
  }

  window.onclick = function(event) {
    if (event.target == paymentModal) {
      paymentModal.style.display = "none";
    } else if (event.target == paymentResultModal) {
      paymentResultModal.style.display = "none";
    }
  };

  confirmPaymentBtn.onclick = async function() {
    paymentModal.style.display = "none";
  
    // Simulate a call to the GCash payment API
    const simulateGCashPayment = () => {
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve({ success: true }); 
        }, 2000); 
      });
    };
  
    try {
      const result = await simulateGCashPayment();
  
      if (result.success) {
        paymentResultTitle.textContent = "Payment Received";
        paymentResultMessage.textContent = "Your payment was successful.";
      } else {
        paymentResultTitle.textContent = "Payment Failed";
        paymentResultMessage.textContent = "Cancelled. Please try again.";
      }
    } catch (error) {
      paymentResultTitle.textContent = "Payment Failed";
      paymentResultMessage.textContent = "There was an issue with your payment. Please try again.";
    }
  
    paymentResultModal.style.display = "block";
  };

  cancelPaymentBtn.onclick = function() {
    paymentModal.style.display = "none";
    paymentResultTitle.textContent = "Payment Cancelled";
    paymentResultMessage.textContent = "Your payment was cancelled.";
    paymentResultModal.style.display = "block";
  };

  closeResultBtn.onclick = function() {
    paymentResultModal.style.display = "none";
    window.location.href = window.location.href; 
  };

  const paymentButtonsContainer = document.createElement('div');
  paymentButtonsContainer.className = 'd-flex justify-content-between mt-3';
  paymentButtonsContainer.innerHTML = `
    <button id="confirmPaymentBtn" class="btn btn-success">Confirm</button>
    <button id="cancelPaymentBtn" class="btn btn-danger">Cancel</button>
  `;
  paymentModal.querySelector('.modal-body').appendChild(paymentButtonsContainer);

  // Place the URL for the GCash payment API here
  // const gcashPaymentUrl = "https://your-gcash-payment-api-url.com";
}

function handleOverTheCounterClick() {
  Swal.fire({
    title: "Payment Over the Counter",
    text: "Please proceed to the counter to complete your payment.",
    icon: "info",
    confirmButtonText: "OK",
  }).then(() => {
    window.location.href = window.location.href; 
  });
}

async function cancelBooking(referenceNumber) {
  console.log("Cancel button clicked. Reference number:", referenceNumber); // Debugging log

  // Ask for confirmation
  if (confirm("Are you sure you want to cancel this booking?")) {
    try {
      const formData = new FormData();
      formData.append("reference_number", referenceNumber);
      formData.append("action", "cancelBooking");

      const response = await fetch("../data/load.php?action=cancelBooking", {
        method: "POST",
        body: formData,
        headers: {
          Accept: "application/json",
        },
      });

      const result = await response.json();
      console.log("Cancel booking response:", result); // Debugging log

      if (result.success) {
        showCustomAlert(
          "Booking has been cancelled successfully.",
          function () {
            location.reload();
          }
        );
        // Optionally, update the UI here to reflect the cancellation
      } else {
        showCustomAlert("Failed to cancel the booking: " + result.message);
      }
    } catch (error) {
      console.error("Error cancelling booking:", error);
      showCustomAlert(
        "An error occurred while cancelling the booking. Please try again later."
      );
    }
  }
}

function getTermRateAmount(termDescription) {
  console.log("Term Description:", termDescription); // Debugging log
  switch (
    String(termDescription) // Ensure termDescription is a string
  ) {
    case "0":
      return "75";
    case "1":
      return "249";
    case "2":
      return "995";
    case "3":
      return "3600";
    default:
      return "20";
  }
}
