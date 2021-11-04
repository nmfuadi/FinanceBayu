<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class Com_user extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Com_user_model');
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_project');
		$this->load->model('M_general');
		$this->load->model('M_Admin');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('AntiXSS');
		
    }

    public function index()
    {
		$this->VIEW_FILE = "admin/com_user/com_user_list";
		$load_resource = $this->load_resource();
		
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/com_user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/com_user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/com_user/index.html';
            $config['first_url'] = base_url() . 'admin/com_user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Com_user_model->total_rows($q);
        $com_user = $this->Com_user_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

	$load_resource['data'] = array(
            'com_user_data' => $com_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
		$this->load->view($this->MAIN_VIEW, $load_resource);

    }

    public function read($id) 
    {
		$this->VIEW_FILE = "admin/com_user/com_user_read";
		$load_resource = $this->load_resource();
		
        $row = $this->Com_user_model->get_by_id($id);
        if ($row) {
            $load_resource['data'] = array(
		'id_user' => $row->id_user,
		'username' => $row->username,
		'passwords' => $row->passwords,
		'surename' => $row->surename,
		'email' => $row->email,
		'level' => $row->level,
		'is_active' => $row->is_active,
		'uc' => $row->uc,
		'dc' => $row->dc,
	    );
			$this->load->view($this->MAIN_VIEW, $load_resource);
           
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/com_user'));
        }
    }

    public function create() 
    {
		$this->VIEW_FILE = "admin/com_user/com_user_form";
		$load_resource = $this->load_resource();
        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('admin/com_user/create_action'),
	    'id_user' => set_value('id_user'),
	    'username' => set_value('username'),
	    'passwords' => set_value('passwords'),
	    'surename' => set_value('surename'),
	    'email' => set_value('email'),
	    'level' => set_value('level'),
	    'is_active' => set_value('is_active'),
	    'uc' => set_value('uc'),
	    'dc' => set_value('dc'),
	);
        $this->load->view($this->MAIN_VIEW, $load_resource);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			 $this->session->set_flashdata('message', 'erro validation');
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'passwords' => md5($this->input->post('passwords',TRUE)),
		'surename' => $this->input->post('surename',TRUE),
		'email' => $this->input->post('email',TRUE),
		'level' => $this->input->post('level',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'uc' => $this->session->userdata('portal'),
		'dc' => date("Y-m-d H:i:s")
	    );

            $this->Com_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/com_user'));
        }
    }
    
    public function update($id) 
    {
		$this->VIEW_FILE = "admin/com_user/com_user_form";
		$load_resource = $this->load_resource();
        $row = $this->Com_user_model->get_by_id($id);

        if ($row) {
           $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('admin/com_user/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'username' => set_value('username', $row->username),
		'passwords' => set_value('passwords', $row->passwords),
		'surename' => set_value('surename', $row->surename),
		'email' => set_value('email', $row->email),
		'level' => set_value('level', $row->level),
		'is_active' => set_value('is_active', $row->is_active),
		'uc' => set_value('uc', $row->uc),
		'dc' => set_value('dc', $row->dc),
	    );	
		
		$this->load->view($this->MAIN_VIEW, $load_resource);
         } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/com_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'passwords' => md5($this->input->post('passwords',TRUE)),
		'surename' => $this->input->post('surename',TRUE),
		'email' => $this->input->post('email',TRUE),
		'level' => $this->input->post('level',TRUE),
		'is_active' => $this->input->post('is_active',TRUE),
		'uc' => $this->input->post('uc',TRUE),
		'dc' => $this->input->post('dc',TRUE),
	    );

            $this->Com_user_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/com_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Com_user_model->get_by_id($id);

        if ($row) {
            $this->Com_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/com_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/com_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('passwords', 'passwords', 'trim|required');
	$this->form_validation->set_rules('surename', 'surename', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');
	$this->form_validation->set_rules('is_active', 'is active', 'trim|required');
	//$this->form_validation->set_rules('uc', 'uc', 'trim|required');
	//$this->form_validation->set_rules('dc', 'dc', 'trim|required');

	//$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Com_user.php */
/* Location: ./application/controllers/Com_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-16 11:12:32 */
/* http://harviacode.com */