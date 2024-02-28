<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Tambah Data Kategori</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Kategori Produk</li>
        </ol>
    </nav>
</div>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Kategori Produk</h5>

                        <form action="<?= site_url('simpan-kategori') ?>" method="post" class="row g-3">
                            <? csrf_field(); ?>
                            <div class="col-md-12">
                                <div class="from-floating">
                                    <input type="text" class="form-control" name="txtNamaKategori" id="txtNamaKategori" placeholder="Masukan Kategori Produk" autofocus>

                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?= $this->endSection(); ?>