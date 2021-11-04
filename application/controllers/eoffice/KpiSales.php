<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class KpiSales extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('M_KpiSales');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
    }

    public function index() {

    		  $this->VIEW_FILE = "eoffice/KpiSales/ListKpi"; // dynamic
         $load_resource = $this->load_resource(); 
       

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'eoffice/KpiSales/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'eoffice/KpiSales/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'eoffice/KpiSales/index.html';
            $config['first_url'] = base_url() . 'eoffice/KpiSales/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_KpiSales->total_rows($q);
        $settkpi = $this->M_KpiSales->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'settkpi_data' => $settkpi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

         $this->load->view($this->MAIN_VIEW, $load_resource); // fix

		}

	public function InsertAcvity($id){
		$this->VIEW_FILE = "eoffice/KpiSales/FormKpi"; // dynamic
         $load_resource = $this->load_resource(); 
         $load_resource['setKpi'] = $this->M_KpiSales->get_by_id($id);
          $load_resource['sales'] = $this->M_KpiSales->get_data_marketing();

         $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('eoffice/KpiSales/InsertAction'),
	    'id' => set_value('id'),
	    'kpi_name' => set_value('kpi_name'),
	    'kpi_value' => set_value('kpi_value'),
	    'kry_id' => set_value('kry_id'),
	    'kpiDate' => set_value('kpiDate'),
	    'value' => set_value('value'),
	    'otherText1' => set_value('otherText1'),


	  //  'dt_cr' => set_value('dt_cr'),
	   // 'u_dt' => set_value('u_dt'),
	);
        $this->load->view($this->MAIN_VIEW, $load_resource); 
       // $this->load->view('eoffice/settkpi/st_kpi_sett_form', $data);


	}

	public function InsertAction(){

		$this->_rules();
        $datetime = date("Y-m-d H:i:s");

        if ($this->form_validation->run() == FALSE) {	
             $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('eoffice/KpiSales/InsertAcvity/'.$this->input->post('sett_id',TRUE)));
        } else {
            $data = array(
				'sett_id' => $this->input->post('sett_id',TRUE),
				'kry_id' => $this->input->post('kry_id',TRUE),
				'kpiDate' => $this->input->post('kpiDate',TRUE),
				'value' => $this->input->post('value',TRUE),
				'otherText1' => $this->input->post('otherText1',TRUE),
				'kpiDate' => $this->input->post('kpiDate',TRUE),
				'dt_cr' => $datetime,
				'u_dt' => $this->session->userdata('u'),
			);

            $this->M_KpiSales->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('eoffice/KpiSales/InsertAcvity/'.$this->input->post('sett_id',TRUE)));
        }


	}


	public function _rules() 
    {
	$this->form_validation->set_rules('kpiDate', 'Tanggal Input', 'trim|required');
	$this->form_validation->set_rules('kry_id', 'Nama Karyawan', 'trim|required|numeric');
	$this->form_validation->set_rules('value', 'Pencapaian', 'trim|required');
	$this->form_validation->set_rules('otherText1', 'Keterangan', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

	public function Pencapaian(){
		 $this->VIEW_FILE = "eoffice/KpiSales/ListPencapaian"; // dynamic
         $load_resource = $this->load_resource();

         $st = $this->input->post('start',TRUE);
         $fn = $this->input->post('finish',TRUE);

         if (empty($st) or empty($fn)){

         	$start =date("Y-m-01");
         	$finish=date("Y-m-31");
         }else {

         	$start =$st;
         	$finish=$fn;
         }

         $load_resource['data'] = array(
            'button' => 'Create',
            'actionDetail' => site_url('eoffice/KpiSales/PencapaianDetail'),
            'actionSearch' => site_url('eoffice/KpiSales/Pencapaian'),
            'start'=>$start,
            'finish'=>$finish,

        );

         

         

         $load_resource['penc']=$this->M_KpiSales->get_kpi(array( $start,$finish));


          $this->load->view($this->MAIN_VIEW, $load_resource); 


	}


	public function PencapaianDetail($kry_id=null,$st=null,$fn=null){
		 $this->VIEW_FILE = "eoffice/KpiSales/ListPencapaianDet"; // dynamic
         $load_resource = $this->load_resource();

        
         if (empty($st) or empty($fn)){

         	$start =date("Y-m-01");
         	$finish=date("Y-m-31");
         }else {

         	$start =$st;
         	$finish=$fn;
         }

         $load_resource['penc']=$this->M_KpiSales->get_kpi_kry_id(array( $start,$finish,$kry_id));


          $this->load->view($this->MAIN_VIEW, $load_resource); 


	}

	public function AddSettProccess(){


	}


	public function UpdateSett(){


	}

	



	}