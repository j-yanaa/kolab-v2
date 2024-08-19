<?php
include_once("./connect/session_check.php");
include_once("./includes/benefits.php")
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main>
    <section id="home-section" class="position-relative mt-5 section_hero hero" style="width: calc(100 * var(--vw))">
        <div class="container position-relative">
            <span class="chromaphobic subtitle-1 position-absolute top-0 start-0">Your go-to space for go-getters</span>
        </div>
        <div class="row hero-container h-100">
            <div class="col w-100 h-100 p-0 first-col">
                <div class="w-100 h-100 d-flex flex-column pe-0">
                    <div class="position-absolute line_container_left">
                        <img src="./assets/img/top_left_lines.svg" alt="" class="img-fluid" width="380">
                    </div>
                    <div class="mt-auto connect-title candy-apple d-flex justify-content-end">CONNECT</div>
                    <div class="connect-column d-flex flex-row align-items-start">
                        <img src="./assets/img/connect-image.avif" class="img-fluid connect-position">
                    </div>
                </div>
            </div>

            <div class="col w-100 h-100 p-0 second-col">
                <div class="position-absolute line_container_center">
                    <img src="./assets/img/bottom_center_lines.svg" alt="" class="img-fluid" width="380">
                </div>
                <div class="collab-column position-relative">
                    <img src="./assets/img/center.avif" class="img-fluid collab-position">
                    <div class="collab-title pumpkin d-flex justify-content-center">COLLAB</div>
                </div>
            </div>

            <div class="col w-100 h-100 pe-0 p-0 third-col">
                <div class="position-absolute line_container_right">
                    <img src="./assets/img/bottom_right_lines.svg" alt="" class="img-fluid" width="380">
                </div>
                <div class="w-100 h-100 d-flex flex-column pe-0">
                    <div class="d-flex flex-row align-items-end justify-content-end position-relative p-0">
                        <div class="create-title barberry d-flex justify-content-start">CREATE</div>
                        <div class="create-column">
                            <img src="./assets/img/create-image.avif" class="img-fluid create-position">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container position-relative">
            <span class="chromaphobic subtitle-2 position-absolute bottom-0 end-0">and make awesome happen!</span>
        </div>
    </section>

    <section class="section section-promo">
        <div class=" bg">
            <div class="white_stripe d-flex justify-content-end"></div>
            <div class="container p-4">
                <div class="row content card-container">
                    <div class="col d-flex photo">
                        <img src="./assets/img/promo-arrow.avif" alt="promo" class="img-fluid">
                    </div>
                    <div class="col d-flex flex-column justify-content-center text">
                        <div class="title">
                            RAINY SEASON
                            <br>
                            <span class="fw-bold">SALE!</span>
                        </div>
                        <div class="desc">
                            Promo Ends on August 31, 2024.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery-section" class="section section_gallery position-relative">
        <div class="container-fluid remove-padding">
            <div class="container mb-5 ">
                <p class="subheading barberry">Gallery</p>
                <h4 class="heading chromaphobic">COLLAB SPACES</h4>
            </div>
            <div class="container parent responsive-container">
                <div class="container gallery-bg gallery-bg-gradient">
                    <div id="gallery-caption" class="text-white fw-light gallery-caption col-sm-2 h-100">
                        <span>Nordic Desk</span>
                    </div>
                </div>
                <div class="container-fluid carousel_container d-flex align-items-center">
                    <div id="carousel-gallery" class="child hide-scrollbar g-0 carousel slide hero-carousel" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-box h-100">
                            <div class="carousel-item active h-100">
                                <div class="w-100 h-100 carousel-image">
                                    <div id="image-gallery1" class="img_gallery_container d-flex justify-content-between hide-scrollbar h-100">
                                        <div id="imageGallery" class="img_gallery_box d-flex align-items-center slide-track">
                                            <img src="assets/img/gallery/nordic-desk/nordic-1.avif" class="vertical-image gallery-img" alt="blinc sofa and tables">
                                            <img src="assets/img/gallery/nordic-desk/nordic-2.avif" class="horizontal-image gallery-img" alt="wideshot of colab space">
                                            <img src="assets/img/gallery/nordic-desk/nordic-3.avif" class="vertical-image gallery-img" alt="nordic table with breakroom background">
                                            <img src="assets/img/gallery/nordic-desk/nordic-4.avif" class="vertical-image gallery-img" alt="nordic table facing entrance">
                                            <img src="assets/img/gallery/nordic-desk/nordic-1.avif" class="vertical-image gallery-img" alt="blinc sofa and tables">
                                            <img src="assets/img/gallery/nordic-desk/nordic-2.avif" class="horizontal-image gallery-img" alt="wideshot of colab space">
                                            <img src="assets/img/gallery/nordic-desk/nordic-3.avif" class="vertical-image gallery-img" alt="nordic table with breakroom background">
                                            <img src="assets/img/gallery/nordic-desk/nordic-4.avif" class="vertical-image gallery-img last-image" alt="nordic table facing entrance">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="w-100 h-100 carousel-image">
                                    <div id="image-gallery2" class="img_gallery_container d-flex justify-content-between hide-scrollbar h-100">
                                        <div id="imageGallery" class="img_gallery_box d-flex align-items-center slide-track">
                                            <img src="assets/img/gallery/breakout-room/breakout-1.avif" class="vertical-image" alt="tv and beanbags">
                                            <img src="assets/img/gallery/breakout-room/breakout-2.avif" class="horizontal-image" alt="landscape image">
                                            <img src="assets/img/gallery/breakout-room/breakout-3.avif" class="vertical-image" alt="other view">
                                            <img src="assets/img/gallery/breakout-room/breakout-4.avif" class="vertical-image" alt="another view">
                                            <img src="assets/img/gallery/breakout-room/breakout-1.avif" class="vertical-image" alt="tv and beanbags">
                                            <img src="assets/img/gallery/breakout-room/breakout-2.avif" class="horizontal-image" alt="landscape image">
                                            <img src="assets/img/gallery/breakout-room/breakout-3.avif" class="vertical-image" alt="other view">
                                            <img src="assets/img/gallery/breakout-room/breakout-4.avif" class="vertical-image" alt="another view">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="w-100 h-100 carousel-image">
                                    <div id="image-gallery3" class="img_gallery_container d-flex justify-content-between hide-scrollbar h-100">
                                        <div id="imageGallery" class="img_gallery_box d-flex align-items-center slide-track">
                                            <img src="assets/img/gallery/high-coffee-table/high-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/high-coffee-table/high-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/high-coffee-table/high-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/high-coffee-table/high-4.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/high-coffee-table/high-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/high-coffee-table/high-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/high-coffee-table/high-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/high-coffee-table/high-4.avif" class="vertical-image" alt="high coffee table">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="w-100 h-100 carousel-image">
                                    <div id="image-gallery4" class="img_gallery_container d-flex justify-content-between hide-scrollbar h-100">
                                        <div id="imageGallery" class="img_gallery_box d-flex align-items-center slide-track">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-4.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/sofa-coffee-table/sofa-4.avif" class="vertical-image" alt="high coffee table">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item h-100">
                                <div class="w-100 h-100 carousel-image">
                                    <div id="image-gallery5" class="img_gallery_container d-flex justify-content-between hide-scrollbar h-100">
                                        <div id="imageGallery" class="img_gallery_box d-flex align-items-center slide-track">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-4.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-1.avif" class="vertical-image" alt="high coffee table">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-2.avif" class="horizontal-image" alt="coffee table landscape">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-3.avif" class="vertical-image" alt="high coffee table other angle">
                                            <img src="assets/img/gallery/dedicated-edge-desk/edge-4.avif" class="vertical-image" alt="high coffee table">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="g-0 bottom-bar">
                <div class="container row spacing mx-auto">
                    <div class="col d-flex align-items-center p-0">
                        <button class="control-prev link bounce-out-on-hover" type="button" data-bs-target="#carousel-gallery" data-bs-slide="prev">
                            <img src="assets/img/arrow-left.svg" class="img-fluid" alt="buttonpng" border="0" />
                        </button>
                        <span id="left-label" class="ash btn-spacing bottom-label text-center">High Coffee Table</span>
                    </div>
                    <div id="indicatorContainer" class="col auto d-flex align-items-center justify-content-center p-0">
                        <img src="assets/img/focused.svg" class="img-fluid mx-1 indicator-img" alt="buttonpng" border="0" data-bs-target="#carousel-gallery" data-bs-slide-to="0" />
                        <img src="assets/img/unfocused.svg" class="img-fluid mx-1 indicator-img" alt="buttonpng" border="0" data-bs-target="#carousel-gallery" data-bs-slide-to="1" />
                        <img src="assets/img/unfocused.svg" class="img-fluid mx-1 indicator-img" alt="buttonpng" border="0" data-bs-target="#carousel-gallery" data-bs-slide-to="2" />
                        <img src="assets/img/unfocused.svg" class="img-fluid mx-1 indicator-img" alt="buttonpng" border="0" data-bs-target="#carousel-gallery" data-bs-slide-to="3" />
                        <img src="assets/img/unfocused.svg" class="img-fluid mx-1 indicator-img" alt="buttonpng" border="0" data-bs-target="#carousel-gallery" data-bs-slide-to="4" />
                    </div>
                    <div class="col d-flex align-items-center justify-content-end p-0">
                        <span id="right-label" class="ash bottom-label btn-spacing text-center">Breakout Room</span>
                        <button class="control-next link bounce-out-on-hover" type="button" data-bs-target="#carousel-gallery" data-bs-slide="next">
                            <img src="assets/img/arrow-right.svg" class="img-fluid" alt="buttonpng" border="0" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="rates-section" class="section section-rates position-relative my-5">
        <div class="line-1"></div>
        <div class="line-2"></div>
        <div class="line-3"></div>
        <div class="line-4"></div>
        <div class="container-sm px-sm-4 py-4 px-0">
            <div class="title-group px-4 px-sm-0">
                <p class="title m-0">RATES</p>
                <h4 class="text-uppercase">COLLAB SPACE</h4>
            </div>
            <div class="membership-card-group d-flex w-100 flex-column flex-sm-row">
                <div class="col-6">
                    <img src="./assets/img/collab-space.avif" alt="card" class="img-fluid w-100">
                </div>
                <div class="col-6 membership-card-info">
                    <div class="card-info ">
                        <div class="container-sm ">
                            <?php
                            $ratesList = array(

                                "Free Fiber WIFI up to 100mbps",
                                "Free Unlimited Coffee",
                                "Free Drinking Water",
                                "Pantry Use",
                                "One Time Local Calls",
                                "One Time Free Printing Service",
                                "Power Generator"
                            );
                            $rates = array(
                                "hourly" => array(
                                    "Price" => "45",
                                    "Inclusions" => array(
                                        true,
                                        true,
                                        true,
                                        true,
                                        true,
                                        false,
                                        true,
                                    ),
                                ),
                                "daily" => array(
                                    "Price" => "149",
                                    "Inclusions" => array(
                                        true,
                                        true,
                                        true,
                                        true,
                                        true,
                                        true,
                                        true,
                                    ),
                                ),
                            );
                            ?>
                            <div class="rates-group d-flex justify-content-center w-100">
                                <div class="table-container px-sm-0 px-3 d-none d-sm-block">
                                    <table class="table m-0 table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="benefits-col text-start fw-normal align-top text-uppercase fw-bold" colspan="2">Inclusions</th>
                                                <?php foreach ($rates as $rateName => $ratesDetails) { ?>
                                                    <th class="filler"></th>
                                                    <th scope="col" class="checklist-header text-capitalize <?php echo $rateName; ?> active text-center text-white">

                                                        <div class="benefit title-group w-100 text-center">
                                                            <h5 class="fw-bold m-0"><?php echo ucfirst($rateName); ?></h5>
                                                            <p class="text-uppercase m-0 fw-normal">₱<?php echo $ratesDetails["Price"]; ?></p>
                                                        </div>
                                                    </th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ratesList as $key => $item) { ?>
                                                <tr>
                                                    <td class="text-start dash-col">
                                                        <i class="bi bi-dash-lg text-dark"></i>
                                                    </td>
                                                    <td class="text-start">
                                                        <?php echo $item; ?>
                                                    </td>
                                                    <?php foreach ($rates as $planName => $planDetails) { ?>
                                                        <td class="filler"></td>
                                                        <?php if ($planDetails["Inclusions"][$key]) { ?>
                                                            <td class="text-center <?php echo $planName; ?>" style="width: 12%;"><i class="bi bi-check-lg"></i></td>
                                                        <?php } else { ?>
                                                            <td class="text-center <?php echo $planName; ?>" style="width: 12%;"><i class="bi bi-check-lg text-success d-none"></i></td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>


                                </div>

                                <div class="accordion w-100 d-sm-none d-block border border-0 rounded-0" id="accordionExample">
                                    <?php foreach ($rates as $rateName => $ratesDetails) { ?>
                                        <?php $index = array_search($rateName, array_keys($rates)); ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header text-center" id="heading<?php echo $rateName; ?>">
                                                <button class="accordion-button text-center text-uppercase <?php echo $rateName; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $rateName; ?>" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $rateName; ?>">
                                                    <span class="fw-bold"><?php echo ucfirst($rateName) . ' ' ?> </span> ₱<?php echo $ratesDetails["Price"]; ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo $rateName; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $rateName; ?>" data-bs-parent="#accordionExample">
                                                <div class="accordion-body <?php echo $rateName; ?>">
                                                    <div class="table-container d-block d-sm-none mobile w-100 <?php echo $rateName; ?>">
                                                        <table class="table table-borderless m-0">
                                                            <tbody>
                                                                <?php foreach ($ratesList as $key => $item) { ?>
                                                                    <tr>
                                                                        <?php if ($ratesDetails["Inclusions"][$key]) { ?>
                                                                            <td class="text-center <?php echo $rateName; ?>">
                                                                                <i class="bi bi-check-lg me-1"></i>
                                                                            </td>
                                                                            <td class="text-start <?php echo $rateName; ?>">
                                                                                <p class="m-0 text-dark"><?php echo $item; ?></p>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services-section" class="section section-services position-relative">
        <div class="container mx-auto">
            <div class="mb-3 heading-container">
                <h2 class="subheading calgar">SERVICES</h2>
                <h1 class="heading chromaphobic text-uppercase">COLLAB RATES</h1>
            </div>
            <div class="d-sm-block d-flex flex-column row">
                <!-- membership -->
                <div class="row mb-5 pb-5">
                    <div class="row exp_row">
                        <div class="content col-md-5 content col-10 p-0 d-flex align-items-center">
                            <div class="h-80 w-100 my-auto calgar_lightest_bg position-relative exp_container d-flex align-items-center">
                                <div class="row p-3 exp_text_w ms-2">
                                    <div class="col-12">
                                        <p class="chromaphobic">Enjoy complete flexibility and huge discounts whenever you work.</p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-default"> Become a member </button>
                                    </div>
                                </div>

                                <div class="why_us_title content col-md-7 content col-12 calgar_bg position-absolute top-50 end-0 exp_box_left text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">MEMBERSHIP</div>
                            </div>
                        </div>
                        <div class="content col-2 p-0 d-md-block d-none"></div>
                        <div class="content col p-0 align-items-center d-md-flex d-none">
                            <div class="h-75 w-100 my-auto  d-flex align-items-center gap-3">
                                <span class="exp_number calgar_lightest">One</span>
                                <div class="calgar_bg exp_line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="exp-row row">
                        <div class="col-5 no-padding-left">
                            <table class="table table-stripes-blue table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th blue d-flex justify-content-between pb-(-5))">
                                            <p>Inclusions</p>
                                            <p>3500/month</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Monthly Kolab Use</td>
                                    </tr>
                                    <tr>
                                        <td>Free Coffee and Drinking Water</td>
                                    </tr>
                                    <tr>
                                        <td>Pantry Use</td>
                                    </tr>
                                    <tr>
                                        <td>Exclusive Locker Space</td>
                                    </tr>
                                    <tr>
                                        <td>Free Local Calls</td>
                                    </tr>
                                    <tr>
                                        <td>Discounted Printing Service</td>
                                    </tr>
                                    <tr>
                                        <td>Professional Connections</td>
                                    </tr>
                                    <tr>
                                        <td>Power Generator</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-7 no-padding-right">
                            <div class="image-container">
                                <img src="./assets/img/membership.avif" class="object-fit-cover w-100 position-absolute" alt="membership-photo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- virtual office address -->
                <div class="row my-5 pb-5">
                    <div class="row exp_row justify-content-end">
                        <div class="content col p-0 d-md-flex d-none align-items-center">
                            <div class="h-75 w-100 my-auto  d-flex align-items-center justify-content-end gap-3">
                                <div class="barberry_bg exp_line"></div>
                                <span class="exp_number barberry_lightest">Two</span>
                            </div>
                        </div>
                        <div class="content col-2 p-0 d-md-block d-none"></div>
                        <div class="content col-md-5 content col-10 p-0 d-flex align-items-center">
                            <div class="h-80 w-100 my-auto barberry_lightest_bg position-relative exp_container d-flex align-items-center">
                                <div class="row p-3 exp_text_w ml-auto my-auto d-flex align-items-center">
                                    <div class="col-12">
                                        <p class="chromaphobic">Build your business presence without physically being there.</p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-yellow"> Get now </button>
                                    </div>
                                </div>
                                <div class="why_us_title content col-md-7 content col-12 barberry_bg position-absolute top-50 end-0 exp_box_right text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">Virtual Office</br>Address</div>
                            </div>
                        </div>
                    </div>
                    <div class="exp-row row">
                        <div class="col-7 no-padding-left">
                            <div class="image-container">
                                <img src="./assets/img/image-1.avif" class="object-fit-cover w-100 position-absolute" alt="membership-photo">
                            </div>
                        </div>
                        <div class="col-5 no-padding-right">
                            <table class="table table-stripes-yellow table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th yellow d-flex justify-content-between pb-(-5))">
                                            <p>Inclusions</p>
                                            <p>3000/month</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Business Address</td>
                                    </tr>
                                    <tr>
                                        <td>Mail and Packages Handling</td>
                                    </tr>
                                    <tr>
                                        <td>Locker Space</td>
                                    </tr>
                                    <tr>
                                        <td>Complimentary Drinks during visits</td>
                                    </tr>
                                    <tr>
                                        <td>Professional Connections</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- event space -->
                <div class="row my-5 pb-5">
                    <div class="row exp_row">
                        <div class="content col-md-5 content col-10 p-0 d-flex align-items-center">
                            <div class="h-80 w-100 my-auto pumpkin_lightest_bg position-relative exp_container d-flex align-items-center">
                                <div class="row p-3 exp_text_w ms-2 my-auto d-flex align-items-center">
                                    <div class="col-12">
                                        <p class="chromaphobic">Host engaging community meet-ups in style.</p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-orange"> Inquire now </button>
                                    </div>
                                </div>
                                <div class="why_us_title content col-md-7 content col-12 pumpkin_bg position-absolute top-50 end-0 exp_box_left text-uppercase d-flex align-items-center justify-content-center fw-semibold text-white ms-5">Event Space</div>
                            </div>
                        </div>
                        <div class="content col-2 p-0 d-md-block d-none"></div>
                        <div class="content col p-0 align-items-center d-md-flex d-none">
                            <div class="h-75 w-100 my-auto  d-flex align-items-center gap-3">
                                <span class="exp_number pumpkin_lightest">Three</span>
                                <div class="pumpkin_bg exp_line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="exp-row row">
                        <div class="col-5 no-padding-left">
                            <table class="table table-stripes-orange table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th orange">Pricing</th>
                                        <th class="th orange"></th>
                                        <th class="th orange"></th>
                                        <th class="th orange text-end">6 hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>10-15 pax</td>
                                        <td>15-20 pax</td>
                                        <td>20-30 pax</td>
                                        <td>30-40 pax</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>₱3000</td>
                                        <td>₱5000</td>
                                        <td>₱8000</td>
                                        <td>₱10000</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-stripes-orange table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th orange">Inclusions</th>
                                        <th class="th orange"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kolab Space use (sqm)</td>
                                        <td>Additional Hours ₱1000/h</td>
                                    </tr>
                                    <tr>
                                        <td>40 Seating Capacity</td>
                                        <td>Hosting Fee (₱1500/6hrs)</td>
                                    </tr>
                                    <tr>
                                        <td>Smart TV/Projector</td>
                                        <td>Live Streaming (₱1500/6hrs)</td>
                                    </tr>
                                    <tr>
                                        <td>Speaker/mic</td>
                                        <td>Photo & Video Coverage (₱4000)</td>
                                    </tr>
                                    <tr>
                                        <td>2 Dedicated Support Staff</td>
                                        <td>Corkage Fee (₱500)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-7 no-padding-right">
                            <div class="image-container">
                                <img src="./assets/img/event-space.avif" class="object-fit-cover w-100 position-absolute" alt="membership-photo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- meeting room -->
                <div class="row my-5 pb-5">
                    <div class="row exp_row justify-content-end">
                        <div class="content col p-0 d-md-flex d-none align-items-center">
                            <div class="h-75 w-100 my-auto  d-flex align-items-center justify-content-end gap-3">
                                <div class="candy-apple_bg exp_line"></div>
                                <span class="exp_number candy-apple_lightest">Four</span>
                            </div>
                        </div>
                        <div class="content col-2 p-0 d-md-block d-none"></div>
                        <div class="content col-md-5 content col-10 p-0 d-flex align-items-center">
                            <div class="h-80 w-100 my-auto candy-apple_lightest_bg position-relative exp_container d-flex align-items-center">
                                <div class="row p-3 exp_text_w ml-auto my-auto d-flex align-items-center">
                                    <div class="col-12">
                                        <p class="chromaphobic">Professional space for your business meetings.</p>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-red"> Schedule now </button>
                                    </div>
                                </div>
                                <div class="why_us_title content col-md-7 content col-12 candy-apple_bg position-absolute top-50 end-0 exp_box_right text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">Meeting Room</div>
                            </div>
                        </div>
                    </div>
                    <div class="exp-row row">
                        <div class="col-5 no-padding-left">
                            <table class="table table-stripes-red table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th red">Pricing</th>
                                        <th class="th red"></th>
                                        <th class="th red text-end">3 hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>Solo</td>
                                        <td>2-4 pax</td>
                                        <td>5-6 pax</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>₱250</td>
                                        <td>₱600</td>
                                        <td>₱1250</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-stripes-red table-borderless">
                                <thead>
                                    <tr>
                                        <th class="th red">Inclusions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Free coffee and drinking water</td>
                                    </tr>
                                    <tr>
                                        <td>Pantry use</td>
                                    </tr>
                                    <tr>
                                        <td>Smart TV</td>
                                    </tr>
                                    <tr>
                                        <td>Power generator</td>
                                    </tr>
                                    <tr>
                                        <td>Additional Hours ₱100/h</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-7 no-padding-right">
                            <div class="image-container">
                                <img src="./assets/img/image-1.avif" class="object-fit-cover w-100 position-absolute" alt="membership-photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="amenities-section" class="section section_amenities container-fluid mb-5">
        <div class="name lead text-center container justify-content-center p-0">
            <div class="amenities-line1 "></div>
            <div>
                <p class="amenities text-uppercase -candy-apple">Amenities</p>
            </div>
            <div class="amenities-line2"></div>
        </div>
        <div class="container-amenities container g-0 mt-5">
            <div class="line-one position-relative row g-0 gap-5">
                <div class="content col text-center">
                    <img src="assets/img/amenities/wifi.svg">
                    <p class="title-text chromaphobic">Fast WiFi</p>
                    <p class="chromaphobic">Stay connected with our lightning-fast WiFi, up to 100 Mbps.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/coffee.svg">
                    <p class="title-text chromaphobic">Free Coffee</p>
                    <p class="chromaphobic">Fuel your day with unlimited, freshly brewed coffee.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/water.svg">
                    <p class="title-text chromaphobic">Water</p>
                    <p class="chromaphobic">Stay refreshed with free, purified drinking water.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/snackbar.svg">
                    <p class="title-text chromaphobic">Pantry Access</p>
                    <p class="chromaphobic">Enjoy the convenience of our pantry at your service.</p>
                </div>
            </div>

            <div class="line-two row gap-5 g-0 container mt-5">
                <div class="content col text-center">
                    <img src="assets/img/amenities/outlet.svg">
                    <p class="title-text chromaphobic">Power Outlets</p>
                    <p class="chromaphobic">Power up anywhere with ample outlets at every corner.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/power.svg">
                    <p class="title-text chromaphobic">Power Generator</p>
                    <p class="chromaphobic">Uninterrupted workdays with our reliable power generator.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/elevator.svg">
                    <p class="title-text chromaphobic">Elevator Access</p>
                    <p class="chromaphobic">You can access the elevator through the basement parking.</p>
                </div>
                <div class="content col text-center">
                    <img src="assets/img/amenities/parking.svg">
                    <p class="title-text chromaphobic">Pay Parking</p>
                    <p class="chromaphobic">Park with ease—first-come, first-served access.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<?php $scripts = ob_get_clean(); ?>

<?php include './layouts/base.php'; ?>
<script src="./assets/js/default.js?=<?php echo $randomNumber; ?>"></script>