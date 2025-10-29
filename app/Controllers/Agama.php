<?php

namespace App\Controllers;

use App\Models\AgamaModel;
use App\Models\CompanyModel;

class Agama extends BaseController
{
    protected $agama;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');

        $this->agama = new AgamaModel();
        $this->company = new CompanyModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Agama',
            'menu'      => 'Master',
            'submenu'   => 'Data Agama',
            'agama'     => $this->agama->findAll(),
            'logo'      => $this->company->first(),
        ];
        return view('backend/data_agama/index', $data);
    }

    public function add()
    {
        // Deskripsi aturan validasi
        $rules = [
            'agama' => [
                'rules'  => 'required|is_unique[tb_agama.agama]|min_length[3]|max_length[8]',
                'errors' => [
                    'required'   => 'Form agama tidak boleh kosong.',
                    'is_unique'  => 'Data sudah tersedia',
                    'min_length' => 'Input agama minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input agama tidak boleh lebih dari 8 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'agama'  => $this->request->getPost('agama'),
        ];

        // Lakukan insert data agama
        $agama = $this->agama->insert($data);

        if ($agama) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/agama/index')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function update($id)
    {
        // Cek apakah agama dengan ID tersebut ada
        $agama = $this->agama->find($id);

        // Deskripsi aturan validasi
        $rules = [
            'agama' => [
                'rules' => 'required|min_length[3]|max_length[8]',
                'errors' => [
                    'required'   => 'Form agama tidak boleh kosong.',
                    'min_length' => 'Input agama minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input agama tidak boleh lebih dari 8 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        if (isset($agama)) {
            // Ambil data dari request (POST)
            $data = [
                'agama' => $this->request->getPost('agama'),
            ];

            // Lakukan update data agama
            $this->agama->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar agama
            return redirect()->to('/agama/index')->with('success', 'Data berhasil diupdate');
        } else {
            // Jika ID agama tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $agama = $this->agama->find($id);
        if (isset($agama)) {

            // Lakukan update data agama
            $this->agama->delete($id);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar agama
            return redirect()->to('/agama/index')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika ID agama tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
