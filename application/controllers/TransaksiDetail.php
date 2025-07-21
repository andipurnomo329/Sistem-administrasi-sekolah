<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class TransaksiDetail extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_Detail_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Transaksi Detail';
        $this->global['modTitle'] = $this->module;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('people/yatim');
    }
    
    public function getData($type) {
        $postData = $this->input->post();
        $data = $this->pm->getRows($postData,$type);
        // log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getTotalAmountByHeaderId(){
        $transaksiId = $this->input->post('transaksiId');
        // debug($postData);
        $data = $this->pm->getTotalAmountByHeaderId($transaksiId);
        log_message('debug', 'Post Data: ' . print_r($data, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getEventByPerson(){
        $search = $this->input->post('search');
        $data = $this->pm->getEventByPerson($search);
        // print(count($data));
        // debug($data[0]->isSuccess);die;
        if($data){
            if($data[0]->isSuccess == 0){
                $taskInfo = array(
                    'isSuccess'=>'1', 
                    'updatedBy'=>$this->vendorId, 
                    'updatedDtm'=>date('Y-m-d H:i:s')
                );
                $result = $this->pm->editTask($taskInfo, $data[0]->id);
                $data[0]->absen = 'Absen Berhasil';
            }else{
                $data[0]->absen = 'Sudah Pernah Absen';
            }
        }else{
            $this->load->model('People_model', 'pp');
            $data = $this->pp->getPeopleByCode($search);
            if(!$data){ $data['nama'] = 'ID tidak ditemukan !!'; }
        }
        // debug($data);die;
        echo json_encode($data);
    }
    
    public function getDataDetailTansaksi() {

        $postData = $this->input->post();
        // debug($postData);
        $data = $this->pm->getRows($postData);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }

    public function getDataById() {
        $id = $this->input->post('id');
        $data = $this->pm->getTaskInfo($id);
        echo json_encode($data);
    }

    public function updateData() {
        $id = $this->input->post('id');
        // debug($this->input->post());
        $clean_data = $this->security->xss_clean($this->input->post());
        // debug($clean_data);exit;
        $taskInfo = array(
            'nik'=>$clean_data['nik'], 
            'tempat_lahir'=>$clean_data['tempat_lahir'], 
            'tanggal_lahir'=>$clean_data['tanggal_lahir'], 
            'alamat'=>$clean_data['alamat'], 
            'jenis_kelamin'=>$clean_data['jenis_kelamin'], 
            'no_telp'=>$clean_data['no_telp'], 
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

    public function flagStatusPenerimaan() {
        $id = $this->input->post('id');
        $isSuccess = $this->input->post('id');
        $clean_data = $this->security->xss_clean($this->input->post());
        $taskInfo = array(
            'isSuccess'=>$clean_data['isSuccess'], 
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

    
    /**
     * This function is used to add new user to the system
     */
    function addNewTask()
    {
        // debug($this->input->post());exit;
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('amount','amount','trim|callback_html_clean|required|max_length[256]');
            // debug($this->input->post());die;
            switch($this->input->post('isCash')){
                case 0: $direct = 'detailNonTunai'; break;
                case 1: $direct = 'detail'; break;
                default: $direct = 'loadThis';
            }
            if($this->form_validation->run() == FALSE)
            {
                $this->$direct();
            }
            else
            {
                $clean_data = $this->security->xss_clean($this->input->post());
                $fileUpload = $this->doUpload('dokumen','detailTransaksi');

                // debug($clean_data);exit;
                $taskInfo = array(
                    'title'=>$clean_data['title'], 
                    'amount'=>$clean_data['amount'], 
                    'keterangan'=>$clean_data['keterangan'], 
                    'transaksiId'=>$clean_data['transaksiId'], 
                    'poepleId'=>$clean_data['peopleId'], 
                    'isCash'=>$clean_data['isCash'], 
                    'dokumen'=>$fileUpload['upload_data']['file_name'], 
                    'createdBy'=>$this->vendorId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
                
                $result = $this->pm->addNewTask($taskInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'Data "'.$clean_data['title'].'" Berhasil ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }

                redirect('transaksi/'.$direct.'/'.$clean_data['transaksiId']);
            }
        }
    }

    public function cekHasInputPeople(){
        // debug($this->input->post());
        $clean_data = $this->security->xss_clean($this->input->post());
        $data = $this->pm->cekHasInputPeople($clean_data);
        
        echo json_encode($data);
    }

    public function addNonTunaiRegist(){
        $clean_data = $this->security->xss_clean($this->input->post());
        $sukses=[];
        $terdaftar=[];
        $selectedIds = $clean_data['selectedIds']; // Mengambil data selectedIds dari POST
        // debug($clean_data);
        
        if (!empty($selectedIds)) {
            // Lakukan proses yang diperlukan dengan $selectedIds dan $nominal
            foreach ($selectedIds as $row) {
                // Proses setiap ID dan gunakan $nominal jika diperlukan
                // debug($row['nama']);
                $post['poepleId'] = $row['id'];
                $post['transaksiId'] = $clean_data['transaksiId'];
                $cekHasInput = $this->pm->cekHasInputPeople($post);
                // debug($cekHasInput);
                if(!$cekHasInput){
                    $taskInfo = array(
                        'title'=>$row['nama'], 
                        'amount'=>$clean_data['amount'], 
                        'transaksiId'=>$clean_data['transaksiId'], 
                        'poepleId'=> $row['id'], 
                        'isCash'=>$clean_data['isCash'], 
                        'createdBy'=>$this->vendorId, 
                        'createdDtm'=>date('Y-m-d H:i:s')
                    );
                    $sukses[$row['id']] = $this->pm->addNewTask($taskInfo);
                }else{
                    $terdaftar[$row['id']] = $cekHasInput;
                }
            }
            // debug($result);
            // debug($this->input->post());exit;
            $data['berhasilInput'] = $sukses;
            $data['sudahTerdaftar'] = $terdaftar;
            $data['status'] = 'sukses';

            echo json_encode($data);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang dipilih']);
        }
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
        for ($no = 1; $no <= 5; $no++) {
            if ($no % 2 == 0){ //Kondisi
                $people = rand(1017,1266);
            }
            // $paramId = rand(4,12);
            $paramId = 10;
            $taskInfo = array(
                'transaksiId'=>rand(304,308),
                'peopleId'=>$people,
                'amount'=>rand(150000,2000000), 
                'tanggal_transaksi'=>$this->randomDate($start_date, $end_date),
                'keterangan'=>'sample input keterangan '.$paramId.' data ke '.$no, 
                'title'=>'sample input '.$paramId.' data ke '.$no, 
                'isCash'=>1,
                'inOut'=>'0',
                'createdBy'=>$this->vendorId, 
                'createdDtm'=>date('Y-m-d H:i:s')
            );
            
            $result = $this->pm->addNewTask($taskInfo);
            if($result > 0) { echo "proses input data ke ".$no." berhasil. <br/>"; }
        }

    }
}

?>