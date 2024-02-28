<?php

namespace App\Controllers;
use App\Controllers\BaseController;


use Dompdf\Dompdf;

class LaporanStok extends BaseController
{
    public function generate()
    {
        $dompdf = new Dompdf();

        $data = [
            'title' => 'Laporan Stok',
            'listLaporan' => $this->laporan->getLaporan()
        ];

        $html = view('laporan/pdf_view', $data);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        // Tampilkan atau unduh file PDF
        $dompdf->stream('Laporan Stok Produk', ['Attachment' => 0]);
    }
}
