<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Mapel extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        
        $this->isLoggedIn();
        $this->load->model('mapel_model', 'bm');

        $this->module = 'Mata Pelajaran';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('mapel/dataList');
    }
    
    function dataList(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }else{
            $pageInfo='';
            $this->global['pageTitle'] = "Data Mata Pelajaran";
            $this->loadViews2("mapel/mapelList", $this->global, $pageInfo , NULL, 'mapel/mapelModal');    
        }
    }
    
    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->bm->getDatabyid($id);
        echo json_encode($data);
    }

    public function getData() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->bm->getDataTable($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function addNewTask() {
        $clean_data = $this->security->xss_clean($this->input->post());
        // debug($clean_data);exit;
        $result = $this->bm->addNewTask($clean_data);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data" => $clean_data);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function updateData() {
        $id = $this->input->post('id');
        $clean_data = $this->security->xss_clean($this->input->post());
        unset($clean_data["id"]);

        $result = $this->bm->editTask($clean_data, $id);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data"=>$clean_data);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function deleteData() {
        $id = $this->input->post('id');
        $clean_data = $this->security->xss_clean($this->input->post());
        $taskInfo = array(
            'isDeleted'=>'1', 
            'updatedBy'=>$this->vendorId, 
            'updatedDtm'=>date('Y-m-d H:i:s')
        );
        $result = $this->bm->editTask($taskInfo, $clean_data['id']);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data"=> $result);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

}

?>