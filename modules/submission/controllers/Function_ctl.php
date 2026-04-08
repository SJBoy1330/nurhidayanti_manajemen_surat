<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Admin
{
    var $id_user = '';
    var $id_role = '';
    var $name = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
        $this->id_role = $this->session->userdata(PREFIX_SESSION.'_id_role');
        $this->name = $this->session->userdata(PREFIX_SESSION.'_name');
    }

    // FUNCTION OVERTIME
    public function insert_overtime()
    {
        // VARIABEL
        if (in_array($this->id_role,[1])) {
        $arrVar['id_user']             = 'Karyawan';
        }
        $arrVar['date']             = 'Tanggal lembur';
        $arrVar['time']             = 'Lama lembur';
        $arrVar['description']             = 'Keterangan';
        
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

        $post['code'] = 'OV'.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }

            $status = 'P';
            if (in_array($this->id_role,[1])) {
                $status = 'Y';
                $post['approve_by'] = $this->id_user;
                $post['approve_date'] = date('Y-m-d H:i:s');
            }else{
                $post['id_user'] = $this->id_user;
            }

            $ss = status_submission($status);
            $badge = '<span class="badge badge-'.$ss['badge'].'">'.$ss['name'].'</span>';

            $post['approve'] = $status;
            $insert = $this->action_m->insert('overtime', $post);
            if ($insert) {
                if ($this->id_role == 1) {
                    $self = $this->action_m->get_single('user',['id_user' => $this->id_user]);
                    $post2['id_user'] = $id_user;
                    $post2['message'] = 'Admin <b>'.$self->name.'</b> telah menambahkan data lembur atas nama anda selama <b>'.$time.' Jam</b> pada '.date('d M Y',strtotime($date));
                    $post2['description'] = $description;
                    $this->action_m->insert('notification',$post2);
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Pengajuan lembur berhasil di tambahkan!<br><b>status : </b>'.$badge;
                $data['datatable'] = 'table_overtime';
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

    // FUNCTION PERMISSION
    public function insert_permission()
    {
        // VARIABEL
        if (in_array($this->id_role,[1])) {
        $arrVar['id_user']             = 'Karyawan';
        }
        $arrVar['date']             = 'Tanggal izin';
        $arrVar['type']             = 'Tipe';
        $arrVar['description']             = 'Keterangan';
        
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

        $post['code'] = 'PR'.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }

            $status = 'P';
            if (in_array($this->id_role,[1])) {
                $status = 'Y';
                $post['approve_by'] = $this->id_user;
                $post['approve_date'] = date('Y-m-d H:i:s');
            }else{
                $post['id_user'] = $this->id_user;
            }

            $ss = status_submission($status);
            $badge = '<span class="badge badge-'.$ss['badge'].'">'.$ss['name'].'</span>';

            $post['approve'] = $status;
            $insert = $this->action_m->insert('permission', $post);
            if ($insert) {
                if ($this->id_role == 1) {
                    $self = $this->action_m->get_single('user',['id_user' => $this->id_user]);
                    $post2['id_user'] = $id_user;
                    $post2['message'] = 'Admin <b>'.$self->name.'</b> telah menambahkan data izin '.permission_type($type)['name'].' atas nama anda pada '.date('d M Y',strtotime($date));
                    $post2['description'] = $description;
                    $this->action_m->insert('notification',$post2);
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Pengajuan izin berhasil di tambahkan!<br><b>status : </b>'.$badge;
                $data['datatable'] = 'table_permission';
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

    // FUNCTION LEAVE
    public function insert_leave()
    {
        // VARIABEL
        if (in_array($this->id_role,[1])) {
        $arrVar['id_user']             = 'Karyawan';
        }
        $arrVar['date']             = 'Tanggal cuti';
        $arrVar['description']             = 'Keterangan';
        
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

        $post['code'] = 'LV'.date('YmdHis');
        if (!in_array(false, $arrAccess)) {
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }

            $status = 'P';
            if (in_array($this->id_role,[1])) {
                $status = 'Y';
                $post['approve_by'] = $this->id_user;
                $post['approve_date'] = date('Y-m-d H:i:s');
            }else{
                $post['id_user'] = $this->id_user;
            }

            $ss = status_submission($status);
            $badge = '<span class="badge badge-'.$ss['badge'].'">'.$ss['name'].'</span>';

            $post['approve'] = $status;
            $insert = $this->action_m->insert('leave', $post);
            if ($insert) {
                if ($this->id_role == 1) {
                    $self = $this->action_m->get_single('user',['id_user' => $this->id_user]);
                    $post2['id_user'] = $id_user;
                    $post2['message'] = 'Admin <b>'.$self->name.'</b> telah menambahkan data cuti atas nama anda pada '.date('d M Y',strtotime($date));
                    $post2['description'] = $description;
                    $this->action_m->insert('notification',$post2);
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Pengajuan cuti berhasil di tambahkan!<br><b>status : </b>'.$badge;
                $data['datatable'] = 'table_leave';
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



    // APPROVAL
    public function approval($table = '',$idfield = '')
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $cek = $this->action_m->get_single($table,[$idfield => $id]);
        if (!$cek) {
            $data['status'] = false;
            $data['alert']['message'] = 'Data pengajuan tidak ditemukan!';
            echo json_encode($data);
            exit;
        }

        $post['approve'] = $status;
        $post['approve_by'] = $this->id_user;
        $post['approve_date'] = date('Y-m-d H:i:s');

        $ss = status_submission($status);

        $update = $this->action_m->update($table,$post,[$idfield => $id]);
        if ($update) {
            $subs = 'undifind';
            if ($table == 'leave') {
                $subs = 'Cuti';
            }
            if ($table == 'permission') {
                $subs = 'Izin';
            }
            if ($table == 'overtime') {
                $subs = 'Lembur';
            }

            $self = $this->action_m->get_single('user',['id_user' => $this->id_user]);
            $post2['id_user'] = $cek->id_user;
            $post2['message'] = 'Pengajuan <b>'.$subs.'</b> anda telah <b>'.$ss['name'].'</b> oleh admin <b>'.$self->name.'</b>';
            $post2['description'] = $cek->description;
            $this->action_m->insert('notification',$post2);


            $data['status'] = true;
            $data['alert']['message'] = 'Status pengajuan berhasil di rubah menjadi <span class="badge badge-'.$ss['badge'].'">'.$ss['name'].'</span>';
            echo json_encode($data);
            exit;
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Status pengajuan gagal di rubah menjadi <span class="badge badge-'.$ss['badge'].'">'.$ss['name'].'</span>';
            echo json_encode($data);
            exit;
        }
    }

}


