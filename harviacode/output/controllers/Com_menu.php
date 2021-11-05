<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Com_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Com_menu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'com_menu/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'com_menu/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'com_menu/index.html';
            $config['first_url'] = base_url() . 'com_menu/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Com_menu_model->total_rows($q);
        $com_menu = $this->Com_menu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'com_menu_data' => $com_menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('com_menu/com_menu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Com_menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'menu_id' => $row->menu_id,
		'rules_id' => $row->rules_id,
		'parent_id' => $row->parent_id,
		'menu_name' => $row->menu_name,
		'description' => $row->description,
		'number' => $row->number,
		'url' => $row->url,
		'is_active' => $row->is_active,
		'cu' => $row->cu,
		'cd' => $row->cd,
	    );
            $this->load->view('com_menu/com_menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('com_menu/create_action'),
	    'menu_id' => set_value('menu_id'),
	    'rules_id' => set_value('rules_id'),
	    'parent_id' => set_value('parent_id'),
	    'menu_name' => set_value('menu_name'),
	    'description' => set_value('description'),
	    'number' => set_value('number'),
	    'url' => set_value('url'),
	    'is_active' => set_value('is_active'),
	    'cu' => set_value('cu'),
	    'cd' => set_value('cd'),
	);
        $this->load->view('com_menu/com_menu_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'rules_id' => $this->input->post('rules_id',TRUE),
		'parent_id' => $this->input->post('parent_id',TRUE),
		'menu_name' => $this->input->post('menu_name',TRUE),
		'description' => $this->input->post('description',TRUE),
		'number' => $this->input->post('number',TRUE),
		'url' => $this->input->post('url',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('com_menu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Com_menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('com_menu/update_action'),
		'menu_id' => set_value('menu_id', $row->menu_id),
		'rules_id' => set_value('rules_id', $row->rules_id),
		'parent_id' => set_value('parent_id', $row->parent_id),
		'menu_name' => set_value('menu_name', $row->menu_name),
		'description' => set_value('description', $row->description),
		'number' => set_value('number', $row->number),
		'url' => set_value('url', $row->url),
		'is_active' => set_value('is_active', $row->is_active),
		'cu' => set_value('cu', $row->cu),
		'cd' => set_value('cd', $row->cd),
	    );
            $this->load->view('com_menu/com_menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('menu_id', TRUE));
        } else {
            $data = array(
		'rules_id' => $this->input->post('rules_id',TRUE),
		'parent_id' => $this->input->post('parent_id',TRUE),
		'menu_name' => $this->input->post('menu_name',TRUE),
		'description' => $this->input->post('description',TRUE),
		'number' => $this->input->post('number',TRUE),
		'url' => $this->input->post('url',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'cu' => $this->input->post('cu',TRUE),
		'cd' => $this->input->post('cd',TRUE),
	    );

            $this->Com_menu_model->update($this->input->post('menu_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('com_menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Com_menu_model->get_by_id($id);

        if ($row) {
            $this->Com_menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('com_menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('com_menu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('rules_id', 'rules id', 'trim|required');
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
	$this->form_validation->set_rules('menu_name', 'menu name', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');
	$this->form_validation->set_rules('number', 'number', 'trim|required');
	$this->form_validation->set_rules('url', 'url', 'trim|required');
	$this->form_validation->set_rules('is_active', 'is active', 'trim|required');
	$this->form_validation->set_rules('cu', 'cu', 'trim|required');
	$this->form_validation->set_rules('cd', 'cd', 'trim|required');

	$this->form_validation->set_rules('menu_id', 'menu_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Com_menu.php */
/* Location: ./application/controllers/Com_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-16 09:57:37 */
/* http://harviacode.com */