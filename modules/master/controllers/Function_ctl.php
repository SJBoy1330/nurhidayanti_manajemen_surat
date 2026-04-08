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

    // FUNCTION BOX
    public function insert_box_arsip()
    {
        // VARIABEL
        $arrVar['code']             = 'Kode';
        $arrVar['name']             = 'Nama box';
        
        // INFORMASI UMUM
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

        if (!in_array(false, $arrAccess)) {
            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            $cek = $this->action_m->get_single('box_arsip',['code' => $code]);
            if ($cek) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kode sudah terdaftar! Silahkan gunakan kode lain';
                echo json_encode($data);
                exit;
            }

            $insert = $this->action_m->insert('box_arsip', $post);
            if ($insert) {
                $log['type'] = 'add';
                $log['description'] = 'Menambahkan data <b>"Box Arsip"</b> baru';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);


                $data['status'] = true;
                $data['alert']['message'] = 'Data box berhasil di tambahkan!';
                $data['datatable'] = 'table_box_arsip';
                $data['modal']['id'] = '#kt_modal_box_arsip';
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

    public function update_box_arsip()
    {
        // VARIABEL
        $arrVar['id']          = 'Id box';
        $arrVar['code']             = 'Kode';
        $arrVar['name']             = 'Nama box';

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
        $result = $this->action_m->get_single('box_arsip', ['id' => $id]);
        
        if (!in_array(false, $arrAccess)) {
            $cek = $this->action_m->get_single('box_arsip',['code' => $code,'id !=' => $id]);
            if ($cek) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kode sudah terdaftar! Silahkan gunakan kode lain';
                echo json_encode($data);
                exit;
            }
            $update = $this->action_m->update('box_arsip', $post, ['id' => $id]);
            if ($update) {
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Box Arsip"</b> dengan code <b>"'.$result->code.'"</b>';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data box berhasil di rubah!';
                $data['datatable'] = 'table_box_arsip';
                $data['modal']['id'] = '#kt_modal_box_arsip';
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

    // FUNCTION KATEGORI
    public function insert_category()
    {
        // VARIABEL
        $arrVar['name']             = 'Nama kategori';
        
        // INFORMASI UMUM
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

        $post['code'] = 'CT'.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            if ($this->id) {
                $post['create_by'] = $this->id;
            }

            $insert = $this->action_m->insert('category', $post);
            if ($insert) {
                $log['type'] = 'add';
                $log['description'] = 'Menambahkan data <b>"Kategori"</b> baru';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data kategori berhasil di tambahkan!';
                $data['datatable'] = 'table_category';
                $data['modal']['id'] = '#kt_modal_category';
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

    public function update_category()
    {
        // VARIABEL
        $arrVar['id']          = 'Id kategori';
        $arrVar['name']             = 'Nama kategori';

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
        $result = $this->action_m->get_single('category', ['id' => $id]);
        
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('category', $post, ['id' => $id]);
            if ($update) {
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Kategori"</b> dengan code <b>"'.$result->code.'"</b>';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data kategori berhasil di rubah!';
                $data['datatable'] = 'table_category';
                $data['modal']['id'] = '#kt_modal_category';
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



    // FUNCTION LOKASI
    public function insert_location()
    {
        // VARIABEL
        $arrVar['code']             = 'Kode';
        $arrVar['name']             = 'Nama lokasi';
        $arrVar['address']             = 'Alamat';
        
        // INFORMASI UMUM
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

        if (!in_array(false, $arrAccess)) {
            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            $cek = $this->action_m->get_single('location',['code' => $code]);
            if ($cek) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kode sudah terdaftar! Silahkan gunakan kode lain';
                echo json_encode($data);
                exit;
            }

            $insert = $this->action_m->insert('location', $post);
            if ($insert) {
                $log['type'] = 'add';
                $log['description'] = 'Menambah data <b>"Lokasi"</b> baru';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data lokasi berhasil di tambahkan!';
                $data['datatable'] = 'table_location';
                $data['modal']['id'] = '#kt_modal_location';
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

    public function update_location()
    {
        // VARIABEL
        $arrVar['id']          = 'Id lokasi';
        $arrVar['code']             = 'Kode';
        $arrVar['name']             = 'Nama lokasi';
        $arrVar['address']             = 'Alamat';

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
        $result = $this->action_m->get_single('location', ['id' => $id]);
        
        if (!in_array(false, $arrAccess)) {
            $cek = $this->action_m->get_single('location',['code' => $code,'id !=' => $id]);
            if ($cek) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kode sudah terdaftar! Silahkan gunakan kode lain';
                echo json_encode($data);
                exit;
            }
            $update = $this->action_m->update('location', $post, ['id' => $id]);
            if ($update) {
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Lokasi"</b> dengan code <b>"'.$result->code.'"</b>';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data lokasi berhasil di rubah!';
                $data['datatable'] = 'table_location';
                $data['modal']['id'] = '#kt_modal_location';
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

    
    // FUNCTION USER
    public function insert_arsip()
    {
        // VARIABEL
        $arrVar['name']             = 'Nama arsip';
        $arrVar['description']      = 'Keterangan';
        $arrVar['id_location']      = 'Lokasi';
        $arrVar['id_category']      = 'Kategori';
        $arrVar['id_box_arsip']      = 'Box arsip';
        // INFORMASI UMUM
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
        $post['code'] = 'AR'.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/arsip/';

            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/arsip/')) {
                    mkdir('./data/arsip');
                }
                $file = $_FILES['file'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'pdf|PDF';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('file')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['file'] = $data_upload['upload_data']['file_name'];
                }
            }else{
                 $data['status'] = 500;
                $data['alert']['message'] = 'File tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }

            if ($this->id) {
                $post['create_by'] = $this->id;
            }
            
            $insert = $this->action_m->insert('arsip', $post);
            if ($insert) {
                $log['type'] = 'add';
                $log['description'] = 'Menambah data <b>"Arsip"</b> baru';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data arsip berhasil di tambahkan!';
                $data['datatable'] = 'table_arsip';
                $data['modal']['id'] = '#kt_modal_arsip';
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

    public function update_arsip()
    {
        // VARIABEL
        $arrVar['id']          = 'Id';
        $arrVar['name']             = 'Nama arsip';
        $arrVar['description']      = 'Keterangan';
        $arrVar['id_location']      = 'Lokasi';
        $arrVar['id_category']      = 'Kategori';
        $arrVar['id_box_arsip']      = 'Box arsip';
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
        $result = $this->action_m->get_single('arsip', ['id' => $id]);
        $name_file = $_POST['name_file'] ?? '';
        $tujuan = './data/arsip/';

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

            if (!empty($_FILES['file']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/arsip/')) {
                    mkdir('./data/arsip');
                }
                $file = $_FILES['file'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'pdf|PDF';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('file')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['file'] = $data_upload['upload_data']['file_name'];
                    if ($result->file && file_exists($tujuan.$result->file)) {
                        unlink($tujuan.$result->file);
                    }
                    
                }
            }else{
                if (!$name_file) {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'File tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }else{
                    if ($result->file == '' || !file_exists($tujuan.$result->file)) {
                        $data['status'] = 500;
                        $data['alert']['message'] = 'File tidak boleh kosong!';
                        echo json_encode($data);
                        exit;
                    }
                }
            }

            $update = $this->action_m->update('arsip', $post, ['id' => $id]);
            if ($update) {
                $log['type'] = 'edt';
                $log['description'] = 'Merubah data <b>"Arsip"</b> dengan code <b>"'.$result->code.'"</b>';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data arsip berhasil di rubah!';
                $data['datatable'] = 'table_arsip';
                $data['modal']['id'] = '#kt_modal_arsip';
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

}


