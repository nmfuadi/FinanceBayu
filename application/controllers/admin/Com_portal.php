<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Com_portal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Com_portal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'com_portal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'com_portal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'com_portal/index.html';
            $config['first_url'] = base_url() . 'com_portal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Com_portal_model->total_rows($q);
        $com_portal = $this->Com_portal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'com_portal_data' => $com_portal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('com_portal/com_portal_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Com_portal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'portal_id' => $row->portal_id,
		'portal_name' => $row->portal_name,
		'portal_des' => $row->portal_des,
		'is_active' => $row->is_active,
		'cu' => $row->cu,
		'cd' => $row->cd,
	    );
            $this->load->view('com_portal/com_portal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_portal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('com_portal/create_action'),
	    'portal_id' => set_value('portal_id'),
	    'portal_name' => set_value('portal_name'),
	    'portal_des' => set_value('portal_des'),
	    'is_active' => set_value('is_active'),
	    'cu' => set_value('cu'),
	    'cd' => set_value('cd'),
	);
        $this->load->view('com_portal/com_portal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'portal_name' => $this->input->post('portal_name',TRUE),
		'portal_des' => $this->input->post('portal_des',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_portal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('com_portal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Com_portal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('com_portal/update_action'),
		'portal_id' => set_value('portal_id', $row->portal_id),
		'portal_name' => set_value('portal_name', $row->portal_name),
		'portal_des' => set_value('portal_des', $row->portal_des),
		'is_active' => set_value('is_active', $row->is_active),
		'cu' => set_value('cu', $row->cu),
		'cd' => set_value('cd', $row->cd),
	    );
            $this->load->view('com_portal/com_portal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_portal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('portal_id', TRUE));
        } else {
            $data = array(
		'portal_name' => $this->input->post('portal_name',TRUE),
		'portal_des' => $this->input->post('portal_des',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_portal_model->update($this->input->post('portal_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('com_portal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Com_portal_model->get_by_id($id);

        if ($row) {
            $this->Com_portal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('com_portal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_portal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('portal_name', 'portal name', 'trim|required');
	$this->form_validation->set_rules('portal_des', 'portal des', 'trim|required');
	$this->form_validation->set_rules('is_active', 'is active', 'trim|required');
	$this->form_validation->set_rules('cu', 'cu', 'trim|required');
	$this->form_validation->set_rules('cd', 'cd', 'trim|required');

	$this->form_validation->set_rules('portal_id', 'portal_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Com_portal.php */
/* Location: ./application/controllers/Com_portal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-16 11:12:15 */
/* http://harviacode.com */