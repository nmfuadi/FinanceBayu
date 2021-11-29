<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    // load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

class SaldoAwal extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('SaldoAwalModel');
        $this->load->library('form_validation');
        $this->load->model('M_Admin');
    }

    public function index()
    {
        $this->VIEW_FILE = "saldoawal/fin_saldo_list"; 
        $load_resource = $this->load_resource(); // digawe ngene ikie

       
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'saldoawal/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'saldoawal/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'saldoawal/index';
            $config['first_url'] = base_url() . 'saldoawal/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->SaldoAwalModel->total_rows($q);
        $saldoawal = $this->SaldoAwalModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'saldoawal_data' => $saldoawal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
      
    }

    public function read($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'bank_id' => $row->bank_id,
		'currancy' => $row->currancy,
		'amount' => $row->amount,
		'original_amount' => $row->original_amount,
		'trx_date' => $row->trx_date,
		'input_date' => $row->input_date,
	    );
            $this->load->view('saldoawal/fin_saldo_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('saldoawal/create_action'),
	    'id' => set_value('id'),
	    'bank_id' => set_value('bank_id'),
	    'currancy' => set_value('currancy'),
	    'amount' => set_value('amount'),
	    'original_amount' => set_value('original_amount'),
	    'trx_date' => set_value('trx_date'),
	    'input_date' => set_value('input_date'),
	);
        $this->load->view('saldoawal/fin_saldo_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'bank_id' => $this->input->post('bank_id',TRUE),
		'currancy' => $this->input->post('currancy',TRUE),
		'amount' => $this->input->post('amount',TRUE),
		'original_amount' => $this->input->post('original_amount',TRUE),
		'trx_date' => $this->input->post('trx_date',TRUE),
		'input_date' => $this->input->post('input_date',TRUE),
	    );

            $this->SaldoAwalModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('saldoawal/update_action'),
		'id' => set_value('id', $row->id),
		'bank_id' => set_value('bank_id', $row->bank_id),
		'currancy' => set_value('currancy', $row->currancy),
		'amount' => set_value('amount', $row->amount),
		'original_amount' => set_value('original_amount', $row->original_amount),
		'trx_date' => set_value('trx_date', $row->trx_date),
		'input_date' => set_value('input_date', $row->input_date),
	    );
            $this->load->view('saldoawal/fin_saldo_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'bank_id' => $this->input->post('bank_id',TRUE),
		'currancy' => $this->input->post('currancy',TRUE),
		'amount' => $this->input->post('amount',TRUE),
		'original_amount' => $this->input->post('original_amount',TRUE),
		'trx_date' => $this->input->post('trx_date',TRUE),
		'input_date' => $this->input->post('input_date',TRUE),
	    );

            $this->SaldoAwalModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);

        if ($row) {
            $this->SaldoAwalModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saldoawal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('bank_id', 'bank id', 'trim|required');
	$this->form_validation->set_rules('currancy', 'currancy', 'trim|required');
	$this->form_validation->set_rules('amount', 'amount', 'trim|required');
	$this->form_validation->set_rules('original_amount', 'original amount', 'trim|required');
	$this->form_validation->set_rules('trx_date', 'trx date', 'trim|required');
	$this->form_validation->set_rules('input_date', 'input date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fin_saldo.xls";
        $judul = "fin_saldo";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Currancy");
	xlsWriteLabel($tablehead, $kolomhead++, "Amount");
	xlsWriteLabel($tablehead, $kolomhead++, "Original Amount");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Input Date");

	foreach ($this->SaldoAwalModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bank_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->currancy);
	    xlsWriteLabel($tablebody, $kolombody++, $data->amount);
	    xlsWriteLabel($tablebody, $kolombody++, $data->original_amount);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trx_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->input_date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file SaldoAwal.php */
/* Location: ./application/controllers/SaldoAwal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-26 03:26:24 */
/* http://harviacode.com */