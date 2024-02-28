<?= $this->extend('layout/tamplate') ?>;

<?= $this->section('konten') ?>;

<div class="pagetitle">
    <h1>Data Laporan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Data Laporan</li>
        </ol>
    </nav>
</div>

<?php
if (session()->getFlashdata('pesan')) {
    echo session()->getFlashdata('pesan');
}
?>

<div class="row mb-3">
    <div class="col-lg-12">
        <a href="<?= site_url('cetak-laporan'); ?>" class="btn btn-primary">Print PDF</a>
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
                            <th>No.</th>
                            <th>Nama Produk</th>
                           
                            <th>Harga Beli</th>
                            <th>Harga jual</th>
                            <th>Stock</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($listLaporan as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_produk']; ?></td>
                             
                                <td><?= $row['harga_beli']; ?></td>
                                <td><?= $row['harga_jual']; ?></td>
                                <td><?= $row['stok']; ?></td>
                                <td>
                                    <!--<a href="<?= site_url('edit-produk/' . $row['id_produk']); ?>" class="btn btn-warning">Edit</a>
                                    <a href="<?= site_url('hapus-produk/' . $row['id_produk']); ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data ini?');">Hapus</a>-->
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