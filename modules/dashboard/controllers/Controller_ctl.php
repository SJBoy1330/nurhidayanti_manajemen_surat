<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id = '';
    var $role = '';
    var $name = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
        $this->role = $this->session->userdata(PREFIX_SESSION.'_role');
        $this->name = $this->session->userdata(PREFIX_SESSION.'_name');
    }

    public function index()
    {
        $mydata = [];

        // SET TITLE
        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Landing Page '.($this->role == 'admin') ? 'Admin' : 'Petugas'; 

        // DEFAULT DATA
        $cnt_petugas = 0;
        $cnt_admin = 0;
        $cnt_arsip = 0;

        // GET DATA
        $user = $this->action_m->get_all('users',['status' => 'Y']);
        $arsip = $this->action_m->get_all('arsip');
        if ($user) {
            foreach ($user as $key) {
                if ($key->role == 'admin') {
                    $cnt_admin += 1;
                }else{
                    $cnt_petugas += 1;
                }
            }
        }

        if ($arsip) {
            $cnt_arsip += count($arsip);
        }

        // SET DATA
        
        $data['cnt_petugas'] = $cnt_petugas;
        $data['cnt_admin'] = $cnt_admin;
        $data['cnt_arsip'] = $cnt_arsip;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $data, TRUE);
        $this->display();
    }

    public function log()
    {
        $filter_date = $this->input->get('filter_date') ?? date('Y-m-d');

        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Log Aktivitas';
        $this->data['subtitle'] = 'Riwayat aktifitas user';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "log"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/log.js"></script>';

        $order['order_by'] = 'create_date';
        $order['ascdesc']  = 'DESC';
        $result = $this->action_m->get_all('log',['id_user' => $this->id,'DATE(create_date)' => date('Y-m-d',strtotime($filter_date))],$order);

        // SET DATA
        $mydata['result'] = $result;
        $mydata['nowdate'] = $filter_date;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('log', $mydata, TRUE);
        $this->display();
    }

}
