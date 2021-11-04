<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseMarketing.php');
class Customer extends AppBase
{
    function __construct()
    {
        parent::__construct();
		$this->cek_absen();
        $this->load->model('M_Customer');
		  $this->load->model('general_model');
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->library('pagination');
		$this->load->library('session');
		ini_set('memory_limit',-1);
    }

    public function index($st=null)
    {
		$this->VIEW_FILE = "marketing/customer/st_cust_list"; // dynamic
		$load_resource = $this->load_resource();
		
		$mrk = $this->M_Customer->get_marketing_by_id($this->session->userdata('u'));
		
		
		$id_mrk = $mrk->id;
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
        $config['total_rows'] = $this->M_Customer->total_rows($q,$id_mrk,$st);
        $customer = $this->M_Customer->get_limit_data($config['per_page'], $start, $q,$id_mrk,$st);

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
	
	
	public function create() 
    {
		$this->VIEW_FILE = "marketing/customer/st_cust_form"; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['source_cus'] =$this->M_Customer->get_source();
		
		
		
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('marketing/customer/create_action'),
	    'source' => set_value('source'),
	    'cust_name' => set_value('cust_name'),
	    'cust_phone' => set_value('cust_phone'),
	   
	);
        //$this->load->view('marketing/customer/st_cust_form', $data);
		$this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_Customer->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'project_id' => $row->project_id,
		'sales_id' => $row->sales_id,
		'st_cust' => $row->st_cust,
		'source' => $row->source,
		'cust_name' => $row->cust_name,
		'cust_email' => $row->cust_email,
		'cust_phone' => $row->cust_phone,
		'cut_addres' => $row->cut_addres,
		'cr_dt' => $row->cr_dt,
		'cr_up' => $row->cr_up,
		'u_cr' => $row->u_cr,
	    );
            $this->load->view('marketing/customer/st_cust_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }

     
    
    public function create_action() 
    {
   $this->form_validation->set_rules('source', 'source', 'required');
	$this->form_validation->set_rules('cust_name', 'cust name', 'required');
	$this->form_validation->set_rules('cust_phone', 'cust phone', 'required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
			 $this->session->set_flashdata('message','<span class="text-danger">'. validation_errors().'</span>');
            $this->create();
        } else {
			
		$sales = $this->M_Customer->get_data_by_id('st_marketing','user_id',$this->session->userdata('u'));
		$datetime = date("Y-m-d H:i:s");
        $data = array(
		'sales_id'=>$sales['id'],
		'source' => $this->input->post('source',TRUE),
		'cust_name' => $this->input->post('cust_name',TRUE),
		'cust_phone' => $this->input->post('cust_phone',TRUE),
		'cust_stat'=>'new',
		'fu_st'=>'NW',
		'cr_dt' => $datetime,
		'cr_up' => $datetime,
		'u_cr' => $this->session->userdata('u')
	    );

             
			
			$text = $sales['name_mark'].' Menambahkan Kontak Customer '.$this->input->post('cust_name',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'add_cust',
												"actv_text"=>$text,
												"cr_dt"=>$datetime
											);
						$and = '';
						$cek_hp = $this->general_model->get_data_by_id('st_cust','cust_phone',$this->input->post('cust_phone',TRUE),$and);
						 
						if(empty($cek_hp)){
								$this->M_Customer->insert($data);
								$this->M_Customer->insert_activity('st_sales_activity',$data_activity);
						
								$this->session->set_flashdata('message','<span class="text-danger">Data Customer Sukses Ditambahkan</span>');
								redirect(site_url('marketing/customer'));
						}else{
							
							$this->session->set_flashdata('message','<span class="text-danger">DATA NOMOR HP SUDAH ADA</span>');
								redirect(site_url('marketing/customer'));
							
						}
						
						
				}
			}
    
    public function update($id) 
    {
		$this->VIEW_FILE = "marketing/customer/st_cust_form"; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['project_cust'] =$this->M_Customer->get_project();
		$load_resource['source_cus'] =$this->M_Customer->get_source();
		
        $row = $this->M_Customer->get_by_id($id);

        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('marketing/customer/update_action'),
		'id' => set_value('id', $row->id),
		'project_id' => set_value('project_id', $row->project_id),
		'sales_id' => set_value('sales_id', $row->sales_id),
		'st_cust' => set_value('st_cust', $row->st_cust),
		'source' => set_value('source', $row->source),
		'cust_name' => set_value('cust_name', $row->cust_name),
		'cust_email' => set_value('cust_email', $row->cust_email),
		'cust_phone' => set_value('cust_phone', $row->cust_phone),
		'cut_addres' => set_value('cut_addres', $row->cut_addres),
		'cr_dt' => set_value('cr_dt', $row->cr_dt),
		'cr_up' => set_value('cr_up', $row->cr_up),
		'u_cr' => set_value('u_cr', $row->u_cr),
	    );
            $this->load->view($this->MAIN_VIEW, $load_resource);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('marketing/customer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'project_id' => $this->input->post('project_id',TRUE),
		'st_cust' => $this->input->post('st_cust',TRUE),
		'source' => $this->input->post('source',TRUE),
		'cust_name' => $this->input->post('cust_name',TRUE),
		'cust_email' => $this->input->post('cust_email',TRUE),
		'cust_phone' => $this->input->post('cust_phone',TRUE),
		'cut_addres' => $this->input->post('cut_addres',TRUE),
		'cr_up' => date("Y-m-d H:i:s"),
		'u_cr' => $this->session->userdata('u')
	    );

            $this->M_Customer->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('marketing/customer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_Customer->get_by_id($id);

        if ($row) {
            $this->M_Customer->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('marketing/customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('marketing/customer'));
        }
    }

    public function _rules() 
    {
	
	$this->form_validation->set_rules('source', 'source', 'trim|required');
	$this->form_validation->set_rules('cust_name', 'cust name', 'trim|required');
	$this->form_validation->set_rules('cust_phone', 'cust phone', 'trim|required');
	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "st_cust.xls";
        $judul = "st_cust";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Project Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Sales Id");
	xlsWriteLabel($tablehead, $kolomhead++, "St Cust");
	xlsWriteLabel($tablehead, $kolomhead++, "Source");
	xlsWriteLabel($tablehead, $kolomhead++, "Cust Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Cust Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Cust Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Cut Addres");
	xlsWriteLabel($tablehead, $kolomhead++, "Cr Dt");
	xlsWriteLabel($tablehead, $kolomhead++, "Cr Up");
	xlsWriteLabel($tablehead, $kolomhead++, "U Cr");

	foreach ($this->M_Customer->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->project_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->sales_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->st_cust);
	    xlsWriteLabel($tablebody, $kolombody++, $data->source);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cust_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cust_email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cust_phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cut_addres);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cr_dt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cr_up);
	    xlsWriteNumber($tablebody, $kolombody++, $data->u_cr);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-14 07:42:22 */
/* http://harviacode.com */