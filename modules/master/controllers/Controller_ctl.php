<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id = '';
    var $role = '';
    var $access = [];
    var $acc = 0;
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
        $this->role = $this->session->userdata(PREFIX_SESSION.'_role');

    }

    public function index()
    {
        redirect('master/admin');
    }


    public function admin()
    {
        if (!in_array($this->role,['admin'])) {
            redirect('dashboard');
        }
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Admin';
        $this->data['subtitle'] = 'Manajemen data admin';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/admin"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/admin.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('admin', $mydata, TRUE);
        $this->display();
    }


    // ==========================================
    // 1. SURAT MASUK
    // ==========================================
    public function surat_masuk()
    {
        if (!in_array($this->role, ['admin', 'petugas'])) {
            redirect('dashboard');
        }
        
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Surat Masuk';
        $this->data['subtitle'] = 'Manajemen data surat masuk';
        
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/surat_masuk"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/surat_masuk.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('surat_masuk', $mydata, TRUE);
        $this->display();
    }

    // ==========================================
    // 2. SURAT KELUAR
    // ==========================================
    public function surat_keluar()
    {
        if (!in_array($this->role, ['admin', 'petugas'])) {
            redirect('dashboard');
        }
        
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Surat Keluar';
        $this->data['subtitle'] = 'Manajemen data surat keluar';
        
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/surat_keluar"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/surat_keluar.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('surat_keluar', $mydata, TRUE);
        $this->display();
    }

    // ==========================================
    // 3. LHP (Laporan Hasil Pemeriksaan)
    // ==========================================
    public function lhp()
    {
        if (!in_array($this->role, ['admin', 'petugas'])) {
            redirect('dashboard');
        }
        
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data LHP';
        $this->data['subtitle'] = 'Manajemen data Laporan Hasil Pemeriksaan';
        
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/lhp"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/lhp.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('lhp', $mydata, TRUE);
        $this->display();
    }
}
