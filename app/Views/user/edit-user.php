<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Edit Pengguna</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header fw-bold">
                Form Edit Pengguna
            </div>
            <div class="card-body">
                <form action="<?= site_url('update-user/') . $listUser[0]['id_user']; ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="namaPengguna">Nama Pengguna</label>
                        <input type="text" class="form-control" id="namaPengguna" name="namaPengguna" value="<?= $listUser[0]['nama_user']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $listUser[0]['username']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="pass">Pasword</label>
                        <input type="text" class="form-control" id="pass" name="password" value="<?= $listUser[0]['password']; ?>">
                    </div>
                    <div class="col-12">
                        <label for="level" class="form-label">Level</label>
                        <select id="level" name="level" class="form-select">
                            <option selected value="">--pilih--</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    </select>
                    <div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?= $this->endSection(); ?>