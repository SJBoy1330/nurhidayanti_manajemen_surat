<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Controller 
{
   var $role = '';
    var $id = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->role = $this->session->userdata(PREFIX_SESSION.'_role');
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
    }

    

    // FUNCTION SEO
    public function ubah_seo()
    {
        // VARIABEL
        $arrVar['meta_title']            = 'Judul website';
        $arrVar['meta_author']            = 'Nama author';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var) ?? '';
            if (!$$var) {
                $data['required'][] = ['req_'.$var,$value.' tidak boleh kosong!'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $meta_keyword = $_POST['meta_keyword'] ?? '';
        $meta_description = $_POST['meta_description'] ??'';
        $meta_address = $_POST['meta_address'] ??'';
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);
        if ($meta_keyword) {
            $meta_keyword = json_decode($meta_keyword, true);
            $aru = [];
            foreach ($meta_keyword as $key) {
                $val = str_replace(["'",'"',"`"], "", $key['value']);
                $aru[] = $val;
            }
            $post['meta_keyword'] = implode(',',$aru);
        }else{
             $post['meta_keyword'] = '';
        }
        $post['meta_description'] = $meta_description;
        $post['meta_address'] = $meta_address;

        if (!in_array(false, $arrAccess)) {
            
            $update = $this->action_m->update('setting', $post, ['id_setting' => 1]);
            
            if ($update) {
                $log['type'] = 'edt';
                    $log['description'] = 'Telah merubah data <b>"SEO"</b>';
                    $log['id_user'] = $this->id;
                    $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data berhasil dirubah';
                $data['reload'] = true;
            } else {
                $data['status'] = false;
                 $data['alert']['message'] = 'Data gagal dirubah';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }


    // FUNCTION LOGO
    public function update_logo()
    {
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);

        $tujuan = './data/setting/';

        if (!file_exists($tujuan)) {
            mkdir($tujuan);
        }
        $arrAccess = [];

        $name_icon = $_POST['name_icon'] ?? '';
        $name_icon_white = $_POST['name_icon_white'] ?? '';
        $name_logo = $_POST['name_logo'] ?? '';
        $name_logo_white = $_POST['name_logo_white'] ?? '';

        if (!empty($_FILES['logo']['tmp_name'])) {
            $arrAccess[] = true;
        }else{
            if ($name_logo) {
                $arrAccess[] = true;
            }else{
                if ($setting->logo != '') {
                    $arrAccess[] = true;
                }else{
                    $arrAccess[] = false;
                }
                
            }
            
        }

        if (!empty($_FILES['logo_white']['tmp_name'])) {
            $arrAccess[] = true;
        }else{
            if ($name_logo_white) {
                $arrAccess[] = true;
            }else{
                if ($setting->logo_white != '') {
                    $arrAccess[] = true;
                }else{
                    $arrAccess[] = false;
                }
                
            }
        }

        if (!empty($_FILES['icon']['tmp_name'])) {
            $arrAccess[] = true;
        }else{
            if ($name_icon) {
                $arrAccess[] = true;
            }else{
                if ($setting->icon != '') {
                    $arrAccess[] = true;
                }else{
                    $arrAccess[] = false;
                }
                
            }
        }

        if (!empty($_FILES['icon_white']['tmp_name'])) {
            $arrAccess[] = true;
        }else{
            if ($name_icon_white) {
                $arrAccess[] = true;
            }else{
                if ($setting->icon_white != '') {
                    $arrAccess[] = true;
                }else{
                    $arrAccess[] = false;
                }
                
            }
        }

        if (in_array(true, $arrAccess)) {

            $post = [];
            // LOGO WARNA
            if (!empty($_FILES['logo']['tmp_name'])) {
                $logo = $_FILES['logo'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('logo')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['logo'] = $data_upload['upload_data']['file_name'];
                    if ($name_logo) {
                        if (file_exists($tujuan.$name_logo)) {
                            unlink($tujuan.$name_logo);
                        }
                    }
                    
                }
            }else{
                 if (!$name_logo) {
                    if (file_exists($tujuan.$result->logo)) {
                        unlink($tujuan.$result->logo);
                    }
                    $post['logo'] = '';
                }
            }

            // LOGO WHITE
            if (!empty($_FILES['logo_white']['tmp_name'])) {
                $logo_white = $_FILES['logo_white'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('logo_white')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['logo_white'] = $data_upload['upload_data']['file_name'];
                    if ($name_logo_white) {
                        if (file_exists($tujuan.$name_logo_white)) {
                            unlink($tujuan.$name_logo_white);
                        }
                    }
                    
                }
            }else{
                 if (!$name_logo_white) {
                    if (file_exists($tujuan.$result->logo_white)) {
                        unlink($tujuan.$result->logo_white);
                    }
                    $post['logo_white'] = '';
                }
            }

            // ICON WARNA

            $name_icon = $_POST['name_icon'] ?? '';
            if (!empty($_FILES['icon']['tmp_name'])) {
                $icon = $_FILES['icon'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('icon')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['icon'] = $data_upload['upload_data']['file_name'];
                    if ($name_icon) {
                        if (file_exists($tujuan.$name_icon)) {
                            unlink($tujuan.$name_icon);
                        }
                    }
                    
                }
            }else{
                 if (!$name_icon) {
                    if (file_exists($tujuan.$result->icon)) {
                        unlink($tujuan.$result->icon);
                    }
                    $post['icon'] = '';
                }
            }

            // ICON WHITE
            $name_icon_white = $_POST['name_icon_white'] ?? '';
            if (!empty($_FILES['icon_white']['tmp_name'])) {
                $icon_white = $_FILES['icon_white'];
               
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_upload = [];

                if (!$this->upload->do_upload('icon_white')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_upload = array('upload_data' => $this->upload->data());
                    $post['icon_white'] = $data_upload['upload_data']['file_name'];
                    if ($name_icon_white) {
                        if (file_exists($tujuan.$name_icon_white)) {
                            unlink($tujuan.$name_icon_white);
                        }
                    }
                    
                }
            }else{
                 if (!$name_icon_white) {
                    if (file_exists($tujuan.$result->icon_white)) {
                        unlink($tujuan.$result->icon_white);
                    }
                    $post['icon_white'] = '';
                }
            }

            if (count($post) > 0) {
                $update = $this->action_m->update('setting', $post, ['id_setting' => 1]);
                if ($update) {
                    $log['type'] = 'edt';
                    $log['description'] = 'Telah merubah data <b>"Logo"</b>';
                    $log['id_user'] = $this->id;
                    $this->action_m->insert('log',$log);

                    $data['status'] = true;
                    $data['alert']['message'] = 'Data berhasil dirubah';
                    $data['reload'] = true;
                } else {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Data gagal dirubah';
                }
            }else{
                $data['status'] = false;
                $data['alert']['message'] = 'Tidak ada data di rubah';
            }
            
        } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Tidak ada data di rubah';
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    

    // FUNCTION UPDATE PROFILE
    public function update()
    {
        // VARIABEL
        $arrVar['name']             = 'Nama lengkap';
        $arrVar['username']            = 'Username';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var) ?? '';
            if (!$$var) {
                $data['required'][] = ['req_'.$var,$value.' tidak boleh kosong!'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $id = $this->id;

        $result = $this->action_m->get_single('users', ['id' => $id]);
        $password = $_POST['password'] ?? '';
        $new_password = $_POST['new_password'] ??'';
        $repassword = $_POST['repassword'] ??'';
        $name_image = $_POST['name_image'] ??'';
        if (!in_array(false, $arrAccess)) {
            $tujuan = './data/user/';

            if (!empty($_FILES['image']['tmp_name'])) {
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
                    $arrSession[PREFIX_SESSION.'_image'] = $data_upload['upload_data']['file_name'];
                    if ($name_image) {
                        if (file_exists($tujuan.$name_image)) {
                            unlink($tujuan.$name_image);
                        }
                    }
                    
                }
            }
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Username tidak valid! Silahkan cek format username';
                echo json_encode($data);
                exit;
            }

            if ($password) {
                if (hash_my_password($password) == $result->password) {
                    if ($new_password != $repassword) {
                        $data['status'] = false;
                        $data['alert']['message'] = 'Konfirmasi kata sandi tidak valid!';
                        echo json_encode($data);
                        exit;
                    } else {
                        $post['password'] = hash_my_password($new_password);
                    }
                }else{
                    $data['status'] = false;
                    $data['alert']['message'] = 'Kata sandi tidak valid!';
                    echo json_encode($data);
                    exit;
                }
                
            }
            $update = $this->action_m->update('users', $post, ['id' => $id]);
            if ($update) {
                $arrSession[PREFIX_SESSION.'_name'] = $name;

                $this->session->set_userdata($arrSession);

                $log['type'] = 'edt';
                $log['description'] = 'Telah merubah profil';
                $log['id_user'] = $this->id;
                $this->action_m->insert('log',$log);

                $data['status'] = true;
                $data['alert']['message'] = 'Data berhasil dirubah';
                $data['reload'] = true;
            } else {
                $data['status'] = false;
                 $data['alert']['message'] = 'Data gagal dirubah';
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }


    // FUNCTION UMUM
    public function switch($db = 'users',$idf= '')
    {
        $id = $_POST['id'];
        $action = $_POST['action'];
        $reason = $_POST['reason'] ?? '';
        $idfield = ($idf) ? $idf : 'id';
         $res = $this->action_m->get_single($db,[$idfield => $id]);
        if (!$res) {
             $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data '.$db.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'N') {
            $set['reason'] = $reason;
            $atn ='Menonaktifkan';
        } else {
            $set['reason'] = '';
            $atn = 'Mengaktifkan';
        }
        // var_dump($db);var_dump($id);die;
        $update = $this->action_m->update($db, $set, [$idfield => $id]);
        
        $alasan = '';
        if ($update) {
            
            if ($db == 'users') {
                if ($res->role == 'admin') {
                    $trans['users'] = 'Admin';
                }else{
                    $trans['users'] = 'Petugas';
                }
            }else{
                $trans['users'] = 'User';
            }
            $trans['box_arsip'] = 'Box Arsip';
            $trans['location'] = 'Lokasi';
            $trans['category'] = 'Kategori';
            $trans['arsip'] = 'Arsip';

            
            $trs = (isset($trans[$db])) ? $trans[$db] : 'undifind';
            $log['type'] = 'apv';
            $log['description'] = $atn.' data <b>"'.$trs.'"</b> dengan code <b>"'.$res->code.'"</b>';
            $log['id_user'] = $this->id;
            $this->action_m->insert('log',$log);


            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'Y') {
                $data['alert']['message'] = 'Akses '.$db.' telah di aktifkan!';
            } else {
                if ($reason != '') {
                    $alasan .= ' Dengan alasan '.$reason;
                }
                $data['alert']['message'] = 'Akses '.$db.' telah di matikan!'.$alasan;
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = $db.' gagal di update! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function get_single($db = 'users',$idf = '')
    {
        $id = $_POST['id'];

        $idfield = ($idf) ? $idf : 'id';

        $result = $this->action_m->get_single($db, [$idfield => $id]);
        echo json_encode($result);
        exit;
    }
    
    public function hapus_data()
    {
        $id        = $this->input->post('id', true);
        $db        = $this->input->post('db', true);
        $file      = $this->input->post('file', true);
        $primary   = $this->input->post('primary', true) ?: "id_{$db}";
        $permanent = $this->input->post('permanent', true);
        $reload    = $this->input->post('reload', true);

        // Validasi input dasar
        if (!$id || !$db) {
            echo json_encode([
                'status' => 500,
                'alert' => ['message' => 'Permintaan tidak valid!']
            ]);
            return;
        }

        // Cek apakah table ada
        if (!$this->db->table_exists($db)) {
            echo json_encode([
                'status' => 500,
                'alert' => ['message' => 'Database tidak ditemukan!']
            ]);
            return;
        }

        // Cek apakah data tersedia
        $res = $this->action_m->get_single($db, [$primary => $id]);
        if (!$res) {
            echo json_encode([
                'status' => 500,
                'alert' => ['message' => 'Data tidak ditemukan!']
            ]);
            return;
        }

        // Eksekusi hapus
        if ($permanent !== 'none') {
            $aksi = $this->action_m->delete($db, [$primary => $id]);
            
        } else {
            $prefix = PREFIX_SESSION;
            $idhps  = $_SESSION[$prefix . '_id'];
            $set = [
                'delete'      => 'Y',
                'delete_date' => date('Y-m-d H:i:s'),
                'delete_by'   => $idhps
            ];
            $aksi = $this->action_m->update($db, $set, [$primary => $id]);
        }

        // Jika berhasil, hapus file (jika ada) dan kirim response
        if ($aksi) {
            if (!empty($file) && file_exists($file)) {
                @unlink($file); // suppress error
            }
            if ($db == 'users') {
                if ($res->role == 'admin') {
                    $trans['users'] = 'Admin';
                }else{
                    $trans['users'] = 'Petugas';
                }
            }else{
                $trans['users'] = 'User';
            }
            $trans['box_arsip'] = 'Box Arsip';
            $trans['location'] = 'Lokasi';
            $trans['category'] = 'Kategori';
            $trans['arsip'] = 'Arsip';

            
            $trs = (isset($trans[$db])) ? $trans[$db] : 'undifind';
            $log['type'] = 'dlt';
            $log['description'] = 'Menghapus data <b>"'.$trs.'"</b> dengan code <b>"'.$res->code.'"</b>';
            $log['id_user'] = $this->id;
            $this->action_m->insert('log',$log);

            $response = [
                'status' => 200,
                'alert'  => ['message' => 'Data berhasil dihapus!']
            ];
            if (!empty($reload)) {
                $response['reload'] = $reload;
            }

            echo json_encode($response);
        } else {
            echo json_encode([
                'status' => 500,
                'alert' => ['message' => 'Data gagal dihapus!']
            ]);
        }
    }

   

}
