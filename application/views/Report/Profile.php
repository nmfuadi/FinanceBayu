<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class Profile extends AppBase {
	protected $rules = 4;
	 

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('JobsModel');
      	$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
		
			$user_id = $this->session->userdata('u');
			$session_rules = $this->session->userdata('rules');
		if($session_rules!=$this->rules){
				if($session_rules==5){
						
						redirect('Report/AdminStaff');
					}
			
		}
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "Report/admin/profile"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['empl'] =$this->M_Admin->get_employe_by_id($this->session->userdata('u'))
			
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function EditPassword() {
		
	
        $this->VIEW_FILE = "Report/Vp/VextData"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['ext'] = 'from';
		$load_resource['judul'] = 'MY REQUEST TASK LIST TO OTHER DEPARTMENTS';
		$load_resource['jobs'] = $this->M_Admin->get_jobs_by_user_id_ext_from($this->session->userdata('u'));
		$load_resource['tot'] = $this->M_Admin->get_jobs_by_user_id_ext_to_total($this->session->userdata('u'));		
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
}

