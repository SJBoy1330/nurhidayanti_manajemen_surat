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



    public function petugas()
    {
        if (!in_array($this->role,['admin'])) {
            redirect('dashboard');
        }
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Petugas';
        $this->data['subtitle'] = 'Manajemen data petugas';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/petugas"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/petugas.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('petugas', $mydata, TRUE);
        $this->display();
    }

     public function box()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Box Arsip';
        $this->data['subtitle'] = 'Manajemen data box arsip';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/box"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/box.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('box', $mydata, TRUE);
        $this->display();
    }

    public function category()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Kategori';
        $this->data['subtitle'] = 'Manajemen data kategori';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/category"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/category.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('category', $mydata, TRUE);
        $this->display();
    }


    public function location()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Lokasi';
        $this->data['subtitle'] = 'Manajemen data lokasi';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/location"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/location.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('location', $mydata, TRUE);
        $this->display();
    }


    public function arsip()
    {
        $mydata = [];
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Arsip';
        $this->data['subtitle'] = 'Manajemen data arsip';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/petugas"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/arsip.js"></script>';

        // GET DATA
        $category = $this->action_m->get_all('category');
        $location = $this->action_m->get_all('location');
        $box_arsip = $this->action_m->get_all('box_arsip');

        // SET DATA
        $mydata['category'] = $category;
        $mydata['location'] = $location;
        $mydata['box_arsip'] = $box_arsip;

        // LOAD VIEW
        $this->data['content'] = $this->load->view('arsip', $mydata, TRUE);
        $this->display();
    }


    public function detail_arsip()
    {
        $id = $this->input->post('id');
        if (!$id) {
            echo "ID Tidak terdeteksi";
            exit;
        }
        $params['arrjoin']['category']['statement'] = 'category.id = arsip.id_category';
        $params['arrjoin']['category']['type'] = 'LEFT';
        $params['arrjoin']['location']['statement'] = 'location.id = arsip.id_location';
        $params['arrjoin']['location']['type'] = 'LEFT';
        $params['arrjoin']['box_arsip']['statement'] = 'box_arsip.id = arsip.id_box_arsip';
        $params['arrjoin']['box_arsip']['type'] = 'LEFT';

        $result = $this->action_m->get_where_params('arsip', ['arsip.id' => $id], 'arsip.*,category.name AS category,location.name AS location,location.code AS location_code,box_arsip.name AS box_arsip', $params);
        if (!$result) {
            echo "Data Arsip Tidak Terdeteksi";
            exit;
        }

        $data['result'] = $result[0];
        sleep(1);
        $this->load->view('modal/display_arsip',$data);
    }
}
