<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\SeksiModel;

class Seksi extends BaseController
{
    protected $seksi;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');

        $this->company = new CompanyModel();
        $this->seksi   = new SeksiModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Seksi',
            'menu'      => 'Master',
            'submenu'   => 'Data Seksi',
            'logo'      => $this->company->first(),
            'seksi'     => $this->seksi->findAll(),
        ];
        return view('backend/data_seksi/index', $data);
    }

    public function add()
    {
        // Deskripsi aturan validasi
        $rules = [
            'nama_seksi' => [
                'rules'  => 'required|is_unique[tb_seksi.nama_seksi]|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form nama seksi tidak boleh kosong',
                    'is_unique'  => 'Data sudah tersedia',
                    'min_length' => 'Input nama seksi minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input nama seksi tidak boleh lebih dari 50 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'nama_seksi'  => $this->request->getPost('nama_seksi'),
        ];

        // Lakukan insert data seksi
        $seksi = $this->seksi->insert($data);

        if ($seksi) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/seksi/index')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function update($id)
    {
        // Cek apakah seksi dengan ID tersebut ada
        $seksi = $this->seksi->find($id);

        $rules = [
            'nama_seksi' => [
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form nama seksi tidak boleh kosong',
                    'min_length' => 'Input nama seksi minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input nama seksi tidak boleh lebih dari 50 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        if (isset($seksi)) {
            // Ambil data dari request (POST)
            $data = [
                'nama_seksi' => $this->request->getPost('nama_seksi'),
            ];

            // Lakukan update data seksi
            $this->seksi->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar seksi
            return redirect()->to('/seksi/index')->with('success', 'Data berhasil diupdate');
        } else {
            // Jika ID seksi tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $seksi = $this->seksi->find($id);
        if (isset($seksi)) {

            // Lakukan update data seksi
            $this->seksi->delete($id);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar seksi
            return redirect()->to('/seksi/index')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika ID seksi tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
