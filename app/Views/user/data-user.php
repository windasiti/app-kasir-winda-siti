<?= $this->extend('layout/tamplate'); ?>
<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1> Data Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item active">Pengguna</li>

        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="<?= site_url('tambah-user') ?>" class="btn btn-primary">Tambah Data User</a>
                    </div>
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($listUser as $row) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>

                                    </td>
                                    <td>
                                        <?= $row['nama_user']; ?>
                                    </td>
                                    <td>
                                        <?= $row['username']; ?>
                                    </td>
                                    <td>
                                        <?= $row['password']; ?>
                                    </td>
                                    <td>
                                        <?= $row['level']; ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('edit-user/' . $row['id_user']); ?>" class="btn btn-warning">Edit</a>
                                        <a href="<?= site_url('hapus-user/' . $row['id_user']); ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data ini?');">Hapus</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>