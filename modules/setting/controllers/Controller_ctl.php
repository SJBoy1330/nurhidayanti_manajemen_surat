<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
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

    public function index(){
        if ($this->role != 'admin') {
            redirect('dashboard');
        }
        $page = '';
        if (isset($_GET['page']) && $_GET['page'] != '') {
            $page = $_GET['page'];
        }
        $data = [];
        // GLBL
        $data['title'] = 'setting';
        $data['subtitle'] = 'setting lanjutan website';

        // LOAD JS
        $data['js_add'][] = '<script>var page = "setting"</script>';
        $data['js_add'][] = '<script src="'.base_url('assets/admin/js/modul/setting/logo.js').'"></script>';
        $data['js_add'][] = '<script src="'.base_url('assets/admin/js/modul/setting/umum.js').'"></script>';

        // GET DATA
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);
        $result = $setting;


        // SET DATA
        $data['result'] = $result;
        $data['page'] = $page;
        
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $data, TRUE);
        $this->display();
    }

    public function profile(){
        $data = [];
        // GLBL
        $data['title'] = 'Profil';
        $data['subtitle'] = 'Pengaturan data pribadi';

        // LOAD JS
        $data['js_add'][] = '<script>var page = "profile"</script>';
        $data['js_add'][] = '<script src="' . base_url('assets/admin/') . 'js/modul/setting/profile.js"></script>';

        $result = $this->action_m->get_single('users',['id' => $this->id]);

        $data['result'] = $result;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('profile', $data, TRUE);
        $this->display();
    }

   
}
