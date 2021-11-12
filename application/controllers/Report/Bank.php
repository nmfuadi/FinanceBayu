<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

class Bank extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bank_model');
        $this->load->library('form_validation');
        $this->load->model('M_Admin');

    }

    public function index()
    {
        $this->VIEW_FILE = "bank/fin_bank_list"; 

        $load_resource = $this->load_resource(); // digawe ngene ikie

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/Bank/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Report/Bank/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Report/Bank/index';
            $config['first_url'] = base_url() . 'Report/Bank/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Bank_model->total_rows($q);
        $bank = $this->Bank_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data']  = array(
            'bank_data' => $bank,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix

    }

    public function read($id) 
    {
        $row = $this->Bank_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'bank_name' => $row->bank_name,
		'branch' => $row->branch,
		'bank_norek' => $row->bank_norek,
		'bank_rek_name' => $row->bank_rek_name,
        'gl_account' => $row->gl_account,
		'cr_dt' => $row->cr_dt,
	    );
            
            $this->load->view('bank/fin_bank_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bank'));
        }
    }

    public function create() 
    {
        $this->VIEW_FILE = "bank/fin_bank_form"; 

        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('Report/Bank/create_action'),
	    'id' => set_value('id'),
	    'bank_name' => set_value('bank_name'),
	    'branch' => set_value('branch'),
	    'bank_norek' => set_value('bank_norek'),
	    'bank_rek_name' => set_value('bank_rek_name'),
        'currency_code' => set_value('currency_code'),
        'gl_account' => set_value('gl_account'),
	    'cr_dt' => set_value('cr_dt'),
	);
    $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
            $this->session->set_flashdata('message', 'Create Record Error');
            $this->session->set_flashdata('status', 'alert-danger');
        } else {
            $data = array(
		'bank_name' => $this->input->post('bank_name',TRUE),
		'branch' => $this->input->post('branch',TRUE),
		'bank_norek' => $this->input->post('bank_norek',TRUE),
       	'bank_rek_name' => $this->input->post('bank_rek_name',TRUE),
        'currency_code' => $this->input->post('currency_code',TRUE),
        'gl_account' => $this->input->post('gl_account',TRUE),
		'cr_dt' => date('Y-m-d H:i:s', strtotime("now")),
	    );

            $this->Bank_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('Report/Bank'));
        }
    }
    
    public function update($id) 
    {
        
        $this->VIEW_FILE = "bank/fin_bank_form"; 

        $load_resource = $this->load_resource(); // digawe ngene ikie

        $row = $this->Bank_model->get_by_id($id);
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/Bank/update_action'),
		'id' => set_value('id', $row->id),
		'bank_name' => set_value('bank_name', $row->bank_name),
		'branch' => set_value('branch', $row->branch),
		'bank_norek' => set_value('bank_norek', $row->bank_norek),
		'gl_account' => set_value('gl_account', $row->gl_account),
        'currency_code' => set_value('currency_code', $row->currency_code),
        'branch' => set_value('branch', $row->branch),
        'bank_rek_name' => set_value('bank_rek_name', $row->bank_rek_name),
		'cr_dt' => set_value('cr_dt', $row->cr_dt),
	    );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Bank'));
        }
        
        

    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'bank_name' => $this->input->post('bank_name',TRUE),
		'branch' => $this->input->post('branch',TRUE),
		'bank_norek' => $this->input->post('bank_norek',TRUE),
        'gl_account' => $this->input->post('gl_account',TRUE),
        'currency_code' => $this->input->post('currency_code',TRUE),
		'bank_rek_name' => $this->input->post('bank_rek_name',TRUE),
		
	    );

            $this->Bank_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('status', 'alert-success');
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Report/Bank'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bank_model->get_by_id($id);

        if ($row) {
            $this->Bank_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('status', 'alert-warning');
            redirect(site_url('Report/Bank'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Bank'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');
	$this->form_validation->set_rules('bank_norek', 'bank norek', 'trim|required');
	$this->form_validation->set_rules('bank_rek_name', 'bank rek name', 'trim|required');
	

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fin_bank.xls";
        $judul = "fin_bank";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Norek");
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Rek Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Cr Dt");

	foreach ($this->Bank_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank_code);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank_norek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank_rek_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cr_dt);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Bank.php */
/* Location: ./application/controllers/Bank.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-13 04:29:15 */
/* http://harviacode.com */