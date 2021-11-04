<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class Bill extends AppBase {
	protected $rules = 5;
	
	
    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('M_Bill');
		$this->load->model('Jobs_update_model');
		$this->load->model('JobsModel');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
		$session_rules = $this->session->userdata('rules');
		 
		
    }

    	
	public function index() {
		

       $this->VIEW_FILE = "eoffice/procurment/bill/index"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['bill'] = $this->M_Bill->GetAllBill();
		
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function Listpajak() {
		

       $this->VIEW_FILE = "eoffice/procurment/bill/list_pajak"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['bill'] = $this->M_Bill->GetAllBill();
		
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	
	
	 public function add() {
        $this->VIEW_FILE = "eoffice/procurment/bill/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['vp'] = $this->M_Admin->get_all_depertement_vp();
		$load_resource['vendor'] = $this->M_Bill->get_table('proc_vendor');
		$load_resource['jr_employe'] = $this->M_Bill->get_table('jr_employe');
		$load_resource['st_project'] = $this->M_Bill->get_table('st_project');
		$load_resource['jr_departement'] = $this->M_Bill->get_table('jr_departement');
		
		
					
		 $load_resource['data'] = array(
            'button' => 'Input Data Invocie',
            'action' => site_url('eoffice/procurment/bill/create_proccess'),
	    'id' => set_value('id'),
	    'invoice_date_receipt' => set_value('invoice_date_receipt'),
	    'invoice_date' => set_value('invoice_date'),
	    'invoice_no' => set_value('invoice_no'),
	    'invoice_image' => set_value('invoice_image'),
	    'vendor_id' => set_value('vendor_id'),
	    'description' => set_value('description'),
		'npwp' => set_value('npwp'),
		'departement_id' => set_value('departement_id'),
	    'employe_id' => set_value('employe_id'),
		'amount' => set_value('amount'),
		'duedate' => set_value('duedate'),
		'project_id' => set_value('project_id'),
	    
	);
       
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }


public function create_proccess() 
    {
        $this->_rules_bill();

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Error! Field Not Complited');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('eoffice/procurment/Bill/Add'));
        } else {
			$filename = $_FILES['uploadFile']['name'];
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			if(!empty($filename)){
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			$doc_name= $emp['emp_name'];
									
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace('/', '_',$this->input->post('invoice_no',TRUE));
			$t=time();
			
			$name_file_save1 = $t."-".$img_name.".".$ext;
			$name_file = $t."-".$img_name;
			
			//$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			/*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			$file_old = './file/'.$bk['doc_file'];
			if(file_exists($file_old)){
				unlink($file_old);
			}
			*/
			
		$config['upload_path'] = './file/invoice';
		$config['allowed_types'] = 'gif|jpg|JPG|png|pdf|jpeg|doc|docx|xlsx|ppt|pptx|zip|rar';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
		$field_name = "uploadFile";
		if ($this->upload->do_upload($field_name)) {
			$data = array(
				'invoice_date_receipt' => $this->input->post('invoice_date_receipt',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'invoice_no' => $this->input->post('invoice_no',TRUE),
				'vendor_id' => $this->input->post('vendor_id',TRUE),
				'description' => $this->input->post('description',TRUE),
				'departement_id' => $this->input->post('departement_id',TRUE),
				'invoice_image' => $name_file_save1,
				'employe_id' => $this->input->post('employe_id',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'duedate' => $this->input->post('duedate',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'created_date' => date("Y-m-d H:i:s"),
				'created_by' => $this->session->userdata('u')
				);

					$this->M_Bill->insert($data);
					$this->session->set_flashdata('message', 'Create Record Success');
					$this->session->set_flashdata('status', 'alert-success');
					redirect(site_url('eoffice/procurment/Bill/Add'));

		}else {
			
			echo 'belum berhasil upload';
					$this->session->set_flashdata('message', 'Upload Error'.$this->upload->display_errors());
					$this->session->set_flashdata('status', 'alert-danger');
					redirect(site_url('eoffice/procurment/Bill/Add'));
		}
				
			}else {
				
				$data = array(
				'invoice_date_receipt' => $this->input->post('invoice_date_receipt',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'invoice_no' => $this->input->post('invoice_no',TRUE),
				'vendor_id' => $this->input->post('vendor_id',TRUE),
				'description' => $this->input->post('description',TRUE),
				'departement_id' => $this->input->post('departement_id',TRUE),
				'employe_id' => $this->input->post('employe_id',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'duedate' => $this->input->post('duedate',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'created_date' => date("Y-m-d H:i:s"),
				'created_by' => $this->session->userdata('u')
				);

					$this->M_Bill->insert($data);
					$this->session->set_flashdata('message', 'Create Record Success');
					$this->session->set_flashdata('status', 'alert-success');
					redirect(site_url('Report/AdminStaff'));
				
			}
		}
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
	
	
	
	
	public function Edit($id=null) {
			
		
		 $this->VIEW_FILE = "eoffice/procurment/bill/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$load_resource['bill'] = $this->M_Bill->get_table_by_id($id);
		$load_resource['vendor'] = $this->M_Bill->get_table('proc_vendor');
		$load_resource['jr_employe'] = $this->M_Bill->get_table('jr_employe');
		$load_resource['st_project'] = $this->M_Bill->get_table('st_project');
		$load_resource['jr_departement'] = $this->M_Bill->get_table('jr_departement');

		 
		//$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);
		 $row = $this->M_Bill->get_by_id($id);;
		//echo '<pre>'.print_r($row,true).'<pre>';
		//exit();
		
        if ($row) {
       $load_resource['data']= array(
			'button' => 'Edit Data Invocie',
            'action' => site_url('eoffice/procurment/bill/edit_action'),
		
		'id' => $row->id,
	    'invoice_date_receipt' =>$row->invoice_date_receipt,
	    'invoice_date' => $row->invoice_date,
	    'invoice_no' => $row->invoice_no,
	    'invoice_image' => $row->invoice_image,
	    'vendor_id' => $row->vendor_id,
	    'description' => $row->description,
		'departement_id' => $row->departement_id,
	    'employe_id' => $row->employe_id,
		'amount' => $row->amount,
		'duedate' => $row->duedate,
		'project_id' => $row->project_id,
	    
	   
		   );
           $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('eoffice/procurment/Bill'));
        }
		
		
			
        
    }
	
	
	 public function edit_action() 
    {
		
		
		$this->_rules_bill();

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Error! Field Not Complited');
			$this->session->set_flashdata('status', 'alert-danger');
			redirect(site_url('eoffice/procurment/Bill/Edit/'.$this->update($this->input->post('id', TRUE))));
            
        } else {
			$filename = $_FILES['uploadFile']['name'];
		
			if(!empty($filename)){
						
			$bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			$code = $bk['jobs_code'];
			$doc_name= $emp['emp_name'];
									
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace('/', '_',$this->input->post('invoice_no',TRUE));
			$t=time();
			
			$name_file_save1 = $t."-".$img_name."-" .$code.".".$ext;
			$name_file = $t."-".$img_name."-" .$code;
			
			//$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			/*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			
			*/
		if(!empty($this->input->post('pic_old',TRUE))){
			$file_old = './file/invoice/'.$this->input->post('pic_old',TRUE);
			if(file_exists($file_old)){
				unlink($file_old);
			}
		}
			
		$config['upload_path'] = './file/invoice';
		$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx|ppt|pptx|zip|rar';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if ($this->upload->do_upload($field_name)) {
			
			
			$data = array(
		
				'invoice_date_receipt' => $this->input->post('invoice_date_receipt',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'invoice_no' => $this->input->post('invoice_no',TRUE),
				'vendor_id' => $this->input->post('vendor_id',TRUE),
				'description' => $this->input->post('description',TRUE),
				'departement_id' => $this->input->post('departement_id',TRUE),
				'invoice_image' => $name_file_save1,
				'employe_id' => $this->input->post('employe_id',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'duedate' => $this->input->post('duedate',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'updated_date' => date("Y-m-d H:i:s"),
				'updated_by' => $this->session->userdata('u')
	    );

            $this->M_Bill->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
			$this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('eoffice/procurment/Bill'));
			
			
		}
		
			}else{
				
				//only data Update
				
				$data = array(
		
				'invoice_date_receipt' => $this->input->post('invoice_date_receipt',TRUE),
				'invoice_date' => $this->input->post('invoice_date',TRUE),
				'invoice_no' => $this->input->post('invoice_no',TRUE),
				'vendor_id' => $this->input->post('vendor_id',TRUE),
				'description' => $this->input->post('description',TRUE),
				'departement_id' => $this->input->post('departement_id',TRUE),
				'employe_id' => $this->input->post('employe_id',TRUE),
				'project_id' => $this->input->post('project_id',TRUE),
				'duedate' => $this->input->post('duedate',TRUE),
				'amount' => $this->input->post('amount',TRUE),
				'updated_date' => date("Y-m-d H:i:s"),
				'updated_by' => $this->session->userdata('u')
					);

						$this->M_Bill->update($this->input->post('id', TRUE), $data);
						$this->session->set_flashdata('message', 'Update Record Success');
						$this->session->set_flashdata('status', 'alert-success');
						redirect(site_url('eoffice/procurment/Bill'));
				
				
			}
		
		}

        
    }
	
	
	
	public function InsertTax($id=null) {
			
		
		 $this->VIEW_FILE = "eoffice/procurment/bill/Insert_pajak"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$load_resource['bill'] = $this->M_Bill->get_table_by_id($id);
		

		 
		//$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);
		 $row = $this->M_Bill->get_by_id($id);;
		//echo '<pre>'.print_r($row,true).'<pre>';
		//exit();
		
        if ($row) {
       $load_resource['data']= array(
			'button' => 'INPUT PAJAK',
            'action' => site_url('eoffice/procurment/Bill/InsertTax_action'),
		
		'id' => $row->id,
	    'tax_dpp' =>$row->tax_dpp,
	    'tax_ppn' => $row->tax_ppn,
	    'tax_pph4_2' => $row->tax_pph4_2,
	    'tax_pph_2126' => $row->tax_pph_2126,
	    'tax_pph_22' => $row->tax_pph_22,
	    'tax_pph_2326' => $row->tax_pph_2326,
		'tax_pph_15' => $row->tax_pph_15,
	    'down_payment' => $row->down_payment,
		'invoice_date_receipt' =>$row->invoice_date_receipt,
	    'invoice_date' => $row->invoice_date,
	    'invoice_no' => $row->invoice_no,
	    'invoice_image' => $row->invoice_image,
	    'vendor_id' => $row->vendor_id,
	    'description' => $row->description,
		'departement_id' => $row->departement_id,
	    'employe_id' => $row->employe_id,
		'amount' => $row->amount,
		'duedate' => $row->duedate,
		'project_id' => $row->project_id
		
	    
	   
		   );
           $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('eoffice/procurment/Bill'));
        }
		
		
			
        
    }
	
	
	 public function InsertTax_action() 
    {
		
		
		$this->_rules_bill_tax();

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Error! Field Not Complited');
			$this->session->set_flashdata('status', 'alert-danger');
			redirect(site_url('eoffice/procurment/Bill/InsertTax/'.$this->update($this->input->post('id', TRUE))));
            
        } else {
			$id = 			$this->input->post('id', TRUE);
			$tax_dpp =		$this->input->post('tax_dpp', TRUE);
			$tax_ppn =		$this->input->post('tax_ppn', TRUE);
			$tax_pph4_2 = 	$this->input->post('tax_pph4_2', TRUE);
			$tax_pph_2126 = $this->input->post('tax_pph_2126', TRUE);
			$tax_pph_22 = $this->input->post('tax_pph_22', TRUE);
			$tax_pph_2326 = $this->input->post('tax_pph_2326', TRUE);
			$tax_pph_15 = $this->input->post('tax_pph_15', TRUE);
			$down_payment = $this->input->post('down_payment', TRUE);
			$amount = $this->input->post('amount', TRUE);
			
		
			$tax_djp = $tax_pph4_2 + $tax_pph_2126 + $tax_pph_22 + $tax_pph_2326 + $tax_pph_15;
			$debt_vendor = 	($tax_dpp + $tax_ppn) - $tax_djp;  
				//only data Update
				
				$data = array(
		
				'id' => $this->input->post('id', TRUE),
				'tax_dpp' =>$this->input->post('tax_dpp', TRUE),
				'tax_ppn' => $this->input->post('tax_ppn', TRUE),
				'tax_pph4_2' => $this->input->post('tax_pph4_2', TRUE),
				'tax_pph_2126' =>$this->input->post('tax_pph_2126', TRUE),
				'tax_pph_22' => $this->input->post('tax_pph_22', TRUE),
				'tax_pph_2326' => $this->input->post('tax_pph_2326', TRUE),
				'tax_pph_15' => $this->input->post('tax_pph_15', TRUE),
				'tax_djp' =>$tax_djp,
				'debt_vendor'=>$debt_vendor,
				'down_payment' => $this->input->post('down_payment', TRUE),
				'updated_date' => date("Y-m-d H:i:s"),
				'updated_by' => $this->session->userdata('u')
					);

						$this->M_Bill->update($this->input->post('id', TRUE), $data);
						$this->session->set_flashdata('message', 'Update Record Success');
						$this->session->set_flashdata('status', 'alert-success');
						redirect(site_url('eoffice/procurment/Bill'));
			
		
		}

        
    }
	
	
	
	
	
	 public function read($id) 
    {
		
		$this->VIEW_FILE = "Report/Staff/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		 $row = $this->M_Admin->get_update_jobs_by_id($id);
		$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);
		
       
        if ($row) {
       $load_resource['data']= array(
		'up_jobs_id' => $row->up_jobs_id,
		'jobs_id' => $row->jobs_id,
		'kry_id' => $row->kry_id,
		'jobs_up_descr' => $row->jobs_up_descr,
		'pic' => $row->pic,
		'job_up_st' => $row->job_up_st
		   );
           $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }

    
    
    
	
	public function UpdateTaskList($jobs_id=null) {
			
		
       $this->VIEW_FILE = "Report/Staff/VupdateList"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$load_resource['emp_jobs'] = $this->M_Admin->get_jobs_by_id($jobs_id);
		$load_resource['jobsUp'] = $this->M_Admin->get_update_jobs_by_jobs_id($jobs_id);	
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
    
    public function update_flow($id) 
    {
       $this->VIEW_FILE = "Report/Staff/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$cek = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		 $row = $this->M_Admin->get_update_jobs_by_id($id);
		$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);
		
		if($row['staff_kry']!=$cek['id_kry']){
			
			$this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
		}
		
        if ($row) {
       $load_resource['data']= array(
			'button' => 'Update',
            'action' => site_url('Report/AdminStaff/update_action'),
		'up_jobs_id' => $row['up_jobs_id'],
		'jb_id'=>$row['jobs_id'],
		'jobs_id' => $row['jobs_id'],
		'kry_id' => $row['kry_id'],
		'jobs_up_descr' => $row['jobs_up_descr'],
		'update_date'=>$row['update_date'],
		'pic' => $row['pic'],
		'job_up_st' => $row['job_up_st']
		   );
           $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }
    
   
    
    public function delete($id) 
    {
		$row = $this->M_Admin->get_update_jobs_by_id($id);
		$cek = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		if($row['staff_kry']!=$cek['id_kry']){
			
			$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminStaff/UpdateList'));
		}
        $row = $this->Jobs_update_model->get_by_id($id);

        if ($row) {
            $this->Jobs_update_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
			$this->session->set_flashdata('status', 'alert-success');
             redirect(site_url('Report/AdminStaff/UpdateList'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
             redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }

    public function _rules() 
    {
	
	$this->form_validation->set_rules('jobs_up_descr', 'jobs up descr', 'trim|required');
	



	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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
	
	
	public function booking_doc($cust_id=null){
		
		//$and = '';
		//$cust_cek = $this->general_model->get_data_by_id('st_cust','id',$cust_id,$and);
		//$cek_book = $this->general_model->get_data_by_id('st_booking','cust_id',$cust_id,$and);
		
		
		$this->VIEW_FILE = "Report/Staff/followBookingFormDoc"; // dynamic
		$load_resource = $this->load_resource();
		//$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
		//$load_resource['project_cust'] =$this->general_model->get_data('st_project');
		//$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('Report/AdminStaff/booking_doc_proses'),
		 'doc_name' => set_value('doc_name'),
		'doc_file'=>set_value('doc_file'), 
	   

	    
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
			
			$filename = $_FILES['uploadFile']['name'];
						
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
		$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if (!$this->upload->do_upload($field_name)) {
			
			echo $this->session->set_flashdata('message',$this->upload->display_errors());
					redirect('marketing/Customer/')	;				
			
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
						$this->session->set_flashdata('message', 'File Document Berhasil Di update');
						
						redirect(site_url('marketing/FollowUp/DetailCustomer/'.$this->input->post('cust_id',TRUE).'#tab4'));
						
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
							 $this->session->set_flashdata('message', 'Anda berhasil Upload Dokument');
							  redirect(site_url('marketing/FollowUp/DetailCustomer/'.$this->input->post('cust_id',TRUE).'#tab4'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->absensi();
						}

					}
			}
			 
		}

	}
	
	
	public function _rules_vp() 
    {
	$this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
	$this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
	$this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	
	public function _rules_bill() 
    {
	$this->form_validation->set_rules('invoice_date_receipt', 'Tanggal Diterima Invoice', 'trim|required');
	$this->form_validation->set_rules('invoice_date', 'Tanggal Invoice', 'trim|required');
	
    }
	
	
	public function _rules_bill_tax() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	
	
    }

	
	// iki taroh di base ae
	

}
