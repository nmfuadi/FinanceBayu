<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Finance extends AppBase
{
    protected $rules = 5;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_Admin');
        $this->load->model('Jobs_update_model');
        $this->load->model('JobsModel');
        $this->load->library('pagination');
        $this->load->library("form_validation");
        $this->load->library('session');


        $session_rules = $this->session->userdata('rules');
    }


    public function index()
    {

        $this->VIEW_FILE = "Report/Finance/SelectFormat"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['data'] = array(
            'button' => 'Select Format',
            'action' => site_url('Report/Finance/importData'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function importData()
    {

        // dynamic
        if (empty($_GET['format'])) {
            redirect(site_url('Report/Finance'));
        } else {
            $this->VIEW_FILE = "Report/Finance/Insert";

            $load_resource = $this->load_resource(); // digawe ngene ikie
            $load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
            $table = "fin_bank WHERE bank_name = '".$_GET['format']."'";
            $load_resource['bank'] = $this->M_Admin->get_all_data($table);
            $load_resource['data'] = array(
                'button' => 'Import Excell',
                'action' => site_url('Report/Finance/' . $_GET['format']),
                'id' => set_value('id')
            );


            $this->load->view($this->MAIN_VIEW, $load_resource); // fix

        }
    }

    public function GeneralReport()
    {

        $this->VIEW_FILE = "Report/Finance/SelectReport"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['data'] = array(
            'button' => 'Select Format',
            'action' => site_url('Report/Finance/importData'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }



    public function inputManual()
    {

        $this->VIEW_FILE = "Report/Finance/InsertManual"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank');
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['data'] = array(
            'button' => 'Posting Journal',
            'action' => site_url('Report/Finance/InputPorsess'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }


    public function editMutasi($id=null,$tgl=null)
    {

        $this->VIEW_FILE = "Report/Finance/Edit"; 
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $row = $this->M_Admin->get_data_by_mutation_id('fin_mutation','id',$id);
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank');
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/Finance/edit_action'),
		'id' => set_value('id', $row['id']),
		'account_code' => set_value('account_code', $row['account_code']),
		'amount' => set_value('amount', $row['amount']),
		'trx_date' => set_value('trx_date', $row['trx_date']),
        'bank_id' => set_value('bank_id', $row['bank_id']),
        
		'type_mutation' => set_value('type_mutation', $row['type_mutation']),
        'remark' => set_value('remark', $row['remark']),
		'currancy' => set_value('currancy', $row['currancy']),
        'tgl'=>$tgl
	    );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/Bank'));
        }


    }




    public function edit_action() 
    {
        $this->_rules_finance();
        $tglnew = $this->input->post('tglform', TRUE);
        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/editMutasi/'.$id.'/'.$tglnew));
        } else {
            $data = array(
                'bank_id' => $this->input->post('rekening', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'amount' => $this->input->post('amount', TRUE),
                'currancy'=>$this->input->post('currancy', TRUE),
                'trx_date' => $this->input->post('trx_date', TRUE),
                'type_mutation' => $this->input->post('type_trx', TRUE),
                'posting_by' => $this->session->userdata('u'),
              'account_code' => $this->input->post('account', TRUE),

	    );

        $where = array(

            'id'=>$this->input->post('id', TRUE)
        );

            $this->M_Admin->update('fin_mutation',$data, $where);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('status', 'alert-success');
            if (empty($tglnew)) {
                redirect(site_url('Report/Finance/viewAllPostingJournal/'));
            } else {
                redirect(site_url('Report/Finance/PostingImport/'.$tglnew));
            }
           
        }
    }


    public function InputPorsess()
    {
        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {


            $dataPost = date('Y-m-d H:i:s', strtotime("now"));
            $ar = array(
                'bank_id' => $this->input->post('rekening', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'amount' => $this->input->post('amount', TRUE),
                'currancy'=>$this->input->post('currancy', TRUE),
                'trx_date' => date('Y-m-d', strtotime($this->input->post('trx_date', TRUE))),
                'type_mutation' => $this->input->post('type_trx', TRUE),
                'posting_by' => $this->session->userdata('u'),
                'posting_st' => 'YES',
                'posting_date' => $dataPost,
                'account_code' => $this->input->post('account', TRUE),
            );

            if ($this->M_Admin->insert('fin_mutation', $ar)) {
                $this->session->set_flashdata('message', 'Import Data Sukses');
                $this->session->set_flashdata('status', 'alert-success');
                redirect(site_url('Report/Finance/inputManual'));
            } else {
                $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/inputManual'));
            }
        }
    }


    public function _rules_input_jurnal()
    {
        $this->form_validation->set_rules('rekening', 'Rekenening Bank', 'trim|required');
        $this->form_validation->set_rules('account', 'Pilih Account', 'trim|required');
        $this->form_validation->set_rules('trx_date', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('type_trx', 'Type Transaksi', 'trim|required');
        $this->form_validation->set_rules('amount', 'Jumlah Transaksi', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }



    public function PostingJournal()
    {

        $this->VIEW_FILE = "Report/Finance/Insert"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank');
        $load_resource['data'] = array(
            'button' => 'Import Excell',
            'action' => site_url('Report/Finance/ImportPorcess'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function BCA()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded
            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                 /* 
                echo count($sheetData);
                echo '<table border=1>
                <tr>
                <th>NO</th>
                <th>TGL</th>
                <th>KET</th>
                <th>CAB</th>
                <th>JML</th>
                <th>JN</th>
                </tr>';
              */
                
                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['1'];
                    $cab = $sheetData[$i]['2'];
                    $jml = $sheetData[$i]['3'];

                    $str = ['CR', 'DB', ','];
                    $jml_fix = str_replace($str, '', $jml);
                    $jml_jn = substr($jml, -2);
                    /* 
                    if (($jml_fix != 0 or !empty($jml_fix)) and $tgl !='PEND') {
                    echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'. date('Y-m-d', strtotime($tgl)).'</td>
                                <td>'.$ket.'</td>
                                <td>'.$cab.'</td>
                                <td>'.$jml_fix.'</td>
                                <td>'.$jml_jn.'</td>
                            </tr>
                    ';
                    
                }

                */
                 

                if (($jml_fix != 0 or !empty($jml_fix)) and $tgl !='PEND') {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => date('Y-m-d H:i:s', strtotime("now"))
                        );
                    }
                }

               // echo "</table>";
               
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }



    public function MANDIRI()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                //  echo count($sheetData);
                // echo '<table border=1>
                // <tr>
                // <th>NO</th>
                // <th>TGL</th>
                // <th>KET</th>
                // <th>JML</th>
                // <th>JN</th>
                // </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['3'];
                    $ket = $sheetData[$i]['5'];
                    $dbt = $sheetData[$i]['7'];
                    $crd = $sheetData[$i]['8'];

                    if ($dbt == '0.00') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = substr($jml, -2);

                    //   echo '  <tr>
                    //              <td>'.$i.'</td>
                    //             <td>'.$tgl.'</td>
                    //             <td>'.$ket.'</td>
                    //            <td>'.$jml_fix.'</td>
                    //             <td>'.$jml_jn.'</td>
                    //         </tr>
                    // ';



                    if ($tgl != 0 or !empty($tgl)) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('d-m-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }


                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }



    public function BRI()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
/*
                 echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                 <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';
*/
                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['5'];
                    $dbt = $sheetData[$i]['12'];
                    $crd = $sheetData[$i]['15'];

                    if ($dbt == '0.00') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);

                    //$jml_jn = substr($jml, -2);
                      /*
                    if(!empty($tgl) and !empty($ket) and !empty($jml_fix)){
                       echo '  <tr>
                                  <td>'.$i.'</td>
                                 <td>'.$tgl.'</td>
                                 <td>'.$ket.'</td>
                                <td>'.$jml_fix.'</td>
                                 <td>'.$jml_jn.'</td>
                             </tr>
                     ';

                }

                   */

                  if(!empty($tgl) and !empty($ket) and !empty($jml_fix)){
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('d-m-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                   
                }

               
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }


    public function BNI()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded
            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                /*
                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                 <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';
                  */

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['7'];
                    $ket = $sheetData[$i]['12'];
                    $jml = $sheetData[$i]['21'];
                    $cd = $sheetData[$i]['23'];

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    $jml_jn = $cd == 'D' ? 'DB' : 'CR';

                    /*
                    if ($tgl != 0 or !empty($tgl) and !empty (is_numeric($jml)) ) {
                        $no = 1;
                        echo '  <tr>
                        <td>'.$no++.'</td>
                        <td>'.$tgl.'</td>
                        <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                        <td>'.$jml_jn.'</td>
                   </tr>
                 ';
                         }
                 */




                if ($tgl != 0 or !empty($tgl) and !empty (is_numeric($jml)) ) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => floatval($jml_fix),
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('d-m-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }


                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }



    public function PERMATA()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded
            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                /*
                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                 <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';
                  */

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['1'];
                    $ket = $sheetData[$i]['8'];
                   // $jml = $sheetData[$i]['21'];
                    $db  =  $sheetData[$i]['4'];
                    $cd  =  $sheetData[$i]['5'];
                    $jn =   $sheetData[$i]['3'];

                    if($jn=='D'){
                        $jml = $db ;
                        $jml_jn = 'DB';


                    }else {

                        $jml = $cd ;
                        $jml_jn = 'CR';
                    }
 
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = $cd == 'D' ? 'DB' : 'CR';

                     /*
                    if ($tgl != 0 or !empty($tgl) and !empty (is_numeric($jml))) {
                        $no = 1;
                        echo '<tr>
                        <td>'.$no++.'</td>
                        <td>'.$tgl.'</td>
                        <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                        <td>'.$jml_jn.'</td>
                        </tr>
                        ';
                    }
                    */
                 

                 

                    if ($tgl != 0 or !empty($tgl) and !empty (is_numeric($jml))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => floatval($jml_fix),
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                

                }

                
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }

                
            
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }



    public function OCBC()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['1'];
                    $ket = $sheetData[$i]['4'];
                    $dbt = $sheetData[$i]['5'];
                    $crd = $sheetData[$i]['6'];

                    if ($dbt == '0') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = substr($jml, -2);
                    if (!empty(is_numeric($jml_fix))) {
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$jml_jn.'</td>
                             </tr>
                     ';
                    }



                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }

               
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }




    public function DBS()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['1'];
                    $ket = $sheetData[$i]['3'];
                    $dbt = $sheetData[$i]['4'];
                    $crd = $sheetData[$i]['5'];

                    if ($dbt == '') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = substr($jml, -2);
                   /* if (!empty(is_numeric($jml_fix))) {
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$jml_jn.'</td>
                             </tr>
                     ';
                    }

                    */



                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }

            
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }



    public function UOB()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['3'];
                    $dbt = $sheetData[$i]['5'];
                    $crd = $sheetData[$i]['4'];

                    if ($dbt == '0') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = substr($jml, -2);
                   
                  
                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }

            
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }

                
            
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
        }
    }




    public function CIMB()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['3'];
                    $ket = $sheetData[$i]['8'];
                    $dbt = $sheetData[$i]['10'];
                    $crd = $sheetData[$i]['12'];

                    if ($dbt == '0.00') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }


                    
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);

                    /*
                    //$jml_jn = substr($jml, -2);
                    if (!empty(is_numeric($jml_fix))) {
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$jml_jn.'</td>
                             </tr>
                     ';
                    }

                    */

                    



                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }

            
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
                       
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
            
        }
    }
    
    

    public function SAP()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['2'];
                    $ket = $sheetData[$i]['9'];
                    $jml = $sheetData[$i]['4'];
                    $ket2 = $sheetData[$i]['6'];

                   


                    
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    $ket_fix = '('.$ket2 .') '.$ket;
                    
                    //$jml_jn = substr($jml, -2);

                    /*
                    if (!empty(is_numeric($jml_fix))) {
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket_fix.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$ket2.'</td>
                             </tr>
                     ';
                    }

                    */

                 
                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket_fix,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => 'DB',
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }

            
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            
                       
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
            
        }
    }




    public function DANAMON(){
        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['1'];
                    $ket = $sheetData[$i]['5'];
                    $dbt = $sheetData[$i]['6'];
                    $crd = $sheetData[$i]['8'];

                    if ($dbt == '0.00' OR $dbt =='' ) {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }


                    
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);

                  
                    //$jml_jn = substr($jml, -2);
                 
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$jml_jn.'</td>
                             </tr>
                     ';
                

               

                    

  /*

                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
             */

                    
                }

                 /*
           
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }

                 */
            
                       
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
            
        }
   
    }



    public function VICTORIA()
    {

        $this->_rules_finance();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/importData'));
        } else {

            // If file uploaded

            if (!empty($_FILES['uploadFile']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }

                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                  echo count($sheetData);
                 echo '<table border=1>
                 <tr>
                 <th>NO</th>
                <th>TGL</th>
                 <th>KET</th>
                 <th>JML</th>
                 <th>JN</th>
                 </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['1'];
                    $dbt = $sheetData[$i]['2'];
                    $crd = $sheetData[$i]['3'];

                    if ($dbt == '0.00') {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }


                    
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);

                   /*
                    //$jml_jn = substr($jml, -2);
                    if (!empty(is_numeric($jml_fix))) {
                      echo '  <tr>
                                 <td>'.$i.'</td>
                                <td>'.$tgl.'</td>
                                <td>'.$ket.'</td>
                        <td>'.$jml_fix.'</td>
                         <td>'.$jml_jn.'</td>
                             </tr>
                     ';
                    }

                */

                    

 

                    if (!empty(is_numeric($jml_fix))) {
                        $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }

                    
                }

           
                if ($this->db->insert_batch('fin_mutation', $ar)) {

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/Finance/PostingImport/' . $dataPost));
                } else {
                    $this->session->set_flashdata('message', 'Error! Data Gagal di import mohon di ulangi');
                    $this->session->set_flashdata('status', 'alert-danger');
                    redirect(site_url('Report/Finance/importData'));
                }
            
                       
                
            } else {
                $this->session->set_flashdata('message', 'Error! File Tidak Di dukung');
                $this->session->set_flashdata('status', 'alert-danger');
                redirect(site_url('Report/Finance/importData'));
            }
            
        }
    }


    public function PostingImport($tgl = null)
    {

        $this->VIEW_FILE = "Report/Finance/ViewImportList"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $tglnew = rawurldecode($tgl);
        $where = "posting_date = '$tglnew' AND posting_st = 'NO' order by trx_date ASC";
        $table = 'fin_mutation a JOIN fin_bank b ON a.bank_id = b.id';
        $select = 'a.*,bank_rek_name,bank_norek,branch,gl_account,bank_name';
        $load_resource['data'] = $this->M_Admin->get_all_data_where_select($select,$table, $where);
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['tgl'] =$tgl;
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }



    public function postingPorcessAll()
    {
   
       $id =$this->input->post('myCheckboxes', TRUE);
       echo $account = $this->input->post('accountAll', TRUE);

        $mutasi_id=explode(",",$id);
        print_r($mutasi_id);
        $jml_acc = count($mutasi_id);

        for($i=0;$i<=$jml_acc;$i++){

                   
            $db = $this->M_Admin->get_data_by_id('fin_account','code',"'".$account."'");

            $mut =  $this->M_Admin->get_data_by_id('fin_mutation','id',"'".$mutasi_id[$i]."'");
            if(!empty($db) and !empty($mut)){

                if($db['trx_type'] == $mut['type_mutation']){

                    $data = array(
                        'account_code' => $account,
                        'posting_st' => 'YES',
                        'posting_by' => $this->session->userdata('u'),
                    );
        
                    $where = array(
        
                        'id' => $mutasi_id[$i]
                    );
        
                    $this->M_Admin->update('fin_mutation', $data, $where);
                }

            }
           
            
               
    
               
            }
       
    }

    public function postingPorcess($ids = null, $tgll = null, $typeAct = null, $fr = null)
    {
        $typeAction = $_GET['actionType'] == null ? $typeAct : $_GET['actionType'];
        $tgl = $_GET['tglGet'] == null ? $tgll : $_GET['tglGet'];
        $id = $_GET['id'] == null ? $ids : $_GET['id'];
        

        $tglnew = rawurldecode($tgl);
       
            $account = $_GET['account'];
            $data = array(

                'account_code' => $account,
                'posting_st' => 'YES',
                'posting_by' => $this->session->userdata('u'),
            );

            $where = array(

                'id' => $id
            );

            $this->M_Admin->update('fin_mutation', $data, $where);
            $this->session->set_flashdata('message', 'Posting Record Success');
            $this->session->set_flashdata('status', 'alert-success');

           
         
    }


    

    public function viewAllPostingJournal()
    {

        $this->VIEW_FILE = "Report/Finance/ViewPostingJournal"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        //$load_resource['jobs'] = $this->M_Admin->get_jobs_by_dprtmn_id($load_resource['emp']['dptmn_id']);	
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/Finance/viewAllPostingJournal?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Report/Finance/viewAllPostingJournal?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Report/Finance/viewAllPostingJournal';
            $config['first_url'] = base_url() . 'Report/Finance/viewAllPostingJournal';
        }

        $config['per_page'] = 50;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Admin->total_rows($q);
        $bayuform = $this->M_Admin->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['data'] = array(
            'bayu_data' => $bayuform,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        //$this->load->view('bayuform/bayu_form_list', $data);

        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }



    public function viewAllJournal()
    {

        $this->VIEW_FILE = "Report/Finance/ViewJournal"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        //$load_resource['jobs'] = $this->M_Admin->get_jobs_by_dprtmn_id($load_resource['emp']['dptmn_id']);	
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/Finance/viewAllJournal?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Report/Finance/viewAllJournal?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Report/Finance/viewAllJournal';
            $config['first_url'] = base_url() . 'Report/Finance/viewAllJournal';
        }

        $config['per_page'] = 50;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Admin->total_rows_jurnal($q);
        $bayuform = $this->M_Admin->get_limit_data_jurnal($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['data'] = array(
            'bayu_data' => $bayuform,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        //$this->load->view('bayuform/bayu_form_list', $data);

        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }






    /* Batas Bawah */


    public function InsertJobs()
    {
        $this->VIEW_FILE = "Report/Vp/Insert"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['vp'] = $this->M_Admin->get_all_depertement_vp();

        $load_resource['data'] = array(
            'button' => 'Create Jobs',
            'action' => site_url('Report/AdminStaff/create_action_task'),
            'id' => set_value('id'),
            'jobs_code' => set_value('jobs_code'),
            'kry_id' => set_value('kry_id'),
            'jobs_tittle' => set_value('jobs_tittle'),
            'jobs_desc' => set_value('jobs_desc'),
            'jobs_stat' => set_value('jobs_stat'),
            'jobs_start' => set_value('jobs_start'),
            'ext_kry_id' => set_value('ext_kry_id'),
            'ext_st' => set_value('ext_st'),
            'jobs_end' => set_value('jobs_end'),
            'archieve_st' => set_value('archieve_st'),
            'cr_dt' => set_value('cr_dt'),
            'cr_up' => set_value('cr_up'),
            'u_cr' => set_value('u_cr'),
        );



        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }

    public function token()
    {
        //jumlah panjang karakter angka dan huruf.
        $length_abjad = "3";
        $length_angka = "3";
        $angka_pasti = '4';

        //huruf yg dimasukan, kecuali I,L dan O
        $huruf = "ABCDEFGHJKLMNPQRSTUVWXYZ";



        //mulai proses generate angka
        $datejam = date("His");
        $time_md5 = rand(time(), $datejam);
        $acak_huruf = str_shuffle($huruf);
        $cut_huruf = substr($acak_huruf, 0, $length_abjad);
        $cut = substr($time_md5, 0, $length_angka);

        //mennggabungkan dan mengacak hasil generate huruf dan angka
        $acak = str_shuffle($cut . $cut_huruf);

        $angka = $acak;



        //menghitung dan memeriksa hasil generate di database menggunakan fungsi getTotalRow(),
        //jika hasil generate sudah ada di database maka proses generate akan diulang


        return $angka;
    }


    public function create_action_task()
    {
        $this->_rules_vp();
        $em = $this->input->post('jobs_date', TRUE);
        $employe = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $dateori = $this->input->post('jobs_date', TRUE);
        $dateexplode = explode("to", $dateori);
        //echo date("Y-m-d",);

        $start = date('Y-m-d', strtotime($dateexplode[0]));
        $end = date('Y-m-d', strtotime($dateexplode[1]));
        $token = $this->token();
        if ($this->input->post('ext_st', TRUE) == 'yes') {

            $kry = null;
            $ext_kry = $employe['id_kry'];
        } else {

            $kry = $employe['id_kry'];
            $ext_kry = null;
        }


        if ($this->form_validation->run() == FALSE) {
            $this->InsertJobs();
        } else {
            $data = array(
                'jobs_code' => $token,
                'kry_id' => $kry,
                'jobs_tittle' => $this->input->post('jobs_tittle', TRUE),
                'jobs_desc' => $this->input->post('jobs_desc', TRUE),
                'jobs_stat' => $this->input->post('jobs_stat', TRUE),
                'archieve_st' => $this->input->post('archieve_st', TRUE),
                'jobs_start' => $start,
                'jobs_end' => $end,
                'ext_kry_id' => $this->input->post('ext_kry_id', TRUE),
                'ext_kry_from' => $ext_kry,
                'ext_st' => $this->input->post('ext_st', TRUE),
                'cr_dt' => date("Y-m-d H:i:s"),
                'cr_up' => date("Y-m-d H:i:s"),
                'u_cr' => $this->session->userdata('u')
            );

            $this->JobsModel->insert($data);
            $this->session->set_flashdata('message', 'Create Task Success');
            $this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('Report/AdminVp/InsertJobs'));
        }
    }

    public function UpdateList()
    {


        $this->VIEW_FILE = "Report/Staff/VupdateList"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['CONTOH'] = 'Namaku Fuad';


        $load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $load_resource['jobsUp'] = $this->M_Admin->get_update_jobs_by_user_id($load_resource['emp']['id_kry']);
        $load_resource['emp_jobs'] = $this->M_Admin->get_jobs_by_id(null);



        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }










    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/create' . $this->input->post('jb_id', TRUE)));
        } else {
            $filename = $_FILES['uploadFile']['name'];
            $emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
            if (!empty($filename)) {

                $bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
                $emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
                $code = $bk['jobs_code'];
                $doc_name = $emp['emp_name'];

                $ext = substr(strrchr($filename, '.'), 1);
                $img_name = str_replace(' ', '_', ucwords($doc_name));
                $t = time();

                $name_file_save1 = $t . "-" . $img_name . "-" . $code . "." . $ext;
                $name_file = $t . "-" . $img_name . "-" . $code;

                //$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
                /*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			$file_old = './file/'.$bk['doc_file'];
			if(file_exists($file_old)){
				unlink($file_old);
			}
			*/

                $config['upload_path'] = './file';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx|ppt|pptx|zip|rar';
                $config['max_size']     = 6000;
                $config['file_name'] = $name_file;

                $this->load->library('upload', $config);

                $field_name = "uploadFile";
                if ($this->upload->do_upload($field_name)) {


                    $data = array(
                        'jobs_id' => $this->input->post('jb_id', TRUE),
                        'kry_id' => $emp['id_kry'],
                        'jobs_up_descr' => $this->input->post('jobs_up_descr', TRUE),
                        'pic' => $name_file_save1,
                        'job_up_st' => $this->input->post('job_up_st', TRUE),
                        'update_date' => $this->input->post('update_date', TRUE),
                        'cr_dt' => date("Y-m-d H:i:s"),
                        'cr_up' => date("Y-m-d H:i:s"),
                        'u_cr' => $this->session->userdata('u')
                    );

                    $this->Jobs_update_model->insert($data);
                    $this->session->set_flashdata('message', 'Create Record Success');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/AdminStaff'));
                } else {

                    echo 'belum berhasil upload';
                }
            } else {

                $data = array(
                    'jobs_id' => $this->input->post('jb_id', TRUE),
                    'kry_id' => $emp['id_kry'],
                    'jobs_up_descr' => $this->input->post('jobs_up_descr', TRUE),
                    'job_up_st' => $this->input->post('job_up_st', TRUE),
                    'update_date' => $this->input->post('update_date', TRUE),
                    'cr_dt' => date("Y-m-d H:i:s"),
                    'cr_up' => date("Y-m-d H:i:s"),
                    'u_cr' => $this->session->userdata('u')
                );

                $this->Jobs_update_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                $this->session->set_flashdata('status', 'alert-success');
                redirect(site_url('Report/AdminStaff'));
            }
        }
    }

    public function UpdateTaskList($jobs_id = null)
    {


        $this->VIEW_FILE = "Report/Staff/VupdateList"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $load_resource['CONTOH'] = 'Namaku Fuad';

        $load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $load_resource['emp_jobs'] = $this->M_Admin->get_jobs_by_id($jobs_id);
        $load_resource['jobsUp'] = $this->M_Admin->get_update_jobs_by_jobs_id($jobs_id);


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }



    public function update($id)
    {
        $this->VIEW_FILE = "Report/Staff/Insert"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $cek = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        $row = $this->M_Admin->get_update_jobs_by_id($id);
        $load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);

        if ($row['staff_kry'] != $cek['id_kry']) {

            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }

        if ($row) {
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/AdminStaff/update_action'),
                'up_jobs_id' => $row['up_jobs_id'],
                'jb_id' => $row['jobs_id'],
                'jobs_id' => $row['jobs_id'],
                'kry_id' => $row['kry_id'],
                'jobs_up_descr' => $row['jobs_up_descr'],
                'update_date' => $row['update_date'],
                'pic' => $row['pic'],
                'job_up_st' => $row['job_up_st']
            );
            $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }

    public function update_action()
    {


        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Field Not Complited');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/' . $this->update($this->input->post('up_jobs_id', TRUE))));
        } else {
            $filename = $_FILES['uploadFile']['name'];

            if (!empty($filename)) {

                $bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
                $emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
                $code = $bk['jobs_code'];
                $doc_name = $emp['emp_name'];

                $ext = substr(strrchr($filename, '.'), 1);
                $img_name = str_replace(' ', '_', ucwords($doc_name));
                $t = time();

                $name_file_save1 = $t . "-" . $img_name . "-" . $code . "." . $ext;
                $name_file = $t . "-" . $img_name . "-" . $code;

                //$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
                /*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			
			*/
                if (!empty($this->input->post('pic_old', TRUE))) {
                    $file_old = './file/' . $this->input->post('pic_old', TRUE);
                    if (file_exists($file_old)) {
                        unlink($file_old);
                    }
                }

                $config['upload_path'] = './file';
                $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx|ppt|pptx|zip|rar';
                $config['max_size']     = 6000;
                $config['file_name'] = $name_file;

                $this->load->library('upload', $config);

                $field_name = "uploadFile";
                if ($this->upload->do_upload($field_name)) {


                    $data = array(

                        'jobs_up_descr' => $this->input->post('jobs_up_descr', TRUE),
                        'pic' => $name_file_save1,
                        'update_date' => $this->input->post('update_date', TRUE),
                        'job_up_st' => $this->input->post('job_up_st', TRUE),
                        'cr_up' => date("Y-m-d H:i:s"),
                        'u_cr' => $this->session->userdata('u')
                    );

                    $this->Jobs_update_model->update($this->input->post('up_jobs_id', TRUE), $data);
                    $this->session->set_flashdata('message', 'Update Record Success');
                    $this->session->set_flashdata('status', 'alert-success');
                    redirect(site_url('Report/AdminStaff/UpdateList'));
                }
            } else {

                //only data Update

                $data = array(

                    'jobs_up_descr' => $this->input->post('jobs_up_descr', TRUE),
                    'update_date' => $this->input->post('update_date', TRUE),
                    'job_up_st' => $this->input->post('job_up_st', TRUE),
                    'cr_up' => date("Y-m-d H:i:s"),
                    'u_cr' => $this->session->userdata('u')
                );

                $this->Jobs_update_model->update($this->input->post('up_jobs_id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                $this->session->set_flashdata('status', 'alert-success');
                redirect(site_url('Report/AdminStaff/UpdateList'));
            }
        }
    }

    public function delete($id)
    {
        $row = $this->M_Admin->get_update_jobs_by_id($id);
        $cek = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        if ($row['staff_kry'] != $cek['id_kry']) {

            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
        $row = $this->Jobs_update_model->get_by_id($id);

        if ($row) {
            $this->Jobs_update_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }

    public function _rules()
    {

        $this->form_validation->set_rules('jobs_up_descr', 'jobs up descr', 'trim|required');




        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function Menu()
    {
        $this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }


    public function coba()
    {
        //$this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        //$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix

        echo 'cakaakka';
    }


    public function booking_doc($cust_id = null)
    {

        //$and = '';
        //$cust_cek = $this->general_model->get_data_by_id('st_cust','id',$cust_id,$and);
        //$cek_book = $this->general_model->get_data_by_id('st_booking','cust_id',$cust_id,$and);


        $this->VIEW_FILE = "Report/Staff/followBookingFormDoc"; // dynamic
        $load_resource = $this->load_resource();
        //$load_resource['range_price'] =$this->general_model->get_data('st_range_price');
        //$load_resource['project_cust'] =$this->general_model->get_data('st_project');
        //$load_resource['st_abs_jns'] =$this->general_model->get_data('st_absensi_jns');


        $load_resource['data'] = array(
            'button' => 'Create',
            'action' => site_url('Report/AdminStaff/booking_doc_proses'),
            'doc_name' => set_value('doc_name'),
            'doc_file' => set_value('doc_file'),



        );
        //$this->load->view('marketing/customer/st_cust_form', $data);
        $this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);

    }





    public function _rules_vp()
    {
        $this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
        $this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
        $this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function _rules_finance()
    {
        $this->form_validation->set_rules('rekening', 'No Rekening', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    // iki taroh di base ae


}
