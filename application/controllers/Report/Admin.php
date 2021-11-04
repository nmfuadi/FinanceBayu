<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class Admin extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "Report/admin/admin"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
					
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 public function Menu() {
        $this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	
	public function coba() {
        //$this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        //$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	public function edit_profile(){
		
		$this->VIEW_FILE = "Report/Staff/profile"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));	
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
		
	}
	
	
	
	// iki taroh di base ae
	

}
