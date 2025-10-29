<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\pemohonModel;

class Pemohon extends BaseController
{
    protected $pemohon;
    protected $company;

    public function __construct()
    {
        // Load Form Helper
        helper('form');

        $this->pemohon = new PemohonModel();
        $this->company = new CompanyModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Pemohon',
            'menu'      => 'Master',
            'submenu'   => 'Data Pemohon',
            'logo'      => $this->company->first(),
            'pemohon'   => $this->pemohon->findAll(),
        ];
        return view('backend/data_pemohon/index', $data);
    }

    public function add()
    {
        // Deskripsi aturan validasi
        $rules = [
            'asal_pemohon' => [
                'rules'  => 'required|is_unique[tb_pemohon.asal_pemohon]|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form pemohon seksi tidak boleh kosong',
                    'is_unique'  => 'Data sudah tersedia',
                    'min_length' => 'Input pemohon minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input pemohon tidak boleh lebih dari 50 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'asal_pemohon'  => $this->request->getPost('asal_pemohon'),
        ];

        // Lakukan insert data pemohon
        $pemohon = $this->pemohon->insert($data);

        if ($pemohon) {
            // Redirect dengan pesan sukses jika insert berhasil
            return redirect()->to('/pemohon/index')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika insert gagal
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function update($id)
    {

        // Cek apakah pemohon dengan ID tersebut ada
        $pemohon = $this->pemohon->find($id);

        // Deskripsi aturan validasi
        $rules = [
            'asal_pemohon' => [
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form pemohon seksi tidak bolrh kosong',
                    'min_length' => 'Input pemohon minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input pemohon tidak boleh lebih dari 50 karakter.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        if (isset($pemohon)) {
            // Ambil data dari request (POST)
            $data = [
                'asal_pemohon' => $this->request->getPost('asal_pemohon'),
            ];

            // Lakukan update data pemohon
            $this->pemohon->update($id, $data);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar pemohon
            return redirect()->to('/pemohon/index')->with('success', 'Data berhasil diupdate');
        } else {
            // Jika ID pemohon tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function delete($id)
    {
        $pemohon = $this->pemohon->find($id);
        if (isset($pemohon)) {

            // Lakukan update data pemohon
            $this->pemohon->delete($id);  // Pastikan ID diberikan sebagai parameter

            // Redirect ke halaman daftar pemohon
            return redirect()->to('/pemohon/index')->with('success', 'Data berhasil dihapus');
        } else {
            // Jika ID pemohon tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
