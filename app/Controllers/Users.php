<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;


class Users extends BaseController
{
    protected $db;
    protected $builder;
    protected $user_model;
    protected $company;

    public function __construct()
    {
        helper('form');
        $this->db         = \Config\Database::connect();
        $this->builder    = $this->db->table('users');
        $this->user_model = new UserModel();
        $this->company    = new CompanyModel();
    }

    public function index()
    {
        $this->builder->select('users.id as userid, username, email, active, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query   = $this->builder->get();

        $data = [
            'title' => 'Manajemen Akun',
            'logo'  => $this->company->first(),
            'users' => $query->getResultArray(),
            'roles' => $this->db->table('auth_groups')->get()->getResultArray(),

        ];
        return view('backend/data_akun/index', $data);
    }

    public function add()
    {
        $user_myth = new UserModel();
        $password  = $this->request->getVar('password'); // Ambil input password dari form

        $user_myth->withGroup($this->request->getVar('role'))->save([
            'email'         => $this->request->getVar('email'),
            'username'      => $this->request->getVar('username'),
            'password_hash' => Password::hash($password), // Hash password sebelum disimpan
            'active'        => 1
        ]);

        session()->setFlashdata('success', 'Berhasil menambahkan pengguna');
        return redirect()->to('/users');
    }

    public function repassword()
    {
        $data = [
            'title' => 'Ubah Password',
            'validation' => \Config\Services::validation(),
            'logo'      => $this->company->first(),
        ];
        return view('backend/profile/repassword', $data);
    }

    public function savepassword()
    {
        $users = new UserModel();
        $user = $users->find(user_id()); // Mengambil user berdasarkan ID

        // Validasi input
        if (!$this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min_length[6]',
            'confirm_password' => 'matches[new_password]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        // **Perbaikan akses properti objek**
        if (!Password::verify($currentPassword, $user->password_hash)) {
            return redirect()->back()->with('error', 'Password lama salah!');
        }

        // Hash password baru dan update
        $users->update(user_id(), ['password_hash' => Password::hash($newPassword)]);

        return redirect()->to('/users/repassword')->with('success', 'Password berhasil diubah!');
    }


    public function aktif($id)
    {
        // Validasi ID
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        // Ambil data pengguna berdasarkan ID
        $user = $this->builder->where('id', $id)->get()->getRow();

        if ($user) {
            // Data untuk diupdate
            $newStatus = $user->active == '1' ? '0' : '1'; // Toggle status aktif/non-aktif
            $data = [
                'active' => $newStatus,
            ];

            // Update data di database
            $this->builder->where('id', $id)->update($data);

            // Redirect dengan pesan sukses
            return redirect()->to('/users/index')->with('success', 'Status berhasil diperbarui.');
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function nonaktif($id)
    {
        // Validasi ID
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        // Ambil data pengguna berdasarkan ID
        $user = $this->builder->where('id', $id)->get()->getRow();

        if ($user) {
            // Data untuk diupdate
            $newStatus = $user->active == '1' ? '0' : '1'; // Toggle status aktif/non-aktif
            $data = [
                'active' => $newStatus,
            ];

            // Update data di database
            $this->builder->where('id', $id)->update($data);

            // Redirect dengan pesan sukses
            return redirect()->to('/users/index')->with('success', 'Status berhasil diperbarui.');
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function delete($id)
    {
        // Validasi ID
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        // Ambil data pengguna berdasarkan ID
        $user = $this->builder->where('id', $id)->get()->getRow();

        if ($user) {
            // Hapus data di database
            $this->builder->where('id', $id)->delete();

            // Redirect dengan pesan sukses
            return redirect()->to('/users/index')->with('success', 'Pengguna berhasil dihapus.');
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }
    }
}
