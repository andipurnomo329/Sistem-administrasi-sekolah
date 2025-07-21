<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Kas extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kas_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Kas';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('kas/list');
    }
    
    public function listing(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Saldo Kas";
            $pageInfo['param']='';
            $this->loadViews2("kas/akun", $this->global, $pageInfo , NULL, "reporting/akun" );    
        }
    }

    public function getSaldo() {
        $postData = $this->input->post();
        // debug($postData);exit;
        $data['datas'] = $this->pm->getSaldo($postData);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }
    
}

?>