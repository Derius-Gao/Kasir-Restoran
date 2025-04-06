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
        <link rel="shortcut icon" href="<?= base_url($pengaturan->logo ? 'writable/uploads/' . $pengaturan->logo : 'img/default-logo.png') ?>" type="image/x-icon">

        <!-- Tambahkan logo di atas title -->
        <?php if ($pengaturan->logo && file_exists(WRITEPATH . 'uploads/' . $pengaturan->logo)): ?>
            <img src="<?= base_url('writable/uploads/' . $pengaturan->logo) ?>" alt="Logo">
        <?php endif; ?>

		<!-- CSS here -->

        <div id="google_translate_element"></div>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'en,id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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

  <main>
<div class="container">
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

          <!-- Login Card -->
          <div class="card mb-3" style="width: 100%; max-width: 500px; min-height: 300px;">
            <div class="card-body d-flex flex-column justify-content-between">

              <!-- Header -->
              <div>
                  <!-- Logo -->
          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
             <a href="<?= base_url() ?>" class="app-brand-link gap-3">
    <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" 
         alt="Logo" 
         style="max-height: 50px;"/>
            </a>
          </div>
          <!-- End Logo -->
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Reset your password</h5>
                  <p class="text-center small">Enter the email address linked to your account and we'll send you an email.</p>
                </div>
              </div>
              <!-- End Header -->

              <!-- Forgot Password Form -->
              <div>
                <form action="<?= base_url('home/aksi_forgot_password') ?>" method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input 
                      type="email" 
                      class="form-control" 
                      id="email" 
                      name="email" 
                      placeholder="Enter your email" 
                      style="height: 50px;" 
                      required>
                  </div>
                  <div class="d-grid mt-auto">
                <button type="submit" class="btn btn-primary">Send Link</button>
              </div>
                </form>

              </div>
              <!-- End Forgot Password Form -->

              <!-- Submit Button -->
              
              <!-- End Submit Button -->

            </div>
          </div>
          <!-- End Login Card -->
        </div>
      </div>
    </div>
  </section>
</div>
 </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Template Main JS File -->
</body>

</html>