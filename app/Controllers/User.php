<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function dataUser()
    {
        $session = session();
        $session->set('akses','admin');
        $session->set('akses','kasir');

        $data = [
            'listUser' => $this->user->findAll(),
            'akses' => session()->get('level')
        ];
        return view('user/data-user', $data);
    }

    public function dashboard()
    {
        $data = [
            'akses' => session()->get('level')
        ];
        return view('admin/dashboard');
        
    }

    public function login()
    {
        return view('user/login');
    }

    public function prosesLogin()
    {
        // 1 membuat validasi dorm
        $validasiForm = [
            'username' => 'required',
            'password' => 'required'
        ];
        //validasi form
        if ($this->validate($validasiForm)) {

            $user = $this->request->getPost('username');
            $pass =  $this->request->getPost('password');
            //var digunakan untuk siapa yang login
            $whereLogin = [
                'username' => $user,
                'password' => $pass
            ];

            $cekLogin = $this->user->getUser($user, $pass);

            // var_dump($cekLogin);

            if (count($cekLogin) == 1) { //untuk kasus sukses login
                // jika ditemukan 1 data
                $dataSession = [
                    'id_user' => $cekLogin[0]['id_user'],
                    'username' => $cekLogin[0]['username'],
                    'password' => $cekLogin[0]['password'],
                    'nama_user' => $cekLogin[0]['nama_user'],
                    'level' => $cekLogin[0]['level'],
                    'sudahkahLogin' => true
                ];

                session()->set($dataSession);

                return redirect()->to('/dashboard');
            } else {
                // jika tidak ditemukan data apapun
                return redirect()->to('/login')->with('pesan', '<p class="text-danger text-center">Username atau Password Salah.</p>');
            }
        }
        return view('user/login');
    }


    public function tambahUser()
    {
        return view('user/tambah-user');
    }

    public function simpanUser()
    {
        $data = [
            'nama_user' => $this->request->getPost('namaPengguna'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'level' => $this->request->getPost('level')
        ];
        $this->user->insert($data);
        return redirect()->to('data-user')->with('pesan', 'data berhasil di simpan');
    }

    public function profile()
    {
        return view('user/profile');
    }

    public function editUser($iduser)
    {
        $syarat = [
            'id_user' => $iduser
        ];
        $data = [
            'title' => 'edit_data',
            'judulHalaman' => 'edit data user',
            'listUser' => $this->user->where($syarat)->findAll()
        ];
        return view('user/edit-user', $data);
    }

    public function updateUser($iduser)
    {
        $data = [
            'nama_user' => $this->request->getPost('namaPengguna'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'level' => $this->request->getPost('level'),
        ];
        $this->user->update($iduser, $data);
        return redirect()->to('data-user');
    }

    public function delete($id)
    {
        $this->user->delete($id);
        return redirect()->to('data-user')->with('pesan', '<h1>Data Berhasil Di Hapus</h1>');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}
