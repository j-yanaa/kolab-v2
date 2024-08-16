/*===================*/
/* STICKY NAVBAR POSITION
/*===================*/

// Get the element
const element = document.getElementById('navbar');

// Function to add or remove the class based on scroll position
function toggleClassOnScroll() {
    if (window.scrollY > 50) {
        element.classList.add('sticky_nav');
        console.log('sticky navbar');
    } else {
        element.classList.remove('sticky_nav');
    }
}
// Listen for scroll events on the window
window.addEventListener('scroll', toggleClassOnScroll);


/*===================*/
/* OFFSET NAVBAR HREF POSITION
/*===================*/
document.addEventListener('DOMContentLoaded', () => {
  // Calculate the navbar height
  const navbarHeight = document.querySelector('.navbar').offsetHeight;

  // Function to smoothly scroll to the target element
  function scrollToTargetWithOffset(event) {
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);

      if (targetElement) {
          // Prevent the default anchor behavior
          event.preventDefault();
          
          // Calculate the position to scroll to, accounting for the navbar height
          const offsetTop = targetElement.offsetTop - navbarHeight;

          // Execute the scroll
          window.scrollTo({
              top: offsetTop,
              behavior: 'smooth'
          });
      }
  }

  // Attach the scroll function to all navbar links
  document.querySelectorAll('#navbarSupportedContent .nav-link').forEach(link => {
      link.addEventListener('click', scrollToTargetWithOffset);
  });

  // Also attach to any specific links you have outside the navbar if necessary
  const specificLinks = ['#home-link', '#why-us-link', '#gallery-link', '#rates-link', '#membership-link', '#rental-link'];
  specificLinks.forEach(id => {
      const link = document.querySelector(id);
      if (link) {
          link.addEventListener('click', scrollToTargetWithOffset);
      }
  });
});


