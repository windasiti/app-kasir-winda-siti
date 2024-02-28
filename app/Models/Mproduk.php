<?php

namespace App\Models;

use CodeIgniter\Model;

class Mproduk extends Model
{

    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_produk', 'nama_produk','', 'harga_beli', 'harga_jual','id_satuan','id_kategori', 'stok'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function getProduk($id = false)
    {
       $produk = new Mproduk();
       $produk->select('tbl_produk.id_produk, tbl_produk.kode_produk, tbl_produk.nama_produk, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_satuan.nama_satuan, tbl_kategori.nama_kategori, tbl_produk.stok');
       $produk->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_produk.id_kategori', 'LEFT');
       $produk->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan', 'LEFT');
       $produk->orderBy('tbl_produk.id_produk', 'desc');
       return $produk->find();
    }
    public function getLaporan($id = false)
    {
       $laporan = new Mproduk();
       $laporan->select('tbl_produk.id_produk, tbl_produk.kode_produk, tbl_produk.nama_produk,  tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.stok');
       $laporan->orderBy('tbl_produk.id_produk', 'desc');
       return $laporan->find();
    }

        public function updateProduk($id = false)
       {
         if ($id == false) {
            return $this->findAll();
         }
         return $this->where(['id_produk' => $id])->first();
       }

       public function generateProductCode()
       {
        $prefix = 'PRD';
        $lastProduct = $this->orderBy('id_produk', 'DESC')->first();

        if (!$lastProduct) {
            $code = $prefix . '001';
        } else {
            $lastCode = substr ($lastProduct['kode_produk'], strlen($prefix));
            $nextCode = str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
            $code = $prefix . $nextCode;
        }
        return $code;
        }
        public function cekKeterkaitan($id)
    {
        // Contoh: Cek apakah data dengan ID yang diberikan digunakan di tabel lain
        $builder = $this->db->table('tbl_produk');
        $builder->where('id_satuan', $id);
        $count = $builder->countAllResults();

        // Jika terdapat keterkaitan, kembalikan true, jika tidak, kembalikan false
        return ($count > 0);
    }
    public function getAllProduk(){
        $produk= NEW MProduk;
        $queryproduk=$produk->query("CALL lihat_produk()")->getResult();
        return $queryproduk;
        }
        
       }

