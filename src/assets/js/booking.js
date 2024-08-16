let myCarousel = document.getElementById("carouselExample");
let prevButton = document.getElementById("prevButton");
let nextButton = document.getElementById("nextButton");
let termRateDropdown = document.getElementById("term_rate");
let paymentMethodDropdown = document.getElementById("payment_method");
let endTimeField = document.querySelector("input[name='end_time']").parentNode;
let endTimeReview = document.querySelector(
  "#bookingReviewForm input[name='end_time']"
).parentNode;
let endDateField = document.querySelector(
  "input[name='end_date_label']"
).parentNode;
let endDateReview = document.querySelector(
  "#bookingReviewForm input[name='end_date_label']"
).parentNode;

function initializeEndDateCalculation() {
  const termRateSelect = document.getElementById("term_rate");
  const bookingDateInput = document.getElementById("booking_date");
  const endDateInput = document.getElementById("end_date_label");

  function calculateEndDate() {
    const termRate = termRateSelect.value;
    const bookingDate = new Date(bookingDateInput.value);

    if (!bookingDate || isNaN(bookingDate.getTime())) {
      endDateInput.value = "";
      return;
    }

    let endDate = new Date(bookingDate);

    switch (termRate) {
      case '0': // Hourly
        endDate.setHours(endDate.getHours() + 1);
        break;
      case "1":
        let daysCount = 0;
        while (daysCount < 7) {
          endDate.setDate(endDate.getDate() + 1);
          const dayOfWeek = endDate.getDay();
          if (dayOfWeek !== 0 && dayOfWeek !== 6) {
            daysCount++;
          }
        }
        break;
      case "2":
        for (let i = 0; i < 7; i++) {
          endDate.setDate(endDate.getDate() + 1);
          if (endDate.getDay() === 0 || endDate.getDay() === 6) {
            i--;
          }
        }
        break;
      case "3":
        endDate.setMonth(endDate.getMonth() + 1);
        break;
    }
    endDateInput.value = endDate.toISOString().split("T")[0];
  }

  termRateSelect.addEventListener("change", calculateEndDate);
  bookingDateInput.addEventListener("change", calculateEndDate);

  // Populate the form with fetched data
  if (typeof end_date_label !== "undefined") {
    endDateInput.value = end_date_label;
  }
}

// Toggle end time visibility based on term rate
function toggleEndTimeVisibility() {
  console.log("hello");
  var selectedValue = termRateDropdown.value;
  var endDateInput = endDateField.querySelector('input[name="end_date_label"]');

  if (selectedValue === "1") {
    endTimeField.style.display = "none";
    endTimeReview.style.display = "none";
    endDateField.style.display = "block";
    endDateReview.style.display = "block";
    endDateField.querySelector(
      'input[name="end_date_label"]'
    ).style.backgroundColor = "white";
    endDateInput.removeAttribute("disabled");
  } else if (selectedValue === "2" || selectedValue === "3") {
    endTimeField.style.display = "none";
    endTimeReview.style.display = "none";
    endDateField.style.display = "block";
    endDateReview.style.display = "block";
    endDateField.querySelector(
      'input[name="end_date_label"]'
    ).style.backgroundColor = "#EEEEEE";
    endDateInput.setAttribute("disabled", "disabled");
  } else {
    endTimeField.style.display = "block";
    endTimeReview.style.display = "block";
    endDateField.style.display = "none";
    endDateReview.style.display = "none";
  }
}

termRateDropdown.addEventListener("change", toggleEndTimeVisibility);
toggleEndTimeVisibility();
// Initially set the correct visibility
// Toggle end time visibility based on term rate
let onsite_payment;
function togglePaymentVisibility() {
  console.log("hello");
  var selectedValue = paymentMethodDropdown.value;
  if (selectedValue === "1") {
    onsite_payment = true;
    console.log(onsite_payment);
  } else {
    onsite_payment = false;
    console.log(onsite_payment);
  }
}
paymentMethodDropdown.addEventListener("change", togglePaymentVisibility);
togglePaymentVisibility(); 

