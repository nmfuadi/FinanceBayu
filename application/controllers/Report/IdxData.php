<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class IdxData extends AppBase {
	protected $rules = 4;
	 

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('JobsModel');
      	$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->load->library('curl');
		$this->API="https://www.idx.co.id/umbraco/Surface/ListedCompany/GetTradingInfoSS";
		$this->GetTradingInfoDaily = 'https://www.idx.co.id/umbraco/Surface/ListedCompany/GetTradingInfoDaily?code=REAL';
		
		
		
			$user_id = $this->session->userdata('u');
			$session_rules = $this->session->userdata('rules');
		if($session_rules!=$this->rules){
				if($session_rules==6){
						
						redirect('Report/AdminDir');
					}elseif($session_rules==5){
						
						redirect('Report/AdminStaff');
					}else {
						
						echo $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Anda Tidak memiliki hak Akses untuk mumat halaman ini. </div>');
								redirect('Report/LoginAdmin');
						
					}
			
		}
		
    }

    public function index() {
		
		$this->VIEW_FILE = "Report/Vp/VidxData"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
			
		
		 $InfoSS=json_decode($this->curl->simple_get($this->API.'?code=REAL&language=id-id&draw=2&start=0&length=1000'),true);
		 $jsonInfoDaily =$this->curl->simple_get($this->GetTradingInfoDaily);
		 $arrayInfoDaily =json_decode($jsonInfoDaily,true);
		 $data_InfoSS =$InfoSS['replies'];
		 

		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
		
		
		
		//echo '<pre>'. print_r($arrayInfoDaily ,true).'</pre>';
		
		//echo '<pre>'. print_r($json_decode,true).'</pre>';
		
		
		//$emp= $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		//$jobs = $this->M_Admin->get_jobs_by_dprtmn_id($emp['dptmn_id']);	
		
		//echo '<pre>'. print_r($jobs,true).'</pre>';
		
		//echo $json_decode['KodeEmiten'];
		//echo count($json_decode['replies']);
		
		 
    }
	
	public function UpdateTaskList($jobs_id=null) {
			
		
       $this->VIEW_FILE = "Report/Staff/VupdateList"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$load_resource['jobsUp'] = $this->M_Admin->get_update_jobs_by_jobs_id($jobs_id);	
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function ArchieveJobs() {
		
	
        $this->VIEW_FILE = "Report/admin/adminVp"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['jobs'] = $this->M_Admin->get_jobs_by_user_id_archieve($this->session->userdata('u'));	
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	 public function InsertJobs() {
        $this->VIEW_FILE = "Report/Vp/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
					
		 $load_resource['data'] = array(
            'button' => 'Create Jobs',
            'action' => site_url('Report/AdminVp/create_action'),
	    'id' => set_value('id'),
	    'jobs_code' => set_value('jobs_code'),
	    'kry_id' => set_value('kry_id'),
	    'jobs_tittle' => set_value('jobs_tittle'),
	    'jobs_desc' => set_value('jobs_desc'),
	    'jobs_stat' => set_value('jobs_stat'),
	    'jobs_start' => set_value('jobs_start'),
	    'jobs_end' => set_value('jobs_end'),
		'archieve_st' => set_value('archieve_st'),
	    'cr_dt' => set_value('cr_dt'),
	    'cr_up' => set_value('cr_up'),
	    'u_cr' => set_value('u_cr'),
	);
       
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function ViewAllTask() {
		
		$this->VIEW_FILE = "Report/Staff/viewAllJobs"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		
		$css= base_url().'resource/assets_eoffice/table.css';
		
		$emp= $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$jobs = $this->M_Admin->get_jobs_by_dprtmn_id($emp['dptmn_id']);	
		
		$html = '
			<!DOCTYPE html>
			
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
			<link rel="stylesheet" href="'.$css.'">
			
			<table class="responstable">
  			  <tr>
				<th>NO</th>
				<th>Task Title</th>
				<th>Task Detail</th>
				<th>PIC AND STATUS</th>
				<th>PICTURE</th>
			  </tr>
		';
		$no = 1;
		foreach($jobs as $jb){
			if($jb['jobs_stat']=='progress'){
				
						$jobs_stat = '<div class="label label-table label-warning">PROGRESS</div>';
					}elseif($jb['jobs_stat']=='done'){
						
						$jobs_stat = '<div class="label label-table label-success">DONE</div>';
						
					}else {	
						
						$jobs_stat = '<div class="label label-table label-danger">HOLD</div>';
					}
			
				$html .= '
				
					
				
					<tr>
						<td>'.$no.'</td>
						<td><b>Task Code: '.$jb['jobs_code'].'</b><br/>'.$jb['jobs_tittle'].'<br/> Task Range:<br/>'.$jb['jobs_start'].' to '.$jb['jobs_end'].'<br/>'.$jobs_stat.'</td>
						<td>'.$jb['jobs_desc'].'</td>
						<td>'.$jb['emp_name'].'</td>
						<td></td>
					 </tr>
				
				';
				
			$jobs_up = $this->M_Admin->get_update_jobs_by_jobs_id($jb['jobs_id']);
			
			if(!empty($jobs_up)){
				foreach($jobs_up as $up){
					
					if($up['job_up_st']=='progress'){
				
						$job_up_st = ' <label class="label label-table label-warning">PROGRESS</label>';
					}elseif($up['job_up_st']=='done'){
						
						$job_up_st = ' <label class="label label-table label-success">DONE</label>';
						
					}else {
						
						$job_up_st = ' <label class="label label-table label-danger">DONE</label>';
					}
					
					if(!empty($up['pic'])){
						
						$picture ='<a href="'.base_url('file/'.$up['pic']).'" data-toggle="lightbox" data-gallery="multiimages" data-title="Image title will be apear here"><img width="200px" src="'.base_url('file/'.$up['pic']).'" alt="gallery" class="all studio" /> </a>';
					}else {
						
						$picture='';
					}
				
				$html .= '
				
					<tr>
						<td></td>
						<td></td>
						<td>'.$up['jobs_up_descr'].'</td>
						<td> PIC : '.$up['emp_name'].'<br/> Processing Date : '.$up['update_date'].'<br/>'.$job_up_st.'</td>
						<td>'.$picture.'</td>
					 </tr>
				
				';
				
			}
			}
			
			
			$no++;
		}
		
		$html .= '</table>
				<!-- partial -->
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
			
			';
		
		$load_resource['html']= $html;
		
		 $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        
    }
	
	public function token() {
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
		$cut_huruf=substr($acak_huruf,0, $length_abjad);
        $cut = substr($time_md5, 0, $length_angka);

        //mennggabungkan dan mengacak hasil generate huruf dan angka
        $acak = str_shuffle($cut.$cut_huruf);

        $angka = $acak;



        //menghitung dan memeriksa hasil generate di database menggunakan fungsi getTotalRow(),
        //jika hasil generate sudah ada di database maka proses generate akan diulang


        return $angka;
    }
	
	
	public function create_action() 
    {
        $this->_rules();
		$em = $this->input->post('jobs_date',TRUE);
		$employe = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$dateori = $this->input->post('jobs_date',TRUE);
		$dateexplode = explode("to",$dateori);
		//echo date("Y-m-d",);
	
		 $start = date('Y-m-d', strtotime($dateexplode[0]));
		 $end = date('Y-m-d', strtotime($dateexplode[1]));
		$token = $this->token();
		
			
		
        if ($this->form_validation->run() == FALSE) {
            $this->InsertJobs();
        } else {
            $data = array(
		'jobs_code' =>$token ,
		'kry_id' => $employe['id_kry'],
		'jobs_tittle' => $this->input->post('jobs_tittle',TRUE),
		'jobs_desc' => $this->input->post('jobs_desc',TRUE),
		'jobs_stat' => $this->input->post('jobs_stat',TRUE),
		'archieve_st' => $this->input->post('archieve_st',TRUE),
		'jobs_start' =>$start,
		'jobs_end' => $end,
		'cr_dt' => date("Y-m-d H:i:s"),
		'cr_up' => date("Y-m-d H:i:s"),
		'u_cr' => $this->session->userdata('u')
	    );

            $this->JobsModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Report/AdminVp/InsertJobs'));
        }
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
	
	 public function update($id) 
    {
		$this->VIEW_FILE = "Report/Vp/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
        $row = $this->M_Admin->get_jobs_by_id($id);

        if ($row) {
           $load_resource['data'] = array(
                'button' => 'Update',
                'action' => site_url('Report/AdminVp/update_action'),
		'id' => set_value('id', $row['jobs_id']),
		'jobs_code' => set_value('jobs_code', $row['jobs_code']),
		'kry_id' => set_value('kry_id', $row['kry_id']),
		'jobs_tittle' => set_value('jobs_tittle', $row['jobs_tittle']),
		'jobs_desc' => set_value('jobs_desc', $row['jobs_desc']),
		'jobs_stat' => set_value('jobs_stat', $row['jobs_stat']),
		'jobs_start' => set_value('jobs_start', $row['jobs_start']),
		'jobs_end' => set_value('jobs_end', $row['jobs_end']),
		'archieve_st' => set_value('archieve_st', $row['archieve_st']),
			
	    );
           $this->load->view($this->MAIN_VIEW, $load_resource);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminVp'));
        }
		
		
		  // fix
		
    }
    
    public function update_action() 
    {
        $this->_rules();
		
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
			
		$employe = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$dateori = $this->input->post('jobs_date',TRUE);
		$dateexplode = explode("to",$dateori);
		//echo date("Y-m-d",);
	
		 $start = date('Y-m-d', strtotime($dateexplode[0]));
		 $end = date('Y-m-d', strtotime($dateexplode[1]));
			
            $data = array(
		'jobs_tittle' => $this->input->post('jobs_tittle',TRUE),
		'jobs_desc' => $this->input->post('jobs_desc',TRUE),
		'jobs_stat' => $this->input->post('jobs_stat',TRUE),
		'archieve_st' => $this->input->post('archieve_st',TRUE),
		'jobs_start' =>  $start,
		'jobs_end' => $end ,
		'cr_up' => date("Y-m-d H:i:s"),
		'u_cr' => $this->session->userdata('u')
	    );

            $this->JobsModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Report/AdminVp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->JobsModel->get_by_id($id);

        if ($row) {
            $this->JobsModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Report/AdminVp'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminVp'));
        }
    }
	
	
	public function coba() {
        //$this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        //$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	public function _rules() 
    {
	$this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
	$this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
	$this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	
	
	// iki taroh di base ae
	

}
