<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\CompanyModel;
use App\Models\LayananDetailModel;
use App\Models\PemohonModel;
use App\Models\PelayananModel;
use App\Models\LayananModel;
use App\Models\AgamaModel;
use App\Models\JkModel;
use CodeIgniter\I18n\Time;

class Beranda extends BaseController
{
    protected $company;
    protected $about;
    protected $detail;
    protected $layanan;
    protected $pelayanan;
    protected $pemohon;
    protected $agama;
    protected $jk;
    protected $db;


    public function __construct()
    {
        $this->company   = new CompanyModel();
        $this->about     = new AboutModel();
        $this->detail    = new LayananDetailModel();
        $this->layanan   = new LayananModel();
        $this->pelayanan = new PelayananModel();
        $this->pemohon   = new PemohonModel();
        $this->agama     = new AgamaModel();
        $this->jk        = new JkModel();
    }


    public function index()
    {
        $data = [
            'title'         => 'Beranda',
            'company'       => $this->company->first(),
            'about'         => $this->about->first(),
            'contohlayanan' => $this->detail->getFront(),
        ];
        return view('frontend/web/index', $data);
    }

    public function ketentuan()
    {
        $data = [
            'title'              => 'Ketentuan',
            'company'            => $this->company->first(),
            'layanan'            => $this->detail->getJoin(),
        ];
        return view('frontend/web/ketentuan', $data);
    }

    public function permohonan()
    {
        $data = [
            'title'     => 'Permohonan',
            'company'   => $this->company->first(),
            'layanan'   => $this->layanan->where('status', 1)->findAll(),
            'pemohon'   => $this->pemohon->findAll(),
            'agama'     => $this->agama->findAll(),
            'jk'        => $this->jk->findAll(),
        ];
        return view('frontend/web/permohonan', $data);
    }

    private function generateUniqueETicket(): string
    {
        $model = new PelayananModel();
        do {
            $eTiket = 'PTSP' . date('YmdHis') . rand(1000, 9999);
        } while ($model->where('e_tiket', $eTiket)->first());

        return $eTiket;
    }

