<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Task (TaskController)
 * Task Class to control task related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Param extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Param_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Parameter';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('param/taskListing');
    }

    function listing(){
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'Parameter';
            // debug($this->global);die;
            $pageInfo='';
            $this->loadViews2("param/index", $this->global, $pageInfo , NULL);    
        }
    }
    
    public function getData() {
        $postData = $this->input->post();
        $data = $this->pm->getRows($postData);
        // debug($data);
        log_message('debug', 'Post Data: ' . print_r($postData, true)); // Tambahkan log untuk data POST
        echo json_encode($data);
    }
    
    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'CodeInsect : Add New Task';

            $this->loadViews("param/add", $this->global, NULL, NULL);
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewTask()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','Param Title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('type','Param Type','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->add();
            }
            else
            {
                $taskTitle = $this->security->xss_clean($this->input->post('title'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $paramType = $this->security->xss_clean($this->input->post('type'));
                
                $taskInfo = array(
                    'title'=>$taskTitle, 
                    'type'=>$paramType, 
                    'description'=>$description, 
                    'createdBy'=>$this->vendorId, 
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
                
                $result = $this->pm->addNewTask($taskInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'New Task created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }
                
                redirect('param/taskListing');
            }
        }
    }

    
    /**
     * This function is used load task edit information
     * @param number $taskId : Optional : This is task id
     */
    function edit($taskId = NULL)
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($taskId == null)
            {
                redirect('param/taskListing');
            }
            
            $data['taskInfo'] = $this->pm->getTaskInfo($taskId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Task';
            
            $this->loadViews("param/edit", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editTask()
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $taskId = $this->input->post('taskId');
            
            $this->form_validation->set_rules('title','Task Title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->edit($taskId);
            }
            else
            {
                $taskTitle = $this->security->xss_clean($this->input->post('title'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $taskInfo = array(
                    'title'=>$taskTitle, 
                    'description'=>$description, 
                    'updatedBy'=>$this->vendorId, 
                    'updatedDtm'=>date('Y-m-d H:i:s')
                );
                
                $result = $this->pm->editTask($taskInfo, $taskId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Param updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Param updation failed');
                }
                
                redirect('param/taskListing');
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>