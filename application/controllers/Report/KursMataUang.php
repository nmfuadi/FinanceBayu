<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

class KursMataUang extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('KursMataUangModel');
        $this->load->library('form_validation');
        $this->load->model('M_Admin');
    }

    public function index()
    {
        $this->VIEW_FILE = "KursMataUang/fin_kurs_list"; 
        $load_resource = $this->load_resource(); // digawe ngene ikie

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'KursMataUang/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'KursMataUang/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'KursMataUang/index';
            $config['first_url'] = base_url() . 'KursMataUang/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->KursMataUangModel->total_rows($q);
        $KursMataUang = $this->KursMataUangModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'KursMataUang_data' => $KursMataUang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function read($id) 
    {
        $row = $this->KursMataUangModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kurs_code' => $row->kurs_code,
		'kurs_amount' => $row->kurs_amount,
		'kurs_date' => $row->kurs_date,
		'input_date' => $row->input_date,
	    );
            $this->load->view('KursMataUang/fin_kurs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('KursMataUang'));
        }
    }

    public function create() 
    {
        $this->VIEW_FILE = "KursMataUang/fin_kurs_form"; 
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['data']  = array(
            'button' => 'Create',
            'action' => site_url('Report/KursMataUang/create_action'),
	    'id' => set_value('id'),
	    'kurs_code' => set_value('kurs_code'),
	    'kurs_amount' => set_value('kurs_amount'),
	    'kurs_date' => set_value('kurs_date'),
	    'input_date' => set_value('input_date'),
	);
       
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $dataPost = date('Y-m-d H:i:s', strtotime("now"));
            $data = array(
		'kurs_code' => $this->input->post('kurs_code',TRUE),
		'kurs_amount' => $this->input->post('kurs_amount',TRUE),
		'kurs_date' => $this->input->post('kurs_date',TRUE),
		'input_date' => $dataPost,
	    );

            $this->KursMataUangModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Report/KursMataUang/'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->KursMataUangModel->get_by_id($id);
        $this->VIEW_FILE = "KursMataUang/fin_kurs_form"; 
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/KursMataUang/update_action'),
		'id' => set_value('id', $row->id),
		'kurs_code' => set_value('kurs_code', $row->kurs_code),
		'kurs_amount' => set_value('kurs_amount', $row->kurs_amount),
		'kurs_date' => set_value('kurs_date', $row->kurs_date),
		'input_date' => set_value('input_date', $row->input_date),
	    );
            $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/KursMataUang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kurs_code' => $this->input->post('kurs_code',TRUE),
		'kurs_amount' => $this->input->post('kurs_amount',TRUE),
		'kurs_date' => $this->input->post('kurs_date',TRUE),
	
	    );

            $this->KursMataUangModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Report/KursMataUang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->KursMataUangModel->get_by_id($id);

        if ($row) {
            $this->KursMataUangModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('KursMataUang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('KursMataUang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kurs_code', 'kurs code', 'trim|required');
	$this->form_validation->set_rules('kurs_amount', 'kurs amount', 'trim|required|numeric');
	$this->form_validation->set_rules('kurs_date', 'kurs date', 'trim|required');


	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file KursMataUang.php */
/* Location: ./application/controllers/KursMataUang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-12 03:51:19 */
/* http://harviacode.com */