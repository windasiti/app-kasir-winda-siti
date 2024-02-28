<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produk extends BaseController
{

    public function index()
    {

        return view('admin/dashboard');
    }
    public function dataProduk()
    {
        $data = [
            'listProduk' => $this->produk->getProduk()
        ];
        return view('produk/data-produk', $data);
    }
    public function dataLaporan()
    {
        $data = [
            'listLaporan' => $this->laporan->getLaporan()
        ];
        return view('laporan/data-laporan', $data);
    }
    public function tambahProduk()
    {
        $data = [
            'listSatuan' => $this->satuan->findAll(),
            'listKategori' => $this->kategori->findAll(),
            'kodeProduk' => $this->produk->generateProductCode()
        ];
        return view('produk/tambah-produk', $data);
    }

    public function simpanProduk()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $rules = [
            'kodeProduk' => 'required|is_unique[tbl_produk.kode_produk]',
            'namaProduk' => 'required|is_unique[tbl_produk.nama_produk]',
            
            'hargaBeli' => 'required',
            'hargaJual' => 'required|checkHargaValid[txtHargaBeli,txtHargaJual]',
            'stok' => 'required|greater_than[0]',
            'satuan' => 'required',
            'kategori' => 'required',
        ];

        $messages = [
            'kodeProduk' => [
                'required' => 'Tidak boleh kosong!',
                'is_unique' => 'Kode produk sudah ada!',
            ],
            'namaProduk' => [
                'required' => 'Nama produk tidak boleh kosong!',
                'is_unique' => 'Nama produk sudah ada!'

            ],
            'satuan' => [
                'required' => 'Satuan tidak boleh kosong!',
            ],
            'hargaBeli' => [
                'required' => 'Harga beli tidak boleh kosong!',
            ],
            'hargaJual' => [
                'required' => 'Harga jual tidak boleh kosong!',
                'checkHargaValid' => 'Harga jual tidak boleh lebih kecil dari harga beli!'
            ],
            'stok' => [
                'required' => 'Stok tidak boleh kosong!',
                'greater_than' => 'Stok harus lebih besar dari 0!'
            ],
            'satuan' => [
                'required' => 'Satuan tidak boleh kosong!',
            ],
            'kategori' => [
                'required' => 'kategori tidak boleh kosong!',
            ],
        ];

        // set validasi
        $validation->setRules($rules, $messages);

        // cek validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'kode_produk' => $this->request->getPost('kodeProduk'),
            'nama_produk' => $this->request->getPost('namaProduk'),
          
            'harga_beli' => str_replace('.', '', $this->request->getPost('hargaBeli')),
            'harga_jual' => str_replace('.', '', $this->request->getPost('hargaJual')),
            'stok' => str_replace('.', '', $this->request->getPost('stok')),
            'id_satuan' => $this->request->getPost('satuan'),
            'id_kategori' => $this->request->getPost('kategori'),
            'diskon' => str_replace('%', '', $this->request->getPost('diskon'))
        ];

        // var_dump($data);

        $this->produk->insert($data);

        return redirect()->to('data-produk')->with('pesan', '<h1>Data Berhasil Di simpan</h1>');
    }


    public function hapusProduk($id)
    {

        $this->produk->delete($id);

        return redirect()->to('data-produk')->with('pesan', '<h1>Data Berhasil Di Hapus</h1>');
    }
    public function editProduk($idproduk)
    {
        $data = [
            'title' => 'edit_data',
            'judulHalaman' => 'edit data produk',
            'listSatuan' => $this->satuan->findAll(),
            'listKategori' => $this->kategori->findAll(),
            'produk' => $this->produk->find($idproduk)
        ];
        return view('produk/edit-produk', $data);
    }
    public function updateProduk($idproduk)
    {
        $data = [
            'kode_produk' => $this->request->getVar('kodeProduk'),
            'nama_produk' => $this->request->getVar('namaProduk'),
           
            'harga_beli' => $this->request->getVar('hargaBeli'),
            'harga_jual' => $this->request->getVar('hargaJual'),
            'stok' => $this->request->getVar('stok'),
            'id_satuan' => $this->request->getVar('satuan'),
            'id_kategori' => $this->request->getVar('kategori'),
        ];
        $this->produk->update($idproduk, $data);
        return redirect()->to('data-produk');
    }

    public function delete($id)
    {
        $this->produk->delete($id);
        return redirect()->to('/data-produk')->with('pesan', 'data telah terhapus.');
    }
}
