<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('konten'); ?>

<div class="pagetitle">
    <h1>Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>

            <li class="breadcrumb-item active">Transaksi</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card md-12">
                <div class="card-body">
                    <h1 class="card-title">Form Penjualan</h1>
                    <form class="row g-3" action="<?= site_url('transaksi-penjualan') ?>" method="POST">
                        <div class="col-md-3">
                            <div class="form-floating">

                                <input type="text" class="form-control" value="<?= $no_faktur; ?>" disabled>
                                <input type="hidden" name="txtNoFaktur" value="<?= $no_faktur; ?>">
                                <label class="form-label">Nomor Faktur</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <!-- <label class="form-label">Kode Produk</label> -->
                                <input type="hidden" value="<?= $no_faktur; ?>" name="no_faktur" class="form-control">
                                <select class="js-example-basic-single form-select" name="id_produk">
                                    <?php if (isset($produkList)) :
                                        foreach ($produkList as $row) : ?>
                                            <option value="<?= $row->id_produk; ?>"><?= $row->kode_produk; ?><?= $row->nama_produk; ?> | <?= $row->stok; ?> | <?= number_format($row->harga_jual, 0, ',', '.'); ?></option>
                                    <?php
                                        endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" value="<?= session()->get('nama_user'); ?>" disabled>
                                <input type="hidden" name="" value="<?= session()->get('nama_user'); ?>">
                                <label for="floatingCity">Kasir</label>

                            </div>
                        </div>
               
                <div class="col-md-3">
                    <div class="form-floating">
                        <label class="form-label">Jumlah</label>
                        <input type="text" name="txtqty" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn sm btn-success"><i class="bi bi-cart-fill"></i>Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <div class="col">
        <div class="row">
            <div class="col">
                <p>Tanggal : <?php
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s");
                                ?>
                </p>
            </div>
        </div>
    </div>

    <table class="table table-sm table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($detailPenjualan) && !empty($detailPenjualan)) :
                $no = 1;
                foreach ($detailPenjualan as $detail) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $detail['nama_produk']; ?></td>
                        <td><?= $detail['qty']; ?></td>
                        <td><?= number_format($detail['total_harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach;
            else : ?>
                <tr>
                    <td colspan="4">Tidak ada produk</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>



    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TOTAL : RP <?= number_format($totalHarga, 0, ',', '.'); ?></h3>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">BAYAR</label>
                    <input type="text" name="txtbayar" class="form-control" id="txtbayar">
                </div>
                <div class="mb-3">
                    <label class="form-label">KEMBALI</label>
                    <input type="text" name="kembali" class="form-control" id="kembali" readonly>
                </div>
                <div class="card-footer text-end">
                    <a href="<?= site_url('pembayaran') ?>" class="btn btn-primary">
                        SIMPAN
                    </a>

                </div>
            </div>
        </div>
    </div>


    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen-elemen yang diperlukan
            var txtBayar = document.getElementById('txtbayar');
            var kembali = document.getElementById('kembali');
            var totalHarga = <?= $totalHarga ?>; // Ambil total harga dari controller dan diteruskan ke view

            // Tambahkan event listener untuk memantau perubahan pada input bayar
            txtBayar.addEventListener('input', function() {
                // Ambil nilai yang dibayarkan
                var bayar = parseFloat(txtBayar.value);

                // Hitung kembaliannya
                var kembalian = bayar - totalHarga;

                // Tampilkan kembaliannya pada input kembali
                if (kembalian >= 0) {
                    kembali.value = kembalian.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'});
                } else {
                    kembali.value = '0'; // Jika kembalian negatif, tampilkan '0.00'
                }
            });
        });
    </script>
    <?= $this->endSection(); ?>