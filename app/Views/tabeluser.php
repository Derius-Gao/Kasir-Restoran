<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Data Pengguna</li>
            </ol>
        </nav>
</div>
    <?php if (session()->get('level') == 'superadmin') { ?>
    <div class="mb-3">
        <a href="<?= base_url('home/deletedUsers') ?>" class="btn btn-info">Tabel Pengguna Terhapus</a>
    </div>
 <?php } ?>
    <section class="section">
        <div class="row">
            <!-- Dashboard Summary -->
            <div class="col-lg-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3><?= $total_admin ?></h3>
                        <p>Administrator</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h3><?= $total_kasir ?></h3>
                        <p>Total Kasir</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h3><?= $total_pelanggan ?></h3>
                        <p>Total Pelanggan</p>
                    </div>
                </div>
            </div>

            <!-- Input Button -->
            <?php 
            if (!isset($marah) || !is_array($marah)) {
                $marah = [];
            }

            $roles = [ 
                'Admin' => 'admin',
                'Kasir' => 'kasir',
                'Pelanggan' => 'pelanggan'
            ];

            foreach ($roles as $role_name => $role_id) {
                $filtered_users = array_filter($marah, function($user) use ($role_id) {
                    return $user['level'] == $role_id;
                });

                if (!empty($filtered_users)): ?>
                    <div class="widget-content nopadding">
                        <h3>Data <?= $role_name ?></h3>
                        <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin'): ?>
                                        <th>Edit</th>
                                    <?php endif; ?>
                                    <?php if (session()->get('level') == 'superadmin'): ?>
                                        <th>Hapus</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($filtered_users as $user): ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?= $no++; ?>.</td>
                                        <td><?= $user['nama_user']; ?></td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['level']; ?></td>
                                        <?php if (session()->get('level') == 'superadmin' || session()->get('level') == 'admin'): ?>
                                            <td>
                                                <a href="<?= base_url('home/edituser/' . $user['id_user']) ?>">
                                                    <button class="btn btn-info">Detail</button>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (session()->get('level') == 'superadmin'): ?>
                                            <td>
                                                <?php if ($user['delete_status'] == 0): ?>
                                                    <a href="<?= base_url('home/softDeleteUser/' . $user['id_user']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">❌ Hapus</a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php 
                endif; 
            } 
            ?>
        </div>
    </section>
</main>