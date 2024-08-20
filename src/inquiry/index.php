<?php
include("../connect/session_check.php");
?>

<?php ob_start(); ?>

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<main class="inquiry_section">
    <div class="container py-5">
        <div class="row align-items-center justify-content-center main-container-inquiry">
            <div class="col-4">
                <div class="container p-5 bg-white align-middle">
                    <div class="row why_us_title fw-bold content pb-2">
                        COLLAB SPACE
                    </div>
                    <div class="row pb-4">
                        Simply book a space to work at your own tempo!
                    </div>
                    <div class="row">
                        <button class="btn btn-default">Book now</button>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row exp_row justify-content-end mb-4">
                    <div class="content col-2 p-0 d-md-block d-none"></div>
                    <div class="content col-md-8 col-10 p-0 d-flex align-items-center">
                        <div class="h-80 w-100 my-auto calgar_lightest_bg position-relative exp_container d-flex align-items-center">
                            <div class="row p-3 exp_text_w ml-auto my-auto d-flex align-items-center">
                                <div class="col-12">
                                    <p class="chromaphobic">Enjoy complete flexibility and huge discounts whenever you work.</p>
                                </div>
                                <div class="col-12">
                                    <a href="../membership/" class="btn btn-default"> Become a member </a>
                                </div>
                            </div>
                            <div class="why_us_title content col-md-7 content col-12 calgar_bg position-absolute top-50 end-0 exp_box_right text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">Membership</div>
                        </div>
                    </div>
                </div>
                <div class="row exp_row justify-content-end mb-4">
                    <div class="content col-2 p-0 d-md-block d-none"></div>
                    <div class="content col-md-8 col-10 p-0 d-flex align-items-center">
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
                <div class="row exp_row justify-content-end mb-4">
                    <div class="content col-2 p-0 d-md-block d-none"></div>
                    <div class="content col-md-8 col-10 p-0 d-flex align-items-center">
                        <div class="h-80 w-100 my-auto pumpkin_lightest_bg position-relative exp_container d-flex align-items-center">
                            <div class="row p-3 exp_text_w ml-auto my-auto d-flex align-items-center">
                                <div class="col-12">
                                    <p class="chromaphobic">Host engaging community meet-ups in style.</p>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-orange"> Inquire now </button>
                                </div>
                            </div>
                            <div class="why_us_title content col-md-7 content col-12 pumpkin_bg position-absolute top-50 end-0 exp_box_right text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">Event Space</div>
                        </div>
                    </div>
                </div>
                <div class="row exp_row justify-content-end mb-4">
                    <div class="content col-2 p-0 d-md-block d-none"></div>
                    <div class="content col-md-8 col-10 p-0 d-flex align-items-center">
                        <div class="h-80 w-100 my-auto candy-apple_lightest_bg position-relative exp_container d-flex align-items-center">
                            <div class="row p-3 exp_text_w ml-auto my-auto d-flex align-items-center">
                                <div class="col-12">
                                    <p class="chromaphobic">Professional space for your business meetings.</p>
                                </div>
                                <div class="col-12">
                                    <a href="../meeting/" class="btn btn-red"> Schedule now </a>
                                </div>
                            </div>
                            <div class="why_us_title content col-md-7 content col-12 candy-apple_bg position-absolute top-50 end-0 exp_box_right text-uppercase p-3 d-flex align-items-center justify-content-center fw-semibold text-white">Meeting Room</div>
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