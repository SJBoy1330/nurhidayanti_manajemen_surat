<?php defined('BASEPATH') or exit('No direct script access allowed');

class Table_ctl extends MY_Controller 
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



    public function admin()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);
        $filter_status = $this->input->post('filter_status') ?? '';

        $where = [];
        $params = [];
        $columns = [null, 'users.code', 'users.name', 'users.status'];

        if ($search) {
            $params['columnsearch'][] = 'users.code';
            $params['columnsearch'][] = 'users.name';
            $params['search'] = $search;
        }

        $where['users.role'] = 'admin';
        $where['users.id !='] = $this->id;

        if ($filter_status !== null && $filter_status !== '' && $filter_status != 'all') {
            $where['status'] = $filter_status;
        }

        $totalRecords = $this->action_m->cnt_where_params('users', $where, 'users.*', $params);

        $params['limit'] = $limit;
        if ($offset) $params['offset'] = $offset;

        $kolom = 'users.create_date';
        $odr = 'DESC';
        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        $result = $this->action_m->get_where_params('users', $where, 'users.*', $params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                $image = image_check($item->image, 'user', 'user');
                $code = '<span class="text-primary">'.$item->code.'</span>';

                // User Info Column
                $user = '<div class="d-flex align-items-center">';
                $user .= '<div class="symbol symbol-50px"><span class="symbol-label" style="background-image:url('.$image.');"></span></div>';
                $user .= '<div class="ms-5 d-flex flex-column">';
                $user .= '<span class="text-gray-800 fs-5 fw-bold">'.$item->name.'</span>';
                $user .= '<span class="text-gray-500 fs-7">'.$item->username.'</span>';
                $user .= '</div></div>';

                // Status Switch
                $checked = ($item->status == 'Y') ? 'checked' : '';
                $status = '<div class="d-flex justify-content-center align-items-center">';
                $status .= '<div class="form-check form-switch">';
                $status .= '<input onchange="switching(this,event,'.$item->id.')" data-url="'.base_url('setting_function/switch/users/id').'" class="form-check-input cursor-pointer" type="checkbox" '.$checked.'>';
                $status .= '</div></div>';

                // Generate URL QR
                // Gunakan str_replace atau helper base64url_encode milikmu
                $encoded_id = rtrim(base64url_encode($item->id));
                $qr_link = base_url('logqr/' . $encoded_id);

                $fl = ($item->image && file_exists('./data/user/'.$item->image)) ? './data/user/'.$item->image : '';
                
                // Action Buttons
                $action = '<div class="d-flex justify-content-end flex-shrink-0">';
                // Tombol QR
                $action .= '<button type="button" class="btn btn-icon btn-primary btn-sm me-1" title="Generate QR" onclick="generate_qr(\''.$qr_link.'\', \''.$item->name.'\')">
                                <i class="fa-solid fa-qrcode fs-2"></i>
                            </button>';
                // Tombol Edit
                $action .= '<button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-image="'.$image.'" data-bs-toggle="modal" data-bs-target="#kt_modal_admin">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>';
                // Tombol Delete
                $action .= '<button type="button" onclick="hapus_data(this,event,'.$item->id.',`users`,`id`,`'.$fl.'`)" data-datatable="table_admin" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>';
                $action .= '</div>';

                $html[] = [$code, $user, $status, $action];
            }
        }

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $html
        ]);
    }

    public function petugas()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);
        $filter_status = $this->input->post('filter_status') ?? '';

        $id = $this->id;

        $where = [];
        $params = [];
        $columns = [
            null,
            'users.code',
            'users.name',
            'users.status'
        ];

        if ($search) {
            $params['columnsearch'][] = 'users.code';
            $params['columnsearch'][] = 'users.name';
            $params['search'] = $search;
        }

        $where['users.role'] = 'petugas';
        $where['users.id !='] = $this->id;

        if ($filter_status !== null && $filter_status !== '') {
            if ($filter_status != 'all') {
                $where['status'] = $filter_status;
            }
        }

        $totalRecords = $this->action_m->cnt_where_params('users', $where, 'users.*', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'users.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('users',$where,'users.*',$params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                $image = image_check($item->image, 'user', 'user');
                 $code = '<span class="text-primary">'.$item->code.'</span>';

                $user = '<div class="d-flex align-items-center">';
                $user .= '<a role="button" class="symbol symbol-50px"><span class="symbol-label" style="background-image:url('.$image.');"></span></a>';
                $user .= '<div class="ms-5 d-flex flex-column">';
                $user .= '<a role="button" class="text-gray-800 text-hover-primary fs-5 fw-bold">'.$item->name.'</a>';
                $user .= '<a role="button" class="text-gray-500 fs-7 fw-bold">'.$item->username.'</a>';
                $user .= '</div></div>';

                $checked = ($item->status == 'Y') ? 'checked' : '';
                $status = '<div class="d-flex justify-content-center align-items-center">';
                $status .= '<div class="form-check form-switch">';
                $status .= '<input onchange="switching(this,event,'.$item->id.')" data-url="'.base_url('setting_function/switch/users/id').'" class="form-check-input cursor-pointer focus-info" type="checkbox" role="switch" id="switch-'.$item->id.'" '.$checked.'>';
                $status .= '</div></div>';

                $fl = '';
                if ($item->image && file_exists('./data/user/'.$item->image)) {
                    $fl = './data/user/'.$item->image;
                }
                
                $action = '<div class="d-flex justify-content-end flex-shrink-0">
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-image="'.$image.'" data-bs-toggle="modal" data-bs-target="#kt_modal_petugas">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`users`,`id`,`'.$fl.'`)" data-datatable="table_petugas" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>
                        </div>';

                $html[] = [
                    $code,
                    $user,
                    $status,
                    $action
                ];
            }
        }
       

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $html
        ]);
    }

    public function surat_masuk()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);

        $id = $this->id;

        $where = [];
        $params = [];
        $columns = [
            null,
            'surat_masuk.no_surat',
            'surat_masuk.tgl_diterima',
            'surat_masuk.asal_surat',
            'surat_masuk.perihal',
            'surat_masuk.keterangan'
        ];

        if ($search) {
            $params['columnsearch'][] = 'surat_masuk.no_surat';
            $params['columnsearch'][] = 'surat_masuk.asal_surat';
            $params['columnsearch'][] = 'surat_masuk.perihal';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('surat_masuk', $where, 'surat_masuk.*', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'surat_masuk.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('surat_masuk', $where, 'surat_masuk.*', $params);

        $html = [];
        if ($result) {
            $no = $offset + 1;
            foreach ($result as $item) {
                $no_surat = '<span class="text-primary fw-bold">' . $item->no_surat . '</span>';
                $tgl = $item->tgl_diterima ? date('d-m-Y', strtotime($item->tgl_diterima)) : '-';

                $action = '<div class="d-flex justify-content-start flex-shrink-0">
                                <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,' . $item->id . ')" data-bs-toggle="modal" data-bs-target="#kt_modal_surat_masuk">
                                    <i class="ki-outline ki-pencil fs-2"></i>
                                </button>
                                <button type="button" onclick="hapus_data(this,event,' . $item->id . ',`surat_masuk`,`id`)" data-datatable="table_surat_masuk" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                    <i class="ki-outline ki-trash fs-2"></i>
                                </button>
                            </div>';

                $html[] = [
                    $action,
                    $no_surat,
                    $tgl,
                    $item->asal_surat,
                    $item->perihal,
                    $item->keterangan,
                    
                ];
            }
        }

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $html
        ]);
    }

    public function surat_keluar()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);

        $id = $this->id;

        $where = [];
        $params = [];
        $columns = [
            null, // Aksi
            'surat_keluar.no_surat',
            'surat_keluar.tgl_surat',
            'surat_keluar.perihal',
            'surat_keluar.tujuan',
            'surat_keluar.keterangan'
        ];

        if ($search) {
            $params['columnsearch'][] = 'surat_keluar.no_surat';
            $params['columnsearch'][] = 'surat_keluar.tujuan';
            $params['columnsearch'][] = 'surat_keluar.perihal';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('surat_keluar', $where, 'surat_keluar.*', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'surat_keluar.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        $result = $this->action_m->get_where_params('surat_keluar', $where, 'surat_keluar.*', $params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                $no_surat = '<span class="text-primary fw-bold">' . $item->no_surat . '</span>';
                $tgl = $item->tgl_surat ? date('d-m-Y', strtotime($item->tgl_surat)) : '-';

                $action = '<div class="d-flex justify-content-start flex-shrink-0">
                                <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,' . $item->id . ')" data-bs-toggle="modal" data-bs-target="#kt_modal_surat_keluar">
                                    <i class="ki-outline ki-pencil fs-2"></i>
                                </button>
                                <button type="button" onclick="hapus_data(this,event,' . $item->id . ',`surat_keluar`,`id`)" data-datatable="table_surat_keluar" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                    <i class="ki-outline ki-trash fs-2"></i>
                                </button>
                            </div>';

                $html[] = [
                    $action,
                    $no_surat,
                    $tgl,
                    $item->perihal,
                    $item->tujuan,
                    $item->keterangan
                ];
            }
        }

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $html
        ]);
    }

    public function lhp()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);

        $id = $this->id;

        $where = [];
        $params = [];
        $columns = [
            null, // Aksi
            'lhp.no_lhp',
            'lhp.tgl_lhp',
            'lhp.judul_lhp',
            'lhp.nama_obrik',
            'lhp.tim_pemeriksa',
            'lhp.keterangan'
        ];

        if ($search) {
            $params['columnsearch'][] = 'lhp.no_lhp';
            $params['columnsearch'][] = 'lhp.judul_lhp';
            $params['columnsearch'][] = 'lhp.nama_obrik';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('lhp', $where, 'lhp.*', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'lhp.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        $result = $this->action_m->get_where_params('lhp', $where, 'lhp.*', $params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                $no_lhp = '<span class="text-primary fw-bold">' . $item->no_lhp . '</span>';
                $tgl = $item->tgl_lhp ? date('d-m-Y', strtotime($item->tgl_lhp)) : '-';
                
                // Menggabungkan Judul LHP & LHR jika ada
                $judul = '<b>LHP:</b> ' . $item->judul_lhp;
                if($item->judul_lhr) $judul .= '<br><small class="text-muted"><b>LHR:</b> ' . $item->judul_lhr . '</small>';

                $action = '<div class="d-flex justify-content-start flex-shrink-0">
                                <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,' . $item->id . ')" data-bs-toggle="modal" data-bs-target="#kt_modal_lhp">
                                    <i class="ki-outline ki-pencil fs-2"></i>
                                </button>
                                <button type="button" onclick="hapus_data(this,event,' . $item->id . ',`lhp`,`id`)" data-datatable="table_lhp" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                    <i class="ki-outline ki-trash fs-2"></i>
                                </button>
                            </div>';

                $html[] = [
                    $action,
                    $no_lhp,
                    $tgl,
                    $judul,
                    $item->nama_obrik,
                    $item->tim_pemeriksa,
                    $item->keterangan
                ];
            }
        }

        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $html
        ]);
    }
}