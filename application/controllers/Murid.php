<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Murid extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        
        $this->isLoggedIn();
        $this->load->model('murid_model', 'km');
        $this->module = 'Murid';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('murid/dataList');
    }
    
    function dataList(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }else{
            $this->global['pageTitle'] = "Data Murid";
            $pageInfo='';
            $this->loadViews2("murid/muridList", $this->global, $pageInfo , NULL, 'murid/muridModal');    
        }
    }
    
    function detailMurid($id){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }else{
            $this->global['pageTitle'] = "Detail Data Murid";
            $pageInfo['param']='7';
            $pageInfo['dataDetail'] = $this->km->getDatabyid($id);
            $this->loadViews2("murid/detailMurid", $this->global, $pageInfo , NULL, null);    
        }
    }
    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->km->getDatabyid($id);
        echo json_encode($data);
    }

    public function getData() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->km->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function addNewTask() {
        $clean_data = $this->security->xss_clean($this->input->post());
        $fileUpload = $this->doUpload('foto','murid');
        if(isset($fileUpload['upload_data']['file_name'])){
            $filename = $fileUpload['upload_data']['file_name'];
        }else{
            $filename = 'default.jpg';
        }
        $adding = array("foto" => $filename);
        // debug($fileUpload);
        $taskInfo = $clean_data + $adding;

        $result = $this->km->addNewTask($taskInfo);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data" => $clean_data);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function updateData() {
        $id = $this->input->post('id');
        
        $fileUpload = $this->doUpload('foto','murid');
        // debug($fileUpload);
        

        $clean_data = $this->security->xss_clean($this->input->post());
        unset($clean_data["id"]);
        $log = array(
            'updatedBy'=>$this->vendorId, 
            'updatedDtm'=>date('Y-m-d H:i:s')
        );
        
        $taskInfo = $clean_data + $log;
        if(isset($fileUpload['upload_data']['file_name'])){
            $filename = $fileUpload['upload_data']['file_name'];
            $adding = array("foto" => $filename);
            $taskInfo = $clean_data + $log + $adding;
        }
        
        // debug($taskInfo); exit;
        $result = $this->km->editTask($taskInfo, $id);

        if($result > 0) {
            $hasil = array("status" => TRUE, "data" => $clean_data);
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
        $result = $this->km->editTask($taskInfo, $clean_data['id']);

        if($result > 0) {
            $hasil = array("status" => TRUE);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }
    public function generate_cv($id) {
        $data = $this->km->getDatabyid($id);
        if (!$data) {
            show_error('Data murid tidak ditemukan.', 404, 'Error');
            return;
        }
        $html = $this->load->view('murid/murid_cv', $data, TRUE);
        
        $this->load->library('MYPDF'); 
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
        $image_file = K_PATH_IMAGES . 'logosekolah.png'; // Sesuaikan path gambar
        $background = FCPATH . 'files\logosekolah.png';
        $image_file = K_PATH_IMAGES . 'logosekolah.png';
        // debug($image_file);
        // echo $html; exit;
        // Aktifkan Header & Footer
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
    
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 20);
        $pdf->AddPage();
            
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Nama file PDF yang aman untuk download
        $safe_nama = preg_replace('/[^A-Za-z0-9]/', '_', $data->nama);
        $file_name = 'CV-' . $safe_nama . '.pdf';
    
        // Pastikan tidak ada output lain sebelum mengirim PDF
        ob_clean();
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Cache-Control: max-age=0");
    
        // Download otomatis ke client
        $pdf->Output($file_name, 'D');
        exit;
    }
    
    
    
}

?>