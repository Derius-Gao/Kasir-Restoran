<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .receipt {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #444;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            line-height: 1.6;
        }
        .bukti-image {
            text-align: center;
            margin-top: 20px;
        }
        .bukti-image img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="receipt">
        <h2>NOTA KASIR</h2>
        <div class="header">
            app. WEB, kasir restoran <br>
            Telp: 0821-7063-9694
        </div>

        <div class="info">
            <p><strong>Nomor Transaksi:</strong> <?= esc($transaksi['id_transaksi']) ?></p>
            <p><strong>Tanggal:</strong> <?= esc($transaksi['tanggal']) ?></p>
            <p><strong>Total Harga:</strong> Rp. <?= number_format($transaksi['total_harga'], 0, ',', '.') ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= esc($transaksi['metode_pembayaran']) ?></p>
            <p><strong>Status Pembayaran:</strong> <?= esc($transaksi['status_pembayaran']) ?></p>
        </div>
        <div class="footer">
            <p>Terima kasih telah melakukan pembayaran. Jika ada pertanyaan, silakan hubungi kami.</p>
        </div>
    </div>
</body>
</html>