<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Kategori Produk</h5>

                    <!--floating labels form -->
                   <form method="POST" action="<?=site_url('update-kategori');?>">
                   <div class="row mb-3">
                   <label for="inputText" class="col-sm-2 col-form-label">Nama Kategori</label>
                   <div class="col-md-12">
                    <input type="hidden" class="form-control" id="hidden" name="id_kategori" value="<?=$listKategori[0]['id_kategori'];?>">
                    <input type="text" class="form-control" id="imputName4" name="nama_kategori" value="<?=$listKategori[0]['nama_kategori'];?>">
                    </div>
                    </div>
        
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
</div>
</div>

</main><!-- End #main -->

<?= $this->endSection(); ?>