<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Kelas extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        
        $this->isLoggedIn();
        $this->load->model('kelas_model', 'bm');
        $this->load->model('guru_model', 'mm');
        $this->load->model('WaliKelas_model', 'wm');

        $this->module = 'Menu';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('kelas/dataList');
    }
    
    function dataList(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $pageInfo='';
            $this->global['pageTitle'] = "Data Kelas";
            $this->loadViews2("kelas/kelasList", $this->global, $pageInfo , NULL, 'kelas/kelasModal');    
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
        $data = $this->bm->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function addNewTask() {
        $clean_data = $this->security->xss_clean($this->input->post());
        $result = $this->bm->addNewTask($clean_data);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data" => $clean_data);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function updateData() {
        $id = $this->input->post('id_kelas');
        $clean_data = $this->security->xss_clean($this->input->post());
        unset($clean_data["id_kelas"]);
        $result = $this->bm->editTask($clean_data, $id);

        if($result > 0) {
            $hasil = array("status" => TRUE, 'data'=>$clean_data);
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


    // Transaksi Data Kelas
    function dataKelas(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            
            $this->global['pageTitle'] = "Data Kelas";
            $pageInfo['param']='7';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/DataKelas/transaksiKelas", $this->global, $pageInfo , NULL, 'kelas/kelasModal');    
        }
    }

    function detail($id){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Detail Data ";
            $pageInfo['dataDetail'] = $this->bm->getTaskInfo($id);
            $pageInfo['dataGuru'] = $this->bm->getGuruByPeople($id);
            $this->loadViews2("transaksi/DataKelas/detailTransaksi", $this->global, $pageInfo , NULL,'transaksi/DataKelas/modalDetailTrx');    
        }
    }

    public function AddWaliKelas()
    {
        $taskInfo = [
            'id_guru' => $this->input->post('id_guru'),
            'id_kelas' => $this->input->post('id_kelas')
        ];
        // debug($taskInfo);
        $insert_id = $this->bm->addTrxKelas($taskInfo);
        

        if ($insert_id) {
            echo json_encode(["status" => true, "message" => "Data berhasil ditambahkan", "insert_id" => $insert_id]);
        } else {
            echo json_encode(["status" => false, "message" => "Gagal menambahkan data"]);
        }
    }

    public function cekGuruByKelas() {
        $id_kelas = $this->input->post('id_kelas'); // Ambil id_kelas dari request
        $data = $this->bm->getGuruByKelas($id_kelas); // Ambil data guru

        if (!empty($data)) {
            echo json_encode(['status' => true, 'data' => $data]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function getDataWaliKelas() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->wm->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }
    
}

?>