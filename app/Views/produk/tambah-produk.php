<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Tambah Data Produk</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Produk</li>
        </ol>
    </nav>
</div>

<?php if (session()->has('errors')) : ?>
    <?php foreach (session('errors') as $error) : ?>
        <ul>
            <li><?= $error; ?></li>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('simpan-produk'); ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="kodeProduk">Kode Produk</label>
                        <input type="text" class="form-control" id="kodeProduk" name="kodeProduk" value="<?= $kodeProduk; ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="namaProduk">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                    </div>
                   
                    <div class="form-group mb-3">
                        <label for="hargaBeli">Harga Beli</label>
                        <input type="text" class="form-control money" id="hargaBeli" name="hargaBeli">
                    </div>
                    <div class="form-group mb-3">
                        <label for="hargaJual">Harga Jual</label>
                        <input type="text" class="form-control money" id="hargaJual" name="hargaJual">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stok">stok</label>
                        <input type="text" class="form-control money" id="stok" name="stok">
                    </div>
                    <div class="form-group col-md-2 mb-3">
                        <label for="namaProduk">Nama Satuan</label>
                        <select class="form-select" id="floatingSelect" aria-label="State" name="satuan">
                            <option value="">--pilih--</option>
                            <?php foreach ($listSatuan as $value) : ?>
                                <option value="<?= $value['id_satuan'] ?>" <?= ($value === old('satuan')) ? 'selected' : '' ?>>
                                    <?= $value['nama_satuan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2 mb-3">
                        <label for="namaProduk">Nama Kategori</label>
                        <select class="form-select" id="floatingSelect" aria-label="State" name="kategori">
                            <option>--pilih--</option>
                            <?php foreach ($listKategori as $value) : ?>
                                <option value="<?= $value['id_kategori'] ?>" <?= ($value === old('kategori')) ? 'selected' : '' ?>>
                                    <?= $value['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="Reset" class="btn btn-dark mx-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>