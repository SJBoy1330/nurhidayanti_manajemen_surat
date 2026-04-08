<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Auth
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
        redirect('login');
    }
    
    public function login()
    {
        $mydata = [];
        
        // GLOBAL VARIABEL
        $this->data['title'] = 'Masuk untuk menerima akses';

        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);

        $mydata['setting'] = $setting;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('login', $mydata, TRUE);
        $this->display();
    }
}
