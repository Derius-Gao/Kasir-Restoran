<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Morning Bakery</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('img/luiga.jpeg')?>">

        <!-- CSS here -->
        <link rel="stylesheet" href="<?= base_url('css/preloader.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/slick.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/backToTop.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/meanmenu.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/nice-select.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/magnific-popup.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/owl.carousel.min.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/animate.min.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/jquery.fancybox.min.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/fontAwesome5Pro.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/ui-range-slider.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/default.css')?>">
        <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
    </head>
    <body>
        <!-- offcanvas area start -->
        <div class="offcanvas__area">
            <div class="offcanvas__wrapper">
            <div class="offcanvas__close">
                <button class="offcanvas__close-btn" id="offcanvas__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="offcanvas__content">
                <div class="offcanvas__logo mb-40">
                    <a href="index.html">
                    <img src="assets/img/logo/logo-black.png" alt="logo">
                    </a>
                </div>
                <div class="offcanvas__search mb-25">
                    <form action="#">
                        <input type="text" placeholder="What are you searching for?">
                        <button type="submit" ><i class="far fa-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-2 fix"></div>
                <div class="offcanvas__action">

                </div>
            </div>
            </div>
        </div>
        <!-- offcanvas area end -->      
        <div class="body-overlay"></div>
        <!-- offcanvas area end -->

        <main>
            
            <!-- breadcrumb area start -->
            <section class="breadcrumb__area box-plr-75">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Register</li>
                                    </ol>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- login Area Strat-->
            <section class="login-area pb-100">
                <div class="container">
                  <form action="<?= base_url('home/aksi_registrasi') ?>" method="post">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                            <div class="basic-login">
                            <h3 class="text-center mb-60">Register From Here</h3>
                            <form action="#">
                                  <label for="username">Username <span>**</span></label>
                                  <input type="username" class="form-control" id="username" placeholder="Enter Username" name="username" required>
                                  <label for="nama_user">Nama User <span>**</span></label>
                                  <input type="username" class="form-control" id="nama_user" placeholder="Enter Nama" name="nama_user" required>
                                  <label for="email">Email Address <span>**</span></label>
                                  <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                <label for="pass">Password <span>**</span></label>
                                 <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                 <button type="submit" class="t-y-btn w-100">Register</button>

                                   </form>
                            </div>
                    </div>
                </div>
                </div>
            </section>
            <script src="<?= base_url('js/imagesloaded.pkgd.min.js')?>"></script>
        <script src="<?= base_url('js/vendor/jquery-3.6.0.min.js')?>"></script>
        <script src="<?= base_url('js/vendor/waypoints.min.js')?>"></script>
        <script src="<?= base_url('js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?= base_url('js/meanmenu.js')?>"></script>
        <script src="<?= base_url('js/slick.min.js')?>"></script>
        <script src="<?= base_url('js/backToTop.js')?>"></script>
        <script src="<?= base_url('js/jquery.fancybox.min.js')?>"></script>
        <script src="<?= base_url('js/countdown.js')?>"></script>
<script src="<?= base_url('js/imagesloaded.pkgd.min.js')?>"></script>
        <script src="<?= base_url('js/nice-select.min.js')?>"></script>
        <script src="<?= base_url('js/owl.carousel.min.js')?>"></script>
        <script src="<?= base_url('js/magnific-popup.min.js')?>"></script>
        <script src="<?= base_url('js/jquery-ui-slider-range.js')?>"></script>
        <script src="<?= base_url('js/ajax-form.js')?>"></script>
        <script src="<?= base_url('js/wow.min.js')?>"></script>
        <script src="<?= base_url('js/main.js')?>"></script>
    </body>
