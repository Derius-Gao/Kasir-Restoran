<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minuman - Morning Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .promo-card { background: #FFC107; color: black; padding: 20px; border-radius: 10px; }
        .menu-icon { text-align: center; margin-top: 20px; }
        .menu-icon img { width: 50px; }
    </style>
</head>
<body>
    <!-- Promo Section -->
  <div class="container mt-4">
    <div class="row g-3"> 
       <div class="col-mt-3">
    <div class="promo-card d-flex justify-content-between align-items-center">
        <div>
            <h5>Teh Tarik Panas</h5>
            <a href="#" class="btn btn-danger">Shop</a>
        </div>
        <img src="<?= base_url('img/tehtarik3.jpeg')?>" alt="Teh Tarik Panas" class="promo-img">
    </div>
</div>
               <div class="col-mt-3">
    <div class="promo-card d-flex justify-content-between align-items-center">
        <div>
            <h5>Kopi Tarik</h5>
            <a href="#" class="btn btn-danger">Shop</a>
        </div>
        <img src="<?= base_url('img/tehtarik3.jpeg')?>" alt="Kopi tarik" class="promo-img">
    </div>
</div>
               <div class="col-mt-3">
    <div class="promo-card d-flex justify-content-between align-items-center">
        <div>
            <h5>Kopi Susu</h5>
            <a href="#" class="btn btn-danger">Shop</a>
        </div>
        <img src="<?= base_url('img/tehtarik3.jpeg')?>" alt="Kopi susu" class="promo-img">
    </div>
</div>
              <div class="col-mt-3">
    <div class="promo-card d-flex justify-content-between align-items-center">
        <div>
            <h5>Teh Obeng</h5>
            <a href="#" class="btn btn-danger">Shop</a>
        </div>
        <img src="<?= base_url('img/tehtarik3.jpeg')?>" alt="Teh obeng" class="promo-img">
    </div>
</div>
        </div>
    </div>

    <!-- Ikon Menu Bawah -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
