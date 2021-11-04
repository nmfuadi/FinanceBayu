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
		$this->load->model('Jobs_update_model');
		$this->load->library("form_validation");
		$this->load->library('session');
		
		
			
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "Report/admin/profile"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['empl'] =$this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		 $load_resource['data']  = array(
            'button' => 'EDIT PROFILE',
            'action' => site_url('Report/Profile/update_action'),
			 'button_pwd' => 'CHANGE PASSWORD',
            'action_pwd' => site_url('Report/Profile/EditPassword'),
	    'id' => $load_resource['empl']['id_kry'],
		'emp_name'=>set_value('emp_name'),
		'emp_alamat'=>set_value('emp_alamat'),
	    'emp_phone' => set_value('emp_phone'),
	    'emp_email' => set_value('emp_email'),
	    'photo' => set_value('photo')
	);
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	public function update_action() 
    {
		
		$this->_rules();

        if ($this->form_validation->run() == FALSE) {
			  $this->session->set_flashdata('message', 'Field Belum Lengkap');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Profile'));
			
        } else {
			$filename = $_FILES['uploadFile']['name'];
			
			$phone = $this->input->post('emp_phone',TRUE);
			$subPhone = substr($phone,0,2);
			$subPhone2 = substr($phone,0,1);
			if ($subPhone == '08'){
				$tlp = '+62'.substr($phone,1);
			}elseif($subPhone != '08' and $subPhone2 =='8' ){
				$tlp = '+62'.$phone;
			}else {
				$tlp = $phone;
			}
			
			
			if(!empty($filename)){
						
			$bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			$code = $bk['jobs_code'];
			$doc_name= $emp['emp_name'];
									
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace(' ', '_', ucwords($doc_name));
			$t=time();
			
			$name_file_save1 = $t."-".$img_name."-" .$code.".".$ext;
			$name_file = $t."-".$img_name."-" .$code;
			
			//$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			/*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			
			*/
		if(!empty($this->input->post('pic_old',TRUE))){
			$file_old = './file/PP/'.$this->input->post('pic_old',TRUE);
			if(file_exists($file_old)){
				unlink($file_old);
			}
		}
			
		$config['upload_path'] = './file/PP';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if ($this->upload->do_upload($field_name)) {
			
			
			$data = array(
		
		'emp_name' => $this->input->post('emp_name',TRUE),
		'photo' => $name_file_save1,
		'emp_alamat'=>$this->input->post('emp_alamat',TRUE),
		'emp_phone' => $tlp,
		'emp_email' => $this->input->post('emp_email',TRUE)
	    );

            $this->Jobs_update_model->update_profile($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
			$this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('Report/Profile'));
			
			
		}
		
			}else{
				
				//only data Update
				
				$data = array(
		
					'emp_name' => $this->input->post('emp_name',TRUE),
					'emp_alamat'=>$this->input->post('emp_alamat',TRUE),
					'emp_phone' => $tlp,
					'emp_email' => $this->input->post('emp_email',TRUE)
					);

						$this->Jobs_update_model->update_profile($this->input->post('up_jobs_id', TRUE), $data);
						$this->session->set_flashdata('message', 'Update Record Success');
						$this->session->set_flashdata('status', 'alert-success');
						redirect(site_url('Report/Profile'));
				
				
			}
		
		}

        
    }
	
	
	  public function _rules() 
    {
	
	$this->form_validation->set_rules('emp_name', 'name', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	  public function _rules_pwd() 
    {
	
	$this->form_validation->set_rules('old_password', 'old_password', 'trim|required');
	$this->form_validation->set_rules('new_password', 'new_password', 'trim|required');
	$this->form_validation->set_rules('re_password', 're_password', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	
	
	public function EditPassword() {
		
	
        $this->_rules_pwd();

        if ($this->form_validation->run() == FALSE) {
            redirect(site_url('Report/Profile'));
			$this->session->set_flashdata('message', 'CHANGE PASSWORD ERROR| FORM NOT COMPLITED');
			$this->session->set_flashdata('status', 'alert-danger');
        } else {
			$old_password = md5($this->input->post('old_password',TRUE));
			$new_password = $this->input->post('new_password',TRUE);
			$re_password = $this->input->post('re_password',TRUE);
			
			$emp =$this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			
			if ($old_password ==$emp['passwords'] and $new_password == $re_password){
				
				$data = array(
		
					'passwords' => md5($this->input->post('new_password',TRUE))
					
					);

						$this->Jobs_update_model->update_passwords($this->session->userdata('u'), $data);
						$this->session->set_flashdata('message', 'Change Password Success');
						$this->session->set_flashdata('status', 'alert-success');
						redirect(site_url('Report/LoginAdmin/logout'));
			}else {
				
				
						$this->session->set_flashdata('message', 'CHANGE PASSWORD ERROR');
						$this->session->set_flashdata('status', 'alert-danger');
						redirect(site_url('Report/Profile'));
				
			}
			
		}
    }
}

