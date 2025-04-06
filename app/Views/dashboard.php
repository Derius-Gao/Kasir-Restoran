<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Morning Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-box {
            width: 200px;
            height: 150px;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .dashboard-box:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .menu-box {
            background-color: #007bff;
        }
        .cart-box {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Kotak Menu -->
        <a href="<?= base_url('home/menu') ?>" class="dashboard-box menu-box">
            Menu
        </a>

        <!-- Kotak Keranjang -->
        <a href="<?= base_url('home/viewCart') ?>" class="dashboard-box cart-box">
            Keranjang
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>