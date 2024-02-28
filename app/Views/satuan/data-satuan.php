<?= $this->extend('layout/tamplate') ?>;

<?= $this->section('konten') ?>;

<div class="pagetitle">
    <h1>Data Satuan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item active">Satuan </li>
        </ol>
    </nav>
</div>

<?php
if (session()->getFlashdata('pesan')) {
    echo session()->getFlashdata('pesan');
}
?>

<div class="row mb-4">
    <div class="col-lg-4">
        <a href="<?= site_url('tambah-satuan') ?>" class="btn btn-primary">Tambah Data Satuan</a>
    </div>
</div>
<!-- End Page Title -->
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body mt-4">

                <!-- Table with stripped rows -->
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Id Satuan</th>
                            <th>Nama Produk</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($listSatuan as $row) : ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $row['nama_satuan']; ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('edit-satuan/' . $row['id_satuan']); ?>" class="btn btn-warning">Edit</a>
                                    <a href="<?= site_url('hapus-satuan/' . $row['id_satuan']); ?>"  id="hapusSatuan" data-id="<?= $row['id_satuan']; ?>" class="btn btn-danger" onclick=" return confirm('apakah anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>