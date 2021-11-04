<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseLoginReport.php');

class LoginAdmin extends BaseLoginReport {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		ini_set('memory_limit',-1);
		
    }

    public function index() {
        $this->VIEW_FILE = "Report/login/v_login"; // dynamic
		$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
    }
	
	
	public function LoginProccess(){

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run()==true){

				$user = $this->input->post('username');
				$pass= $this->input->post('password');

				$params = array(

					'username' => $user,
					'password' => md5($pass)
				);

				$login = $this->M_login->cek_login($params);

				if(!empty($login['username'])){
					$data_login = $this->M_login->cek_login($params);
					if($data_login['portal_id'] == $this->portal){
						
						$sesi_login = array(
						'surename' => $data_login['surename'],
						'rules' => $data_login['rules'],
						'portal' => $data_login['portal'],
						'u' => $data_login['id_user']
						
					);
					$this->session->set_userdata($sesi_login);
					
					if($data_login['rules']==4){
						
						redirect('Report/AdminVp');
					}elseif($data_login['rules']==5){
						
						redirect('Report/AdminStaff');
					}else {
						
						redirect('Report/AdminDir');
					}
					
					
						
					}else {
						
						 echo $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Anda Tidak memiliki hak Akses untuk mumat halaman ini. </div>');
                     redirect('Report/LoginAdmin');
	
					}
					
				}else{
					 echo $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Username Atau Password Anda Salah. </div>
</div>');
                     redirect('Report/LoginAdmin');
					//login else
				}

		}else{

			 echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  				Login Gagal..!! Username dan Password tidak Boleh Kosong
				</div>');
			   redirect('Report/LoginAdmin');
			//form validation else
		}

	}
	
	
	function logout(){
		$this->session->sess_destroy();

		 redirect('Report/LoginAdmin');
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


	
	
	