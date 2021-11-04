<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class Slider extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->load->library('AntiXSS');
		
    }

    public function index() {
		
        $this->VIEW_FILE = "eoffice/slider/insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		//$load_resource['CONTOH'] = 'Namaku Fuad';
		// variablemu -> iki sing di bawa ke view?
		$load_resource['category']= $this->M_Admin->cat_slide();
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 public function add() {
        $this->VIEW_FILE = "eoffice/slider/insert"; // dynamic
		$load_resource['category']= $this->M_Admin->cat_slide();
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	 public function add_proccess(){
	
	$hasil = $this->input->post('title');
	echo $hasil;
	exit();
	
	$this->form_validation->set_rules('cat_id', 'Category', 'required');
	
	
	if ($this->form_validation->run() == TRUE)	  {
		//if not issue form validation
		$code = rand(100,10000);
		$name = $this->input->post('title');

	 	$filename = $_FILES['uploadFile']['name'];
		$ext= substr(strrchr($filename, '.'), 1);
		$img_name = str_replace(' ', '_', ucwords($name));
		
		$name_file_save = $img_name."-" .$code.".".$ext;
		$name_file = $img_name."-".$code;
		
		//$file_old = './images/'.$name_file_save;
		//unlink($file_old);
		
		$config['upload_path'] = './resource/assets_eoffice/image/slider';
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
                
               
                'cat_id'      		=> $this->input->post('cat_id'),
                'title'				=> $this->input->post('title'),
                'desction'       	=> $this->input->post('desction'),
                'file'     	 		=> $name_file_save,
				'cu'				=>$this->session->userdata('portal'),
                'cd'				=> date("Y-m-d H:i:s")
                

            );

             $params_cek = array (
				'cat_id'          => $this->input->post('cat_id') ,
                 'title'        => $this->input->post('title')
               	    
             );
			 //cek Resume in DB
			 $res = $this->M_Admin->cek_slide($params_cek);
			  if (!empty($res['cek'])){
				  //is resume exist
                 	echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong> ERROR <i class="glyphicon glyphicon-remove-circle"></i> </strong> Pesan : <a href="#" class="alert-link"> Data Title Sudah Tersedia. </a>.
					  </div>');
                    redirect('eoffice/Slider/add');	
                 }
				//insert resume in db
			  if($this->M_Admin->insert_slider($params)){
				 //if save data resume success
				  echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" id="success_message"> Sukses <i class="glyphicon glyphicon-thumbs-up"> </i> Data Slide Berhasil Tersimpan  </div>');
	              	redirect('eoffice/Slider');
				 
			  }else{
				  //iff save data resume failed
				  echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong>ERROR <i class="glyphicon glyphicon-remove-circle"></i></strong> Pesan : <a href="#" class="alert-link"> Data Gagal Tersimpan Silahkan ulangi untuk mengisi Anda. </a>.
					  </div>');
                    redirect('eoffice/Slider/add');	  
			  }
			
		}else{
			//if upload image error
			echo $this->session->set_flashdata('message',$this->upload->display_errors());
					 redirect('recruitment/add_resume');		
			
		}
		
		
	}else {
		//if form validation error
		echo $this->session->set_flashdata('message', ' <div class="alert alert-danger">
					    <strong>ERROR <i class="glyphicon glyphicon-remove-circle"></i></strong> Pesan : <a href="#" class="alert-link"> Data Gagal Di Simpah silahkan Ulangi. </a>.
					  </div>');
                    redirect('recruitment/add_resume');
		
	}
	
}
	
	
	public function update() {
       $this->VIEW_FILE = "eoffice/slider/update"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	// iki taroh di base ae
	

}