document.addEventListener("DOMContentLoaded", function () {
  const termRateDropdown = document.getElementById("term_rate");
  const termRate = termRateDropdown ? termRateDropdown.value : null;
  console.log(termRate);
  initializeEndDateCalculation();

  if (myCarousel && prevButton && nextButton) {
    const bookingReview = document.getElementById("bookingReviewForm");
    myCarousel.addEventListener("slid.bs.carousel", function () {
      const carouselInner = this.querySelector(".carousel-inner");
      const activeItem = carouselInner.querySelector(".carousel-item.active");
      const carouselItems = Array.from(carouselInner.children);

      if (activeItem === carouselItems[0]) {
        prevButton.style.display = "none";
      } else {
        prevButton.style.display = "block";
        nextButton.innerHTML = `<span class="btn next-button" aria-hidden="true">Next</span>`;
      }

      // Check if the active item is the last item
      if (carouselItems.indexOf(activeItem) === 3) {
        let proceedButton = document.getElementById("proceedButton");
        let updateButton = document.getElementById("updateButton");

        if (proceedButton) {
          // Add event listener only if the button exists
          proceedButton.addEventListener("click", function (event) {
            if (validateForms() && validateAgreementCheckbox()) {
              submitBooking(event);
            }
            console.log("submit booking");
          });
        } else {
          updateButton.addEventListener("click", function (event) {
            if (validateForms() && validateAgreementCheckbox()) {
              submitUpdateBooking(event);
            }
          });
        }
      } else {
        // Enable next button
        nextButton.disabled = false;
      }
    });

    function updateBookingReviewForm() {
      const carouselItems = document.querySelectorAll(
        ".carousel-item:not(:nth-child(4)) input, .carousel-item:not(:nth-child(4)) textarea, .carousel-item:not(:nth-child(4)) select"
      );
      const reviewInputs = bookingReview.querySelectorAll(
        "input, textarea, select"
      );
      carouselItems.forEach(function (input, index) {
        reviewInputs[index].value = input.value;
      });
    }

    let carouselInputs = document.querySelectorAll(
      ".carousel-item:not(:nth-child(4)) input, .carousel-item:not(:nth-child(4)) textarea, .carousel-item:not(:nth-child(4)) select"
    );
    carouselInputs.forEach(function (input) {
      input.addEventListener("input", updateBookingReviewForm);
    });
  }
});

function validateForms() {
  const isEndTimeRequired = termRateDropdown.value === "0";
  const inputs = document.querySelectorAll(
    "#carouselExample input:not([type=hidden]), #carouselExample select"
  );
  const bookingMessage = document.getElementById("bookingMessage");

  // Clear any previous messages
  bookingMessage.textContent = "";

  for (const input of inputs) {
    // Skip 'end_time' validation if not required
    if (input.name === "end_time" && !isEndTimeRequired) {
      continue;
    }
    // Skip voucher code validation
    if (input.name === "voucher") {
      continue;
    }
    // Check if input is required and not filled
    if (input.required && !input.value.trim()) {
      bookingMessage.textContent = `All fields must be filled out.`;
      input.focus();
      return false; // Invalid form
    }
    // Check if the input has been marked as invalid and display specific error message
    if (input.dataset.isValid && input.dataset.isValid === "false") {
      // Assume each input has a corresponding errorElement id in the format 'inputNameError'
      const errorElementId = input.name + "Error";
      const errorElement = document.getElementById(errorElementId);
      if (errorElement && errorElement.textContent) {
        bookingMessage.textContent = errorElement.textContent;
      } else {
        bookingMessage.textContent =
          "Please correct the errors in your form entries.";
      }
      input.focus();
      return false; // Invalid form due to failed custom validation
    }
  }

  // Return true if all required inputs are valid
  return true;
}

function validateAgreementCheckbox() {
  const agreementCheckbox = document.getElementById("agreementCheckbox");
  const bookingMessage = document.getElementById("bookingMessage");

  if (!agreementCheckbox.checked) {
    bookingMessage.textContent =
      "Please agree to the Terms and Conditions before proceeding.";
    agreementCheckbox.focus();
    return false;
  }

  bookingMessage.textContent = ""; // Clear any error messages if the checkbox is checked
  return true;
}

function validateEmail(element) {
  console.log("validateEmail function called.");
  const value = element.value;
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  const errorElement = document.getElementById("emailError");

  if (!emailRegex.test(value)) {
    errorElement.textContent = "Please enter a valid email address.";
    errorElement.style.display = "block";
    element.dataset.isValid = "false"; // Mark the input as invalid
  } else {
    errorElement.textContent = "";
    errorElement.style.display = "none";
    element.dataset.isValid = "true"; // Mark the input as valid
  }
}

function validateNumber(element) {
  console.log("validateNumber function called.");
  const value = element.value;
  const validValue = value
    .replace(/[^0-9+]/g, "")
    .replace(/(^\+?63)|(\d{10}).*/g, "$1$2");

  if (value !== validValue) {
    element.value = validValue;
    showError("Please enter a valid contact number.");
    element.dataset.isValid = "false"; // Mark the input as invalid
  } else {
    hideError();
    element.dataset.isValid = "true"; // Mark the input as valid
  }

  element.selectionStart = element.selectionEnd = Math.min(
    element.selectionStart,
    validValue.length
  );
}

