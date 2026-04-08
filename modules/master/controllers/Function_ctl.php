<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Admin
{
    var $id = '';
    var $role = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
        $this->role = $this->session->userdata(PREFIX_SESSION.'_role');
    }

    // MASTER USER

    // FUNCTION USER
    public function tambah($page = 'petugas')
    {
        // VARIABEL
        $arrVar['name']             = 'Nama user';
        $arrVar['username']             = 'Username';
        $arrVar['role']         = 'Role';
        $arrVar['password']         = 'Kata sandi';
        $arrVar['repassword']       = 'Konfirmasi kata sandi ';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['password', 'repassword'])) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        $prf = 'PT';
        if ($page == 'admin') {
            $prf = 'AD';
        }
        $post['code'] = $prf.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/user/';

            if (!empty($_FILES['image']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/user/')) {
                    mkdir('./data/user');
                }
                $image = $_FILES['image'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('image')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['image'] = $data_upload['upload_data']['file_name'];
                }
            }

            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Username tidak valid! Silahkan cek format username';
                echo json_encode($data);
                exit;
            }
            $user_name = $this->action_m->get_single('users', ['username' => $username]);
            if ($user_name) {
                $data['status'] = false;
                $data['alert']['message'] = 'Username sudah terdaftar!';
                echo json_encode($data);
                exit;
            }
            
            if ($password != $repassword) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                echo json_encode($data);
                exit;
            } else {
                $post['password'] = hash_my_password($password);
            }
            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            
            $insert = $this->action_m->insert('users', $post);
            if ($insert) {
                $log['type'] = 'add';
                $log['description'] = 'Menambahkan data <b>"'.$page.'"</b> baru';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data '.$page.' berhasil di tambahkan!';
                $data['datatable'] = 'table_'.$page;
                $data['modal']['id'] = '#kt_modal_'.$page;
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function update($page = 'petugas')
    {
        // VARIABEL
        $arrVar['id']          = 'Id user';
        $arrVar['name']             = 'Nama user';
        $arrVar['username']             = 'Username';
        $arrVar['role']         = 'Role';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var];
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action_m->get_single('users', ['id' => $id]);
        $password = $_POST['password'] ?? '';
        $repassword = $_POST['repassword'] ?? '';
        $name_image = $_POST['name_image'] ?? '';
        $tujuan = './data/user/';
        if ($result->username != $username) {
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Username tidak valid! Silahkan cek format username';
                echo json_encode($data);
                exit;
            }
            $user_mail = $this->action_m->get_single('users', ['username' => $username,'id !=' => $id]);
            if ($user_mail) {
                $data['status'] = false;
                $data['alert']['message'] = 'Username sudah terdaftar sebagai user!';
                echo json_encode($data);
                exit;
            }

            if (!$password) {
                $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena username berubah'];
                $arrAccess[] = false;
            } 
            if (!$repassword) {
                $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena username berubah'];
                $arrAccess[] = false;
            }   
             
        }
        if (!in_array(false, $arrAccess)) {
            if ($password) {
                if ($password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($password);
                }
            } 

            if (!empty($_FILES['image']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/user/')) {
                    mkdir('./data/user');
                }
                $image = $_FILES['image'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('image')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['image'] = $data_upload['upload_data']['file_name'];
                    if ($result->image && file_exists($tujuan.$result->image)) {
                        unlink($tujuan.$result->image);
                    }
                    
                }
            }else{
                if (!$name_image) {
                    if ($result->image != '' && file_exists($tujuan.$result->image)) {
                        unlink($tujuan.$result->image);
                    }
                    $post['image'] = '';
                }
            }

            $update = $this->action_m->update('users', $post, ['id' => $id]);
            if ($update) {
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"'.$page.'"</b> dengan code <b>"'.$result->code.'"</b>';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);
                
                $data['status'] = true;
                $data['alert']['message'] = 'Data '.$page.' berhasil di rubah!';
                $data['datatable'] = 'table_'.$page;
                $data['modal']['id'] = '#kt_modal_'.$page;
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }


    // FUCNTION SURAT MASUK
    public function insert_surat_masuk()
    {
        // VARIABEL
        $arrVar['no_surat']     = 'Nomor Surat';
        $arrVar['tgl_diterima'] = 'Tanggal Diterima';
        $arrVar['asal_surat']   = 'Asal Surat';
        $arrVar['perihal']      = 'Perihal';
        
        // Keterangan tidak masuk arrVar karena opsional (boleh kosong)

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        // Tambahkan keterangan (opsional)
        $post['keterangan'] = $_POST['keterangan'] ?? '';

        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/surat_masuk/';

            // Upload File (Opsional)
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists('./data/')) mkdir('./data');
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']   = $tujuan;
                $config['allowed_types'] = 'pdf|PDF|jpg|jpeg|png';
                $config['file_name']     = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                }
            }

            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            
            $insert = $this->action_m->insert('surat_masuk', $post);
            if ($insert) {
                // Log Activity
                $log['type'] = 'add';
                $log['description'] = 'Menambah data <b>"Surat Masuk"</b> baru: ' . $post['no_surat'];
                $log['id_user'] = $this->id;
                $this->action_m->insert('log', $log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data surat masuk berhasil ditambahkan!';
                $data['datatable'] = 'table_surat_masuk';
                $data['modal']['id'] = '#kt_modal_surat_masuk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function update_surat_masuk()
    {
        // VARIABEL
        $arrVar['id']           = 'Id';
        $arrVar['no_surat']     = 'Nomor Surat';
        $arrVar['tgl_diterima'] = 'Tanggal Diterima';
        $arrVar['asal_surat']   = 'Asal Surat';
        $arrVar['perihal']      = 'Perihal';

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $post['keterangan'] = $_POST['keterangan'] ?? '';
        $result = $this->action_m->get_single('surat_masuk', ['id' => $id]);
        $tujuan = './data/surat_masuk/';

        if (!in_array(false, $arrAccess)) {
            // Update File jika ada upload baru
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']   = $tujuan;
                $config['allowed_types'] = 'pdf|PDF|jpg|jpeg|png';
                $config['file_name']     = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                    
                    // Hapus file lama jika ada
                    if ($result->file && file_exists($tujuan . $result->file)) {
                        unlink($tujuan . $result->file);
                    }
                }
            }

            $update = $this->action_m->update('surat_masuk', $post, ['id' => $id]);
            if ($update) {
                // Log Activity
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Surat Masuk"</b> No: ' . $result->no_surat;
                $log['id_user'] = $this->id;
                $this->action_m->insert('log', $log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data surat masuk berhasil dirubah!';
                $data['datatable'] = 'table_surat_masuk';
                $data['modal']['id'] = '#kt_modal_surat_masuk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    // FUNCTION SURAT KELUAR
    public function insert_surat_keluar()
    {
        // VARIABEL (Wajib diisi)
        $arrVar['no_surat']  = 'Nomor Surat';
        $arrVar['tgl_surat']  = 'Tanggal';
        $arrVar['perihal']   = 'Perihal';
        $arrVar['tujuan']    = 'Tujuan';
        
        // Keterangan bersifat opsional

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        // Tambahkan keterangan (opsional)
        $post['keterangan'] = $_POST['keterangan'] ?? '';

        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/surat_keluar/';

            // Upload File (Opsional)
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists('./data/')) mkdir('./data');
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']   = $tujuan;
                $config['allowed_types'] = 'pdf|PDF|jpg|jpeg|png';
                $config['file_name']     = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                }
            }

            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            
            $insert = $this->action_m->insert('surat_keluar', $post);
            if ($insert) {
                // Log Activity
                $log['type'] = 'add';
                $log['description'] = 'Menambah data <b>"Surat Keluar"</b> baru: ' . $post['no_surat'];
                $log['id_user'] = $this->id;
                $this->action_m->insert('log', $log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data surat keluar berhasil ditambahkan!';
                $data['datatable'] = 'table_surat_keluar';
                $data['modal']['id'] = '#kt_modal_surat_keluar';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function update_surat_keluar()
    {
        // VARIABEL
        $arrVar['id']        = 'Id';
        $arrVar['no_surat']  = 'Nomor Surat';
        $arrVar['tgl_surat']  = 'Tanggal';
        $arrVar['perihal']   = 'Perihal';
        $arrVar['tujuan']    = 'Tujuan';

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $post['keterangan'] = $_POST['keterangan'] ?? '';
        $result = $this->action_m->get_single('surat_keluar', ['id' => $id]);
        $tujuan = './data/surat_keluar/';

        if (!in_array(false, $arrAccess)) {
            // Update File jika ada upload baru
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']   = $tujuan;
                $config['allowed_types'] = 'pdf|PDF|jpg|jpeg|png';
                $config['file_name']     = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                    
                    // Hapus file lama jika ada
                    if ($result->file && file_exists($tujuan . $result->file)) {
                        unlink($tujuan . $result->file);
                    }
                }
            }

            $update = $this->action_m->update('surat_keluar', $post, ['id' => $id]);
            if ($update) {
                // Log Activity
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Surat Keluar"</b> No: ' . $result->no_surat;
                $log['id_user'] = $this->id;
                $this->action_m->insert('log', $log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data surat keluar berhasil dirubah!';
                $data['datatable'] = 'table_surat_keluar';
                $data['modal']['id'] = '#kt_modal_surat_keluar';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    // FUNCTION LHP
    public function insert_lhp()
    {
        // VARIABEL (Wajib diisi)
        $arrVar['no_lhp']        = 'Nomor LHP';
        $arrVar['tgl_lhp']       = 'Tanggal';
        $arrVar['judul_lhp']     = 'Judul LHP';
        $arrVar['nama_obrik']    = 'Nama Obrik';
        $arrVar['tim_pemeriksa'] = 'Tim Pemeriksa';
        
        // Judul LHR, Keterangan & File bersifat opsional

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        // Tambahkan data opsional
        $post['judul_lhr']  = $_POST['judul_lhr'] ?? '';
        $post['keterangan'] = $_POST['keterangan'] ?? '';

        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/lhp/';

            // Upload File (Opsional)
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists('./data/')) mkdir('./data');
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']      = $tujuan;
                $config['allowed_types']    = 'pdf|PDF|jpg|jpeg|png|doc|docx';
                $config['file_name']        = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                }
            }

            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            
            $insert = $this->action_m->insert('lhp', $post);
            if ($insert) {
                // Log Activity
                $log['type']        = 'add';
                $log['description'] = 'Menambah data <b>"LHP"</b> baru: ' . $post['no_lhp'];
                $log['id_user']     = $this->id;
                $this->action_m->insert('log', $log);

                $data['status']           = true;
                $data['alert']['message'] = 'Data LHP berhasil ditambahkan!';
                $data['datatable']        = 'table_lhp';
                $data['modal']['id']      = '#kt_modal_lhp';
                $data['modal']['action']  = 'hide';
                $data['input']['all']     = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function update_lhp()
    {
        // VARIABEL
        $arrVar['id']            = 'Id';
        $arrVar['no_lhp']        = 'Nomor LHP';
        $arrVar['tgl_lhp']       = 'Tanggal';
        $arrVar['judul_lhp']     = 'Judul LHP';
        $arrVar['nama_obrik']    = 'Nama Obrik';
        $arrVar['tim_pemeriksa'] = 'Tim Pemeriksa';

        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $post['judul_lhr']  = $_POST['judul_lhr'] ?? '';
        $post['keterangan'] = $_POST['keterangan'] ?? '';
        
        $result = $this->action_m->get_single('lhp', ['id' => $id]);
        $tujuan = './data/lhp/';

        if (!in_array(false, $arrAccess)) {
            // Update File jika ada upload baru
            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists($tujuan)) mkdir($tujuan);

                $config['upload_path']      = $tujuan;
                $config['allowed_types']    = 'pdf|PDF|jpg|jpeg|png|doc|docx';
                $config['file_name']        = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file')) {
                    $data['status'] = false;
                    $data['alert']['message'] = $this->upload->display_errors();
                    echo json_encode($data);
                    exit;
                } else {
                    $upload_data = $this->upload->data();
                    $post['file'] = $upload_data['file_name'];
                    
                    // Hapus file lama jika ada
                    if ($result->file && file_exists($tujuan . $result->file)) {
                        unlink($tujuan . $result->file);
                    }
                }
            }

            $update = $this->action_m->update('lhp', $post, ['id' => $id]);
            if ($update) {
                // Log Activity
                $log['type']        = 'edt';
                $log['description'] = 'Merubah data <b>"LHP"</b> No: ' . $result->no_lhp;
                $log['id_user']     = $this->id;
                $this->action_m->insert('log', $log);

                $data['status']           = true;
                $data['alert']['message'] = 'Data LHP berhasil dirubah!';
                $data['datatable']        = 'table_lhp';
                $data['modal']['id']      = '#kt_modal_lhp';
                $data['modal']['action']  = 'hide';
                $data['input']['all']     = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }
}


