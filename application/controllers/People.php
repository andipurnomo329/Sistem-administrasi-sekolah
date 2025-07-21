<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class People extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('People_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'People';
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
    
    function jemaah(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Jema'ah";
            $pageInfo='';
            $this->loadViews2("people/index", $this->global, $pageInfo , NULL, 'people/pengurus');    
        }
    }
    
    function pengurus(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Pengurus";
            // debug($this->global);die;
            $pageInfo='';
            $this->loadViews2("people/pengurus", $this->global, $pageInfo , NULL, 'people/pengurus');    
        }
    }
    
    function detailPeople($id){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Detail Data";

            // debug($this->global);die;
            $pageInfo['people']= $this->pm->getTaskInfo($id);
            // debug($pageInfo); die;

            $this->loadViews2("people/peopleDetail", $this->global, $pageInfo , NULL, null);    
        }
    }
    
    function yatim(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = "Yatim";
            // debug($this->global);die;
            $pageInfo='';
            $this->loadViews2("people/yatim", $this->global, $pageInfo , NULL, 'people/pengurus');    
        }
    }
    
    public function getData() {
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
    
    /**
     * This function is used to add new user to the system
     */
    function addNewTask()
    {
        // debug($this->input->post());
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($this->input->post('type') == 3){
                $direct = 'pengurus';
            }elseif($this->input->post('type') == 2){
                $direct = 'jemaah';
            }else{
                $direct = 'yatim';
            }

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('nama','nama','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('jenis_kelamin','jenis_kelamin','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('tempat_lahir','tempat_lahir','trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('alamat','alamat','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->$direct();
            }
            else
            {
                $clean_data = $this->security->xss_clean($this->input->post());
                $fileUpload = $this->doUpload('foto','foto');

                // debug($fileUpload);exit;
                $taskInfo = array(
                    'nama'=>$clean_data['nama'], 
                    'type'=>$clean_data['type'], 
                    'subType'=>$clean_data['subType'], 
                    'nik'=>$clean_data['nik'], 
                    'pekerjaan'=>$clean_data['pekerjaan'], 
                    'tempat_lahir'=>$clean_data['tempat_lahir'], 
                    'tanggal_lahir'=>$clean_data['tanggal_lahir'], 
                    'alamat'=>$clean_data['alamat'], 
                    'foto'=>$fileUpload['upload_data']['file_name'], 
                    'jenis_kelamin'=>$clean_data['jenis_kelamin'], 
                    'no_telp'=>$clean_data['no_telp'], 
                    'createdBy'=>$this->vendorId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
                $result = $this->pm->addNewTask($taskInfo);
                $peopleCode = $clean_data['type'].$clean_data['subType'].substr('00000'.$result, -5);
                
                $updateTask = array(
                    'peopleCode'=>$peopleCode
                );
                $update = $this->pm->editTask($updateTask, $result);
                // debug($peopleCode);exit;

                if($result > 0) {
                    $this->session->set_flashdata('success', 'Data '.$clean_data['nama'].' created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }

                redirect('people/'.$direct);
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }   
}

?>