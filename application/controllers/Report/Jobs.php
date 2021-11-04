<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('JobsModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jobs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jobs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jobs/index.html';
            $config['first_url'] = base_url() . 'jobs/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->JobsModel->total_rows($q);
        $jobs = $this->JobsModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jobs_data' => $jobs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('jobs/jr_jobs_list', $data);
    }

    public function read($id) 
    {
        $row = $this->JobsModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'jobs_code' => $row->jobs_code,
		'kry_id' => $row->kry_id,
		'jobs_tittle' => $row->jobs_tittle,
		'jobs_desc' => $row->jobs_desc,
		'jobs_stat' => $row->jobs_stat,
		'jobs_date' => $row->jobs_date,
		'jobs_week' => $row->jobs_week,
		'cr_dt' => $row->cr_dt,
		'cr_up' => $row->cr_up,
		'u_cr' => $row->u_cr,
	    );
            $this->load->view('jobs/jr_jobs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jobs'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jobs/create_action'),
	    'id' => set_value('id'),
	    'jobs_code' => set_value('jobs_code'),
	    'kry_id' => set_value('kry_id'),
	    'jobs_tittle' => set_value('jobs_tittle'),
	    'jobs_desc' => set_value('jobs_desc'),
	    'jobs_stat' => set_value('jobs_stat'),
	    'jobs_date' => set_value('jobs_date'),
	    'jobs_week' => set_value('jobs_week'),
	    'cr_dt' => set_value('cr_dt'),
	    'cr_up' => set_value('cr_up'),
	    'u_cr' => set_value('u_cr'),
	);
        $this->load->view('jobs/jr_jobs_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jobs_code' => $this->input->post('jobs_code',TRUE),
		'kry_id' => $this->input->post('kry_id',TRUE),
		'jobs_tittle' => $this->input->post('jobs_tittle',TRUE),
		'jobs_desc' => $this->input->post('jobs_desc',TRUE),
		'jobs_stat' => $this->input->post('jobs_stat',TRUE),
		'jobs_date' => $this->input->post('jobs_date',TRUE),
		'jobs_week' => $this->input->post('jobs_week',TRUE),
		'cr_dt' => $this->input->post('cr_dt',TRUE),
		'cr_up' => $this->input->post('cr_up',TRUE),
		'u_cr' => $this->input->post('u_cr',TRUE),
	    );

            $this->JobsModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jobs'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->JobsModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jobs/update_action'),
		'id' => set_value('id', $row->id),
		'jobs_code' => set_value('jobs_code', $row->jobs_code),
		'kry_id' => set_value('kry_id', $row->kry_id),
		'jobs_tittle' => set_value('jobs_tittle', $row->jobs_tittle),
		'jobs_desc' => set_value('jobs_desc', $row->jobs_desc),
		'jobs_stat' => set_value('jobs_stat', $row->jobs_stat),
		'jobs_date' => set_value('jobs_date', $row->jobs_date),
		'jobs_week' => set_value('jobs_week', $row->jobs_week),
		'cr_dt' => set_value('cr_dt', $row->cr_dt),
		'cr_up' => set_value('cr_up', $row->cr_up),
		'u_cr' => set_value('u_cr', $row->u_cr),
	    );
            $this->load->view('jobs/jr_jobs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jobs'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'jobs_code' => $this->input->post('jobs_code',TRUE),
		'kry_id' => $this->input->post('kry_id',TRUE),
		'jobs_tittle' => $this->input->post('jobs_tittle',TRUE),
		'jobs_desc' => $this->input->post('jobs_desc',TRUE),
		'jobs_stat' => $this->input->post('jobs_stat',TRUE),
		'jobs_date' => $this->input->post('jobs_date',TRUE),
		'jobs_week' => $this->input->post('jobs_week',TRUE),
		'cr_dt' => $this->input->post('cr_dt',TRUE),
		'cr_up' => $this->input->post('cr_up',TRUE),
		'u_cr' => $this->input->post('u_cr',TRUE),
	    );

            $this->JobsModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jobs'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->JobsModel->get_by_id($id);

        if ($row) {
            $this->JobsModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jobs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jobs'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jobs_code', 'jobs code', 'trim|required');
	$this->form_validation->set_rules('kry_id', 'kry id', 'trim|required');
	$this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
	$this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
	$this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
	$this->form_validation->set_rules('jobs_date', 'jobs date', 'trim|required');
	$this->form_validation->set_rules('jobs_week', 'jobs week', 'trim|required');
	$this->form_validation->set_rules('cr_dt', 'cr dt', 'trim|required');
	$this->form_validation->set_rules('cr_up', 'cr up', 'trim|required');
	$this->form_validation->set_rules('u_cr', 'u cr', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jr_jobs.xls";
        $judul = "jr_jobs";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Code");
	xlsWriteLabel($tablehead, $kolomhead++, "Kry Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Tittle");
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Desc");
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Stat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Jobs Week");
	xlsWriteLabel($tablehead, $kolomhead++, "Cr Dt");
	xlsWriteLabel($tablehead, $kolomhead++, "Cr Up");
	xlsWriteLabel($tablehead, $kolomhead++, "U Cr");

	foreach ($this->JobsModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jobs_code);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kry_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jobs_tittle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jobs_desc);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jobs_stat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jobs_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jobs_week);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cr_dt);
	    xlsWriteLabel($tablebody, $kolombody++, $data->cr_up);
	    xlsWriteNumber($tablebody, $kolombody++, $data->u_cr);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jr_jobs.doc");

        $data = array(
            'jr_jobs_data' => $this->JobsModel->get_all(),
            'start' => 0
        );
        
        $this->load->view('jobs/jr_jobs_doc',$data);
    }

}

/* End of file Jobs.php */
/* Location: ./application/controllers/Jobs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-20 08:48:09 */
/* http://harviacode.com */