<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require 'vendor/autoload.php';

// load base class if needed
require_once(APPPATH . 'controllers/base/BaseReport.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




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
            $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');

            if($_GET['format']!='GENERAL'){
                $table = "fin_bank WHERE bank_name = '".$_GET['format']."' Order By bank_name ASC";
            }else {
                $table = "fin_bank   Order By bank_name ASC";
            }

           
            $load_resource['bank'] = $this->M_Admin->get_all_data($table);
            $load_resource['data'] = array(
                'button' => 'Import Excell',
                'format'=>$_GET['format'],
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
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['data'] = array(
            'button' => 'Posting Journal',
            'action' => site_url('Report/Finance/InputPorsess'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }


    public function SyncCurrency()
    {

        $this->VIEW_FILE = "Report/Finance/VsyncCurrency"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
     
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank');
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        
        $load_resource['data'] = array(
            'button' => 'Syncronize',
            'action' => site_url('Report/Finance/SyncCurrencyProccess'),
            'id' => set_value('id')
        );


        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }


    public function SyncCurrencyProccess()
    {
        $this->_rules_sync();
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error! Data Gagal di sinkornasi');
            $this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/Finance/SyncCurrency/'));
        } else {
            $bank = $this->input->post('rekening');
            $start =  $this->input->post('start');
            $end = $this->input->post('end');
            $kurs = $this->input->post('kurs');

            $sync = $this->M_Admin->get_sync_mutation($start, $end, $bank, $kurs);
            $data_count = count($sync);

            foreach ($sync as $sync) {

                if ($sync['currancy'] != 'IDR') {

                    $cur = $this->M_Admin->get_currancy_amount_bymont($sync['currancy'],$start);
                    $cur_ammount = $cur['kurs_amount'] * $sync['original_amount'];
                } else {
                    $cur_ammount =  $sync['original_amount'];
                }
               
                $data = array(

                    
                    'amount' => $cur_ammount,

                );

                $where = array(

                    'id' => $sync['id']
                );

                $this->M_Admin->update('fin_mutation', $data, $where);
            }

            $this->session->set_flashdata('message', 'Success!  '.$data_count.'  Data  Sukses Di Sinkronasi');
            $this->session->set_flashdata('status', 'alert-succeess');
            redirect(site_url('Report/Finance/SyncCurrency/'));
        }
    }


    public function get_last_update_kurs(){

        if(!empty($_GET['kurs'])){

            $cur = $this->M_Admin->get_currancy_amount_bymont($_GET['kurs'],$_GET['tgl']);
            $response = json_encode(($cur));

        }else{

            $response = '{"kurs_amount":"Data Tidak Ada","kurs_date":"Belum di input"}';
        }

        echo $response;
        
    }


    public function editMutasi($id = null, $tgl = null,$source = null, $pagination=null,$q=null)
    {

        $this->VIEW_FILE = "Report/Finance/Edit";
        $load_resource = $this->load_resource(); // digawe ngene ikie
        $row = $this->M_Admin->get_data_by_mutation_id('fin_mutation', 'id', $id);
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank');
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $where = "trx_type ='" . $row['type_mutation'] . "'";
        $load_resource['account'] = $this->M_Admin->get_all_data_where('fin_account', $where);
        if ($row) {

            if($source == 'viewAllJournal'){

                $amount = $row['original_amount'];
            }else {

                $amount = $row['amount'];

            }
            $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/Finance/edit_action'),
                'id' => set_value('id', $row['id']),
                'account_code' => set_value('account_code', $row['account_code']),
                'amount' => set_value('amount', $amount),
                'trx_date' => set_value('trx_date', $row['trx_date']),
                'bank_id' => set_value('bank_id', $row['bank_id']),
                'type_mutation' => set_value('type_mutation', $row['type_mutation']),
                'remark' => set_value('remark', $row['remark']),
                'currancy' => set_value('currancy', $row['currancy']),
                'tgl' => $tgl,
                'source'=>$source,
                'pagination'=>$pagination,
                'q'=>$q
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

            $acc = $this->M_Admin->get_fin_by_id('fin_account','code',$this->input->post('account', TRUE));
            $bank = $this->M_Admin->get_fin_by_id('fin_bank','id',$this->input->post('rekening', TRUE));

           // $mut =  $this->M_Admin->get_data_by_id('fin_mutation','id',"'".$id."'");
                if($bank['currency_code'] != 'IDR'){
                    $cur = $this->M_Admin->get_currancy_amount($bank['currency_code'] );
                    $cur_ammount = $cur['kurs_amount'] * $this->input->post('amount', TRUE);
                }else{
                    $cur_ammount =  $this->input->post('amount', TRUE);
                }

            $data = array(
                'bank_id' => $this->input->post('rekening', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'amount' => $cur_ammount,
                'original_amount'=>$this->input->post('amount', TRUE),
                'currancy'=>$bank['currency_code'],
                'trx_date' => $this->input->post('trx_date', TRUE),
                'type_mutation' =>$acc['trx_type'],
                'posting_by' => $this->session->userdata('u'),
              'account_code' => $this->input->post('account', TRUE),

	    );

        $where = array(

            'id'=>$this->input->post('id', TRUE)
        );

            $this->M_Admin->update('fin_mutation',$data, $where);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('status', 'alert-success');
            if ($this->input->post('source', TRUE)!='PostingImport') {
                redirect(site_url('Report/Finance/'.$this->input->post('source', TRUE).'?start='.$this->input->post('pagination', TRUE).'&q='.$this->input->post('q', TRUE)));
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
            redirect(site_url('Report/Finance/inputManual'));
        } else {

            $acc = $this->M_Admin->get_fin_by_id('fin_account','code',$this->input->post('account', TRUE));
            $bank = $this->M_Admin->get_fin_by_id('fin_bank','id',$this->input->post('rekening', TRUE));

           // $mut =  $this->M_Admin->get_data_by_id('fin_mutation','id',"'".$id."'");

           $cur = $this->M_Admin->get_currancy_amount($bank['currency_code'] );
                if($bank['currency_code'] != 'IDR' and !empty($cur['kurs_amount'])){
                    $cur_ammount = $cur['kurs_amount'] * $this->input->post('amount', TRUE);
                }else{
                    $cur_ammount =  $this->input->post('amount', TRUE);
                }

            $dataPost = date('Y-m-d H:i:s', strtotime("now"));
            $ar = array(
                'bank_id' => $this->input->post('rekening', TRUE),
                'remark' => $this->input->post('remark', TRUE),
                'amount' => $cur_ammount,
                'original_amount'=>$this->input->post('amount', TRUE),
                'currancy'=>$bank['currency_code'],
                'trx_date' => date('Y-m-d', strtotime($this->input->post('trx_date', TRUE))),
                'type_mutation' =>  $acc['trx_type'],
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


                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                <th>CAB</th>
                <th>JML</th>
                <th>JN</th>
                </tr>';
              
                
                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['1'];
                    $cab = $sheetData[$i]['2'];
                    $jml = $sheetData[$i]['3'];

                    $str = ['CR', 'DB', ','];
                    $jml_fix = str_replace($str, '', $jml);
                    $jml_jn = substr($jml, -2);
                   
                /* 
                    if (($jml_fix != 0 or !empty(is_numeric($jml))) and $tgl !='PEND') {
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

               

                if (($jml_fix != 0 or !empty(is_numeric($jml))) and $tgl !='PEND') {
                      
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($tgl)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => date('Y-m-d H:i:s', strtotime("now"))
                        );
                    }
                   
                }

          

               //echo "</table>";
               
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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                    //$jml_jn = substr($jml, -2);
                  
                            
                            //print_r($date_exp);
        
                //             if (($tgl != 0 or !empty($tgl)) and !empty(is_numeric($jml_fix))) {
                //                 if(!empty($tgl)){

                //                     $date_exp = explode('/',$tgl);
                //                     $yy = substr($date_exp[2],0,4);
    
                //                     $date_ok =  $yy.'-'.$date_exp[1].'-'.$date_exp[0]; 
                //                 }

                //                 echo '  <tr>
                //                 <td>'.$i.'</td>
                //                <td>'. $date_ok.'</td>
                //                <td>'.$ket.'</td>
                //               <td>'.$jml_fix.'</td>
                //                <td>'.$jml_jn.'</td>
                //            </tr>
                //    ';
                //             }   
                  
                     



                if (($tgl != 0 or !empty($tgl)) and !empty(is_numeric($jml_fix))) {
                    if(!empty($tgl)){
                    $date_exp = explode('/',$tgl);
                    $yy = substr($date_exp[2],0,4);

                     $date_ok =  $yy.'-'.$date_exp[1].'-'.$date_exp[0]; 
                        }
                        
                        //print_r($date_exp);
    
                      
                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }


                // echo '</table>';


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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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

                    if(!empty($tgl)){
                        $date_exp = explode('/',$tgl);
                        $date_ok =  $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0];
                    }
                    
                   
    
    
                   


                        
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                    if(!empty($tgl)){
                        $date_exp = explode('/',$tgl);
                        $year = substr($date_exp[2],0,4);
                        $date_ok =  $year.'-'.$date_exp[1].'-'.$date_exp[0];
                    }
                    
                  
    
                   

                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => floatval($jml_fix),
                            'original_amount' => floatval($jml_fix),
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime( $date_ok)),
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
                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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

                        
                    if(!empty($tgl)){
                        $date_exp = explode('/',$tgl);
                        $date_ok =  $date_exp[2].'-'.$date_exp[0].'-'.$date_exp[1];
                    }
                    
                    print_r($date_exp);
    
    
                  

                      
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => floatval($jml_fix),
                            'original_amount' => floatval($jml_fix),
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('m-d-Y', strtotime($date_ok)),
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

                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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

                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok =  $date_exp[2].'-'.$date_exp[0].'-'.$date_exp[1];
                        }
                        
                        
        
        
                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($date_ok)),
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
                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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

                        
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
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
                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                   
                  
                    if (!empty(is_numeric($jml_fix)) AND !empty($tgl)) {

                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok =  $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0];
                        }
                        
                       
        
        
                       

                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
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

    //warms
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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
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
    
    

    public function CASH()
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

                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                //   echo count($sheetData);
                //  echo '<table border=1>
                //  <tr>
                //  <th>NO</th>
                // <th>TGL</th>
                //  <th>KET</th>
                //  <th>BANL</th>
                //  <th>JML</th>
                //  <th>JN</th>
                //  </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $no_rek = $sheetData[$i]['1'];
                    $tgl = $sheetData[$i]['4'];
                    $ket = $sheetData[$i]['9'];
                    $jml = $sheetData[$i]['6'];
                    $ket2 = $sheetData[$i]['5'];        
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    $ket_fix = $ket2 .' - '.$ket;
                    
                   
                    //$jml_jn = substr($jml, -2);

                   
//                     if (!empty(is_numeric($jml_fix))) {
//                         $bank_id = $this->M_Admin->get_bank_by_no_rek($no_rek);
//                         if(!empty($bank_id)){

//                             $bnk = $bank_id['id'];
// ;                        }
//                       echo '  <tr>
//                                  <td>'.$i.'</td>
//                                 <td>'.$tgl.'</td>
//                                 <td>'.$ket_fix.'</td>
//                                 <td>'. $bnk.'</td>
//                                 <td>'.$jml_fix.'</td>
//                                  <td>'.$ket2.'</td>
//                              </tr>
//                      ';
//                     }

               
                    if (!empty(is_numeric($jml_fix))) {
                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $bank_id = $this->M_Admin->get_bank_by_no_rek($no_rek);
                        }
                        
                       // print_r($date_exp);
                        
                        if(!empty($bank_id)){

                            $bnk = $bank_id['id'];
                       }
        
                       $date_ok =  $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0];
                       
                        $ar[] = array(
                            'bank_id' => $bnk,
                            'remark' => strval($ket_fix),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($date_ok)),
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
                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                    $crd = $sheetData[$i]['7'];

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

                    // if (!empty(is_numeric($jml_fix))) {
                    //     if(!empty($tgl)){
                    //         $date_exp = explode('-',$tgl);
                    //     }
                        
                    //     //print_r($date_exp);
    
                    //    $date_ok =  $this->input->post('tahun', TRUE).'-'.$date_exp[1].'-'.$date_exp[0];  
                    //     echo '  <tr>
                    //              <td>'.$i.'</td>
                    //             <td>'.$date_ok .'</td>
                    //             <td>'.$ket.'</td>
                    //     <td>'.$jml_fix.'</td>
                    //      <td>'.$jml_jn.'</td>
                    //          </tr>
                    //  ';

                    // }
                 
                      
                

               

                    



                    if (!empty(is_numeric($jml_fix))) {
                        
                         if(!empty($tgl)){
                            $date_exp = explode('-',$tgl);
                            $date_ok =  $this->input->post('tahun', TRUE).'-'.$date_exp[1].'-'.$date_exp[0];  
                        }
                        
                        //print_r($date_exp);
    
                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
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

                //datenow
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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

                    if ($dbt == '0,00' or $dbt == '0.00' or $dbt == ''  ) {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }


                    
                    $str = ['.',','];
                    $replace = ['','.'];
                    $jml_fix = str_replace($str, $replace, $jml);
                


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
                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok =  $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0];
                        }
                        
                        
        
                      
                        
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'trx_date' => date('m-d-Y', strtotime($date_ok)),
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



    public function MANDIRI_PERSONAL(){
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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));

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

                    if ($dbt == '0.00' OR $dbt =='' OR $dbt =='-' ) {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    
                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);

                  
                    //$jml_jn = substr($jml, -2);

                    // if (!empty(is_numeric($jml_fix))) {
                    //     if(!empty($tgl)){
                    //         $date_exp = explode('-',$tgl);
                    //     }
                        
                    //     //print_r($date_exp);
    
                    //    $date_ok =  $this->input->post('tahun', TRUE).'-'.$date_exp[1].'-'.$date_exp[0];  
                    //     echo '  <tr>
                    //              <td>'.$i.'</td>
                    //             <td>'.$date_ok .'</td>
                    //             <td>'.$ket.'</td>
                    //     <td>'.$jml_fix.'</td>
                    //      <td>'.$jml_jn.'</td>
                    //          </tr>
                    //  ';

                    // }
                 
                      
                    if (!empty(is_numeric($jml_fix))) {
                       
                         if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok =  $this->input->post('tahun', TRUE).'-'.$date_exp[1].'-'.$date_exp[0]; 
                        }
                        
                        //print_r($date_exp);
    
                       
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => $ket,
                            'amount' => $jml_fix,
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
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


    public function MAYBANK()
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
                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
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
                    $dbt = $sheetData[$i]['3'];
                    $crd = $sheetData[$i]['4'];

                    if ($dbt == '0.00' or empty($dbt) ) {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [',',' ','Rp'];
                    $jml_fix = str_replace($str, '', $jml);
                  //  $jml_jn = substr($jml, -2);
                    
                    // if ($tgl != 0 or !empty($tgl) AND !empty($jml_fix)) {

                    //     if(!empty($tgl)){
                    //         $date_exp = explode('/',$tgl);
                    //     }
                        
                   
                    // $date_ok = $date_exp[2].'-'.$date_exp[0].'-'.$date_exp[1];
                    //   echo '  <tr>
                    //              <td>'.$i.'</td>
                    //             <td>'.$date_ok.'</td>
                    //             <td>'.$ket.'</td>
                    //            <td>'.$jml_fix.'</td>
                    //             <td>'.$jml_jn.'</td>
                    //         </tr>
                    // ';
                    // }



                    if (($tgl != 0 or !empty($tgl)) AND !empty(is_numeric($jml_fix))) {

                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok = $date_exp[2].'-'.$date_exp[0].'-'.$date_exp[1];
                        }
                        
                        //print_r($date_exp);
    
                          
                        
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }


                // echo '</table>';


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



    public function GENERAL()
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

                $dataPost = date('Y-m-d H:i:s', strtotime("now"));
                // file path
                $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
                //$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

            //       echo count($sheetData);
            //      echo '<table border=1>
            //      <tr>
            //      <th>NO</th>
            //     <th>TGL</th>
            //      <th>KET</th>
            //      <th>JML</th>
            //    <th>JN</th>
            //     </tr>';

                for ($i = 1; $i < count($sheetData); $i++) {
                    $tgl = $sheetData[$i]['0'];
                    $ket = $sheetData[$i]['1'];
                    $dbt = $sheetData[$i]['2'];
                    $crd = $sheetData[$i]['3'];

                    if ($dbt == '0.00' or empty($dbt)) {
                        $jml = $crd;
                        $jml_jn = 'CR';
                    } else {

                        $jml = $dbt;
                        $jml_jn = 'DB';
                    }

                    $str = [','];
                    $jml_fix = str_replace($str, '', $jml);
                    //$jml_jn = substr($jml, -2);
                  
                   
                    //$date_ok = $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0];
                    //   echo '  <tr>
                    //              <td>'.$i.'</td>
                    //             <td>'.$date_ok.'</td>
                    //             <td>'.$ket.'</td>
                    //            <td>'.$jml_fix.'</td>
                    //             <td>'.$jml_jn.'</td>
                    //         </tr>
                    // ';



                    if ($tgl != 0 or !empty($tgl)) {

                        if(!empty($tgl)){
                            $date_exp = explode('/',$tgl);
                            $date_ok =  $date_exp[2].'-'.$date_exp[1].'-'.$date_exp[0]; 
                        }
                        
                        //print_r($date_exp);
    
                        
                        
                        $ar[] = array(
                            'bank_id' => $this->input->post('rekening', TRUE),
                            'remark' => strval($ket),
                            'amount' => $jml_fix,
                            'original_amount' => $jml_fix,
                            'currancy'=>$this->input->post('currancy', TRUE),
                            'trx_date' => date('Y-m-d', strtotime($date_ok)),
                            'type_mutation' => $jml_jn,
                            'posting_st' => 'NO',
                            'posting_date' => $dataPost
                        );
                    }
                }


                // echo '</table>';


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
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }



    public function postingPorcessAll()
    {

        $id = $this->input->post('myCheckboxes', TRUE);
        echo $account = $this->input->post('accountAll', TRUE);

        $mutasi_id = explode(",", $id);
        print_r($mutasi_id);
        echo count($mutasi_id);
        $jml_acc = count($mutasi_id);

        for ($i = 0; $i <= $jml_acc; $i++) {

            $db = $this->M_Admin->get_data_by_id('fin_account', 'code', "'" . $account . "'");
            $mut =  $this->M_Admin->get_data_by_id('fin_mutation', 'id', "'" .$mutasi_id[$i]. "'");
            if (!empty($db['code']) and !empty($mut['id'])) {
                if ($mut['currancy'] != 'IDR') {
                    $cur = $this->M_Admin->get_currancy_amount($mut['currancy']);
                    $cur_ammount = $cur['kurs_amount'] * $mut['amount'];
                } else {
                    $cur_ammount =  $mut['amount'];
                }
                if ($db['trx_type'] == $mut['type_mutation']) {
                    $data = array(
                        'account_code' => $account,
                        'posting_st' => 'YES',
                        'original_amount' => $mut['amount'],
                        'amount' => $cur_ammount,
                        'posting_by' => $this->session->userdata('u'),
                    );
                    $where = array(
                        'id' => $mutasi_id[$i]
                    );
                    $this->M_Admin->update('fin_mutation', $data, $where);
                }
            }

           echo $mut['amount'].' bacaa ';
        }

        echo json_encode($data);
    }

    public function postingPorcess($ids = null, $tgll = null, $typeAct = null, $fr = null)
    {
        $typeAction = $_GET['actionType'] == null ? $typeAct : $_GET['actionType'];
        $tgl = $_GET['tglGet'] == null ? $tgll : $_GET['tglGet'];
        $id = $_GET['id'] == null ? $ids : $_GET['id'];
        
        $mut =  $this->M_Admin->get_data_by_id('fin_mutation','id',"'".$id."'");
        if($mut['currancy'] != 'IDR'){

            $cur = $this->M_Admin->get_currancy_amount($mut['currancy'] );
            $cur_ammount = $cur['kurs_amount'] * $mut['amount'];
        }else{

            $cur_ammount =  $mut['amount'];
        }
        $tglnew = rawurldecode($tgl);
       
            $account = $_GET['account'];
            $data = array(

                'account_code' => $account,
                'posting_st' => 'YES',
                'original_amount' => $mut['amount'],
                 'amount' => $cur_ammount,
                'posting_by' => $this->session->userdata('u'),
            );

            $where = array(

                'id' => $id
            );

            $this->M_Admin->update('fin_mutation', $data, $where);
            $this->session->set_flashdata('message', 'Posting Record Success');
            $this->session->set_flashdata('status', 'alert-success');

           
         
    }


    public function DeletePorcess($id = null, $tgl = null,$source = null, $pagination=null)
    {
       // $typeAction = $_GET['actionType'] == null ? $typeAct : $_GET['actionType'];
        
         $where = array(

                'id' => $id
            );

            $this->M_Admin->delete('fin_mutation', $where);

            if ($this->input->post('source', TRUE)!='PostingImport') {
                redirect(site_url('Report/Finance/'.$source.'?start='.$pagination));
            } else {
                redirect(site_url('Report/Finance/PostingImport/'.$tgl));
            }
            

            $this->session->set_flashdata('message', 'Delete Reocrd Success');
            $this->session->set_flashdata('status', 'alert-success');

           
           
           
         
    }


   



    public function excelJurnalUmum()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $star = $this->input->post('start');
        $end = $this->input->post('end');
        $rekening = $this->input->post('rekening');
        $kurs = $this->input->post('kurs');
        $type = $this->input->post('type');
        

            $sheet->setCellValue('A1', 'No');
			$sheet->setCellValue('B1', 'Tanggal');
			$sheet->setCellValue('C1', 'Keterangan');
			$sheet->setCellValue('D1', 'Amount (Curency IDR)');
			$sheet->setCellValue('E1', 'Amount Origin');
            $sheet->setCellValue('F1', 'Jenis');
            $sheet->setCellValue('G1', 'Account');
            $sheet->setCellValue('H1', 'Bank');

            $no = 1;
			$x = 2;

        $data_list = $this->M_Admin->ExportExcell($star,$end,$rekening,$kurs,$type);
        if(!empty($data_list)){
            foreach ($data_list as $data) {
            

                $account = $data['account_name'].'('.$data['code'].')';
                $banks = $data['bank_name'].'-'.$data['branch'].'('.$data['bank_norek'].')';
    
                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                $sheet->setCellValue('A'. $x,  $no++);
                $sheet->setCellValue('B'. $x, $data['trx_date']);
                $sheet->setCellValue('C'. $x, $data['remark']);
                $sheet->setCellValue('D'. $x, $data['amount']);
                $sheet->setCellValue('E'. $x, $data['original_amount']);
                $sheet->setCellValue('F'. $x, $data['type_mutation']);
                $sheet->setCellValue('G'. $x, $account);
                $sheet->setCellValue('H'. $x, $banks);
                $x++;
                
            }

        }
       

        $writer = new Xlsx($spreadsheet);
			$filename = 'laporan-excel';
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');

       
        
    }


    public function ExcelContoh(){


       
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet->setCellValue('A1', 'No');
			$sheet->setCellValue('B1', 'Nama');
			$sheet->setCellValue('C1', 'Kelas');
			$sheet->setCellValue('D1', 'Jenis Kelamin');
			$sheet->setCellValue('E1', 'Alamat');
			
			
			$no = 1;
			$x = 2;
			
				$sheet->setCellValue('A'.$x, $no++);
				$sheet->setCellValue('B'.$x, 'Nama');
				$sheet->setCellValue('C'.$x, 'Keles');
				$sheet->setCellValue('D'.$x,'Kelamin');
				$sheet->setCellValue('E'.$x, 'Alamat');
				$x++;
			
			$writer = new Xlsx($spreadsheet);
			$filename = 'laporan-siswa';
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
			header('Cache-Control: max-age=0');
	
			$writer->save('php://output');
    }


    public function DeleteAllData($tgl = null)
    {
        
         $where = array(

                'posting_date' => rawurldecode($tgl)
            );

            

            if($this->M_Admin->delete('fin_mutation', $where)){

                $this->session->set_flashdata('message', 'Delete Reocrd Success');
                $this->session->set_flashdata('status', 'alert-success');

                redirect(site_url('Report/Finance/PostingImport/'.$tgl));
            }else {
                
                redirect(site_url('Report/Finance/PostingImport/'.$tgl));
            }

 
         
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

        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank order by bank_name');
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['action'] = site_url('Report/Finance/excelJurnalUmum');

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




    public function ReportCashflow(){

        $this->VIEW_FILE = "Report/Finance/RCashFlow"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        
        $q = urldecode($this->input->get('q', TRUE));

        if(empty($q)){

            $q_val = date("Y"); 
        }else {
            $q_val = $q;

        }
        
        $load_resource['data_cr'] = $this->M_Admin->ReportCashflow($q_val,'CR');
        $load_resource['data_db'] = $this->M_Admin->ReportCashflow($q_val,'DB');
        $load_resource['q'] =$q_val;
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix

    }


    public function ReportBulanan(){

        $this->VIEW_FILE = "Report/Finance/RCashFlowPerbulan"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        
       // $q = urldecode($this->input->get('q', TRUE));
        $start = $this->input->get('start', TRUE);
        $end = $this->input->get('end', TRUE);
        $bank_id = $this->input->get('rekening', TRUE);
        $cur = $this->input->get('kurs', TRUE);


        $load_resource['currancy'] = $this->input->get('kurs', TRUE);
        $load_resource['start'] = $start;
        $load_resource['end'] = $end;
        $load_resource['bank_id'] = $bank_id;
        $load_resource['action'] = site_url('Report/Finance/ReportBulanan');
        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank order by bank_name');
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['data_cr'] = $this->M_Admin->ReportCashflowPerBulan($start,$end,$bank_id, $cur,'CR');
        $load_resource['data_db'] = $this->M_Admin->ReportCashflowPerBulan($start,$end,$bank_id, $cur,'DB');
        //$load_resource['q'] =$q_val;
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix

    }


    public function ReportBulananByAccount(){

        $this->VIEW_FILE = "Report/Finance/RCashFlowPerbulanByAccount"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        
       // $q = urldecode($this->input->get('q', TRUE));
        $start = $this->input->get('start_date', TRUE);
        $end = $this->input->get('end_date', TRUE);
        $account=$this->input->get('account', TRUE);
        $bank_id = $this->input->get('bank_id', TRUE);
        //$cur = $this->input->get('kurs', TRUE);


        $load_resource['currancy'] = $this->input->get('kurs', TRUE);
        $load_resource['start'] = $start;
        $load_resource['end'] = $end;
        $load_resource['action'] = site_url('Report/Finance/ReportBulanan');
        $load_resource['akun'] = $this->M_Admin->get_data_by_id("fin_account","code","'$account'");
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['data_ac'] = $this->M_Admin->ReportCashflowPerBulanByAccount($start,$end,$account,$bank_id);

        $load_resource['data'] = array(
            
            'start' => $start,
            'end'=>$end,
            'account'=>$account

        );
       
        //$load_resource['q'] =$q_val;
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix

    }




    public function DetailReportBulanan()
    {

        $this->VIEW_FILE = "Report/Finance/VDetailReportBulanan"; // dynamic
        $load_resource = $this->load_resource(); // digawe ngene ikie
        //$load_resource['CONTOH'] = 'Namaku Fuad';
        //$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
        //$load_resource['jobs'] = $this->M_Admin->get_jobs_by_dprtmn_id($load_resource['emp']['dptmn_id']);	
        $q = urldecode($this->input->get('q', TRUE));
        $start_date = urldecode($this->input->get('start_date', TRUE));
        $end_date = urldecode($this->input->get('end_date', TRUE));
        $account = urldecode($this->input->get('account', TRUE));
        $bank_id = urldecode($this->input->get('bank_id', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Report/Finance/DetailReportBulanan?q=' . urlencode($q).'&start_date='.$start_date.'&end_date='.$end_date.'&account='.$account.'&bank_id='.$bank_id;
            $config['first_url'] = base_url() . 'Report/Finance/DetailReportBulanan?q=' . urlencode($q).'&start_date='.$start_date.'&end_date='.$end_date.'&account='.$account.'&bank_id='.$bank_id;
        } else {
            $config['base_url'] = base_url() . 'Report/Finance/DetailReportBulanan';
            $config['first_url'] = base_url() . 'Report/Finance/DetailReportBulanan';
        }

        $load_resource['bank'] = $this->M_Admin->get_all_data('fin_bank order by bank_name');
        $load_resource['kurs'] = $this->M_Admin->get_all_data('fin_kurs_name');
        $load_resource['bank'] = $this->M_Admin->get_fin_by_id('fin_bank','id',$account);
        $load_resource['action'] = site_url('Report/Finance/excelJurnalUmum');

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Admin->total_rows_jurnal_for_report_bulanan($start_date, $end_date, $account,$q);
        $bayuform = $this->M_Admin->get_limit_jurnal_for_report_bulanan($start_date, $end_date, $account,$config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $load_resource['account'] = $this->M_Admin->get_all_data('fin_account');
        $load_resource['data'] = array(
            'bayu_data' => $bayuform,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'start_date'=> $start_date,
            'end_date'=>$end_date,
            'account'=>$account

        );
        //$this->load->view('bayuform/bayu_form_list', $data);

        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
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


    public function _rules_sync()
    {
        $this->form_validation->set_rules('start', 'start date', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    /* Batas Bawah FINANCE bayu buana*/


    

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





    


    // iki taroh di base ae


}
