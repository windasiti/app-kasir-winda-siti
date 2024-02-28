<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpenjualan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_penjualan', 'no_faktur', 'tgl_penjualan', 'id_user', 'total'];

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
    public function getPenjualan($id = false)
    {
        $penjualan = new Mpenjualan();
        $penjualan->select('tbl_penjualan.id_penjualan, tbl_penjualan.no_faktur, tbl_penjualan.waktu, tbl_pengguna.nama_user, tbl_produk.nama_produk, tbl_produk.harga_jual');
        $penjualan->join('tbl_pengguna', 'tbl_pengguna.nama_user=tbl_penjualan.nama_user', 'LEFT');
        $penjualan->join('tbl_produk', 'tbl_produk.nama_produk=tbl_penjualan.nama_produk', 'tbl_produk.harga_jual=tbl_penjualan.harga_jual', 'LEFT');
        $penjualan->orderBy('tbl_penjualan.id_penjualan', 'desc');
        return $penjualan->find();
    }
    public function generateTransactionNumber()
    {
        // Dapatkantahunduaangkaterakhir
        $tahun = date('y');

        // Dapatkannomorurutterakhirdari database
        $lastTransaction = $this->orderBy('id_penjualan', 'DESC')->first();

        // Ambilnomorurutterakhiratausetelke 0 jikabelumadatransaksisebelumnya
        $lastNumber = ($lastTransaction) ? intval(substr($lastTransaction['no_faktur'], -4)) : 0;

        // Increment nomorurut
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        // Hasilkannomortransaksidengan format SCDPSYYMMDDXXXX
        $no_faktur = 'KSRWD' . $tahun . date('md') . $nextNumber;

        // Simpannomortransaksidalamsesi
        session()->set('GeneratedTransactionNumber', $no_faktur);

        return $no_faktur;
    }

    public function getTotalHargaById($idPenjualan)
    {
        $query = $this->select('total')->where('id_penjualan', $idPenjualan)->first();
        // Periksaapakahhasilkueritidakkosongsebelummengaksesindeks 'total'
        if ($query) {
            return $query['total'];
        } else {
            // Jikahasilkuerikosong, kembalikannilai default, misalnya 0
            return 0;
        }
    }
}
