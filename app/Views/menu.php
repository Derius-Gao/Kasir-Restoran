<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
    <style>
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .menu-card {
            width: 300px;
            padding: 15px;
            background-color: gold;
            border-radius: 10px;
            text-align: center;
        }
        .buy-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .add-menu-button {
            background-color: blue;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .add-menu-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <h1>Daftar Menu</h1>
        <?php if (session()->get('level') === 'admin' || session()->get('level') === 'superadmin'): ?>
            <a href="<?= base_url('home/inputMenu') ?>" class="add-menu-button">Tambah Menu</a>
        <?php endif; ?>
    </div>

    <div class="menu-container">
        <?php foreach ($menus as $menu): ?>
            <div class="menu-card">
                <h3><?= esc($menu['nama_menu']) ?></h3>
                <p>Rp. <?= number_format($menu['harga'], 0, ',', '.') ?> - <?= esc($menu['kategori']) ?></p>
                
                <a href="<?= base_url('home/addToCart/' . $menu['id_menu']) ?>">
                    <button class="buy-button" onclick="return confirm('Mau Pesan?')">Shop</button>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>