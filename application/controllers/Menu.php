<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Menu extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        
        $this->isLoggedIn();
        $this->load->model('menu_model', 'pm');
        $this->module = 'Menu';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('transaksi/infaqMasjid');
    }
    
    function menuList(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            
            $this->global['pageTitle'] = "Menu List";
            $pageInfo['param']='7';
            $pageInfo['inOut']='I';
            $this->loadViews2("menu/menuList", $this->global, $pageInfo , NULL, 'menu/menulist');    
        }
    }

    public function getDataMenuActive() {
        $data = $this->pm->getDataMenuActive();
        echo json_encode($data);
    }

    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->pm->getDatabyid($id);
        echo json_encode($data);
    }

    public function getData() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }
    
    public function getMenuByRole() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getMenuByRoleId($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function addNewTask() {
        // debug($this->input->post());
        $clean_data = $this->security->xss_clean($this->input->post());
        // debug($clean_data);exit;
        $taskInfo = array(
            'nama'=>$clean_data['nama'], 
            'url'=>$clean_data['url'], 
            'icon'=>$clean_data['icon'],
            'parent_id'=>$clean_data['parent'],
        );

        $result = $this->pm->addNewTask($taskInfo);

        if($result > 0) {
            $hasil = array("status" => TRUE);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function updateData() {
        $id = $this->input->post('id');
        // debug($this->input->post());
        $clean_data = $this->security->xss_clean($this->input->post());
        // debug($clean_data);exit;
        $taskInfo = array(
            'nama'=>$clean_data['nama'], 
            'url'=>$clean_data['url'], 
            'icon'=>$clean_data['icon'],
            'parent_id'=>$clean_data['parent'],
        );

        $result = $this->pm->editTask($taskInfo, $clean_data['id']);

        if($result > 0) {
            $hasil = array("status" => TRUE);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }
    
    public function updatePermission() {
        $postData = $this->input->post();
        // debug($postData);
        if($postData['tmrId']){
            $taskInfo = array(
                $postData['action']=>$postData['value'], 
                'updatedBy'=>$this->vendorId, 
                'updatedDtm'=>date('Y-m-d H:i:s')
            );
            $result = $this->pm->updateMatrix($taskInfo, $postData['tmrId']);
        }else{
            $taskInfo = array(
                'roleId'=>$postData['roleId'], 
                'menuId'=>$postData['menuId'], 
                $postData['action']=>$postData['value'], 
                'createdBy'=>$this->vendorId, 
                'createdDtm'=>date('Y-m-d H:i:s')
            );
            $result = $this->pm->insertMatrix($taskInfo);
        }
        echo json_encode($result);
    }

    public function deleteData() {
        $id = $this->input->post('id');
        $clean_data = $this->security->xss_clean($this->input->post());
        $taskInfo = array(
            'isDeleted'=>'1', 
            'updatedBy'=>$this->vendorId, 
            'updatedDtm'=>date('Y-m-d H:i:s')
        );
        $result = $this->pm->editTask($taskInfo, $clean_data['id']);

        if($result > 0) {
            $hasil = array("status" => TRUE);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }
}

?>