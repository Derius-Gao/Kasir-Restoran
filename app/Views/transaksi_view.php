<!DOCTYPE html>

<html lang="id"> 
    <head> <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Riwayat Transaksi</title> 
     <style> table { width: 80%; margin: auto; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; text-align: center; } th { background-color: #f4f4f4; } </style> </head> <body> <h2 style="text-align: center;">Riwayat Transaksi</h2> 
     <table> 
        <thead> 
            <tr> 
                <th>Nomor Transaksi</th> 
                <th>Tanggal</th> 
                <th>Total Harga</th> 
                <th>Metode Pembayaran</th> 
                <th>Status Pembayaran</th> 
                <th>Bukti Pembayaran</th>
                <?php if (session()->get('level') === 'admin' || session()->get('level') === 'superadmin'): ?> 
                    <th>Aksi</th> 
                    <?php endif; ?> 
                </tr> 
            </thead> 
            <tbody>
    <?php if (empty($transactions)): ?>
        <tr>
            <td colspan="7">Tidak ada transaksi.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= esc($transaction['id_transaksi']) ?></td>
                <td><?= esc($transaction['tanggal']) ?></td>
                <td>Rp. <?= number_format($transaction['total_harga'], 0, ',', '.') ?></td>
                <td><?= esc($transaction['metode_pembayaran']) ?></td>
                <td><?= esc($transaction['status_pembayaran']) ?></td>
                <td>
                    <?php if (!empty($transaction['bukti_pembayaran'])): ?>
                        <a href="<?= base_url($transaction['bukti_pembayaran']) ?>" target="_blank" class="btn btn-success">Lihat Bukti</a>
                    <?php else: ?>
                        Tidak ada bukti
                    <?php endif; ?>
                </td>
                <?php if (session()->get('level') === 'admin' || session()->get('level') === 'superadmin'): ?>
                    <td>
                        <?php if ($transaction['status_pembayaran'] === 'pending'): ?>
                            <a href="<?= base_url('home/updateStatusPembayaran/' . $transaction['id_transaksi']) ?>" class="btn btn-success">Update ke Lunas</a>
                        <?php elseif ($transaction['status_pembayaran'] === 'Lunas'): ?>
                            <a href="<?= base_url('home/updateStatusPembayaran2/' . $transaction['id_transaksi']) ?>" class="btn btn-danger">Batal</a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
                <?php if (session()->get('level') === 'admin' || session()->get('level') === 'superadmin'){ ?>
                <td>
    <a href="<?= base_url('home/cetakBukti/' . $transaction['id_transaksi']) ?>" class="btn btn-primary">Cetak PDF</a>
</td>
<?php } ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody> 
</table> 
</body> 
</html>