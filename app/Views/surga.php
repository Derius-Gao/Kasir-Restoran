<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $pengaturan->judul ?? 'Home' ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <?php if ($pengaturan->logo_web && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)): ?>
            <link rel="shortcut icon" href="<?= base_url('uploads/' . $pengaturan->logo_web) ?>" type="image/x-icon">
        <?php else: ?>
            <link rel="shortcut icon" href="<?= base_url('img/default-logo.png') ?>" type="image/x-icon">
        <?php endif; ?>

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
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <!-- preloader area start -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div id="object"></div>
                </div>
            </div>
        </div>
        <!-- preloader area end -->

        <!-- back to top start -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
        <!-- back to top end -->

        <!-- header area start -->
        <header>
            <div class="header__area">
                <div class="header__top header__padding d-none d-sm-block">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-7">
                                <div class="header__action d-flex justify-content-center justify-content-md-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header__info header__padding">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="header__info-left d-flex justify-content-center justify-content-sm-between align-items-center">
                                <div class="logo">
    <?php if ($pengaturan->logo && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)): ?>
        <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo" width="100">
    <?php else: ?>
        <img src="<?= base_url('img/default-logo.png') ?>" alt="Default Logo" width="100">
    <?php endif; ?>
</div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-3">
                                <div class="header__info-right">
                                    <div class="header__search f-left d-none d-sm-block">
                                    <form action="<?= base_url('home/filterMenu') ?>" method="get">
    <div class="header__search-box">
        <input type="text" name="search" placeholder="Search For Products...">
        <button type="submit">Search</button>
    </div>
    <div class="header__search-cat">
        <select name="kategori">
            <option value="">All Categories</option>
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
        </select>
    </div>
</form>
                                    </div>
                                    <div class="cart__mini-wrapper d-none d-md-flex f-right p-relative">
    <a href="javascript:void(0);" class="cart__toggle">
        <span class="cart__total-item" id="cart-count"></span>
    </a>
    <span class="cart__content">
        <span class="cart__my">My Cart:</span>
        <span class="cart__total-price" id="cart-total"></span>
    </span>
    <div class="cart__mini">
        <div class="cart__close"><button type="button" class="cart__close-btn"><i class="fal fa-times"></i></button></div>
        <ul id="cart-items">
            <li>
                <div class="cart__title">
                    <h4>My Cart</h4>
                    <span id="cart-item-count"></span>
                </div>
            </li>
        </ul>
        <li>
            <a href="<?= base_url('home/viewCart') ?>" class="t-y-btn t-y-btn-border w-100 mb-10">View & Edit Cart</a>
        </li>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   function updateCart() {
    $.ajax({
        url: "<?= base_url('home/getCart') ?>",
        type: "GET",
        dataType: "json",
        success: function (response) {
            let cartItems = response.cart;
            let totalPrice = 0;
            let totalItems = 0;
            let cartHTML = '';

            cartItems.forEach(item => {
                totalItems += parseInt(item.jumlah); // Ensure jumlah is treated as an integer
                totalPrice += item.harga * parseInt(item.jumlah); // Ensure jumlah is treated as an integer

                cartHTML += `
                `;
            });

            $("#cart-items").html(cartHTML);
            $("#cart-count").text(totalItems);
            $("#cart-item-count").text(`(${totalItems} Items in Cart)`);
            $("#cart-total").text(`Rp.${totalPrice.toFixed()}`);
        }
    });
}

    function addToCart(id_menu) {
        $.ajax({
            url: "<?= base_url('home/addToCart') ?>/" + id_menu,
            type: "GET",
            success: function () {
                updateCart();
            }
        });
    }

    function removeFromCart(id_keranjang) {
        $.ajax({
            url: "<?= base_url('home/remove') ?>/" + id_keranjang,
            type: "GET",
            success: function () {
                updateCart();
            }
        });
    }

    $(document).ready(function () {
        updateCart();
    });
</script>
</div>
</div>
                <div class="header__bottom header__padding header__bottom-border">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-6 col-6">
                              <div class="header__bottom-left d-flex d-xl-block align-items-center">
                                <div class="side-menu d-xl-none mr-20">
                                  <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i class="fas fa-bars"></i></button>
                                </div>
                                <div class="main-menu d-none d-md-block">
                                    <nav id="mobile-menu-2">
                                        <ul>
                                            <li>
                                            <a href="<?= base_url('home/menu')?>">Menu<i class="far fa-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="<?= base_url('home/makanan')?>">Makanan</a></li>
                                                    <li><a href="<?= base_url('home/minuman')?>">Minuman</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('home/dashboard')?>">Halaman<i class="far fa-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="<?= base_url('home/logout')?>">Logout</a></li>
                                                    <li><a href="<?= base_url('home/transaksi')?>">Riwayat Transaksi</a></li>
                                                    <li><a href="<?= base_url('home/viewCart')?>">Keranjang</a></li>
                                                    <li><a href="<?= base_url('home/dashboard')?>">Dashboard</a></li>
                                                </ul>
                                            </li>
                                            <?php
                                            if (session()->get('level')=='admin' || session()->get('level')=='superadmin' ){
          ?>
                                            <li>
                                                <a href="<?= base_url('home/dashboard')?>">Penting<i class="far fa-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="<?= base_url('home/logActivitytab')?>">Aktivitas Log</a></li>
                                                    <?php
                                            if (session()->get('level')=='superadmin' ){
          ?>
                                                    <li><a href="<?= base_url('home/pengaturan')?>">Pengaturan</a></li>
                                                    <?php } ?>
                                                    <li><a href="<?= base_url('home/usr')?>">User</a></li>
                                                </ul>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header area end -->