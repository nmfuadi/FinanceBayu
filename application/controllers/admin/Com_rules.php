<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Com_rules extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Com_rules_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'com_rules/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'com_rules/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'com_rules/index.html';
            $config['first_url'] = base_url() . 'com_rules/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Com_rules_model->total_rows($q);
        $com_rules = $this->Com_rules_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'com_rules_data' => $com_rules,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('com_rules/com_rules_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Com_rules_model->get_by_id($id);
        if ($row) {
            $data = array(
		'rules_id' => $row->rules_id,
		'portal_id' => $row->portal_id,
		'user_id' => $row->user_id,
		'rules_name' => $row->rules_name,
		'description' => $row->description,
		'cu' => $row->cu,
		'cd' => $row->cd,
	    );
            $this->load->view('com_rules/com_rules_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('com_rules/create_action'),
	    'rules_id' => set_value('rules_id'),
	    'portal_id' => set_value('portal_id'),
	    'user_id' => set_value('user_id'),
	    'rules_name' => set_value('rules_name'),
	    'description' => set_value('description'),
	    'cu' => set_value('cu'),
	    'cd' => set_value('cd'),
	);
        $this->load->view('com_rules/com_rules_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'portal_id' => $this->input->post('portal_id',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'rules_name' => $this->input->post('rules_name',TRUE),
		'description' => $this->input->post('description',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_rules_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('com_rules'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Com_rules_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('com_rules/update_action'),
		'rules_id' => set_value('rules_id', $row->rules_id),
		'portal_id' => set_value('portal_id', $row->portal_id),
		'user_id' => set_value('user_id', $row->user_id),
		'rules_name' => set_value('rules_name', $row->rules_name),
		'description' => set_value('description', $row->description),
		'cu' => set_value('cu', $row->cu),
		'cd' => set_value('cd', $row->cd),
	    );
            $this->load->view('com_rules/com_rules_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('rules_id', TRUE));
        } else {
            $data = array(
		'portal_id' => $this->input->post('portal_id',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'rules_name' => $this->input->post('rules_name',TRUE),
		'description' => $this->input->post('description',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_rules_model->update($this->input->post('rules_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('com_rules'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Com_rules_model->get_by_id($id);

        if ($row) {
            $this->Com_rules_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('com_rules'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_rules'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('portal_id', 'portal id', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('rules_name', 'rules name', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('cu', 'cu', 'trim|required');
	$this->form_validation->set_rules('cd', 'cd', 'trim|required');

	$this->form_validation->set_rules('rules_id', 'rules_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Com_rules.php */
/* Location: ./application/controllers/Com_rules.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-16 11:12:21 */
/* http://harviacode.com */