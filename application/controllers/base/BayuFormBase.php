<?php

class AppBase extends CI_Controller {

    protected $MAIN_VIEW = "bayu/base/main";
    protected $BASEPATH;
    protected $VIEW_FILE;
    private $javascript = "";
    private $js_bottom = "";
    private $style = "";
	private $sidebar = "";
	protected $portal =2;

    public function __construct() {
        parent::__construct();
        $this->load_config();
    }
	
	
    // load config
    protected function load_config() {
        //require FCPATH . 'vendor/autoload.php';
        $this->BASEPATH = base_url() . "resource/style_bayu/";
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
		//$data['content_sidebar'] = $this->load_sidebar();
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
	
	
	/*public function load_sidebar(){
		$html = '';
		$data = $this->M_Admin->menu(0);
		foreach($data as $menu){
		$html .='<li>';
		$html .='<a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> '.$menu['menu_name'].' <span class="label label-rounded label-info pull-right">3</span></span></a>';
		$html .='<ul aria-expanded="false" class="collapse">';
		$data_sub = $this->M_Admin->menu($menu['menu_id']);
			foreach($data_sub as $sub){
				$html .='<li> <a href="'.base_url().$sub['url'].'">'.$sub['menu_name'].'</a> </li>';	
			}
		$html .='</ul>';
		$html .= '</li>';
		
		}
		
		
		return $html;
		//$this->load->view('eoffice/register/sidebar',$html);
	} */
	

	
	
	// di load di sidebar
	
	
	
	
	

}
