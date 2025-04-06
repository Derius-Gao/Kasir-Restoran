<h2>User</h2>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Input User</h1>
        <nav>
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="<? base_url('home/dashboard')?>">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
<h2>User</h2>
<form action="<?= base_url('home/input_user1')?>" method="POST">
     <div class="mb-3 mt">
        <label for="nama" class="form-label">Nama: </label>
        <input type="text" placeholder="Masukkan Nama" class="form-control" name="nama_user" required>
    </div>
     <div class="mb-3 mt">
        <label for="username" class="form-label">Username: </label>
        <input type="text" placeholder="Masukkan username" class="form-control" name="username" required>
    </div>
    <div class="mb-3 mt">
        <label for="email" class="form-label">Email: </label>
        <input type="text" placeholder="Masukkan Email" class="form-control" name="email" required>
    </div>
    <div class="mb-3 mt">
        <label for="password" class="form-label">Password: </label>
        <input type="text" placeholder="masukkan password" class="form-control" name="password" required>
    </div>
     <div class="mb-3 mt">
        <label for="level" class="form-label">Level: </label>
        <select class="form-control" name="level">
            <option>pelanggan</option>
            <option>kasir</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Simpan">
        <input type="reset" value="Reset">
        <input type="button" value="Kembali" onclick="window.history.back()">
    </div>
</form>
</body>
</html>
       </div>
                </div>
            </div>
        </div>
            </div>
    </section>

</main><!-- End #main -->