<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <style>
    body {
        display: flex;
        flex-direction: column; /* Mengatur elemen dalam kolom */
        justify-content: flex-start; /* Header tetap di atas */
        align-items: center; /* Kontainer keranjang tetap di tengah horizontal */
        min-height: 100vh;
        margin: 0;
        background-color: #f9f9f9;
    }
    .cart-container {
        width: 600px; /* Lebar diperbesar */
        max-width: 90%; /* Agar responsif di layar kecil */
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 100px; /* Memberikan jarak dari header */
    }
    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .cart-item img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }
    .quantity-input {
        width: 50px;
        text-align: center;
    }
    .remove-button {
        background: red;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }
    .total-price {
        font-weight: bold;
        margin-bottom: 15px;
        text-align: right;
    }
    .checkout-button {
        display: block;
        width: 100%;
        background: gold;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
    .checkout-button:hover {
        background: #f1c40f;
    }
    label {
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="cart-container">
    <h3>Keranjang Saya (<?= count($cart) ?> Items)</h3>
    
    <?php $total = 0; ?>
    <?php foreach ($cart as $item): ?>
        <?php $total += $item['harga'] * $item['jumlah']; ?>
        <div class="cart-item">
            <div>
                <p><?= esc($item['nama_menu']) ?> - <?= esc($item['kategori']) ?></p>
                <p>Rp. <?= number_format($item['harga'], 0, ',', '.') ?> x 
                    <form action="<?= base_url('home/update_cart')?>" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= esc($item['id_keranjang']) ?>">
                        <input type="number" name="jumlah" value="<?= esc($item['jumlah']) ?>" class="quantity-input" min="1">
                        <button type="submit">Update</button>
                    </form>
                </p>
            </div>
            <form action="<?=base_url('home/remove_cart')?>" method="post" style="margin: 0;">
                <input type="hidden" name="id" value="<?= esc($item['id_keranjang']) ?>">
                <button type="submit" class="remove-button">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>

    <?php if (!empty($cart)): ?>
    <div class="total-price">
        Total: Rp. <?= number_format($total, 0, ',', '.') ?>
    </div>
    <form action="<?= base_url('home/checkout') ?>" method="post" enctype="multipart/form-data">
        <label for="metode_pembayaran">Metode Pembayaran:</label>
        <select name="metode_pembayaran" id="metode_pembayaran" required onchange="togglePaymentInfo(this.value)">
            <option value="Bank">Bank</option>
            <option value="Gopay">Gopay</option>
            <option value="Ovo">Ovo</option>
        </select>

        <!-- Informasi pembayaran -->
        <div id="payment-info" style="margin-top: 10px;">
            <!-- Informasi rekening bank -->
            <div id="bank-info" style="display: none;">
                <p>Silakan lakukan pembayaran ke rekening berikut:</p>
                <strong>Bank XYZ</strong><br>
                No. Rekening: <strong>123-456-789</strong><br>
                Atas Nama: <strong>Restoran Bispark</strong>
            </div>

            <!-- Informasi Gopay -->
            <div id="gopay-info" style="display: none;">
                <p>Silakan lakukan pembayaran ke nomor Gopay berikut:</p>
                <strong>0821-7063-9694</strong><br>
                Atas Nama: <strong>Restoran Bispark</strong>
            </div>

            <!-- Informasi Ovo -->
            <div id="ovo-info" style="display: none;">
                <p>Silakan lakukan pembayaran ke nomor Ovo berikut:</p>
                <strong>0821-7063-9694</strong><br>
                Atas Nama: <strong>Restoran Bispark</strong>
            </div>
        </div>

        <!-- Input untuk unggah bukti pembayaran -->
        <div id="upload-field" style="margin-top: 10px;">
            <label for="bukti_pembayaran">Unggah Bukti Pembayaran:</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required>
        </div>

        <button type="submit" class="checkout-button">Checkout</button>
    </form>
<?php else: ?>
    <p>Keranjang Anda kosong. Silakan tambahkan item ke keranjang untuk melanjutkan ke pembayaran.</p>
<?php endif; ?>

<script>
    function togglePaymentInfo(paymentMethod) {
        document.getElementById('bank-info').style.display = paymentMethod === 'Bank' ? 'block' : 'none';
        document.getElementById('gopay-info').style.display = paymentMethod === 'Gopay' ? 'block' : 'none';
        document.getElementById('ovo-info').style.display = paymentMethod === 'Ovo' ? 'block' : 'none';
    }
</script>
</div>

</body>
</html>