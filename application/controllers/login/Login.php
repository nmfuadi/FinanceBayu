<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php');

class LoginAdmin extends AppBase {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->VIEW_FILE = "eoffice/login/v_login"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }

    
	
	/* public function index(){

		if(!empty($this->session->userdata('username')) and $this->session->userdata('level') == 2){
			redirect('asset');
		}else {

			$this->load->view('home/v_login');
		}	
		
	}



	public function login_proccess(){

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

				if(!empty($login['cek'])){

					$data_login = $this->M_login->result_user($params);

					$sesi_login = array(
						'username' => $data_login['username'],
						'level' => $data_login['level'],
						'nama' => $data_login['login_name'],
						'photo'=> $data_login['photo'],
						'id' =>$data_login['id_user']
					);

					$this->session->set_userdata($sesi_login);

					
					redirect('home');
				}else{
					 echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  Login Gagal..!! Username dan Password tidak terdaftar
</div>');
                     redirect('login');
					//login else
				}

		}else{

			 echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  				Login Gagal..!! Username dan Password tidak Boleh Kosong
				</div>');
			  redirect('login');
			//form validation else
		}

	}

	*/
	 
	
		
	function logout(){
		$this->session->sess_destroy();

		redirect('login');
	}
    
	
	 
    }

}
	
	
	