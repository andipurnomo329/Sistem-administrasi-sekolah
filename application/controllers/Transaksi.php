<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Transaksi extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model', 'pm');
        $this->load->model('Param_model', 'param');
        $this->isLoggedIn();
        $this->module = 'Transaksi';
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
    
    function infaqMasjid(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            
            $this->global['pageTitle'] = "Infaq Masjid";
            $pageInfo['param']='7';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function infaqJumat(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Infaq Jum'at";
            $pageInfo['param']='9';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function peduliUmat(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Infaq Peduli Umat";
            $pageInfo['param']='8';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function infaqYatim(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Infaq Yatim";
            $pageInfo['param']='10';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function zakatMal(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Zakat Mal";
            $pageInfo['param']='5';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function zakatFitrah(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Zakat Fitrah";
            $pageInfo['param']='4';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function waqafHarta(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Waqaf Harta";
            $pageInfo['param']='12';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function waqafJasa(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Waqaf Jasa";
            $pageInfo['param']='13';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }
    
    function waqafAlQuran(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Waqaf Al Qur'an";
            $pageInfo['param']='14';
            $pageInfo['inOut']='I';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }

    function beasiswa(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Beasiswa Pendidikan Duafa";
            $pageInfo['param']='15';
            $pageInfo['inOut']='O';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }

    function PKBM(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "PKBM";
            $pageInfo['inOut']='O';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
        }
    }

    function nonTunai(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Penyaluran Non Tunai";
            $pageInfo['param']='8';
            $pageInfo['inOut']='O';
            $this->loadViews2("transaksi/transaksiBarang", $this->global, $pageInfo , NULL, 'transaksi/transaksiBarang');    
        }
    }

    function PenyaluranInfakYatim(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Penyaluran Infaq Yatim";
            $pageInfo['param']='10';
            $pageInfo['inOut']='O';
            $this->loadViews2("transaksi/infaqMasjid", $this->global, $pageInfo , NULL, 'transaksi/infaqMasjid');    
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
            $pageInfo['dataDetail'] = $this->pm->getTaskInfo($id);
            $pageInfo['paramDetail'] = $this->param->getTaskInfo($pageInfo['dataDetail']->paramId);
            // debug($pageInfo); exit;
            $this->loadViews2("transaksi/detailTransaksi", $this->global, $pageInfo , NULL,'transaksi/detailTransaksi');    
        }
    }
    
    function detailNonTunai($id){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Detail Data ";
            $pageInfo['dataDetail'] = $this->pm->getTaskInfo($id);
            $pageInfo['paramDetail'] = $this->param->getTaskInfo($pageInfo['dataDetail']->paramId);
            // debug($pageInfo); exit;
            $this->loadViews2("transaksi/detailNonTunai", $this->global, $pageInfo , NULL,'transaksi/detailNonTunai');    
        }
    }
    
    function scanEvent(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Detail Data ";
            $pageInfo['dataDetail'] = $this->pm->getTaskInfo(315);
            $pageInfo['paramDetail'] = $this->param->getTaskInfo($pageInfo['dataDetail']->paramId);
            // debug($pageInfo); exit;
            $this->loadViews2("transaksi/scanEvent", $this->global, $pageInfo , NULL,'transaksi/detailNonTunai');    
        }
    }

    public function getData() {
        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getRows($postData);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->pm->getTaskInfo($id);
        echo json_encode($data);
    }

    public function getMonthTransaction() {
        $postData = $this->input->post();
        // debug($this->input->post());exit;
        $data = $this->pm->getMonthTransaction($postData);
        echo json_encode($data);
    }

    public function getTotalPendapatan3Bulan() {
        $postData = $this->input->post();
        $data = $this->pm->getTotalPendapatan3Bulan($postData);
        // debug($data);
        log_message('debug', 'Data: ' . print_r($data, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function nextEvent() {
        
        $data = $this->pm->nextEvent();
        // debug($data);
        log_message('debug', 'Data: ' . print_r($data, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function todayEvent() {
        
        $data = $this->pm->todayEvent();
        // debug($data);
        log_message('debug', 'Data: ' . print_r($data, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewTask()
    {
        // debug($this->input->post());die;
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            switch($this->input->post('paramId')){
                case 4: $direct = 'zakatFitrah'; break;
                case 5: $direct = 'zakatMal'; break;
                case 7: $direct = 'infaqMasjid'; break;
                case 8: $direct = 'peduliUmat'; break;
                case 9: $direct = 'infaqJumat'; break;
                case 10: $direct = 'infaqYatim'; break;
                case 12: $direct = 'waqafHarta'; break;
                case 13: $direct = 'waqafJasa'; break;
                case 14: $direct = 'waqafAlQuran'; break;
                case 15: $direct = 'beasiswa'; break;
                case 16: $direct = 'PKBM'; break;
                default: $direct = 'loadThis';
            }
            if($this->input->post('isCash') == 0 ){ $direct = 'nonTunai'; }
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('amount','amount','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->$direct();
            }
            else
            {
                $clean_data = $this->security->xss_clean($this->input->post());
                $fileUpload = $this->doUpload('dokumen','infaqMasuk');
                // debug($clean_data); die;
                // debug($fileUpload['upload_data']);exit;
                $taskInfo = array(
                    'title'=>$clean_data['title'], 
                    'tanggal_transaksi'=>$clean_data['tanggal_transaksi'], 
                    'isCash'=>$clean_data['isCash'], 
                    'inOut'=>$clean_data['inOut'], 
                    'peopleId'=>$clean_data['peopleId'], 
                    'satuan'=>$clean_data['satuan'], 
                    'paramId'=>$clean_data['paramId'], 
                    'keterangan'=>$clean_data['keterangan'], 
                    'dokumen'=>$fileUpload['upload_data']['file_name'], 
                    'amount'=>$clean_data['amount'], 
                    'createdBy'=>$this->vendorId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
                // debug($taskInfo);die;
                $result = $this->pm->addNewTask($taskInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'Data "'.$clean_data['title'].'" Berhasil Disimpan.');
                } else {
                    $this->session->set_flashdata('error', 'Penyimpanan Data Gagal');
                }

                redirect('transaksi/'.$direct);
            }
        }
    }
    
    public function updateData() {
        $id = $this->input->post('id');
        // debug($this->input->post());
        $clean_data = $this->security->xss_clean($this->input->post());
        // debug($clean_data);exit;
        $taskInfo = array(
            'amount'=>$clean_data['amount'], 
            'tanggal_transaksi'=>$clean_data['tanggal_transaksi'], 
            'keterangan'=>$clean_data['keterangan'], 
            'updatedBy'=>$this->vendorId, 
            'updatedDtm'=>date('Y-m-d H:i:s')
        );
        $result = $this->pm->editTask($taskInfo, $id);

        if($result > 0) {
            $hasil = array("status" => TRUE);
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
        $result = $this->pm->editTask($taskInfo, $clean_data['id']);

        if($result > 0) {
            $hasil = array("status" => TRUE);
        } else {
            $hasil = array("status" => false);
        }
        echo json_encode($hasil);
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }

    
    function randomDate($start_date, $end_date) {
        $timestamp = mt_rand(strtotime($start_date), strtotime($end_date));
        return date("Y-m-d", $timestamp);
    }

    public function insertSampleTrx(){
        echo "tes <br/>";

        $start_date = '2024-06-01';
        $end_date = '2024-07-31';
        for ($no = 1; $no <= 25; $no++) {
            if ($no % 2 == 0){ //Kondisi
                $people = rand(1017,1266);
            }
            $paramId = rand(4,12);
            $taskInfo = array(
                'paramId'=>$paramId,
                'amount'=>rand(150000,2000000), 
                'tanggal_transaksi'=>$this->randomDate($start_date, $end_date),
                'keterangan'=>'sample input keterangan '.$paramId.' data ke '.$no, 
                'title'=>'sample input '.$paramId.' data ke '.$no, 
                'isCash'=>1,
                'inOut'=>'I',
                'createdBy'=>$this->vendorId, 
                'createdDtm'=>date('Y-m-d H:i:s')
            );
            
            $result = $this->pm->addNewTask($taskInfo);
            if($result > 0) { echo "proses input data ke ".$no." berhasil. <br/>"; }
        }

    }
    
}

?>