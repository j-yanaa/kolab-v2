let myCarousel = document.getElementById('carouselExample');
let prevButton = document.getElementById('prevButton');
let nextButton = document.getElementById('nextButton');

document.addEventListener('DOMContentLoaded', function() {
//Update Inquiry Review Form Carousel
    if (myCarousel && prevButton && nextButton) {
        const inquiryReview = document.getElementById('inquiryReviewForm');
        myCarousel.addEventListener('slid.bs.carousel', function() {
            const carouselInner = this.querySelector('.carousel-inner');
            const activeItem = carouselInner.querySelector('.carousel-item.active');
            const carouselItems = Array.from(carouselInner.children);

            if (activeItem === carouselItems[0]) {
                prevButton.style.display = 'none';
            } else {
                prevButton.style.display = 'block';
                nextButton.innerHTML = `<span class="btn next-button" aria-hidden="true">Next</span>`;
            }

            // Check if the active item is the last item
            if (carouselItems.indexOf(activeItem) === 3) {
                let proceedButton = document.getElementById('proceedButton');

                if (proceedButton) {
                    // Add event listener only if the button exists
                    proceedButton.addEventListener('click', function(event) {
                        if (validateForms() && validateAgreementCheckbox()) {
                            submitInquiry(event);
                        }
                        console.log("submit inquiry");
                    });
                }                       
            } else {
                // Enable next button
                nextButton.disabled = false;
            }
        });

        function updateInquiryReviewForm() {
            const carouselItems = document.querySelectorAll('.carousel-item:not(:nth-child(4)) input, .carousel-item:not(:nth-child(4)) textarea, .carousel-item:not(:nth-child(4)) select');
            const reviewInputs = inquiryReview.querySelectorAll('input, textarea, select');
            carouselItems.forEach(function(input, index) {
                reviewInputs[index].value = input.value;
            });
        }

        let carouselInputs = document.querySelectorAll('.carousel-item:not(:nth-child(4)) input, .carousel-item:not(:nth-child(4)) textarea, .carousel-item:not(:nth-child(4)) select');
        carouselInputs.forEach(function(input) {
            input.addEventListener('input', updateInquiryReviewForm);
        });

    }
});

function validateForms() {
    const inputs = document.querySelectorAll('#carouselExample input:not([type=hidden]), #carouselExample select');
    const inquiryMessage = document.getElementById('inquiryMessage');

    // Clear any previous messages
    inquiryMessage.textContent = '';

    for (const input of inputs) {
        // Skip 'end_time' validation if not required

        // Skip voucher code validation
        if (input.name === 'voucher') {
            continue;
        }
        // Check if input is required and not filled
        if (input.required && !input.value.trim()) {
            inquiryMessage.textContent = `All fields must be filled out.`;
            input.focus();
            return false; // Invalid form
        }
        // Check if the input has been marked as invalid and display specific error message
        if (input.dataset.isValid && input.dataset.isValid === 'false') {
            // Assume each input has a corresponding errorElement id in the format 'inputNameError'
            const errorElementId = input.name + 'Error';
            const errorElement = document.getElementById(errorElementId);
            if (errorElement && errorElement.textContent) {
                inquiryMessage.textContent = errorElement.textContent;
            } else {
                inquiryMessage.textContent = 'Please correct the errors in your form entries.';
            }
            input.focus();
            return false; // Invalid form due to failed custom validation
        }
    }

    // Return true if all required inputs are valid
    return true;
}

function validateAgreementCheckbox() {
    const agreementCheckbox = document.getElementById('agreementCheckbox');
    const inquiryMessage = document.getElementById('inquiryMessage');

    if (!agreementCheckbox.checked) {
        inquiryMessage.textContent = 'Please agree to the Terms and Conditions before proceeding.';
        agreementCheckbox.focus();
        return false;
    }

    inquiryMessage.textContent = ''; // Clear any error messages if the checkbox is checked
    return true;
}

function validateEmail(element) {
    console.log("validateEmail function called.");
    const value = element.value;
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const errorElement = document.getElementById('emailError');

    if (!emailRegex.test(value)) {
        errorElement.textContent = 'Please enter a valid email address.';
        errorElement.style.display = 'block';
        element.dataset.isValid = 'false'; // Mark the input as invalid
    } else {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
        element.dataset.isValid = 'true'; // Mark the input as valid
    }
}

function validateNumber(element) {
    console.log("validateNumber function called.");
    const value = element.value;
    const validValue = value.replace(/[^0-9+]/g, '').replace(/(^\+?63)|(\d{10}).*/g, '$1$2');

    if (value !== validValue) {
        element.value = validValue;
        showError('Please enter a valid contact number.');
        element.dataset.isValid = 'false'; // Mark the input as invalid
    } else {
        hideError();
        element.dataset.isValid = 'true'; // Mark the input as valid
    }

    element.selectionStart = element.selectionEnd = Math.min(element.selectionStart, validValue.length);
}