    public function submit()
    {
        // Validasi data
        $rules = [
            'nama_lengkap' => [
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required'   => 'Form nama lengkap tidak boleh kosong',
                    'min_length' => 'Input nama lengkap minimal harus terdiri dari 3 karakter.',
                    'max_length' => 'Input nama lengkap tidak boleh lebih dari 50 karakter.'
                ]
            ],
            'no_handphone' => [
                'rules'  => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required'   => 'Form nomor handphone tidak boleh kosong',
                    'min_length' => 'Nomor handphone minimal harus terdiri dari 8 karakter.',
                    'max_length' => 'Nomor handphone tidak boleh lebih dari 12 karakter.'
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Form email tidak boleh kosong',
                    'valid_email' => 'Masukkan alamat email yang valid.'
                ]
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form alamat tidak boleh kosong',
                ]
            ],
            'jenis_kelamin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form jenis kelamin tidak boleh kosong',
                ]
            ],
            'agama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form agama tidak boleh kosong',
                ]
            ],
            'pemohon' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form pemohon tidak boleh kosong',
                ]
            ],
            'layanan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Form nama layanan tidak boleh kosong',
                ]
            ],
            'lampiran' => [
                'rules'  => 'ext_in[lampiran,pdf]|max_size[lampiran,2048]',
                'errors' => [
                    'ext_in' => 'File lampiran harus berformat PDF.',
                    'max_size' => 'Ukuran file lampiran tidak boleh lebih dari 2MB.'
                ]
            ],
        ];

        // Menjalankan proses validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Buat kode e-tiket
        $eTiket = $this->generateUniqueETicket();

        // Memuat model LayananModel
        $layananModel = new LayananModel();

        // Ambil file lampiran
        $fileLampiran = $this->request->getFile('lampiran');

        // Ambil nama lengkap dari input
        $namaLengkap = $this->request->getPost('nama_lengkap');

        // Ambil ID layanan dari input
        $layananId = $this->request->getPost('layanan');

        // Dapatkan nama_layanan dari tabel tb_layanan
        $layananData = $layananModel->find($layananId);

        // Periksa apakah layanan ditemukan
        if ($layananData && isset($layananData['nama_layanan'])) {
            $permohonan = $layananData['nama_layanan'];
        } else {
            return redirect()->back()->with('error', 'Layanan tidak ditemukan');
        }

        // Membuat nama file unik dengan timestamp
        $timestamp = date('dmY_His');
        $namaLampiran = $namaLengkap . '_' . $permohonan . '_' . $timestamp . '.' . $fileLampiran->getExtension();

        // Pastikan folder tujuan ada
        $folderPath = FCPATH . 'doc/masuk';
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Bersihkan nama file dari karakter tidak valid
        $namaLampiran = str_replace([
            '/',
            '\\',
            ':',
            '*',
            '?',
            '"',
            '<',
            '>',
            '|'
        ], '_', $namaLengkap . '_' . $permohonan . '_' . $timestamp . '.' . $fileLampiran->getExtension());

        // Pastikan file masih valid sebelum dipindahkan
        if (!$fileLampiran->isValid()) {
            return redirect()->back()->with('error', 'File upload tidak valid atau tidak ditemukan!');
        }

        // Coba dengan move(), jika gagal gunakan copy()
        try {
            $fileLampiran->move($folderPath, $namaLampiran);
        } catch (\Exception $e) {
            copy($fileLampiran->getTempName(), $folderPath . '/' . $namaLampiran);
        }
        // Data untuk disimpan di database
        $data = [
            'nama_lengkap'  => $namaLengkap,
            'e_tiket'       => $eTiket,
            'no_handphone'  => $this->request->getPost('no_handphone'),
            'email'         => $this->request->getPost('email'),
            'alamat'        => $this->request->getPost('alamat'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama'         => $this->request->getPost('agama'),
            'pemohon'       => $this->request->getPost('pemohon'),
            'layanan'       => $this->request->getPost('layanan'),
            'lampiran'      => $namaLampiran,
            'created_at'    => Time::now(),
        ];

        // Insert data ke database
        $idPelayanan = $this->pelayanan->insert($data);

        if (!$idPelayanan) {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }

        // Ambil data yang baru diinsert
        $pelayanan = $this->pelayanan->getJoinForEmail($idPelayanan);

        if (!$pelayanan || !isset($pelayanan['email'])) {
            log_message('error', 'Data pelayanan tidak valid atau email tidak ditemukan.');
            return redirect()->back()->with('error', 'Data pelayanan tidak valid');
        }

        // Kirim email
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $tanggal = date('d', strtotime($pelayanan['created_at']));
        $bulan = $bulan[date(
            'n',
            strtotime($pelayanan['created_at'])
        )];
        $tahun = date('Y', strtotime($pelayanan['created_at']));
        $toEmail = $pelayanan['email'];
        $subject = "Permohonan Layanan " . $pelayanan['e_tiket'] . " Berhasil Dikirim";
        $tanggalPermohonan = $tanggal . ' ' . $bulan . ' ' . $tahun;
        $message = "
        <div style='border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9; font-family: Arial, sans-serif;'>
            <p>Yth. Bapak/Ibu <strong>" . htmlspecialchars($pelayanan['nama_lengkap'], ENT_QUOTES, 'UTF-8') . "</strong>,</p> 
            
            <p>Berikut adalah detail permohonan layanan Anda:</p>
            
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Layanan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['nama_layanan'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>E-Tiket</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['e_tiket'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Nomor Handphone</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($pelayanan['no_handphone'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Tanggal Permohonan</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($tanggalPermohonan, ENT_QUOTES, 'UTF-8') . "</td>
                </tr>
                <tr>
                    <td style='width: 30%; font-weight: bold; padding: 8px; border: 1px solid #ddd;'>Status</td>
                    <td style='padding: 8px; border: 1px solid #ddd;'> Berhasil Dikirim</td>
                </tr>
            </table>
            <p>Permohonan layanan Anda berhasil dikirim</p>
            <p><i>Gunakan kode <strong>E-tiket</strong> dan <strong>Nomor Handphone</strong> untuk melakukan cek status pada website</i></p>
            <p>Terima kasih telah menggunakan layanan kami, Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui</p>
            <table style='width: 100%; border-collapse: collapse; margin-bottom: 5px;'>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Petugas</td>
                    <td style='padding: 8px;'>: PTSP Kemenag Kab. Pekalongan</td>
                </tr>
                <tr>
                    <td style='width: 10%; font-weight: bold; padding: 8px;'>Telp</td>
                    <td style='padding: 8px;'>: (0285)38540</td>
                </tr>
            </table>
            <p>Salam,</p>
            <p><strong>Unit PTSP Kantor Kementrian Agama Kab. Pekalongan</strong></p>
        </div>
    ";

        $email = \Config\Services::email();
        $email->setFrom('', '');
        $email->setTo($toEmail);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Email gagal dikirim: ' . $email->printDebugger());
            return redirect()->back()->with('error', 'Gagal mengirim email notifikasi');
        }

        return redirect()->to('/beranda/permohonan')->with('success', 'Data berhasil terkirim, silakan tunggu email notifikasi.');
    }

    public function track()
    {
        $data = [
            'title'         => 'Lacak Permohonan',
            'company'       => $this->company->first(),
            'pelayanan'     => $this->pelayanan->getJoin(),

        ];
        return view('frontend/web/form/tracking', $data);
    }

    public function search()
    {
        $eTiket = $this->request->getPost('e_tiket');
        $noHandphone = $this->request->getPost('no_handphone');

        // Validasi input
        if (empty($eTiket) || empty($noHandphone)) {
            return view('frontend/web/form/tracking', [
                'title'     => 'Lacak Permohonan',
                'company'   => $this->company->first(),
                'error'     => 'E-Tiket dan Nomor Handphone harus diisi!',
            ]);
        }

        // Query ke model
        $results = $this->pelayanan->trackLayanan($eTiket, $noHandphone);

        // Return hasil ke view
        $data = [
            'title'         => 'Lacak Permohonan',
            'company'       => $this->company->first(),
            'pelayanan'     => $this->pelayanan->getJoin(),
            'results'       => $results,
            'e_tiket'       => $eTiket,
            'no_handphone'  => $noHandphone,
        ];
        return view('frontend/web/form/tracking', $data);
    }

    public function survey()
    {
        $id = $this->request->getPost('id');
        $penilaian = $this->request->getPost('penilaian');

        if (empty($penilaian)) {
            return redirect()->back()->with('error', 'Penilaian dan Saran harus diisi!');
        }

        // Simpan penilaian dan saran ke database
        $data = [
            'penilaian' => $penilaian,
        ];

        $this->pelayanan->update($id, $data);

        return redirect()->to('/beranda/track')->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
