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

        $where['users.role'] = 'admin';
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
                            <button type="button" class="btn btn-icon btn-primary btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-image="'.$image.'" data-bs-toggle="modal" data-bs-target="#kt_modal_admin">
                                <i class="fa-solid fa-qrcode fs-2"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-image="'.$image.'" data-bs-toggle="modal" data-bs-target="#kt_modal_admin">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`users`,`id`,`'.$fl.'`)" data-datatable="table_admin" class="btn btn-icon btn-danger btn-sm" title="Delete">
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

    public function box_arsip()
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
            'box_arsip.code',
            'box_arsip.name',
            'cnt_arsip'
        ];

        if ($search) {
            $params['columnsearch'][] = 'box_arsip.code';
            $params['columnsearch'][] = 'box_arsip.name';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('box_arsip', $where, 'box_arsip.*,(SELECT COUNT(*) FROM arsip WHERE box_arsip.id = arsip.id_box_arsip) AS cnt_arsip', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'box_arsip.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('box_arsip',$where,'box_arsip.*,(SELECT COUNT(*) FROM arsip WHERE box_arsip.id = arsip.id_box_arsip) AS cnt_arsip',$params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                 $code = '<span class="text-primary">'.$item->code.'</span>';
                
                $action = '<div class="d-flex justify-content-end flex-shrink-0">
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-bs-toggle="modal" data-bs-target="#kt_modal_box_arsip">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`box_arsip`,`id`)" data-datatable="table_box_arsip" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>
                        </div>';

                $html[] = [
                    $code,
                    $item->name,
                    $item->cnt_arsip,
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

    public function location()
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
            'location.code',
            'location.name',
            'location.address',
            'cnt_arsip'
        ];

        if ($search) {
            $params['columnsearch'][] = 'location.code';
            $params['columnsearch'][] = 'location.name';
            $params['columnsearch'][] = 'location.address';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('location', $where, 'location.*,(SELECT COUNT(*) FROM arsip WHERE location.id = arsip.id_location) AS cnt_arsip', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'location.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('location',$where,'location.*,(SELECT COUNT(*) FROM arsip WHERE location.id = arsip.id_location) AS cnt_arsip',$params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                 $code = '<span class="text-primary">'.$item->code.'</span>';
                
                $action = '<div class="d-flex justify-content-end flex-shrink-0">
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-bs-toggle="modal" data-bs-target="#kt_modal_location">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`location`,`id`)" data-datatable="table_location" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>
                        </div>';

                $html[] = [
                    $code,
                    $item->name,
                    $item->cnt_arsip,
                    $item->address,
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

    public function category()
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
            'category.code',
            'category.name',
            'cnt_arsip'
        ];

        if ($search) {
            $params['columnsearch'][] = 'category.code';
            $params['columnsearch'][] = 'category.name';
            $params['search'] = $search;
        }

        $totalRecords = $this->action_m->cnt_where_params('category', $where, 'category.*,(SELECT COUNT(*) FROM arsip WHERE category.id = arsip.id_category) AS cnt_arsip', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'category.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('category',$where,'category.*,(SELECT COUNT(*) FROM arsip WHERE category.id = arsip.id_category) AS cnt_arsip',$params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                 $code = '<span class="text-primary">'.$item->code.'</span>';
                
                $action = '<div class="d-flex justify-content-end flex-shrink-0">
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-bs-toggle="modal" data-bs-target="#kt_modal_category">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`category`,`id`)" data-datatable="table_category" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>
                        </div>';

                $html[] = [
                    $code,
                    $item->name,
                    $item->cnt_arsip,
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


    public function arsip()
    {
        $search = $this->input->post('search')['value'] ?? '';
        $offset = (int)($this->input->post('start') ?? 0);
        $limit = (int)($this->input->post('length') ?? 10);
        $orderColumn = $this->input->post('order')[0]['column'] ?? null;
        $orderDir = $this->input->post('order')[0]['dir'] ?? 'asc';
        $draw = (int)($this->input->post('draw') ?? 1);
        $filter_id_category = $this->input->post('filter_id_category') ?? '';
        $filter_id_box_arsip = $this->input->post('filter_id_box_arsip') ?? '';
        $filter_id_location = $this->input->post('filter_id_location') ?? '';

        $id = $this->id;

        $where = [];
        $params = [];
        $columns = [
            null,
            'arsip.code',
            'arsip.name',
            'location.name',
            'category.name',
            'box_arsip.name',
        ];

        if ($search) {
            $params['columnsearch'][] = 'arsip.code';
            $params['columnsearch'][] = 'arsip.name';
            $params['columnsearch'][] = 'location.code';
            $params['columnsearch'][] = 'location.name';
            $params['columnsearch'][] = 'category.code';
            $params['columnsearch'][] = 'category.name';
            $params['columnsearch'][] = 'box_arsip.code';
            $params['columnsearch'][] = 'box_arsip.name';
            $params['search'] = $search;
        }

        if ($filter_id_location !== null && $filter_id_location !== '') {
            if ($filter_id_location != 'all') {
                $where['arsip.id_location'] = $filter_id_location;
            }
        }

        if ($filter_id_category !== null && $filter_id_category !== '') {
            if ($filter_id_category != 'all') {
                $where['arsip.id_category'] = $filter_id_category;
            }
        }

        if ($filter_id_box_arsip !== null && $filter_id_box_arsip !== '') {
            if ($filter_id_box_arsip != 'all') {
                $where['arsip.id_box_arsip'] = $filter_id_box_arsip;
            }
        }

        $params['arrjoin']['category']['statement'] = 'category.id = arsip.id_category';
        $params['arrjoin']['category']['type'] = 'LEFT';
        $params['arrjoin']['location']['statement'] = 'location.id = arsip.id_location';
        $params['arrjoin']['location']['type'] = 'LEFT';
        $params['arrjoin']['box_arsip']['statement'] = 'box_arsip.id = arsip.id_box_arsip';
        $params['arrjoin']['box_arsip']['type'] = 'LEFT';

        $totalRecords = $this->action_m->cnt_where_params('arsip', $where, 'arsip.*,category.name AS category,location.name AS location,location.code AS location_code,box_arsip.name AS box_arsip', $params);

        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $kolom = 'arsip.create_date';
        $odr = 'DESC';

        if ($orderColumn !== null && isset($columns[$orderColumn])) {
            $kolom = $columns[$orderColumn];
            $odr = $orderDir;
        }

        $params['sort'] = $kolom;
        $params['order'] = $odr;

        // Ambil data
        $result = $this->action_m->get_where_params('arsip',$where,'arsip.*,category.name AS category,location.name AS location,location.code AS location_code,box_arsip.name AS box_arsip',$params);

        $html = [];
        if ($result) {
            foreach ($result as $item) {
                $code = '<span class="text-primary">'.$item->code.'</span>';

                $fl = '';
                if ($item->file && file_exists('./data/arsip/'.$item->file)) {
                    $fl = './data/arsip/'.$item->file;
                }
                
                $action = '<div class="d-flex justify-content-end flex-shrink-0">
                            <button type="button" class="btn btn-icon btn-info btn-sm me-1" title="Detail" onclick="detail_arsip(this,'.$item->id.')" data-bs-toggle="modal" data-bs-target="#kt_modal_detail_location">
                                <i class="fa-solid fa-eye fs-2"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-warning btn-sm me-1" title="Update" onclick="ubah_data(this,'.$item->id.')" data-bs-toggle="modal" data-bs-target="#kt_modal_arsip">
                                <i class="ki-outline ki-pencil fs-2"></i>
                            </button>
                            <button type="button" onclick="hapus_data(this,event,'.$item->id.',`arsip`,`id`,`'.$fl.'`)" data-datatable="table_arsip" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </button>
                        </div>';

                $html[] = [
                    $action,
                    $code,
                    $item->name,
                    '<span class="text-primary">'.$item->location_code.'</span> | '.$item->location,
                    '<span class="badge badge-primary">'.$item->category.'</span>',
                    '<span class="badge badge-info">'.$item->box_arsip.'</span>'
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