/*===================*/
/* NAVBAR SCROLL ACTIVE
/*===================*/
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.section, .section_hero');
    const navLinks = document.querySelectorAll('.nav-item .nav-link');
    const navbarHeight = document.getElementById('navbar').offsetHeight;
    const footer = document.querySelector('footer'); // Assuming you have a footer element

    function onScroll() {
        let currentSection = '';
        console.log(sections)
        // Determine the current section in the viewport
        sections.forEach((section) => {
            const sectionTop = section.offsetTop - navbarHeight;
            const sectionHeight = section.clientHeight;

            if (window.scrollY >= sectionTop - 50 && window.scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
                console.log("Current Section: " + currentSection);
            }
        });


        // Check if the footer is at the bottom of the screen
        const footerTop = footer.offsetTop - navbarHeight;
        const footerHeight = footer.clientHeight;
        if (window.scrollY + window.innerHeight >= footerTop + footerHeight) {
            currentSection = 'footer'; // Assuming 'footer' is the ID or unique identifier for the Contact Us section
        }

        // Update the active class on the navbar link
        navLinks.forEach((link) => {
            link.classList.remove('active');
            const href = link.getAttribute('href').substring(1); // Remove the '#' from the href value
            if (href === currentSection) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', onScroll);
});








/*===================*/
/* OFFSET FOOTER HREF POSITION
/*===================*/
document.addEventListener('DOMContentLoaded', (event) => {
  const navbarHeight = document.getElementById('navbar').offsetHeight; // Get the navbar height

  // Get the specific anchor links by their IDs
  const homeLink = document.getElementById('home-link');
  const whyUsLink = document.getElementById('why-us-link');
  const galleryLink = document.getElementById('gallery-link');
  const ratesLink = document.getElementById('rates-link');
  const membershipLink = document.getElementById('membership-link');
  const rentalLink = document.getElementById('rental-link');
  const amenitiesLink = document.getElementById('amenities-link');

  // Add click event listeners to each anchor link
  homeLink.addEventListener('click', scrollToTarget);
  whyUsLink.addEventListener('click', scrollToTarget);
  galleryLink.addEventListener('click', scrollToTarget);
  ratesLink.addEventListener('click', scrollToTarget);
  membershipLink.addEventListener('click', scrollToTarget);
  rentalLink.addEventListener('click', scrollToTarget);
  amenitiesLink.addEventListener('click', scrollToTarget);

  function scrollToTarget(e) {
      e.preventDefault(); // Prevent the default anchor link behavior

      const targetId = this.getAttribute('href'); // Get the target element ID
      const targetElement = document.querySelector(targetId); // Get the target element

      if (targetElement) {
          const offsetTop = targetElement.offsetTop - navbarHeight; // Calculate the position to scroll to

          window.scrollTo({
              top: offsetTop,
              behavior: 'smooth' // Smooth scroll
          });
      }
  }
});

/*===================*/
/* BUTTONS CHANGE GALLERY
/*===================*/

// Define an array of text options
const textOptions = ['Nordic Desk', 'Breakout Room', 'High Coffee Table', 'Sofa Lounge', 'Edge Desk'];
let currentIndex = 0;
const prevButton = document.querySelector('.control-prev');
const nextButton = document.querySelector('.control-next');

function updateText() {
  const galleryCaption = document.getElementById('gallery-caption');
  const leftLabel = document.getElementById('left-label');
  const rightLabel = document.getElementById('right-label');

  // Caption and labels update
  if (galleryCaption) {
    galleryCaption.classList.remove('active-text');
    void galleryCaption.offsetWidth; // Trigger reflow
    galleryCaption.classList.add('active-text');
    galleryCaption.innerHTML = `<span>${textOptions[currentIndex]}</span>`;
  }

  if (leftLabel && rightLabel) {
    leftLabel.textContent = textOptions[(currentIndex - 1 + textOptions.length) % textOptions.length];
    rightLabel.textContent = textOptions[(currentIndex + 1) % textOptions.length];
  }

  // Indicators update
  const indicatorImages = document.querySelectorAll('#indicatorContainer img');
  indicatorImages.forEach((img, index) => {
    if (index === currentIndex) {
      img.src = 'assets/img/focused.svg'; // Active indicator image
    } else {
      img.src = 'assets/img/unfocused.svg'; // Inactive indicator image
    }
  });
}

// Previous and next button functionality
prevButton.addEventListener('click', function() {
    currentIndex = (currentIndex - 1 + textOptions.length) % textOptions.length;
    updateText();
});

nextButton.addEventListener('click', function() {
    currentIndex = (currentIndex + 1) % textOptions.length;
    updateText();
});

// Make indicators clickable
document.querySelectorAll('#indicatorContainer img').forEach((indicator, index) => {
  indicator.addEventListener('click', () => {
    currentIndex = index; // Update currentIndex to the clicked indicator's index
    updateText(); // Update the gallery view
  });
});


updateText();






/*===================*/
/* GALLERY INDICATORS
/*===================*/

// document.addEventListener('DOMContentLoaded', function() {
//   const galleries = document.querySelectorAll('#image-gallery1, #image-gallery2, #image-gallery3');
//   const indicators = document.querySelectorAll('#indicatorContainer .indicator-img');
  
//   function scrollToImage(index) {
//     galleries.forEach(gallery => {
//         const images = gallery.querySelectorAll('img');
//         let scrollPosition = 0;

//         for (let i = 0; i < index; i++) {
//             const style = window.getComputedStyle(images[i]);
//             const margin = parseInt(style.marginLeft, 10) + parseInt(style.marginRight, 10);
//             scrollPosition += images[i].offsetWidth + margin;
//         }

//         // Scroll the gallery to the calculated position
//         gallery.scrollLeft = scrollPosition;
//     });
// }
  
//   // indicators.forEach((indicator, index) => {
//   //   indicator.addEventListener('click', function() {
//   //     // Scroll to the image corresponding to the clicked indicator
//   //     scrollToImage(index);
//   //   });
//   // });

//   galleries.forEach(gallery => {
//     gallery.addEventListener('scroll', function() {
//       const galleryScrollLeft = gallery.scrollLeft;
//       let activeIndex = 0; // Default to the first image
      
//       const images = gallery.querySelectorAll('img');
//       let accumulatedWidth = 0;
      
//       for (let i = 0; i < images.length; i++) {
//         // Include both width and margin of the image
//         const imageWidthWithMargin = images[i].offsetWidth + parseInt(window.getComputedStyle(images[i]).marginLeft);
//         accumulatedWidth += imageWidthWithMargin;
//         if (accumulatedWidth >= galleryScrollLeft) {
//             activeIndex = i;
//             break;
//         }
//     }
    
      
//       // Update indicators based on scroll
//       indicators.forEach((indicator, index) => {
//         indicator.src = index === activeIndex ? 'assets/img/focused.svg' : 'assets/img/unfocused.svg';
//       });
//     });
//   });
// });


/*===================*/
/* DRAGGABLE GALLERY
/*===================*/
// document.addEventListener('DOMContentLoaded', function() {
//   const galleries = document.querySelectorAll('#image-gallery1, #image-gallery2, #image-gallery3');

//   galleries.forEach(gallery => {
//     let isDragging = false;
//     let startX;
//     let scrollLeft;

//     gallery.addEventListener('mousedown', (e) => {
//       isDragging = true;
//       startX = e.pageX - gallery.offsetLeft;
//       scrollLeft = gallery.scrollLeft;
//     });

//     gallery.addEventListener('mouseup', () => {
//       isDragging = false;
//     });

//     gallery.addEventListener('mouseleave', () => {
//       isDragging = false;
//     });

//     gallery.addEventListener('mousemove', (e) => {
//       if (!isDragging) return;
//       e.preventDefault();
//       const x = e.pageX - gallery.offsetLeft;
//       const walk = (x - startX) * 2; // Adjust scrolling speed here
//       gallery.scrollLeft = scrollLeft - walk;
//     });
//   });
// });




// Rates / Membership

const rates = [
  {id: 1, items: "Item1", price: 23, color: "", inclusion: false,},
]


// GET VIEW WIDTH PORT MINUS SCROLLBAR WIDTH
let scroller = document.scrollingElement;

// Force scrollbars to display
scroller.style.setProperty('overflow', 'scroll');

// Wait for next from so scrollbars appear
requestAnimationFrame(()=>{
  
  // True width of the viewport, minus scrollbars
  scroller.style
    .setProperty(
      '--vw', 
      scroller.clientWidth / 100
    );

  // Reset overflow
  scroller.style
    .setProperty(
      'overflow', 
      ''
    );
});

function changeCardView(element) {
    var cardSrc = element.getAttribute("src");
    var chosenCardID = element.getAttribute("id");
    document.getElementById("currentCard").setAttribute("src", cardSrc);


    //loop all checklists headers and remove active class
    var checklistHeaders = document.querySelectorAll(".checklist-header");


    var titleContainer = document.querySelector(".section-rates .title-container");
    // cardInfoBox 

    var cardInfoBox = document.querySelector(".section-rates .card-info");


    //cehck if ther is a malaya, maharlika or uno class

    if (titleContainer.classList.contains("malaya") || titleContainer.classList.contains("maharlika") || titleContainer.classList.contains("uno")) {
        titleContainer.classList.remove("malaya");
        titleContainer.classList.remove("maharlika");
        titleContainer.classList.remove("uno");
        cardInfoBox.classList.remove("malaya");
        cardInfoBox.classList.remove("maharlika");
        cardInfoBox.classList.remove("uno");
    }

    titleContainer.classList.add(chosenCardID);
    titleContainer.querySelector("h3").innerHTML = chosenCardID;
    cardInfoBox.classList.add(chosenCardID);

    let pText = ""; // Default text
    switch (chosenCardID) {
        case "maharlika":
            pText = "Host two yearly events – from Web3 events  to meetups, podcasts etc. Enjoy prominent visibility with logo placements and elevate your brand with networking, discounts, and exclusive features.";
            break;
        case "malaya":
            pText = "Host an event while enjoying prime visibility with logo placement,  benefit from networking opportunities, awesome discounts, and exclusive features like member post and certificates — all designed to boost your brand and enrich your collaborative experience.";
            break;
        case "uno":
            pText = "Members can enjoy brand exposure on diverse social media channels plus special discounts on collab space rates.";
            break;
        default:
            pText = "Default Text"; // You can set a default or keep it empty
    }

// Now, set the <p> text
document.querySelector('.membership-card-info-content.px-5 p').innerHTML = pText;




    checklistHeaders.forEach(function(header) {
        if (header.id == chosenCardID) {
            header.classList.add("active");
        } else {
            header.classList.remove("active");
        }
    });

    var benefits = document.querySelectorAll(".section_benefits");
    var mobileBenefits = benefits[0].querySelectorAll(".mobile");
    mobileBenefits.forEach(function(mobileBenefit) {
        if (mobileBenefit.id == chosenCardID) {
            mobileBenefit.classList.remove("d-none");
        } else {
            mobileBenefit.classList.add("d-none");
        }
    });
}

//membership-cards get card-1 image
changeCardView(document.querySelector(".card-1 img"));




document.addEventListener("DOMContentLoaded", function() {
    // Get the clickable div element
    var clickableDiv = document.getElementById("qr-online-booking");

    // Add a click event listener
    clickableDiv.addEventListener("click", function() {
        // Define the URL you want to navigate to
        var url = "https://forms.gle/4uaX3F4cZyVx8dfF9";

		 // Open the URL in a new tab
		 window.open(url, '_blank').focus();
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get the clickable div element
    var clickableDiv = document.getElementById("qr-membership");

    // Add a click event listener
    clickableDiv.addEventListener("click", function() {
        // Define the URL you want to navigate to
        var url = "https://forms.gle/Z1D4V8PSf62tiHcf6";

		 // Open the URL in a new tab
		 window.open(url, '_blank').focus();
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get the clickable div element
    var clickableDiv = document.getElementById("qr-event-rental");

    // Add a click event listener
    clickableDiv.addEventListener("click", function() {
        // Define the URL you want to navigate to
        var url = "https://forms.gle/2SaoKxMuP6NbRHwz7";

		 // Open the URL in a new tab
		 window.open(url, '_blank').focus();
    });
});
