<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Controller
{
    var $id = '';
    var $name = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
        $this->name = $this->session->userdata(PREFIX_SESSION.'_name');
       
        
    }

    // FUNGSI AUTH
    public function login_proses()
    {
        // Ambil data dari input
        $username = strtolower($this->input->post('username'));
        $password = $this->input->post('password');

        // Validasi input
        if (!$username || !$password) {
            $data['status'] = 700;
            $data['message'] = 'Data tidak terdeteksi! Silahkan cek data anda';
            echo json_encode($data);
            exit;
        }

        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            $data['status'] = 700;
            $data['message'] = 'Username tidak valid! Silahkan cek format username';
            echo json_encode($data);
            exit;
        }

        // Cek user berdasarkan username
        $user = $this->action_m->get_single('users',['username' => $username]);

        if ($user) {
            // Cek apakah user diblokir
            if ($user->status == 'N') {
                $reason = $user->reason ? ' dengan alasan </br></br><b>"' . $user->reason . '!"</b></br></br>' : '!';
                $data['status'] = 700;
                $data['message'] = 'Akun mu telah dinonaktifkan! ' . $reason . ' Hubungi admin jika terjadi kesalahan';
                echo json_encode($data);
                exit;

            }

            // Cek password
            if ($user->password == hash_my_password($password)) {
                $log['type'] = 'apv';
                $log['description'] = 'Masuk ke sistem';
                $log['id_user'] = $user->id;
                $this->action_m->insert('log',$log);

                $arrSession[PREFIX_SESSION.'_id'] = $user->id;
                $arrSession[PREFIX_SESSION.'_role'] = $user->role;
                $arrSession[PREFIX_SESSION.'_name'] = $user->name;

                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['message'] = 'Anda berhasil masuk! Selamat datang <b>'. $user->name.'</b>';
                $data['redirect'] = base_url('dashboard');
                echo json_encode($data);
                exit;
            } else {
                $data['status'] = 500;
                $data['message'] = 'Kata sandi salah! Silahkan coba kembali';
                echo json_encode($data);
                exit;
            }
        }else{
            $data['status'] = 500;
            $data['message'] = 'Username tidak terdaftar';
            echo json_encode($data);
            exit;
        }
    }
    public function login_qr($encoded_id = null)
    {
        // 1. Validasi input: Jika ID tidak dilempar di URL
        if (!$encoded_id) {
            $this->session->set_flashdata('error', 'QR Code tidak valid!');
            redirect('login');
            exit;
        }

        // 2. Decode ID menggunakan fungsi yang sudah kamu punya
        $id_user = base64url_decode($encoded_id);

        // 3. Validasi hasil decode (antisipasi input asal di URL)
        if (!$id_user) {
            $this->session->set_flashdata('error', 'Format data QR rusak!');
            redirect('login');
            exit;
        }

        // 4. Cari user berdasarkan ID hasil decode
        $user = $this->action_m->get_single('users', ['id' => $id_user]);

        if ($user) {
            // 5. Cek status aktif (Sesuai logika login_proses kamu)
            if ($user->status == 'N') {
                $reason = $user->reason ? ' Alasan: ' . $user->reason : '!';
                $this->session->set_flashdata('error', 'Akun nonaktif. ' . $reason);
                redirect('login');
                exit;
            }

            // 6. Login Berhasil - Set Log & Session
            $log = [
                'type'        => 'apv',
                'description' => 'Masuk ke sistem via QR Login',
                'id_user'     => $user->id
            ];
            $this->action_m->insert('log', $log);

            // Set Session (Menggunakan PREFIX yang sama dengan login_proses)
            $arrSession = [
                PREFIX_SESSION.'_id'   => $user->id,
                PREFIX_SESSION.'_role' => $user->role,
                PREFIX_SESSION.'_name' => $user->name
            ];
            $this->session->set_userdata($arrSession);

            // 7. Redirect ke Dashboard
            $this->session->set_flashdata('success', 'Berhasil masuk via QR! Selamat datang <b>' . $user->name . '</b>');
            redirect('dashboard');
            exit;

        } else {
            // User tidak ada di database
            $this->session->set_flashdata('error', 'User tidak terdaftar di sistem!');
            redirect('login');
            exit;
        }
    }
    
    public function logout()
    {
        $log['type'] = 'apv';
        $log['description'] = 'Keluar dari sistem';
        $log['id_user'] = $this->id;
        $this->action_m->insert('log',$log);

        $this->session->unset_userdata(PREFIX_SESSION.'_id');
        $this->session->unset_userdata(PREFIX_SESSION.'_role');
        $this->session->unset_userdata(PREFIX_SESSION.'_name');

        redirect('auth');
    }

}