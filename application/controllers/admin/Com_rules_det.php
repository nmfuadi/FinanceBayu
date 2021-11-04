<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Com_rules_det extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Com_rules_det_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'com_rules_det/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'com_rules_det/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'com_rules_det/index.html';
            $config['first_url'] = base_url() . 'com_rules_det/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Com_rules_det_model->total_rows($q);
        $com_rules_det = $this->Com_rules_det_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'com_rules_det_data' => $com_rules_det,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('com_rules_det/com_rules_det_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Com_rules_det_model->get_by_id($id);
        if ($row) {
            $data = array(
		'user_id' => $row->user_id,
		'rules_id' => $row->rules_id,
	    );
            $this->load->view('com_rules_det/com_rules_det_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules_det'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('com_rules_det/create_action'),
	    'user_id' => set_value('user_id'),
	    'rules_id' => set_value('rules_id'),
	);
        $this->load->view('com_rules_det/com_rules_det_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'rules_id' => $this->input->post('rules_id',TRUE),
	    );

            $this->Com_rules_det_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('com_rules_det'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Com_rules_det_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('com_rules_det/update_action'),
		'user_id' => set_value('user_id', $row->user_id),
		'rules_id' => set_value('rules_id', $row->rules_id),
	    );
            $this->load->view('com_rules_det/com_rules_det_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules_det'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'rules_id' => $this->input->post('rules_id',TRUE),
	    );

            $this->Com_rules_det_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('com_rules_det'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Com_rules_det_model->get_by_id($id);

        if ($row) {
            $this->Com_rules_det_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('com_rules_det'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules_det'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('rules_id', 'rules id', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Com_rules_det.php */
/* Location: ./application/controllers/Com_rules_det.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-16 11:12:27 */
/* http://harviacode.com */