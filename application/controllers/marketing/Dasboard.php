<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseMarketing.php');

class Dasboard extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->cek_absen(); 
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		ini_set('memory_limit',-1);
		
    }
	

    public function index() {
        $this->VIEW_FILE = "marketing/dasboard"; // dynamic
		$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix	
    }
	
	
	
    
	
	/* public function index(){

		if(!empty($this->session->userdata('username')) and $this->session->userdata('level') == 2){
			redirect('asset');
		}else {

			$this->load->view('home/v_login');
		}	
		
	}



	

	function logout(){
		$this->session->sess_destroy();

		redirect('login');
	}
	*/
	
	
	

    
	
	 
    }


	
	
	