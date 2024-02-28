<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Satuan extends BaseController
{
    public function index()
    {

        return view('admin/dashboard');
    }

    public function dataSatuan()
    {
        $data = [
            'listSatuan' => $this->satuan->findAll()
        ];
        return view('satuan/data-satuan', $data);
    }
    public function tambahSatuan()
    {

        return view('satuan/tambah-satuan');
    }
    public function simpanSatuan()
    {
        $data = [
            'nama_satuan' => $this->request->getPost('txtNamaSatuan')
        ];

        $this->satuan->insert($data);

        return redirect()->to('data-satuan')->with('pesan', '<h1>Data Berhasil Di simpan</h1>');
    }

    public function hapusSatuan($id)
    {

        $this->satuan->delete($id);

        return redirect()->to('data-satuan')->with('pesan', '<h1>Data Berhasil Di Hapus</h1>');
    }
    public function editSatuan($idsatuan){
        $syarat=[
            'id_satuan'=>$idsatuan
        ];
        $data=[
        'title' => 'edit_data',
        'judulHalaman' => 'edit data satuan',
        'listSatuan' => $this->satuan->where($syarat)->findAll()
        ];
        return view('satuan/edit-satuan', $data);

        
    }
    public function updateSatuan(){
        $data=[
            'id_satuan'=>$this->request->getVar('id_satuan'),
            'nama_satuan'=>$this->request->getVar('nama_satuan'),
        ];
        $this->satuan->update($this->request->getVar('id_satuan'),$data);
        return redirect()-> to('data-satuan');
    }
 
    public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->satuan->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
}
