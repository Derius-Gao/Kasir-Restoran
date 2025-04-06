<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/home/aksi_reset_password_save') ?>" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <label>Password Baru:</label>
        <input type="password" name="password" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
