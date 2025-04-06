<form action="<?= base_url('home/simpan_pengaturan') ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="judul">Judul Aplikasi:</label>
        <input type="text" name="judul" id="judul" value="<?= $pengaturan->judul ?>" required>
    </div>

    <div>
        <label for="logo">Logo Header Saat Ini:</label><br>
        <?php if ($pengaturan->logo && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)): ?>
            <img src="<?= base_url('uploads/' . $pengaturan->logo) ?>" alt="Logo Header" width="100">
        <?php else: ?>
            <p>Logo header belum diunggah.</p>
        <?php endif; ?>
    </div>

    <div>
        <label for="logo">Unggah Logo Header Baru:</label>
        <input type="file" name="logo" id="logo" accept="image/*">
    </div>

    <div>
        <label for="logo_web">Logo Favicon Saat Ini:</label><br>
        <?php if ($pengaturan->logo_web && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)): ?>
            <img src="<?= base_url('uploads/' . $pengaturan->logo_web) ?>" alt="Logo Favicon" width="50">
        <?php else: ?>
            <p>Logo favicon belum diunggah.</p>
        <?php endif; ?>
    </div>

    <div>
        <label for="logo_web">Unggah Logo Favicon Baru:</label>
        <input type="file" name="logo_web" id="logo_web" accept="image/*">
    </div>

    <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
</form>