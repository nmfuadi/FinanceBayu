<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

class Account extends AppBase
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->library('form_validation');
        $this->load->model('M_Admin');
    }

    public function index()
    {
        $this->VIEW_FILE = "account/fin_account_list";

        $load_resource = $this->load_resource(); // digawe ngene ikie

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/Account/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Report/Account/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Report/Account/index';
            $config['first_url'] = base_url() . 'Report/Account/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Account_model->total_rows($q);
        $account = $this->Account_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $load_resource['data'] = array(
            'account_data' => $account,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view($this->MAIN_VIEW, $load_resource); // fix

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
        $this->VIEW_FILE = "account/fin_account_form";

        $load_resource = $this->load_resource(); // digawe ngene ikie


        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('Report/Account/create_action'),
            'code_acc' => set_value('code_acc'),
            'trx_type' => set_value('trx_type'),
            'account_name' => set_value('account_name'),
        );

        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Form not Completely');
            $this->session->set_flashdata('status', 'alert-danger');
            $this->create();
        } else {
            $cek = $this->M_Admin->cek_avail('fin_account', 'code', $this->input->post('code_acc', TRUE));

            if ($cek > 0) {

                $this->session->set_flashdata('message', 'Account Code Already Exist, Please Change Number');
                $this->session->set_flashdata('status', 'alert-danger');
                $this->create();
            } else {

                $data = array(
                    'account_name' => $this->input->post('account_name', TRUE),
                    'code' => $this->input->post('code_acc', TRUE),
                    'trx_type' => $this->input->post('trx_type', TRUE),
                );

                $this->Account_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                $this->session->set_flashdata('status', 'alert-succes');
                redirect(site_url('Report/Account'));
            }
        }
    }

    public function update($id)
    {
        $this->VIEW_FILE = "account/fin_account_form";
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $row = $this->Account_model->get_by_id($id);

        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/Account/update_action'),
                'code_acc' => set_value('code_acc', $row->code),
                'code' => set_value('code', $row->code),
                'account_name' => set_value('account_name', $row->account_name),
                'trx_type' => set_value('trx_type', $row->trx_type),
            );
            $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/Acount'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('code', TRUE));
        } else {
            $cek = $this->M_Admin->cek_avail('fin_account', 'code', $this->input->post('code_acc', TRUE));

            if ($this->input->post('code_acc', TRUE) == $this->input->post('code', TRUE)) {

                $data = array(
                    'account_name' => $this->input->post('account_name', TRUE),
                    'code' => $this->input->post('code_acc', TRUE),
                    'trx_type' => $this->input->post('trx_type', TRUE),
                );

                $this->Account_model->update($this->input->post('code', TRUE), $data);
                $this->session->set_flashdata('status', 'alert-success');
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('Report/Account'));

            } else {

                if (($cek['total'] > 0)) {

                    $this->session->set_flashdata('message', 'Account Code Already Exist, Please Change Number');
                    $this->session->set_flashdata('status', 'alert-danger');
                    $this->update($this->input->post('code', TRUE));;
                } else {
                    $data = array(
                        'account_name' => $this->input->post('account_name', TRUE),
                        'code' => $this->input->post('code_acc', TRUE),
                        'trx_type' => $this->input->post('trx_type', TRUE),
                    );

                    $this->Account_model->update($this->input->post('code', TRUE), $data);
                    $this->session->set_flashdata('status', 'alert-success');
                    $this->session->set_flashdata('message', 'Update Record Success');
                    redirect(site_url('Report/Account'));
                }
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Account_model->get_by_id($id);

        if ($row) {
            $this->Account_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Report/Account'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/Account'));
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
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-13 03:27:21 */
/* http://harviacode.com */