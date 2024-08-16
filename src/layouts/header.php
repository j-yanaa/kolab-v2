<nav id="navbar" class="navbar navbar-expand-lg bg-white" style="width: calc(100 * var(--vw))">
    <div class="container">

        <a class="navbar-brand" href="#" id="navbar-brand-link">
            <img src="./assets/img/logo/kolab no space.avif" alt="Kolab" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" data-bs-smooth-scroll="true">
                <li class="nav-item me-4">
                    <a class="nav-link active text-uppercase" aria-current="page" href="#home-section">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link text-uppercase" data-mdb-smooth-scroll-init href="#gallery-section">Gallery</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link text-uppercase" data-mdb-smooth-scroll-init href="#rates-section">Rates</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link text-uppercase" data-mdb-smooth-scroll-init href="#services-section">Services</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link text-uppercase" data-mdb-smooth-scroll-init href="#amenities-section">Amenities</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link text-uppercase" data-mdb-smooth-scroll-init href="#footer">Contact Us</a>
                </li>
            </ul>
            <!-- <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let basePath = '/kolabspace/dist/';
                    
                    // Determine if we're in a subdirectory
                    const subDirectories = ['inquiry', 'booking', 'membership', 'host-event', 'check-status'];
                    const isInSubDirectory = subDirectories.some(dir => window.location.pathname.includes(`/kolabspace/dist/${dir}/`));

                    // Set navbar brand link and image
                    var navbarBrandLink = document.getElementById('navbar-brand-link');
                    var navbarBrandImage = navbarBrandLink.querySelector('img');
                    
                    navbarBrandLink.href = basePath;
                    
                    // Adjust image source based on current path
                    if (isInSubDirectory) {
                        navbarBrandImage.src = '../assets/img/logo/kolab no space.avif';
                    } else {
                        navbarBrandImage.src = './assets/img/logo/kolab no space.avif';
                    }
                    
                    navbarBrandLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        window.location.href = basePath;
                    });

                    // Set other nav links
                    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                        const sectionId = link.getAttribute('href');
                        
                        if (isInSubDirectory) {
                            link.setAttribute('href', `../${sectionId}`);
                        } else if (!window.location.pathname.endsWith('index.php') && 
                                !window.location.pathname.endsWith('/kolabspace/dist/')) {
                            link.setAttribute('href', `index.php${sectionId}`);
                        }
                        
                        console.log('Link href:', link.getAttribute('href'));
                    });

                    // Adjust "Inquire now" button
                    var inquireButton = document.querySelector('.btn.btn-primary');
                    if (inquireButton) {
                        inquireButton.href = isInSubDirectory ? '../inquiry/' : './inquiry/';
                    }
                });
            </script> -->
            <?php if ($in_concat == true) { ?>
                <a href="./inquiry/" class="btn btn-primary rounded-0 fw-bold px-3">Book now</a>
            <?php } else { ?>
                <a href="../inquiry/" class="btn btn-primary rounded-0 fw-bold px-3">Book now</a>
            <?php } ?>
        </div>
    </div>
</nav>