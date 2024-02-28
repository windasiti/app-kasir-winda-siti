<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function index()
    {

        return view('admin/dashboard');
    }
    public function dataKategori()
    {
        $data = [
            'listKategori' => $this->kategori->findAll()
        ];
        return view('kategori/data-kategori', $data);
    }
    public function tambahKategori()
    {

        return view('kategori/tambah-kategori');
    }

    public function simpanKategori()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('txtNamaKategori')
        ];

        $this->kategori->insert($data);

        return redirect()->to('data-kategori')->with('pesan', '<div class="alert alert-success" role="alert">
        Data berhasil disimpan
      </div>');
    }

    public function hapusKategori($id)
    {

        $this->kategori->delete($id);

        return redirect()->to('data-kategori')->with('pesan', '<h1>Data Berhasil Di Hapus</h1>');
    }
    public function editKategori($idkategori)
    {
        $syarat = [
            'id_kategori' => $idkategori
        ];
        $data = [
            'title' => 'edit_data',
            'judulHalaman' => 'edit data kategori',
            'listKategori' => $this->kategori->where($syarat)->findAll()
        ];
        return view('kategori/edit-kategori', $data);
    }
    public function updateKategori()
    {
        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ];
        $this->kategori->update($this->request->getVar('id_kategori'), $data);
        return redirect()->to('data-kategori');
    }
    public function delete($id)
    {
        $this->kategori->delete($id);
        return redirect()->to('/data-kategori')->with('pesan', 'data telah terhapus.');
    }
    public function cek_keterkaitan_data($id)
    {
        // Lakukan pemeriksaan keterkaitan data
        $keterkaitan = $this->kategori->cekKeterkaitan($id);

        // Kirim respon ke AJAX
        return $this->response->setJSON(['has_keterkaitan' => $keterkaitan]);
    }
}
