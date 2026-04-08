<?php defined('BASEPATH') or exit('No direct script access allowed');



/**

 * CodeIgniter-HMVC

 *

 * @package    CodeIgniter-HMVC

 * @author     N3Cr0N (N3Cr0N@list.ru)

 * @copyright  2019 N3Cr0N

 * @license    https://opensource.org/licenses/MIT  MIT License

 * @link       <URI> (description)

 * @version    GIT: $Id$

 * @since      Version 0.0.1

 * @filesource

 *

 */


class MY_Controller extends MX_Controller

{

    //

    public $CI;



    /**

     * An array of variables to be passed through to the

     * view, layout,....

     */

    protected $data = array();



    /**

     * [__construct description]

     *

     * @method __construct

     */

    public function __construct()

    {



        parent::__construct();



        // This function returns the main CodeIgniter object.

        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.

        $CI = &get_instance();



        // Copyright year calculation for the footer

        $begin = 2019;

        $end =  date("Y");

        $date = "$begin - $end";



        // Copyright

        $this->data['copyright'] = $date;
    }



    function __nocache()
    {

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');

        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');

        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);

        $this->output->set_header('Pragma: no-cache');
    }
}

class MY_Auth extends MY_Controller
{


    var $path_theme = '';
    public function __construct()
    {

        parent::__construct();

        $this->path_theme = 'auth';
    }



    function display($name = '')
    {
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);
        $user = [];
        if ($this->id) {
            
            $user = $this->action_m->get_single('users',['id' => $this->id,'status' => 'Y']);
            if ($user) {
                if ($this->role != $user->role) {
                    $arrSession[PREFIX_SESSION.'_role'] = $user->role;
                    $this->session->set_userdata($arrSession);
                }
                redirect('dashboard');
            }else{
                redirect('logout');
            }
        }
        
        $this->data['setting'] = $setting;


        $tpl = $this->path_theme . '/base';



        $this->load->view($tpl, $this->data);
    }
}


class MY_Admin extends MY_Controller
{
    var $path_theme = '';
    var $id = 0;
    var $role = 0;
    public function __construct()
    {

        parent::__construct();

        $this->path_theme = 'admin';
        $this->id = $this->session->userdata(PREFIX_SESSION.'_id');
        $this->role = $this->session->userdata(PREFIX_SESSION.'_role');
        
    }



    function display($name = '')
    {
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);
        $user = [];
        if ($this->id) {
            
            $user = $this->action_m->get_single('users',['id' => $this->id,'status' => 'Y']);
            if ($user) {
                if ($this->role != $user->role) {
                    $arrSession[PREFIX_SESSION.'_role'] = $user->role;
                    $this->session->set_userdata($arrSession);
                }
            }else{
                redirect('logout');
            }
        }
        
        $this->data['setting'] = $setting;
        $this->data['profil'] = $user;


        $tpl = $this->path_theme . '/base';



        $this->load->view($tpl, $this->data);
    }
}



// Backend controller

require_once(APPPATH . 'core/Backend_Controller.php');



// Frontend controller

require_once(APPPATH . 'core/Frontend_Controller.php');
