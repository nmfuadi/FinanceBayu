<?php

class AppBase extends CI_Controller {

    protected $MAIN_VIEW = "Report/base/main";
    protected $BASEPATH;
    protected $VIEW_FILE;
    private $javascript = "";
    private $js_bottom = "";
    private $style = "";
	private $sidebar = "";
	private $portal = 1;
	

    public function __construct() {
        parent::__construct();
        $this->load_config();
		$this->cek_login();
		
			
		
    }
	
	protected function cek_login(){
		if(empty($this->session->userdata('surename')) or $this->session->userdata('portal') != $this->portal){
			// echo $this->session->set_flashdata('data', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			//$this->session->set_flashdata('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			redirect('Report/LoginAdmin');
		}
	}
	
    // load config
    protected function load_config() {
        //require FCPATH . 'vendor/autoload.php';
        $this->BASEPATH = base_url() . "resource/assets_eoffice/";
    }
	
	
    protected function load_resourceload_resource() {
        $data['LOAD_JAVASCRIPT'] = $this->javascript;
        $data['LOAD_BOTTOM_JS'] = $this->js_bottom;
        $data['LOAD_STYLE'] = $this->style;
        $data['path'] = $this->BASEPATH;
        $data['view_file'] = $this->VIEW_FILE;
        return $data;
    }

    protected function load_javascript($path) {
        if (is_file($path)) {
            $this->javascript .= '<script type="text/javascript" src="' . base_url() . $path . '"></script>';
            $this->javascript .= "\n";
        } else {
            $msg = "File berikut ini tidak ditemukan : " . base_url() . $path;
            show_error($msg, 404);
        }
    }
	
	protected function load_resource() {
        $data['LOAD_JAVASCRIPT'] = $this->javascript;
        $data['LOAD_BOTTOM_JS'] = $this->js_bottom;
        $data['LOAD_STYLE'] = $this->style;
        $data['path'] = $this->BASEPATH;
        $data['view_file'] = $this->VIEW_FILE;
		$data['ms']=$this->employe_data();
		$data['dp']=$this->dep_data();
		$data['content_sidebar'] = $this->load_sidebar();
        return $data;
    }

    protected function load_bottom_js($path) {
        if (is_file($path)) {
            $this->js_bottom .= '<script type="text/javascript" src="' . base_url() . $path . '"></script>';
            $this->js_bottom .= "\n";
        } else {
            $msg = "File berikut ini tidak ditemukan : " . base_url() . $path;
            show_error($msg, 404);
        }
    }
	
	protected function employe_data(){
		$this->load->model('M_Admin');
		 $ms = $this->M_Admin->get_data_by_id('jr_employe','user_id',$this->session->userdata('u'));
		
		
		if(!empty($ms)){
			
			return $ms;
		}
	}
	
	
	protected function dep_data(){
		$this->load->model('M_Admin');
		$em = $this->employe_data();
		 $dp = $this->M_Admin->get_data_by_id('jr_departement','id',$em['dptmn_id']);
		
		
		if(!empty($dp)){
			
			return $dp;
		}
	}

    protected function load_style($css_file, $media = "all") {
        // assign
        if (is_file($css_file)) {
            $this->style .= '<link rel="stylesheet" type="text/css" href="' . base_url() . $css_file . '" media="' . $media . '" />';
            $this->style .= "\n";
        } else {
            $msg = "File berikut ini tidak ditemukan : " . base_url() . $css_file;
            show_error($msg, 404);
        }
    }
	
	
	public function load_sidebar(){
		$this->load->model('M_Admin');
		$html = '';
		$params_nol = array(
		$this->session->userdata('rules'),0
		);
		$data = $this->M_Admin->menu($params_nol);
		if(!empty($data)){
			
			foreach($data as $menu){
		$html .='<li>';
		$html .='<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> '.$menu['menu_name'].'</a>';
		$html .='<ul aria-expanded="false" class="collapse">';
		$params_sub =array(
			$this->session->userdata('rules'),$menu['menu_id']
		);
		$data_sub = $this->M_Admin->menu($params_sub);
			if(!empty($data_sub)){
				foreach($data_sub as $sub){
				$html .='<li> <a href="'.base_url().$sub['url'].'">'.$sub['menu_name'].'</a> </li>';	
			}
			}
			
		$html .='</ul>';
		$html .= '</li>';
		
		}
		}
		
		
		if( $html!=null){
			return $html;
		}
		
		//$this->load->view('eoffice/register/sidebar',$html);
	}
	

	
	
	// di load di sidebar
	
	
	
	
	

}
