<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller {
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $isAdmin = 0;
	protected $accessInfo = [];
	protected $global = array ();
	protected $lastLogin = '';
	protected $module = '';

	/**
	 * This is default constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			$this->isAdmin = $this->session->userdata ( 'isAdmin' );
			$this->accessInfo = $this->session->userdata ( 'accessInfo' );
			$this->menuList = $this->session->userdata ( 'menuList' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
			$this->global ['last_login'] = $this->lastLogin;
			$this->global ['is_admin'] = $this->isAdmin;
			$this->global ['access_info'] = $this->accessInfo;
			$this->global ['menuList'] = $this->menuList;
			// debug($this->global);exit;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	function isAdmin() {
		if ($this->isAdmin == SYSTEM_ADMIN) {
			return true;
		} else {
			return false;
		}
	}

	private function checkUrlInArray($array, $urlToCheck)
	{
		foreach ($array as $item) {
			// Cek jika item memiliki URL yang sesuai dengan urlToCheck
			if (isset($item->url) && $item->url === $urlToCheck) {
				return true;
			}

			// Jika item memiliki children, cek rekursif di dalam children
			if (isset($item->children) && is_array($item->children)) {
				if ($this->checkUrlInArray($item->children, $urlToCheck)) {
					return true;
				}
			}
		}
		return false;
	}
	/**
	 * This function is used to check the user having list access or not
	 */
	protected function hasListAccess() {
		$relative_url = str_replace(base_url(), '', current_url());
		$cek = $this->checkUrlInArray($this->menuList,$relative_url);

		if ($this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo) 
			&& ($this->accessInfo[$this->module]['list'] == 1 
			|| $this->accessInfo[$this->module]['total_access'] == 1))
			|| $cek
		){
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having create access or not
	 */
	protected function hasCreateAccess() {
		if ($this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo) 
			&& ($this->accessInfo[$this->module]['create_records'] == 1 
			|| $this->accessInfo[$this->module]['total_access'] == 1)))
		{
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having update access or not
	 */
	protected function hasUpdateAccess() {
		if ($this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo) 
			&& ($this->accessInfo[$this->module]['edit_records'] == 1 
			|| $this->accessInfo[$this->module]['total_access'] == 1)))
		{
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having delete access or not
	 */
	protected function hasDeleteAccess() {
		if ($this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo) 
			&& ($this->accessInfo[$this->module]['delete_records'] == 1 
			|| $this->accessInfo[$this->module]['total_access'] == 1)))
		{
			return true;
		}
		return false;
	}

	/**
	 * This function is used to load the set of views
	 */
	function loadThis() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		
		$this->load->view ( 'includes/header', $this->global );
		$this->load->view ( 'general/access' );
		$this->load->view ( 'includes/footer' );
	}
	
	/**
	 * This function is used to logged out user from system
	 */
	function logout() {
		$this->session->sess_destroy ();
		redirect ( 'login' );
	}
	
    function loadViews2($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL, $modalInfo = NULL){
		// pre($this->global); die;
        $this->load->view('includes/headersb', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footersb', $footerInfo);
		if($modalInfo){
			$this->load->view('modal/'.$modalInfo);
		}
        
    }
	function doUpload($name,$folder){
		$config['upload_path']          = './files/'.$folder;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($name)){
			$data = array('error' => $this->upload->display_errors());
		}else{
			$data = array('upload_data' => $this->upload->data());
		}
		return $data;
	}
	
}