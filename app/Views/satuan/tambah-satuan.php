<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Tambah Data Satuan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Satuan Produk</li>
        </ol>
    </nav>
</div>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Satuan Produk</h5>
                        <form action="<?= site_url('simpan-satuan') ?>" method="post" class="row g-3">
                            <? csrf_field(); ?>
                            <div class="col-md-12">
                                <div class="from-floating">
                                    <input type="text" class="form-control" name="txtNamaSatuan" id="txtNamaSatuan" placeholder="Masukan Satuan Produk" autofocus>

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