function checkNumberLength(element) {
    console.log("checkNumberLength function called.");
    const value = element.value.replace(/^\+63/, '');
    if (value.length !== 10) {
        showError('Please enter a valid contact number.');
        element.dataset.isValid = 'false'; // Mark the input as invalid
    } else {
        hideError();
        element.dataset.isValid = 'true'; // Mark the input as valid
    }
}

function showError(message) {
    const errorElement = document.getElementById('numberError');
    errorElement.textContent = message;
    errorElement.style.display = 'block';
}

function hideError() {
    if (document.getElementById('numberError').style.display === 'block') {
        document.getElementById('numberError').textContent = '';
        document.getElementById('numberError').style.display = 'none';
    }
}

document.getElementById('number').addEventListener('input', function() {
    validateNumber(this);
});

document.getElementById('number').addEventListener('blur', function() {
    checkNumberLength(this);
});

// Inquiry Form Submission 
let modalShown = false;  // Flag to track if the success modal has already been displayed

async function submitInquiry(event) {
    event.preventDefault();  // Prevent default form submission behavior
    console.log('submitInquiry function called'); // Debugging statement

    let form1 = document.getElementById('persnalInfoForm');
    let form2 = document.getElementById('detailsEventForm');
    let form3 = document.getElementById('addDetailsForm');

    let formData1 = new FormData(form1);
    let formData2 = new FormData(form2);
    let formData3 = new FormData(form3);
    
    formData1.append('action', 'processInquiry');
    formData2.append('action', 'processInquiry');
    formData3.append('action', 'processInquiry');

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
        const response = await fetch('../data/submit.php', {
            method: 'POST',
            body: combinedFormData
        });
        const data = await response.json();
        if (data.status && !modalShown) {  // Check if the modal has not been shown already
            modalShown = true;  // Set the flag to true after showing the modal for the first time
            successModal('Success!', 'Inquiry sent successfully! Please wait for an email response.', callback_prev_page);
        } else if (!data.status) {
            document.getElementById('inquiryMessage').textContent = data.message; // Show error message from server
        }
    } catch (error) {
        console.error('Error processing inquiry:', error);
        document.getElementById('inquiryMessage').textContent = 'Error processing your inquiry. Please try again.';
    }
    console.log('submitInquiry function completed'); // Debugging statement
}


// a callback function to redirect user if inquiry is successful
const callback = () => {
    const inquiry_btn = document.querySelector(".inquiry-btn");
	inquiry_btn.click();
};

const callback_prev_page = () => {
    window.history.back();
}


function updateHiddenFields() {
    const inquiryId = getCookie('inquiryNumber'); // Make sure 'referenceNumber' matches the name of the cookie set in PHP
    console.log('Inquiry ID:', inquiryId); // Debugging line
    if (inquiryId) {
        document.getElementById('hiddenInquiryId').value = inquiryId;
    } else {
        console.error('Inquiry ID cookie not found.');
    }
}

function getCookie(name) {
    let cookieArray = document.cookie.split(';');
    for(let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i].trim();
        if (cookie.indexOf(name + '=') == 0) {
            return cookie.substring((name + '=').length, cookie.length);
        }
    }
    return null;
}

(async function() {
    try {
        // Fetch Disabled Dates for the Inquiry Date Input
        const response = await fetch('../data/submit.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=fetchDisabledDates'
        });
        const data = await response.json();

        // Initialize Flatpickr for Inquiry Date with fetched disabled dates
        if (data.status) {
            const disabledDates = data.disabledDates.map(date => new Date(date));
            flatpickr("input[name='event_date']", {
                dateFormat: "Y-m-d",
                disable: disabledDates,
                minDate: "today",
            });
        } else {
            console.error('Failed to fetch disabled dates:', data.message);
            // Optionally initialize with defaults if fetch fails
            flatpickr("input[name='event_date']", {
                dateFormat: "Y-m-d",
                minDate: "today",
            });
        }
        
        // Initialize Flatpickr for Date of Birth without disabled dates
        flatpickr("input[name='event_date']", {
            dateFormat: "Y-m-d",
        });

    } catch (error) {
        console.error('Error fetching disabled dates:', error);
        // Initialize both inputs with default settings if error occurs
        flatpickr("input[name='event_date']", {
            dateFormat: "Y-m-d",
            minDate: "today",
        });
        flatpickr("input[name='event_date']", {
            dateFormat: "Y-m-d",
            defaultDate: "1990-01-01"
        });
    }
})();

