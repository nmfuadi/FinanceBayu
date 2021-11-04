<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseMarketing.php');
class Absensi extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->library('pagination');
		$this->load->library('session');
		ini_set('memory_limit',-1);
		
    }


 public function index()
    {
		$this->VIEW_FILE = "marketing/Absensi/absensiForm"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		//$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/Absensi/absensi_proccess'),
		'abs_activity' => set_value('abs_activity'),
	    'latitude' => set_value('latitude'),
	   	'longitude' => set_value('longitude'),
		'location' => set_value('location')
	    
		);
			//$this->load->view('marketing/customer/st_cust_form', $data);
			$this->load->view($this->MAIN_VIEW, $load_resource);
			//$this->load->view('marketing/customer/st_cust_list', $data);
    }
	
		
	
	public function absensi_proccess (){
		$this->form_validation->set_rules('abs_activity', 'Activity Sales', 'required');
		$this->form_validation->set_rules('longitude', 'longitude', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->index();
		 }else {
			 
			 $sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
				
				$data = array(
				
				'mrkt_id' => $sales['id'],
				'abs_activity' => $this->input->post('abs_activity',TRUE),
				'latitude' => $this->input->post('latitude',TRUE),
				'longitude' => $this->input->post('longitude',TRUE),
				'location' => $this->input->post('location',TRUE),
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				
				);
				
				if($this->general_model->insert('st_absensi',$data)){
					$abs= $this->general_model->get_data_by_id('st_absensi_jns','id_jns_absn',$this->input->post('abs_activity',TRUE));
						
						$text = $sales['name_mark'].' Absen '.$abs['jns_name'].', di '.$this->input->post('location',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda Telah Melakukan Absen Hari ini');
							  redirect(site_url('marketing/dasboard'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Gagal Melakukan Absensi');
							$this->index();
						}

					}	
				} 
			}
			
	
	
			public function rotate (){
				$data_all = $this->general_model->get_all_data('st_marketing');
				$count_data = $this->general_model->count_all('queue','st_marketing');
				$queue = $this->general_model->get_data_by_id('st_queue','id',1);
				$q = $queue['queue_up'];		

				
				$data = $this->general_model->get_data_by_id('st_marketing','queue',$q);
				
				
						if($q!=$count_data['total']){
							$up_q = $q+1;
							
						}else {
							
							$up_q = 1;
						}
				if (!empty($data['phone_mark'])){
					$update_queue = array (
						'queue_up'=>$up_q
					);
					
					$where_up = array ("id"=>1);
				
						if($this->general_model->update('st_queue',$update_queue,$where_up )){	
										
						redirect('whatsapp://send/?phone='.$data["phone_mark"].'&text=Halo');
					}else{
						
						
						echo 'erroro';						
						
					}
					
					
				}else {
					
					echo 'nomor tidak ada';
				}
		
				
			}
			
			
	
	
	
	
	}