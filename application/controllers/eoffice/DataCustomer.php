<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class DataCustomer extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "eoffice/admin/VDataCustomer"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['all'] = $this->M_Admin->customer_count_all();	
		$load_resource['pr'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='HOT PROSPECT'");
		$load_resource['bk'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='BOOKING' OR cust_stat = 'PEMBERKASAN'");
		$load_resource['ak'] = $this->M_Admin->customer_count_all("WHERE cust_stat ='AKAD KREDIT'");
		$custBysource = $this->M_Admin->data_customerBysource_chart();
				
		$source ="
			 Morris.Bar({
			element: 'graph',
			barGap:10,
			barSizeRatio:0.55,
			 data: [
		";
			$clo = "[";
		
		foreach ($custBysource as $src){
			$source .= "{x:'".$src['name_sc']."',y:".$src['data_from']."},";	
			
			$wa = dechex(crc32($src['name_sc']));
			$cl = substr($wa, 0, 6);
			
			$clo .="'#".$cl."',";
			
		}
		
		$clo .= "]";
		
		$source .="],
		  xkey: 'x',
		  ykeys: ['y'],
		  labels: ['Y'],
		  barColors: ".$clo.",
		parseTime: false,
        hideHover: 'auto',
        gridLineColor: '#e0e0e0',
        resize: true
    });";
	
					
		$data_tahun =  $this->M_Admin->pertahun_bulan();
		//$lbl = array ('AKAD KREDIT','PEMBERKASAN','BOOKING','HOT PROSPEK','FOLLOWUP','NEW');
		
		
		
		
		
		$html = " Morris.Area({
					element: 'morris-area-chart',
					data: [";
		
		
		$warna = "[";
		foreach ($data_tahun as $bulan){
				$data_pertahun = $this->M_Admin->pertahun_count($bulan['bulan']);
				$html .= "{ 
							period: '".$bulan['bulan']."',
							";
			foreach($data_pertahun as $chart1){
				$str = str_replace(" ","",$chart1['cust_stat']);
				
				$html .= $str.": ".$chart1['jml'].",";
				
				
				  
			}
			
			
			$html .="},";
		}
		
		$ky = array ('AKADKREDIT','PEMBERKASAN','BOOKING','HOTPROSPECT','FOLLOWUP','NEW');
		$pointSize  = count($ky);
		 $i= 0;
		for ($i=0;$i<=5;$i++){
			
			$cl = dechex(crc32($ky[$i]));
				$clour = substr($cl, 5, 6);			
				$warna .= "'#".$clour."',";
			
		}
		
		
		$warna .="],";
		$html .="],
				xkey: 'period',
				ykeys: ['AKADKREDIT','PEMBERKASAN','BOOKING','HOTPROSPECT','FOLLOWUP','NEW'],
				labels: ['AKAD KREDIT','PEMBERKASAN','BOOKING','HOT PROSPECT','FOLLOWUP','NEW'],
				pointSize: ".$pointSize.",
				fillOpacity: 0,
				pointStrokeColors: ".$warna."
				behaveLikeLine: true,
				parseTime: false,
				gridLineColor: '#e0e0e0',
				lineWidth: 1,
				hideHover: 'auto',
				lineColors: ".$warna."
				resize: true

			});";
			
			
			
			
			
			
			
			//Chart Data Customer By source per tahun
			
			$custSource = " Morris.Area({
					element: 'custSource',
					data: [";
		
		
		$warna = "[";
		foreach ($data_tahun as $bulan){
				$data_pertahun = $this->M_Admin->data_customerBysourcePertahun_chart($bulan['bulan']);
				$custSource .= "{ 
							period: '".$bulan['bulan']."',
							";
			foreach($data_pertahun as $chart2){
				$str = str_replace(" ","",$chart2['name_sc']);
				$custSource .= $str.": ".$chart2['data_from'].",";
				
		  
			}
			
			
			$custSource .="},";
		}
		
		
		$ky = $this->M_Admin->source_data();
		$pointSize  = count($ky);
		 $i= 0;
		 $ykey = "[";
		 $label =  "[";
		foreach ($ky as $y){
			
			$cl = dechex(crc32($y['name_sc']));
				$clour = substr($cl, 5, 6);			
				$warna .= "'#".$clour."',";
				$st = str_replace(" ","",$y['name_sc']);
				$ykey .="'".$st."',";
				$label .="'".$y['name_sc']."',";
		}
		
		$ykey .= "]";
		$label .= "]";
		
		$warna .="],";
		$custSource .="],
				xkey: 'period',
				ykeys: ".$ykey.",
				labels: ".$label.",
				pointSize: ".$pointSize.",
				fillOpacity: 0,
				pointStrokeColors: ".$warna."
				behaveLikeLine: true,
				parseTime: false,
				gridLineColor: '#e0e0e0',
				lineWidth: 1,
				hideHover: 'auto',
				lineColors: ".$warna."
				resize: true

			});";
			
			
			
			$donatConv =  $this->M_Admin->data_Konversicustomer_chart();
			$sumDonatConv = $this->M_Admin->sum_Konversicustomer_chart();
			
	$konvAll = "
				  Morris.Donut({
				  element: 'donut',
				  data: [";
			foreach ($donatConv as $donat){
				$donat_sum = $sumDonatConv['total_book'];
				$hasil = number_format($donat['bookSum']*100/$donat_sum);
				$konvAll .=	"{value: ".$hasil.", label: '".$donat['nama_source']."'},";
				
			}
				  
	$konvAll .=		
				"			
				  ],
				  formatter: function (x) { return x + '%'}
				}).on('click', function(i, row){
				  console.log(i, row);
				});

				   
				});
			";		
			
			
			
			
			$load_resource['activity'] = $this->M_Admin->aktivitas_sales();
			$load_resource['chart_garis'] = $html;
			$load_resource['source'] = $source;
			$load_resource['scr'] = $ky;
			$load_resource['konvAll'] = $konvAll;
			$load_resource['custSource'] = $custSource;
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
