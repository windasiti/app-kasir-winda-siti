<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 0 auto;
            width: 100%;
        }

        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Stok Produk</h1>
        <hr>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Produk</th>
                    <th>Ukuran</th>
                    <th>Harga Beli</th>
                    <th>Harga jual</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($listLaporan)) {
                    $no = null;
                    foreach ($listLaporan  as $row) {
                        $no++;
                ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_produk']; ?></td>
                            <td><?= $row['ukuran']; ?></td>
                            <td><?= $row['harga_beli']; ?></td>
                            <td><?= $row['harga_jual']; ?></td>
                            <td style="background-color: <?= $row['stok'] == 0 ? '#ffcccc' : 'transparent'; ?>"><?= $row['stok']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>