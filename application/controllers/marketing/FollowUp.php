<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseMarketing.php');
class FollowUp extends AppBase
{
    function __construct()
    {
        parent::__construct();
		$this->cek_absen();
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
		$this->VIEW_FILE = "marketing/customer/st_cust_list"; // dynamic
		$load_resource = $this->load_resource();
		
		
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'marketing/customer/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'marketing/customer/index.?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'marketing/customer/index';
            $config['first_url'] = base_url() . 'marketing/customer/index';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Customer->total_rows($q);
        $customer = $this->M_Customer->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'customer_data' => $customer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);
    }
	
	public function token() {
        //jumlah panjang karakter angka dan huruf.
        $length_abjad = "3";
        $length_angka = "3";
        $angka_pasti = '4';

        //huruf yg dimasukan, kecuali I,L dan O
        $huruf = "ABCDEFGHJKLMNPQRSTUVWXYZ";



        //mulai proses generate angka
        $datejam = date("His");
        $time_md5 = rand(time(), $datejam);
		$acak_huruf = str_shuffle($huruf);
		$cut_huruf=substr($acak_huruf,0, $length_abjad);
        $cut = substr($time_md5, 0, $length_angka);

        //mennggabungkan dan mengacak hasil generate huruf dan angka
        $acak = str_shuffle($cut.$cut_huruf);

        $angka = $acak;



        //menghitung dan memeriksa hasil generate di database menggunakan fungsi getTotalRow(),
        //jika hasil generate sudah ada di database maka proses generate akan diulang


        return $angka;
    }
	
	public function Activity($id_cust=null,$fol_by=null,$actv_jn){
		
		//$this->VIEW_FILE = "marketing/followup/st_cust_form"; // dynamic
		//$load_resource = $this->load_resource();
		$cust = $this->general_model->get_data_by_id('st_cust','id',$id_cust);
		$sales = $this->general_model->get_data_by_id('st_marketing','id',$cust['sales_id']);
		
		if($fol_by=='tlp' and $actv_jn=='followup'){
			$text_folby = 'Menelepon Calon Custommer';
		}elseif ($fol_by=='wa' and $actv_jn=='followup'){
			$text_folby = 'Mengirim pesan WA Kepada Customer';
		}elseif ($fol_by=='bl' and $actv_jn=='followup'){
			$text_folby = 'Bertemu Langsung Calon Custommer';
		}else{
			$text_folby = 'Menambahkan calon Custommer';	
		}
		$name = $cust['cust_name'];
		$st = $cust['fu_st'];
		if($st=='NW'){
			
			$stu ='FU';
		}else {
			
			$stu ='FUL';
		}
		$text = $sales['name_mark'].' '.$text_folby.' '.$name;
		
		$data_activity = array ("marketing_id"=>$cust['sales_id'],
								"actv_jn"=>$actv_jn,
								"actv_text"=>$text,
								"cr_dt"=>date("Y-m-d H:i:s")
								);
		$data_fullowup = array (
			"fu_st"=>$stu,
			"cr_up"=>date("Y-m-d H:i:s"),
			"u_cr"=>$this->session->userdata('u')
		);
		
		$where_fullowup = array (
			"id"=>$id_cust
		);
		
		if($this->general_model->insert('st_sales_activity',$data_activity)){
			if($this->general_model->update('st_cust',$data_fullowup,$where_fullowup)){
				$phone = $cust['cust_phone'];
				$phone_clear = substr($phone,1);
				
				if($fol_by=='wa'){
					redirect('https://api.whatsapp.com/send?phone=62'.$phone_clear);
				}elseif($fol_by=='tlp'){
					redirect('http://api.sms.intel-tele.com/callto/62'.$phone_clear);
				}else {
					
					echo 'mantul';
				}	
			}
			
			
		}else {
			
			echo 'gagal';
		}	
	}
	
	
	public function booking($cust_id=null){
		
		$and = '';
		$cust_cek = $this->general_model->get_data_by_id('st_cust','id',$cust_id,$and);
		
		$cek_book = $this->general_model->get_data_by_id('st_booking','cust_id',$cust_id,$and);
		
		if(empty($cust_cek)){
			
			$this->session->set_flashdata('message','<span class="text-danger">Tidak Ditemukan Data Customer Anda</span>');
								redirect(site_url('marketing/customer'));
		}elseif(!empty($cek_book)){
			
			$this->session->set_flashdata('message','<span class="text-danger">Anda Sudah Mengisi Data Booking Customer ini</span>');
								redirect(site_url('marketing/customer'));
		}
		
		$this->VIEW_FILE = "marketing/followup/followBookingForm"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/Followup/booking_proccess'),
		'bk_jn' => set_value('bk_jn'),
	    'bk_nominal' => set_value('bk_nominal'),
		'bk_ket'=>set_value('bk_ket'),
	   	'project_id' => set_value('project_id'),
		'project_blok' => set_value('project_blok'),
		'cust_id' => $cust_id

	    
	);
        //$this->load->view('marketing/customer/st_cust_form', $data);
		$this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);
		
		
	}
	
	
	public function booking_proccess (){ 
		$this->form_validation->set_rules('project_id', 'Lokasi Perumahan', 'required');
		$this->form_validation->set_rules('project_blok', 'Blok Yang di Booking', 'required');
		$this->form_validation->set_rules('bk_nominal', 'Nominal', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->booking();
		 }else {
			 
			 $sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
			 $prj = $this->general_model->get_data_by_id('st_project','id',$this->input->post('project_id',TRUE));
			$bk_code = $this->token();
			$bk = $this->input->post('bk_jn');
			
			if($bk=='RESERVE'){
				$table = 'bk_nominal_rsv';	
			}else{
				$table = 'bk_nominal_full';
			}
			
			
			
				$data = array(
				
				'cust_id' => $this->input->post('cust_id',TRUE),
				'bk_code'=>$bk_code,
				'bk_jn' => $this->input->post('bk_jn',TRUE),
				$table => $this->input->post('bk_nominal',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'project_blok' => $this->input->post('project_blok',TRUE),
				'bk_ket' => $this->input->post('bk_ket',TRUE),
				'bk_st'=>'BI CHECKING',
				'bk_bi_stat'=>'PENGAJUAN',
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				
				);
				
				if($this->general_model->insert('st_booking',$data)){
											
						$text = $sales['name_mark'].' INPUT BOOKING CUSTOMER '.$prj['project_name'].', Blok '.$this->input->post('project_blok',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda berhasil Input Booking Customer');
							  redirect(site_url('marketing/customer'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->absensi();
						}

					}	
				} 
			}
			
			
		public function booking_update_proccess (){ 
		$this->form_validation->set_rules('cust_id', 'customer ID', 'required');
		$this->form_validation->set_rules('BookingId', 'BookingID', 'required');
		//$this->form_validation->set_rules('bk_nominal', 'Nominal', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->booking();
		 }else {
			 		 
			 $sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
			// $prj = $this->general_model->get_data_by_id('st_project','id',$this->input->post('project_id',TRUE));
			$bk_code = $this->token();
			$bk = $this->input->post('bk_jn');
			
			if($bk=='RESERVE'){
				$table = 'bk_nominal_rsv';	
			}else{
				$table = 'bk_nominal_full';
			}
			
			
			
				$data = array(
				
				//'cust_id' => $this->input->post('cust_id',TRUE),
				//'bk_code'=>$bk_code,
				'bk_jn' => $this->input->post('bk_jn',TRUE),
				$table => $this->input->post('bk_nominal',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'project_blok' => $this->input->post('project_blok',TRUE),
				'bk_ket' => $this->input->post('bk_ket',TRUE),
				//'bk_st'=>'BI CHECKING',
				//'bk_bi_stat'=>'PENGAJUAN',
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				);
				
				$where = array (
				'id'=>$this->input->post('BookingId',TRUE)
				);
				
				if($this->general_model->update('st_booking',$data,$where)){
											
						$text = $sales['name_mark'].' UPDATE DATA BOOKING '.$prj['project_name'].', Blok '.$this->input->post('project_blok',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda berhasil Input Booking Customer');
							  redirect(site_url('marketing/FollowUp/DetailCustomer/'.$this->input->post('cust_id',TRUE)));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->DetailCustomer($this->input->post('cust_id',TRUE));
						}

					}	
				} 
			}
			
		
		public function booking_doc($cust_id=null){
		
		$and = '';
		$cust_cek = $this->general_model->get_data_by_id('st_cust','id',$cust_id,$and);
		$cek_book = $this->general_model->get_data_by_id('st_booking','cust_id',$cust_id,$and);
		
		if(empty($cust_cek)){
			
			$this->session->set_flashdata('message','<span class="text-danger">Tidak Ditemukan Data Customer Anda</span>');
								redirect(site_url('marketing/customer'));
		}elseif(empty($cek_book)){
			
			$this->session->set_flashdata('message','<span class="text-danger">Anda Belum Mengisi Data Booking Customer</span>');
								redirect(site_url('marketing/customer'));
		}
		
		$this->VIEW_FILE = "marketing/followup/followBookingFormDoc"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/Followup/booking_doc_proses'),
		 'doc_name' => set_value('doc_name'),
		'doc_file'=>set_value('doc_file'), 
	   	'cust_id' => $cust_id

	    
	);
        //$this->load->view('marketing/customer/st_cust_form', $data);
		$this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);
		
		
	}
	
	public function booking_doc_proses(){
		$this->form_validation->set_rules('doc_name', 'Nama Documment', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->booking_doc($this->input->post('cust_id',TRUE));
		 }else {
			 
			$doc_name = str_replace(' ', '', ucwords($this->input->post('doc_name')));
			$and = '';
			$bk = $this->general_model->get_data_by_id('st_booking','cust_id',$this->input->post('cust_id',TRUE),$and);
			$code = $bk['bk_code'];
			
			echo $filename = $_FILES['uploadFile']['name'];
						
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace(' ', '_', ucwords($doc_name));
			
			$name_file_save1 = $img_name."-" .$code.".".$ext;
			$name_file = $img_name."-" .$code;
			$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			$file_old = './file/'.$bk['doc_file'];
			if(file_exists($file_old)){
				unlink($file_old);
			}
			
		$config['upload_path'] = './file';
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']     = 6000;
		$config['max_width'] = 5000;
		$config['max_height'] = 5000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if (!$this->upload->do_upload($field_name)) {
			
			echo $this->session->set_flashdata('message',$this->upload->display_errors());
					redirect('marketing/customer/')	;				
			
			}else {
				
								
				$data = array(
				
				'cust_id' => $this->input->post('cust_id',TRUE),
				'doc_name' => $this->input->post('doc_name',TRUE),
				'doc_file' => $name_file_save1,
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				
				);
				
				
				if(!empty($bk)){
					
					$data_up = array(				
					'doc_file' => $name_file_save1,
					'up_dt' => date("Y-m-d H:i:s"),
					'u_cr' => $this->session->userdata('u')
				
				);
				
				$where_doc = array('id'=>$bk['id']);
				
					//belum selesai
					if($this->general_model->update('st_booking_doc',$data_up,$where_doc)){
						$this->session->set_flashdata('message', 'File Berhasil Di update');
						
						redirect(site_url('marketing/customer'));
						
					}
					
					 
					
				}
				
				if($this->general_model->insert('st_booking_doc',$data)){
											
						$text = $sales['name_mark'].' INPUT BOOKING CUSTOMER '.$prj['project_name'].', Blok '.$this->input->post('project_blok',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda berhasil Input Booking Customer');
							  redirect(site_url('marketing/customer'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->absensi();
						}

					}
			}
			 
		}

	}
	
	public function booking_doc_proccess(){ 
		$this->form_validation->set_rules('project_id', 'Lokasi Perumahan', 'required');
		$this->form_validation->set_rules('project_blok', 'Blok Yang di Booking', 'required');
		$this->form_validation->set_rules('bk_nominal', 'Nominal', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->booking();
		 }else {
			 
			 $sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
			 $prj = $this->general_model->get_data_by_id('st_project','id',$this->input->post('project_id',TRUE));
				
				$data = array(
				
				'cust_id' => $this->input->post('cust_id',TRUE),
				'bk_jn' => $this->input->post('bk_jn',TRUE),
				'bk_nominal' => $this->input->post('bk_nominal',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'project_blok' => $this->input->post('project_blok',TRUE),
				'bk_ket' => $this->input->post('bk_ket',TRUE),
				'bk_st'=>'BI CHECKING',
				'bk_bi_stat'=>'PENGAJUAN',
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				
				);
				
				if($this->general_model->insert('st_booking',$data)){
											
						$text = $sales['name_mark'].' INPUT BOOKING CUSTOMER '.$prj['project_name'].', Blok '.$this->input->post('project_blok',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda berhasil Input Booking Customer');
							  redirect(site_url('marketing/customer'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->absensi();
						}

					}	
				} 
			}
	
	
	
	public function absensi(){
		
		$this->VIEW_FILE = "marketing/Followup/absensiForm"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		//$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/Followup/absensi_proccess'),
		'abs_activity' => set_value('abs_activity'),
	    'latitude' => set_value('latitude'),
	   	'longitude' => set_value('longitude'),
		'location' => set_value('location')
	    
		);
			//$this->load->view('marketing/customer/st_cust_form', $data);
			$this->load->view($this->MAIN_VIEW, $load_resource);
			//$this->load->view('marketing/customer/st_cust_list', $data);
		
		
	}
	
	public function DetailCustomer($cust_id=null){
		
		$this->VIEW_FILE = "marketing/Followup/DetailCustomer"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		//$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		//$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		$load_resource['data'] =$this->general_model->Get_detail_customer($cust_id);
		$load_resource['detail_fu'] =$this->general_model->Get_followup($cust_id);
		
		$like = '%'.$load_resource['data']['BookingId'].'%';
		$load_resource['bicek'] =$this->general_model->Get_bicek($like);
		$load_resource['dok'] =$this->general_model->Get_dokument($cust_id);
		
		

	    
	
		$load_resource['dat'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/FollowUp/Activity_reportL_proccess'),
		'idcustomer' => $cust_id,
		'BookingId'=>$like,
		'cust_email' => set_value('cust_email'),
		'cust_addres'=>set_value('cust_addres'),
	    'sales_id' => set_value('sales_id'),
	   	'fu_price_range' => set_value('fu_price_range'),
	    'fu_exptd_location' => set_value('fu_exptd_location'),
		'fu_srvd_location_id' => set_value('fu_srvd_location_id'),
		'fu_text' => set_value('fu_text'),
		'fu_detail' => set_value('fu_detail'),
		'bk_jn' => set_value('bk_jn'),
	    'bk_nominal' => set_value('bk_nominal'),
		'bk_ket'=>set_value('bk_ket'),
	   	'project_id' => set_value('project_id'),
		'project_blok' => set_value('project_blok')
		
	    
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
			$this->absensi();
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
							$this->absensi();
						}

					}	
				} 
			}
			
	public function Activity_report($cust_id=null){
		//$this->load->model('M_general');
		
		$and = "AND (fu_st ='FU' or fu_st='FUL') ";
		$cust_cek = $this->general_model->get_data_by_id('st_cust','id',$cust_id,$and);
		if(empty($cust_cek)){
			
			$this->session->set_flashdata('message','<span class="text-danger">Tidak Ditemukan Data Customer Anda</span>');
								redirect(site_url('marketing/customer'));
		}
		if($cust_cek['fu_st']=='FUL'){
			
			$link = 'marketing/Followup/followUpFormL';
			$action = site_url('marketing/FollowUp/Activity_reportL_proccess');
		}else{
			
			$link = 'marketing/Followup/followUpForm';
			$action = site_url('marketing/FollowUp/Activity_report_proccess');
		}
		
		
		
		$this->VIEW_FILE = $link; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		$load_resource['surveyed_location'] =$this->general_model->get_data('st_surveyed_location');

        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => $action,
		'cust_id' => $cust_id,
		'cust_email' => set_value('cust_email'),
		'cust_addres'=>set_value('cust_addres'),
	    'sales_id' => set_value('sales_id'),
	   	'fu_price_range' => set_value('fu_price_range'),
	    'fu_exptd_location' => set_value('fu_exptd_location'),
		'fu_srvd_location_id' => set_value('fu_srvd_location_id'),
		'fu_sallary' => set_value('fu_sallary'),
		'cr_up' => set_value('cr_up'),
		'fu_text' => set_value('fu_text'),
		'fu_detail' => set_value('fu_detail')
	    
			);
				//$this->load->view('marketing/customer/st_cust_form', $data);
				$this->load->view($this->MAIN_VIEW, $load_resource);
				//$this->load->view('marketing/customer/st_cust_list', $data);
			
		}
		
		
	public function Activity_reportL_proccess(){
				$this->form_validation->set_rules('cust_id', 'Cust_id', 'trim|required');
				$this->form_validation->set_rules('st_cust', 'St Customer', 'trim|required');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		 if ($this->form_validation->run() == FALSE) {
			$this->DetailCustomer($this->input->post('cust_id',TRUE));
			}else {
				
				$sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
				
				$data = array(
				
				
				'cust_stat' => $this->input->post('st_cust',TRUE),
				'fu_st'=>'DN',
				'cr_up' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				);
				
				$where = array (
						'id'=> $this->input->post('cust_id',TRUE)
					);
					
					
				$fu_det = array (
					'cust_id'=>$this->input->post('cust_id',TRUE),
					'fu_cust_st' => $this->input->post('st_cust',TRUE),
					'fu_detail'=>$this->input->post('fu_detail',TRUE),
					'cr_dt' => date("Y-m-d H:i:s"),
					'u_cr' => $this->session->userdata('u')
				
				);
					
					
					if($this->general_model->update('st_cust',$data,$where)){
							if($this->general_model->insert('st_followup_det',$fu_det)){
								
								if($this->input->post('st_cust',TRUE)=='BOOKING'){
									$this->session->set_flashdata('message', 'Data Followup Telah Di Upadate, Mohon Isi Form Booking');
									redirect(site_url('marketing/followup/booking/'.$this->input->post('cust_id',TRUE)));
								}else {
									$this->session->set_flashdata('message', 'Data Followup Telah Di Upadate');
									redirect(site_url('marketing/customer'));
									
								}
							}
						}
					} 
				}

	public function Activity_report_proccess(){
		 $this->_rules_Activity();
		 if ($this->form_validation->run() == FALSE) {
			echo 'kamu fales';
			}else {
				
				$sales = $this->general_model->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
				
				$data = array(
				
				'cust_email' => $this->input->post('cust_email',TRUE),
				'cust_addres' => $this->input->post('cust_addres',TRUE),
				'fu_price_range' => $this->input->post('fu_price_range',TRUE),
				'fu_exptd_location' => $this->input->post('fu_exptd_location',TRUE),
				'fu_srvd_location_id' => $this->input->post('fu_srvd_location_id',TRUE),
				'fu_sallary' => $this->input->post('fu_sallary',TRUE),
				'fu_text' => $this->input->post('fu_text',TRUE),
				'cust_stat' => $this->input->post('st_cust',TRUE),
				'fu_st'=>'DN',
				'cr_up' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				);
				
				$where = array (
						'id'=> $this->input->post('cust_id',TRUE)
					);
					
					
					if($this->general_model->update('st_cust',$data,$where)){

							if($this->input->post('st_cust',TRUE)=='BOOKING'){
									$this->session->set_flashdata('message', 'Data Followup Telah Di Upadate, Mohon Isi Form Booking');
									redirect(site_url('marketing/followup/booking/'.$this->input->post('cust_id',TRUE)));
								}else {
									$this->session->set_flashdata('message', 'Data Followup Telah Di Upadate');
									redirect(site_url('marketing/customer'));
									
								}
					}
				} 

			}
			
			public function _rules_Activity() 
			{
				//$this->form_validation->set_rules('sales_id', 'Sales Id Hide', 'trim|required');
				$this->form_validation->set_rules('fu_price_range', 'Range Price', 'trim|required');
				$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
			
		
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