<?php

class AppBase extends CI_Controller {

    protected $MAIN_VIEW = "marketing/base/main";
    protected $BASEPATH;
    protected $VIEW_FILE;
    private $javascript = "";
    private $js_bottom = "";
    private $style = "";
	private $sidebar = "";
	private $portal = 2;
	

    public function __construct() {
        parent::__construct();
        $this->load_config();
		$this->cek_login();
		
		
			
		
    }
	
	protected function cek_login(){
		if(empty($this->session->userdata('surename')) or $this->session->userdata('portal') != $this->portal){
			// echo $this->session->set_flashdata('data', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			//$this->session->set_flashdata('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			redirect('marketing/MarketingLogin');
		}
		
		
	}
	
	
	
    // load config
    protected function load_config() {
        //require FCPATH . 'vendor/autoload.php';
        $this->BASEPATH = base_url() . "resource/marketing_page/";
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
		$data['content_menu'] = $this->load_menu();
		$data['ms']=$this->marketing_data();
		$data['count_cust']=$this->cust_count();
        return $data;
    }
	
	
	protected function cek_absen(){
		$this->load->model('M_Admin');
		 $sales = $this->M_Admin->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
		$dat = array($sales['id'],date("Y-m-d"));
		$res = $this->M_Admin->cek_absen($dat);
		if($res['total']<=0){
			
			redirect('marketing/Absensi');
			
		}
	}
	
	
	
	
	protected function marketing_data(){
		$this->load->model('M_Admin');
		 $ms = $this->M_Admin->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
		
		
		if(!empty($ms)){
			
			return $ms;
		}
	}
	
	
	 function cust_count(){
		$this->load->model('M_Admin'
		);
		$ms = $this->M_Admin->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
		$count = $this->M_Admin->customer_count($ms['id']);
		$html = '';
		foreach($count as $count_data){
		$html .='<button type="button" class="btn btn-danger">'.$count_data['cust_stat'].' <span class="badge">'.$count_data['jumlah'].'</span></button>';
			
		}
		//$html .='';
		return $html;
		
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
		foreach($data as $menu){
		$html .='<li>';
		$html .='<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> '.$menu['menu_name'].'</a>';
		$html .='<ul aria-expanded="false" class="collapse">';
		$params_sub =array(
			$this->session->userdata('rules'),$menu['menu_id']
		);
		$data_sub = $this->M_Admin->menu($params_sub);
			foreach($data_sub as $sub){
				$html .='<li> <a href="'.base_url().$sub['url'].'">'.$sub['menu_name'].'</a> </li>';	
			}
		$html .='</ul>';
		$html .= '</li>';
		
		}
		
		
		return $html;
		//$this->load->view('eoffice/register/sidebar',$html);
	}
	
	
	public function load_menu(){
		
		$this->load->model('M_Admin');
		$html = '';
		$params_nol = array(
		$this->session->userdata('rules'),0
		);
		$data = $this->M_Admin->menu($params_nol);
		foreach($data as $menu){
			$html .='<li><a class=" link link--yaku" href="'.base_url().$menu['url'].'"><span>'.$menu['menu_name'].'</span></li>';
			
		}
		
		return $html;
		
	}

	
	
	// di load di sidebar
	
	
	
	
	

}
