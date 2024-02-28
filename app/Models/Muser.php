<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_pengguna';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_user', 'username', 'password', 'level'];

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
    public function getUser($user, $pass)
    {
        $where = [
            'username' => $user,
            'password' => $pass
        ];
        $user = new Muser();
        $user->select('tbl_pengguna.nama_user, tbl_pengguna.username, tbl_pengguna.password, tbl_pengguna.level, tbl_pengguna.id_user');
        $user->where($where);
        return $user->find();
    }
    public function updateUser($id = false)
    {
      if ($id == false) {
         return $this->findAll();
      }
      return $this->where(['id_user' => $id])->first();
    }
    public function getEnumValues()
    {
        $query = $this->db->query("SHOW COLUMS FORM tbl_pengguna WHERE field = 'level'");
        $row = $query->getRow();
        $enum = explode("','", substr($row->type, 6, -2));

        return $enum;
    }
}
