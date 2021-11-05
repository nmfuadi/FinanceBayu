<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'account/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'account/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'account/index.html';
            $config['first_url'] = base_url() . 'account/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Account_model->total_rows($q);
        $account = $this->Account_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'account_data' => $account,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('account/fin_account_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Account_model->get_by_id($id);
        if ($row) {
            $data = array(
		'code' => $row->code,
		'account_name' => $row->account_name,
	    );
            $this->load->view('account/fin_account_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('account'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('account/create_action'),
	    'code' => set_value('code'),
	    'account_name' => set_value('account_name'),
	);
        $this->load->view('account/fin_account_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'account_name' => $this->input->post('account_name',TRUE),
	    );

            $this->Account_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('account'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Account_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('account/update_action'),
		'code' => set_value('code', $row->code),
		'account_name' => set_value('account_name', $row->account_name),
	    );
            $this->load->view('account/fin_account_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('account'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('code', TRUE));
        } else {
            $data = array(
		'account_name' => $this->input->post('account_name',TRUE),
	    );

            $this->Account_model->update($this->input->post('code', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('account'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Account_model->get_by_id($id);

        if ($row) {
            $this->Account_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('account'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('account'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('account_name', 'account name', 'trim|required');

	$this->form_validation->set_rules('code', 'code', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fin_account.xls";
        $judul = "fin_account";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Account Name");

	foreach ($this->Account_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->account_name);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-13 03:24:16 */
/* http://harviacode.com */