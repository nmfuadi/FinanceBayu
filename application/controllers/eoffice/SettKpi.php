<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once( APPPATH . 'controllers/base/BaseReport.php' );

class SettKpi extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_SetKpi');
		$this->load->model('M_KpiSales');
        $this->load->library('form_validation');
    }

    public function index()
    {
         $this->VIEW_FILE = "eoffice/SettKpi/st_kpi_sett_list"; // dynamic
         $load_resource = $this->load_resource(); 
       

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'eoffice/SettKpi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'eoffice/SettKpi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'eoffice/SettKpi/index.html';
            $config['first_url'] = base_url() . 'eoffice/SettKpi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_SetKpi->total_rows($q);
        $SettKpi = $this->M_SetKpi->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'SettKpi_data' => $SettKpi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

         $this->load->view($this->MAIN_VIEW, $load_resource); // fix

       // $this->load->view('eoffice/ettkpi/st_kpi_sett_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_SetKpi->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kpi_name' => $row->kpi_name,
		'kpi_value' => $row->kpi_value,
		'kpi_weight' => $row->kpi_weight,
		'dt_cr' => $row->dt_cr,
		'u_dt' => $row->u_dt,
	    );
             $this->load->view($this->MAIN_VIEW, $load_resource); 

           // $this->load->view('eoffice/SettKpi/st_kpi_sett_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('eoffice/SettKpi'));
        }
    }

    public function create() 
    {
        $this->VIEW_FILE = "eoffice/SettKpi/st_kpi_sett_form"; // dynamic
         $load_resource = $this->load_resource(); 

         $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('eoffice/SettKpi/create_action'),
	    'id' => set_value('id'),
	    'kpi_name' => set_value('kpi_name'),
	    'kpi_value' => set_value('kpi_value'),
	    'kpi_weight' => set_value('kpi_weight'),
	  //  'dt_cr' => set_value('dt_cr'),
	   // 'u_dt' => set_value('u_dt'),
	);
        $this->load->view($this->MAIN_VIEW, $load_resource); 
       // $this->load->view('eoffice/SettKpi/st_kpi_sett_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $datetime = date("Y-m-d H:i:s");

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kpi_name' => $this->input->post('kpi_name',TRUE),
		'kpi_value' => $this->input->post('kpi_value',TRUE),
		'kpi_weight' => $this->input->post('kpi_weight',TRUE),
		'dt_cr' => $datetime,
		'u_dt' => $this->session->userdata('u'),
	    );

            $this->M_SetKpi->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('eoffice/SettKpi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_SetKpi->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('eoffice/SettKpi/update_action'),
		'id' => set_value('id', $row->id),
		'kpi_name' => set_value('kpi_name', $row->kpi_name),
		'kpi_value' => set_value('kpi_value', $row->kpi_value),
		'kpi_weight' => set_value('kpi_weight', $row->kpi_weight),
		'dt_cr' => set_value('dt_cr', $row->dt_cr),
		'u_dt' => set_value('u_dt', $row->u_dt),
	    );
            $this->load->view('eoffice/SettKpi/st_kpi_sett_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('SettKpi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kpi_name' => $this->input->post('kpi_name',TRUE),
		'kpi_value' => $this->input->post('kpi_value',TRUE),
		'kpi_weight' => $this->input->post('kpi_weight',TRUE),
		'dt_cr' => $this->input->post('dt_cr',TRUE),
		'u_dt' => $this->input->post('u_dt',TRUE),
	    );

            $this->M_SetKpi->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('eoffice/SettKpi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_SetKpi->get_by_id($id);

        if ($row) {
            $this->M_SetKpi->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('eoffice/SettKpi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('eoffice/SettKpi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kpi_name', 'kpi name', 'trim|required');
	$this->form_validation->set_rules('kpi_value', 'kpi value', 'trim|required|numeric');
	$this->form_validation->set_rules('kpi_weight', 'kpi weight', 'trim|required');
	

	
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "st_kpi_sett.xls";
        $judul = "st_kpi_sett";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kpi Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Kpi Value");
	xlsWriteLabel($tablehead, $kolomhead++, "Kpi Weight");
	xlsWriteLabel($tablehead, $kolomhead++, "Dt Cr");
	xlsWriteLabel($tablehead, $kolomhead++, "U Dt");

	foreach ($this->M_SetKpi->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kpi_name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kpi_value);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kpi_weight);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dt_cr);
	    xlsWriteNumber($tablebody, $kolombody++, $data->u_dt);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file SettKpi.php */
/* Location: ./application/controllers/SettKpi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-17 09:59:54 */
/* http://harviacode.com */