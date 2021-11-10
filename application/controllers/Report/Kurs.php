<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

class Kurs extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kurs_model');
        $this->load->library('form_validation');
        $this->load->model('M_Admin');
    }

    public function index()
    {
        $this->VIEW_FILE = "kurs/fin_kurs_name_list";

        $load_resource = $this->load_resource(); // digawe ngene ikie

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/kurs/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Report/kurs/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Report/kurs/index';
            $config['first_url'] = base_url() . 'Report/kurs/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kurs_model->total_rows($q);
        $kurs = $this->Kurs_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'kurs_data' => $kurs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function read($id) 
    {
        $row = $this->Kurs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kurs_code' => $row->kurs_code,
		'Kurs_det' => $row->Kurs_det,
	    );
            $this->load->view('kurs/fin_kurs_name_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kurs'));
        }
    }

    public function create() 
    {
        $this->VIEW_FILE = "kurs/fin_kurs_name_form";
        $load_resource = $this->load_resource(); // digawe ngene ikie

        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('Report/kurs/create_action'),
	    'kurs_code' => set_value('kurs_code'),
        'kurs' => set_value('kurs'),
	    'Kurs_det' => set_value('Kurs_det'),
	);
    $this->load->view($this->MAIN_VIEW, $load_resource); // fix
       
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
         'Kurs_code' => $this->input->post('kurs',TRUE),
		'Kurs_det' => $this->input->post('Kurs_det',TRUE),
	    );

            $this->Kurs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Report/kurs'));
        }
    }
    
    public function update($id) 
    {
        $this->VIEW_FILE = "kurs/fin_kurs_name_form";
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $row = $this->Kurs_model->get_by_id($id);

        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/kurs/update_action'),
		'kurs_code' => set_value('kurs_code', $row->kurs_code),
		'Kurs_det' => set_value('Kurs_det', $row->Kurs_det),
        'kurs' => set_value('kurs', $row->kurs_code)
	    );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/kurs'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kurs_code', TRUE));
        } else {
            $data = array(
		'Kurs_det' => $this->input->post('Kurs_det',TRUE),
        'kurs_code' =>  $this->input->post('kurs',TRUE)
	    );

            $this->Kurs_model->update($this->input->post('kurs_code', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Report/Kurs'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kurs_model->get_by_id($id);

        if ($row) {
            $this->Kurs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Report/kurs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/kurs'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('Kurs_det', 'kurs det', 'trim|required');

	$this->form_validation->set_rules('kurs_code', 'kurs_code', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kurs.php */
/* Location: ./application/controllers/Kurs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-10 09:20:48 */
/* http://harviacode.com */