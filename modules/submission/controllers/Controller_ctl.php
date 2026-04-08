<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_user = '';
    var $id_role = '';
    var $access = [];
    var $acc = 0;
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
        $this->id_role = $this->session->userdata(PREFIX_SESSION.'_id_role');

    }

    public function index()
    {
        redirect('master/admin');
    }


    public function overtime()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Pengajuan Lembur';
        $this->data['subtitle'] = 'Formulir pengajuan lembur';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "submission/overtime"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/submission/overtime.js"></script>';


        // GET DATA
        $employee = $this->action_m->get_all('user',['status' => 'Y','delete' => 'N','id_role' => 2]);

        // SET DATA
        $mydata['employee'] = $employee;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('overtime', $mydata, TRUE);
        $this->display();
    }


    public function permission()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Pengajuan Izin';
        $this->data['subtitle'] = 'Formulir pengajuan izin';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "submission/permission"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/submission/permission.js"></script>';


        // GET DATA
        $employee = $this->action_m->get_all('user',['status' => 'Y','delete' => 'N','id_role' => 2]);

        // SET DATA
        $mydata['employee'] = $employee;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('permission', $mydata, TRUE);
        $this->display();
    }

    public function leave()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Pengajuan Cuti';
        $this->data['subtitle'] = 'Formulir pengajuan cuti';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "submission/leave"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/submission/leave.js"></script>';


        // GET DATA
        $employee = $this->action_m->get_all('user',['status' => 'Y','delete' => 'N','id_role' => 2]);

        // SET DATA
        $mydata['employee'] = $employee;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('leave', $mydata, TRUE);
        $this->display();
    }

}
