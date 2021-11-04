<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class Admin extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "eoffice/admin/admin"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['all'] = $this->M_Admin->customer_count_all();	
		$load_resource['pr'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='HOT PROSPECT'");
		$load_resource['bk'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='BOOKING' OR cust_stat = 'PEMBERKASAN'");
		$load_resource['ak'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='AKAD KREDIT'");
		
			$data_tahun =  $this->M_Admin->pertahun_bulan();
		
		$html = " Morris.Area({
					element: 'morris-area-chart',
					data: [";
		$xkey = "[";
		$labels = "[";
		$warna = "[";
		foreach ($data_tahun as $bulan){
				$data_pertahun = $this->M_Admin->pertahun_count($bulan['bulan']);
				$html .= "{ 
							period: '".$bulan['bulan']."',
							";
			foreach($data_pertahun as $chart1){
				$str = str_replace(" ","",$chart1['cust_stat']);
				$html .= $str.": ".$chart1['jml'].",";
				
				$cl = dechex(crc32($chart1['cust_stat']));
				$clour = substr($cl, 0, 6);
				$pointSize = count($chart1['cust_stat']);	
				$xkey .="'".$str."',";	
				$labels .="'".$chart1['cust_stat']."',";
				$warna .= "'#".$clour."',";
				  
				
			
			}
			
			
			$html .="},";
		}
		
		
		$xkey .= "],";
		$labels .= "],";
		$warna .="],";
		$html .="],
				xkey: 'period',
				ykeys: ".$xkey."
				labels: ".$labels."
				pointSize: ".$pointSize.",
				fillOpacity: 0,
				pointStrokeColors: ".$warna."
				behaveLikeLine: true,
				gridLineColor: '#e0e0e0',
				parseTime: false,
				lineWidth: 1,
				hideHover: 'auto',
				lineColors: ".$warna."
				resize: true

			});";
			
			$load_resource['activity'] = $this->M_Admin->aktivitas_sales();
			$load_resource['chart_garis'] = $html;
			$load_resource['colour'] = $data_pertahun; 
			
			
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 public function Menu() {
        $this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	
	public function coba() {
        //$this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        //$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	
	
	// iki taroh di base ae
	

}
