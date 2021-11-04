<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class ProjectUnits extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_project');
		$this->load->model('M_general');
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->load->library('AntiXSS');
		
    }

    public function index($index=null) {
		
		$this->VIEW_FILE = "project/list"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$jumlah_data = $this->M_project->get_total_project_limit();
		$config['base_url'] = base_url().'project/ProjectUnits/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 25;
		$from = $this->uri->segment(3)-0;
		$this->pagination->initialize($config);
		$params = array($from,$config['per_page']);
		$load_resource['idx']=$index+1;
		$load_resource['project'] = $this->M_project->get_all_project_limit($params);	
     
		
		$this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 
	
	
	 public function add() {
        $this->VIEW_FILE = "project/insert"; // dynamic
		//$load_resource['category']= $this->M_Admin->cat_slide();
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	public function add_units($unit_id=null) {
        $this->VIEW_FILE = "project/insert_units"; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['project'] = $this->M_general->get_data_by_id('st_project','id',$unit_id);
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 public function add_proccess(){
	
	$this->form_validation->set_rules('project_name', 'Project Name', 'required');	
	$this->form_validation->set_rules('project_locat', 'Location', 'required');
	$this->form_validation->set_rules('project_unit', 'Unit', 'required');
	$this->form_validation->set_rules('project_blok', 'Blok', 'required');
	
	
	
	if ($this->form_validation->run() == TRUE)	 {
		//cek data

			$params_cek = $this->input->post('project_name');
                                	    
            
			 //cek Resume in DB
			 $res = $this->M_general->is_existdata('st_project','project_name',$params_cek);
			  if (!empty($res['total'])){
				  //is resume exist
                 	echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong> ERROR <i class="glyphicon glyphicon-remove-circle"></i> </strong> Pesan : <a href="#" class="alert-link"> Data project name Sudah Ada. </a>.
					  </div>');
                    redirect('eoffice/Slider/add');	
                 }
		//if not issue form validation
		$code = rand(100,10000);
		$name = $this->input->post('project_name');

	 	$filename = $_FILES['uploadFile']['name'];
		$ext= substr(strrchr($filename, '.'), 1);
		$img_name = str_replace(' ', '_', ucwords($name));
		
		$name_file_save = $img_name."-" .$code.".".$ext;
		$name_file = $img_name."-".$code;
		
		//$file_old = './images/'.$name_file_save;
		//unlink($file_old);
		
		$config['upload_path'] = './resource/assets_eoffice/image/project';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']     = 6000;
		$config['max_width'] = 5000;
		$config['max_height'] = 5000;
		$config['file_name'] = $name_file;
		
		$this->load->library('upload',$config);
		$field_name = "uploadFile";
		
		if ($this->upload->do_upload($field_name)) {
			//if success upload
			
			$params = array(
                'project_name'      		=> $this->input->post('project_name'),
                'project_locat'				=> $this->input->post('project_locat'),
                'project_unit'       		=> $this->input->post('project_unit'),
                'project_blok'     	 		=> $this->input->post('project_blok'),
				'logo'						=>$name_file_save,
                'c_date'					=> date("Y-m-d H:i:s"),
				'u_date'					=> date("Y-m-d H:i:s"),
				'cr_user'					=> $this->session->userdata('portal')
            );
			
				//insert resume in db
			  if($this->M_general->insert("st_project", $params)){
				 //if save data resume success
				  echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" id="success_message"> Sukses <i class="glyphicon glyphicon-thumbs-up"> </i> Data Slide Berhasil Tersimpan  </div>');
	              	redirect('project/ProjectUnits/add');
				 
			  }else{
				  //iff save data resume failed
				  echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong>ERROR <i class="glyphicon glyphicon-remove-circle"></i></strong> Pesan : <a href="#" class="alert-link"> Data Gagal Tersimpan Silahkan ulangi untuk mengisi Anda. </a>.
					  </div>');
                    redirect('project/ProjectUnits/add');	  
			  }
			
		}else{
			//if upload image error
			echo $this->session->set_flashdata('message',$this->upload->display_errors());
					 redirect('project/ProjectUnits/add');		
			
		}
		
		
	}else {
		//if form validation error
		echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong>ERROR <i class="glyphicon glyphicon-remove-circle"></i></strong> Pesan : <a href="#" class="alert-link"> Data Gagal Di Simpah silahkan Ulangi. </a>.
					  </div>');
                    redirect('project/ProjectUnits/add');
		
	}
	
}
	
	
	public function update() {
       $this->VIEW_FILE = "eoffice/slider/update"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	// iki taroh di base ae
	

}