function checkNumberLength(element) {
  console.log("checkNumberLength function called.");
  const value = element.value.replace(/^\+63/, "");
  if (value.length !== 10) {
    showError("Please enter a valid contact number.");
    element.dataset.isValid = "false"; // Mark the input as invalid
  } else {
    hideError();
    element.dataset.isValid = "true"; // Mark the input as valid
  }
}

function showError(message) {
  const errorElement = document.getElementById("numberError");
  errorElement.textContent = message;
  errorElement.style.display = "block";
}

function hideError() {
  if (document.getElementById("numberError").style.display === "block") {
    document.getElementById("numberError").textContent = "";
    document.getElementById("numberError").style.display = "none";
  }
}

document.getElementById("number").addEventListener("input", function () {
  validateNumber(this);
});

document.getElementById("number").addEventListener("blur", function () {
  checkNumberLength(this);
});

// Booking Form Submission
let modalShown = false; // Flag to track if the success modal has already been displayed

async function submitBooking(event) {
  console.log(onsite_payment);
  event.preventDefault(); // Prevent default form submission behavior
  console.log("submitBooking function called"); // Debugging statement

  let form1 = document.getElementById("persnalInfoForm");
  let form2 = document.getElementById("detailsPriceForm");
  let form3 = document.getElementById("detailsPaymentForm");

  let formData1 = new FormData(form1);
  let formData2 = new FormData(form2);
  let formData3 = new FormData(form3);

  formData1.append("action", "processBooking");
  formData2.append("action", "processBooking");
  formData3.append("action", "processBooking");

  // Combine FormData objects into a single FormData object
  let combinedFormData = new FormData();

  for (let pair of formData1.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  for (let pair of formData2.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  for (let pair of formData3.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  // Append end_date_label to the combined FormData
  const endDateLabel = document.getElementById("end_date_label").value;
  combinedFormData.append("end_date_label", endDateLabel);

  try {
    const response = await fetch("../data/submit.php", {
      method: "POST",
      body: combinedFormData,
    });
    const data = await response.json();
    if (data.status && !modalShown) {
      // Check if the modal has not been shown already
      modalShown = true; // Set the flag to true after showing the modal for the first time
      const referenceNumber = getCookie("referenceNumber");
      if (onsite_payment) {
        successModal(
          "Success!",
          "Booking successful! Please check your email for payment instructions",
          callback_prev_page
        );
      } else {
        successModal(
          "Success!",
          `Booking successful! You may now check your booking status with the Reference Number: <span style="color: blue;">${referenceNumber}</span>`,
          function() {
            setCookie("referenceNumber", referenceNumber, 7); // Save reference number for 7 days
            setCookie("email", document.querySelector('input[name="email"]').value, 7); // Save email for 7 days
            window.location.href = "../check-status/index.php";
          }
        );
      }
    } else if (!data.status) {
      document.getElementById("bookingMessage").textContent = data.message; // Show error message from server
    }
  } catch (error) {
    console.error("Error processing booking:", error);
    document.getElementById("bookingMessage").textContent =
      "Error processing your booking. Please try again.";
  }
  console.log("submitBooking function completed"); // Debugging statement
}

// Booking Form Update
async function submitUpdateBooking(event) {
  event.preventDefault(); // Prevent default form submission behavior
  console.log("updateBooking function called"); // Debugging statement

  // Directly fetch the reference number from the URL
  const queryParams = new URLSearchParams(window.location.search);
  const referenceNumber = queryParams.get("reference");

  if (!referenceNumber) {
    console.error("Reference number is missing.");
    return;
  }

  // Assume email is still provided by a form input or is part of user session information
  const emailElement = document.querySelector('input[name="email"]');
  const email = emailElement ? emailElement.value : null;

  if (!email) {
    console.error("Email field is missing.");
    return;
  }

  let form1 = document.getElementById("persnalInfoForm");
  let form2 = document.getElementById("detailsPriceForm");
  let form3 = document.getElementById("detailsPaymentForm");

  let formData1 = new FormData(form1);
  let formData2 = new FormData(form2);
  let formData3 = new FormData(form3);

  // Append actions and identifiers to FormData
  formData1.append("action", "updateBooking");
  formData2.append("action", "updateBooking");
  formData3.append("action", "updateBooking");
  formData1.append("email", email); // Include email in the FormData
  formData1.append("referenceNumber", referenceNumber); // Include reference number in the FormData

  // Combine FormData objects into a single FormData object
  let combinedFormData = new FormData();

  for (let pair of formData1.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  for (let pair of formData2.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  for (let pair of formData3.entries()) {
    combinedFormData.append(pair[0], pair[1]);
  }

  try {
    const response = await fetch("../data/submit.php", {
      method: "POST",
      body: combinedFormData,
    });
    const data = await response.json();
    if (data.status) {
      // Check for a successful update
      successModal(
        "Success!",
        "Booking updated successfully! Proceeding to confirmation.",
        callback_prev_page
      );
    } else {
      document.getElementById("bookingMessage").textContent = data.message; // Show error message from server
    }
  } catch (error) {
    console.error("Error updating booking:", error);
    document.getElementById("bookingMessage").textContent =
      "Error updating your booking. Please try again.";
  }
  console.log("updateBooking function completed"); // Debugging statement
}

// a callback function to redirect user if booking is successful
const callback = () => {
  const booking_btn = document.querySelector(".booking-btn");
  booking_btn.click();
};

const callback_prev_page = () => {
  window.history.back();
};

const submitProofOfPayment = async () => {
  const fileInput = document.getElementById("payment_img");
  const file = fileInput.files[0];

  if (!file || !file.type.match("image.*")) {
    alert.blincph("Please select a valid image");
    return;
  }

  const formData = new FormData();
  formData.append("payment_img", file);
  formData.append("action", "processPoP");

  try {
    const response = await fetch("../data/submit.php", {
      method: "POST",
      body: formData,
    });

    if (response.ok) {
      const data = await response.json();
      if (data.status) {
        console.log("submitted image");
        successModal(
          "Success!",
          "Please await confirmation of your booking. You will receive an email notification from us.",
          callback_prev_page
        );
      } else if (!data.status) {
        document.getElementById("bookingMessage2").textContent = data.message; // Show error message from server
      }
    } else {
      throw new Error("Network response was not ok.");
    }
  } catch (error) {
    console.error("Fetch Error:", error);
  }
};

let payment_proof_btn = document.getElementById("payment_proof_btn");
payment_proof_btn.addEventListener("click", submitProofOfPayment);

function updateHiddenFields() {
  const bookingId = getCookie("referenceNumber"); // Make sure 'referenceNumber' matches the name of the cookie set in PHP
  console.log("Booking ID:", bookingId); // Debugging line
  if (bookingId) {
    document.getElementById("hiddenBookingId").value = bookingId;
  } else {
    console.error("Booking ID cookie not found.");
  }
}

function getCookie(name) {
  let cookieArray = document.cookie.split(";");
  for (let i = 0; i < cookieArray.length; i++) {
    let cookie = cookieArray[i].trim();
    if (cookie.indexOf(name + "=") == 0) {
      return cookie.substring((name + "=").length, cookie.length);
    }
  }
  return null;
}

async function submitPayment() {
  try {
    var form = document.getElementById("paymentForm");
    var formData = new FormData(form);
    formData.append("email", getCookie("email"));
    formData.append("bookingid", getCookie("referenceNumber")); // Ensure consistency in naming

    formData.append("action", "choosePackage");
    for (let entry of formData.entries()) {
      console.log(entry[0], entry[1]); // For debugging
    }

    const response = await fetch("../data/submit.php", {
      method: "POST",
      body: formData,
      credentials: "include", // Ensures that cookies are sent with the request
    });

    const data = await response.json();
    if (data.status) {
      successModal("Success!", "Package selection successful. Pay Now."); // Updated to use successModal with new message
    } else {
      document.getElementById("paymentMessage").textContent =
        "Error: " + data.message;
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
}

(async function () {
  try {
    // Fetch Disabled Dates for the Booking Date Input
    const response = await fetch("../data/submit.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "action=fetchDisabledDates",
    });
    const data = await response.json();

    // Initialize Flatpickr for Booking Date with fetched disabled dates
    if (data.status) {
      const disabledDates = data.disabledDates.map((date) => new Date(date));
      flatpickr("input[name='booking_date']", {
        dateFormat: "Y-m-d",
        disable: disabledDates,
        minDate: "today",
      });
      flatpickr("input[name='end_date_label']", {
        dateFormat: "Y-m-d",
        disable: disabledDates,
        minDate: "today",
      });
    } else {
      console.error("Failed to fetch disabled dates:", data.message);
      // Optionally initialize with defaults if fetch fails
      flatpickr("input[name='booking_date']", {
        dateFormat: "Y-m-d",
        minDate: "today",
      });
    }

    // Initialize Flatpickr for Date of Birth without disabled dates
    flatpickr("input[name='dob']", {
      dateFormat: "Y-m-d",
    });
  } catch (error) {
    console.error("Error fetching disabled dates:", error);
    // Initialize both inputs with default settings if error occurs
    flatpickr("input[name='booking_date']", {
      dateFormat: "Y-m-d",
      minDate: "today",
    });
    flatpickr("input[name='dob']", {
      dateFormat: "Y-m-d",
      defaultDate: "1990-01-01",
    });
  }
})();

// Function to set a cookie
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
