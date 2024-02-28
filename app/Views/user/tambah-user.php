<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Tambah Data Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Pengguna</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('simpan-user/')?>" method="post">
                    <h5 class="card-title">Tambah Pengguna</h5>
                    <div class="form-group mb-3">
                        <label for="namaPengguna">Nama Pengguna</label>
                        <input type="text" class="form-control" id="namaPengguna" name="namaPengguna">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
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