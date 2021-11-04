<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class Register extends AppBase {

    public function __construct() {
        parent::__construct();
    }


    public function index() {
        $this->VIEW_FILE = "eoffice/register/index"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }

    public function add($step = "one") {
        switch ($step) {
            case "one":
                $this->VIEW_FILE = "eoffice/register/add_one"; // dynamic
                $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
                break;
            case "two":
                $this->VIEW_FILE = "eoffice/register/add_two"; // dynamic
                $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
                break;
            case "three":
                $this->VIEW_FILE = "eoffice/register/add_three"; // dynamic
                $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
                break;
            default:
                break;
        }
    }

    public function admin() {
        $this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	 public function edit() {
        $this->VIEW_FILE = "eoffice/register/edit"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }

}
