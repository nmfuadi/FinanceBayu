<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class SelfAssessment extends AppBase {
	protected $rules = 5;
	
	
    public function __construct() {
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

    	
	public function index() {

      // $this->VIEW_FILE = "Report/SelfAssessment/Insert"; // dynamic
		/*$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u')); */
		// fix
	$self = $this->M_Admin->get_self();	
		
	 echo  $dec = $self['resume'];
	   //echo $ruang = json_encode($dec, True);
	
	 //echo "<pre>".print_r($ruang,true)."</pre>";
	$encode = json_decode($dec,true);
	//echo $text = str_replace(array("\t", "\r"), '',  $encode);
	
	
	echo '<pre>'.print_r($encode,true).'<pre>';
	
	$string = "This\r\nis\n\ra\nstring\r";
	//echo nl2br($encode);
		
		 
    }
	
	public function result(){
		
		 $this->VIEW_FILE = "Report/SelfAssessment/result"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
	}
	
	
	 public function InsertSelft() {
        $this->VIEW_FILE = "Report/SelfAssessment/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['vp'] = $this->M_Admin->get_all_depertement_vp();
		
		$load_resource['cov_params'] = $this->M_Admin->get_all_cov_params();
		
		 $load_resource['data'] = array(
					'button' => 'Submit Jawaban',
					'action' => site_url('Report/SelfAssessment/createSelfAction'),
					
		
		 );
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	public function createSelfAction() 
    {
        $params = $this->M_Admin->get_all_cov_params();
		$nilai = 0;
		$level =0;
		$khas = 0;
		$penyerta = 0;
		$pemberat = 0;
		$json = '{';
		$json .='"resume":[';
		foreach ($params as $param){
			$sumNilai = $this->input->post($param['alias'],TRUE);
			$nilai = $nilai + $sumNilai;
			
			$co = count($sumNilai);
			
			if($sumNilai > 0){
				 $level = $level + $param['level'];	
				 
				
					
				if($param['gejala_khas']=='1'){
					$khas = $khas + $param['gejala_khas'];	
					
					
				}elseif($param['gejala_khas']=='2'){
					$penyerta = $penyerta + $param['gejala_khas'];	
				}elseif($param['gejala_khas']=='3'){
					$pemberat = $pemberat + $param['gejala_khas'];	
				}
			}
			
			$json .= '{';
			$json .= '"values":"'.$sumNilai.'",';
			$json .= '"names" :"'.$param['gejala'].'",';
			$json .= '"alias" :" '.$param['alias'].'",';
			$json .= '"gejala" :" '.$param['gejala_khas'].'",';
			$json .= '"level" :" '.$param['level'].'"';
			$json .= '},';

							
		}
		
		
		$g_penyerta = ($penyerta /2);
		$g_pemberat = ($pemberat /3);
				
		$json .='{}';
		$json .='],';
	    $json .= '"nilai":"'.$nilai.'",';
		$json .= '"level":"'.$level.'",';
		$json .= '"khas":"'.$khas.'",';
		$json .= '"penyerta":"'.$g_penyerta.'",';
		$json .= '"pemberat":"'.$g_pemberat.'"';
		$json .='}';
		
		
			
		$json1 = str_replace("\r\n", "",$json); 
		
		if ($nilai<100){
			$nn = '<100';
		}elseif($nilai>=100 && $nilai<200){
			$nn = '>=100<200';
		}elseif($nilai>=200 && $nilai<270){
			$nn = '>=200<270';
		}elseif($nilai>=270){
			$nn = '>=270';
		}
		
		$nl='';
		if($level==1){
			$nl='=1';
		}
		elseif($level>1 && $level<2){
			$nl='<2';
		}elseif($level>=2 && $level<4){
			$nl='>1<=3';
		}		elseif($level==4){
			$nl = '<=4';
		}elseif($level==5){
			$nl = '>4<6';
		}elseif($level==6){
			$nl = '=6';
		}elseif($level>6){
			$nl = '>6';
		}
	
	
	$par = array(
		'nilai'=>$nn,
		'level'=>$nl
	);
	
	$kh = '';
	$py = '';
	$pb = '';
	
	
	if($khas>0){
		$kh = 'Anda Terindikasi terdapat '.$khas.' Gejala Khas Covid19';
	}
	
	if($g_penyerta>0 and $khas>0){
		$py = 'Terdapa '.$g_penyerta.' Gejala Penyakit yang menyertai Gejala Khas Covid';
	}
	
	if($g_penyerta>0 and $khas==0){
		$py = 'Terdapat '.$g_penyerta.' Gejala Penyakit yang mungkin dapat menurunkan imun anda';
	}
	
	
	
	if($g_pemberat>0){
		
		$pb = 'terdapat '.$g_pemberat.' yang memberatkan Gejala Covid 19 jika terinfeksi';
	}
	
	
	$encode = json_decode($json1,true);
	
	//echo '<pre>'.print_r($encode,true).'<pre>';
	$enc = $encode['resume'];
	$ks = '';
	$pyn ='';
	$pbt ='';
	$ks1 = '';
	$pyn1 ='';
	$pbt1='';
	foreach($enc as $sil){
		if($sil != null){
			if($sil['values']>0 and $sil['gejala']=='1'){
				$ks1= 'Gejala Khas Pada Penderita Covid19 yang Anda rasakan Adalah :';
				$ks .= '<li>'.$sil['names'].'</li>';
			}
			
			if($sil['values']>0 and $sil['gejala']=='2'){
				$pyn1 ='Gejala Penyakit yang bukan ciri khas penderita covid-19 namun bisa saja menyertai penderita COvid-19 :';
				$pyn .= '<li>'.$sil['names'].'</li>';
			}
			
			if($sil['values']>0 and $sil['gejala']=='3'){
				$pbt .= '<li>'.$sil['names'].'</li>';
				$pbt1='Ada beberapa faktor yang memberatkan gejala Covid : ';
			}
			
			
		}
		
	}
	
	$ks .= '';
	$pyn .='';
	$pbt .='';
	
	$hasil = $this->M_Admin->get_cov_result($par);
	
	if($hasil == null){
		
		$cttn = 'Mohon maaf sistem baru memepelajari tentang hasil self assesment Anda ('.$nn.$nl.')';
		$cttn1 = 'Sistem baru mempelajari Result Anda';
	}else {
		
		$cttn = $hasil['result3'];
		$cttn1 = 'Dan Anda direkomendasikan untuk '.$hasil['result2'];
	}
	
	
				
	$mencatan = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="panel panel-info block4">
										<div class="panel-heading"> Berikut Hasil Tracing dari data yang Anda Isi
											<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
										</div>
										<div class="panel-wrapper collapse in" aria-expanded="true">
											<div class="panel-body">
												<p>'.$kh.'</p>
												<p>'.$py.'</p>
												<p>Kondisi Kesehatan '.$hasil['result1'].'</p>
												<p>'.$cttn1.'</p>
												<hr/>
												<p>'.$ks1.'</p>
												<ul>'.$ks.'</ul>
												<hr/>
												<p>'.$pyn1.'</p>
												<ul>'.$pyn.'</ul>
												<hr/>
												<p>'.$pbt1.'</p>
												<ul>'.$pbt.'</ul>
												<hr/>
												<p>Notes : '.$cttn.'</p>
											</div>
											</div>
									</div>'.$nn.$nl.'
									<hr> </div>';
	
		
		 
		$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$this->_rulesSelf();
        if ($this->form_validation->run() == FALSE) {
            $this->createSelfAction();
        } else {
            $data = array(
				'emp_id' => $emp['id_kry'],
				'resumsse'=>$json1,
				'score' => $nilai,
				'input_date' => date("Y-m-d"),
				
		
	    );
			
            $this->M_Admin->insert_self($data);
            $this->session->set_flashdata('message', $mencatan);
			$this->session->set_flashdata('status', 'alert-success');

            redirect(site_url('Report/SelfAssessment/result'));
        }
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
	
	
	
	
	public function UpdateList() {
			
		
       $this->VIEW_FILE = "Report/Staff/VupdateList"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		
		$load_resource['emp'] = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		$load_resource['jobsUp'] = $this->M_Admin->get_update_jobs_by_user_id($load_resource['emp']['id_kry']);
		$load_resource['emp_jobs'] = $this->M_Admin->get_jobs_by_id(null);
		
		
		
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
				  <tr>
				<th width="3%">NO</th>
				<th width="20%">TITLE</th>
				<th width="40%">PORGRESS DETAIL</th>
				<th width="15%">PIC AND STATUS</th>
				<th width="25%">PICTURE/FILE</th>
			  </tr>
			  </tr>
		';
		$no = 1;
		foreach($jobs as $jb){
			if($jb['jobs_stat']=='inprogress'){
				
						$jobs_stat = '<div class="label label-table label-warning">INPROGRESS</div>';
					}elseif($jb['jobs_stat']=='done'){
						
						$jobs_stat = '<div class="label label-table label-success">DONE</div>';
						
					}else {	
						
						$jobs_stat = '<div class="label label-table label-danger">HOLD</div>';
					}
			
				$html .= '
				
					
				
					<tr>
						<td>'.$no.'</td>
						<td><b>Task Code: '.$jb['jobs_code'].'</b><br/>'.$jb['jobs_tittle'].'<br/> Task Range: <br/>'.$jb['jobs_start'].' to '.$jb['jobs_end'].'<br/>'.$jobs_stat.'</td>
						<td>'.$jb['jobs_desc'].'</td>
						<td>'.$jb['emp_name'].'</td>
						<td></td>
					 </tr>
				
				';
				
			$jobs_up = $this->M_Admin->get_update_jobs_by_jobs_id($jb['jobs_id']);
			
			if(!empty($jobs_up)){
				foreach($jobs_up as $up){
					
					if($up['job_up_st']=='inprogress'){
				
						$job_up_st = ' <label class="label label-table label-warning">INPROGRESS</label>';
					}elseif($up['job_up_st']=='done'){
						
						$job_up_st = ' <label class="label label-table label-success">DONE</label>';
						
					}else {
						
						$job_up_st = ' <label class="label label-table label-danger">HOLD</label>';
					}
					
					if(!empty($up['pic'])){
						$extension= substr(strrchr($up['pic'], '.'), 1);
						if($extension =='jpg' or $extension =='png' or $extension =='jpeg' or $extension =='gif'){
										$picture ='<a href="'.base_url('file/'.$up['pic']).'" data-toggle="lightbox" data-gallery="multiimages" data-title="Image title will be apear here"><img width="200px" src="'.base_url('file/'.$up['pic']).'" alt="gallery" class="all studio" /> </a>';
						}else {
							
							$picture ='<a href="'.base_url('file/'.$up['pic']).'" class="btn btn-primary"> Download File '.$extension.' </a>';
						}
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
	
	
	
	 public function read($id) 
    {
		
		$this->VIEW_FILE = "Report/Staff/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		 $row = $this->M_Admin->get_update_jobs_by_id($id);
		$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($row['jobs_id']);
		
       
        if ($row) {
       $load_resource['data']= array(
		'up_jobs_id' => $row->up_jobs_id,
		'jobs_id' => $row->jobs_id,
		'kry_id' => $row->kry_id,
		'jobs_up_descr' => $row->jobs_up_descr,
		'pic' => $row->pic,
		'job_up_st' => $row->job_up_st
		   );
           $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Report/AdminStaff/UpdateList'));
        }
    }

    public function create($jobs_id=null) 
    {
		 $this->VIEW_FILE = "Report/Staff/Insert"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['emp'] = $this->M_Admin->get_jobs_by_id($jobs_id);
		$load_resource['jb_id'] = $jobs_id;
       $load_resource['data']  = array(
            'button' => 'Create',
            'action' => site_url('Report/AdminStaff/create_action'),
	    'id' => $jobs_id,
		'update_date'=>set_value('update_date'),
		'up_jobs_id'=>set_value('up_jobs_id'),
	    'jobs_id' => set_value('jobs_id'),
	    'kry_id' => set_value('kry_id'),
	    'jobs_up_descr' => set_value('jobs_up_descr'),
	    'pic' => set_value('pic'),
	    'job_up_st' => set_value('job_up_st'),
	    'cr_dt' => set_value('cr_dt'),
	    'cr_up' => set_value('cr_up'),
	    'u_cr' => set_value('u_cr')
	);
	
		$this->load->view($this->MAIN_VIEW, $load_resource); // fix
        //$this->load->view('jobsupdaate/jr_jobs_update_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Error! Field Not Complited');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/create'.$this->input->post('jb_id',TRUE)));
        } else {
			$filename = $_FILES['uploadFile']['name'];
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			if(!empty($filename)){
						
			$bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			$code = $bk['jobs_code'];
			$doc_name= $emp['emp_name'];
									
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace(' ', '_', ucwords($doc_name));
			$t=time();
			
			$name_file_save1 = $t."-".$img_name."-" .$code.".".$ext;
			$name_file = $t."-".$img_name."-" .$code;
			
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

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if ($this->upload->do_upload($field_name)) {
			
			
			$data = array(
				'jobs_id' => $this->input->post('jb_id',TRUE),
				'kry_id' => $emp['id_kry'],
				'jobs_up_descr' => $this->input->post('jobs_up_descr',TRUE),
				'pic' => $name_file_save1,
				'job_up_st' => $this->input->post('job_up_st',TRUE),
				'update_date'=>$this->input->post('update_date',TRUE),
				'cr_dt' => date("Y-m-d H:i:s"),
				'cr_up' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				);

					$this->Jobs_update_model->insert($data);
					$this->session->set_flashdata('message', 'Create Record Success');
					$this->session->set_flashdata('status', 'alert-success');
					redirect(site_url('Report/AdminStaff'));

		}else {
			
			echo 'belum berhasil upload';
		}
				
			}else {
				
				$data = array(
				'jobs_id' => $this->input->post('jb_id',TRUE),
				'kry_id' => $emp['id_kry'],
				'jobs_up_descr' => $this->input->post('jobs_up_descr',TRUE),
				'job_up_st' => $this->input->post('job_up_st',TRUE),
				'update_date'=>$this->input->post('update_date',TRUE),
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
	
	public function UpdateTaskList($jobs_id=null) {
			
		
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
		
		if($row['staff_kry']!=$cek['id_kry']){
			
			$this->session->set_flashdata('message', 'Record Not Found');
			$this->session->set_flashdata('status', 'alert-danger');
            redirect(site_url('Report/AdminStaff/UpdateList'));
		}
		
        if ($row) {
       $load_resource['data']= array(
			'button' => 'Update',
            'action' => site_url('Report/AdminStaff/update_action'),
		'up_jobs_id' => $row['up_jobs_id'],
		'jb_id'=>$row['jobs_id'],
		'jobs_id' => $row['jobs_id'],
		'kry_id' => $row['kry_id'],
		'jobs_up_descr' => $row['jobs_up_descr'],
		'update_date'=>$row['update_date'],
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
			redirect(site_url('Report/AdminStaff/'.$this->update($this->input->post('up_jobs_id', TRUE))));
            
        } else {
			$filename = $_FILES['uploadFile']['name'];
		
			if(!empty($filename)){
						
			$bk = $this->M_Admin->get_jobs_by_id($this->input->post('jobs_id'));
			$emp = $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
			$code = $bk['jobs_code'];
			$doc_name= $emp['emp_name'];
									
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace(' ', '_', ucwords($doc_name));
			$t=time();
			
			$name_file_save1 = $t."-".$img_name."-" .$code.".".$ext;
			$name_file = $t."-".$img_name."-" .$code;
			
			//$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			/*$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
			
			*/
		if(!empty($this->input->post('pic_old',TRUE))){
			$file_old = './file/'.$this->input->post('pic_old',TRUE);
			if(file_exists($file_old)){
				unlink($file_old);
			}
		}
			
		$config['upload_path'] = './file';
		$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx|ppt|pptx|zip|rar';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if ($this->upload->do_upload($field_name)) {
			
			
			$data = array(
		
		'jobs_up_descr' => $this->input->post('jobs_up_descr',TRUE),
		'pic' => $name_file_save1,
		'update_date'=>$this->input->post('update_date',TRUE),
		'job_up_st' => $this->input->post('job_up_st',TRUE),
		'cr_up' => date("Y-m-d H:i:s"),
		'u_cr' => $this->session->userdata('u')
	    );

            $this->Jobs_update_model->update($this->input->post('up_jobs_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
			$this->session->set_flashdata('status', 'alert-success');
            redirect(site_url('Report/AdminStaff/UpdateList'));
			
			
		}
		
			}else{
				
				//only data Update
				
				$data = array(
		
					'jobs_up_descr' => $this->input->post('jobs_up_descr',TRUE),
					'update_date'=>$this->input->post('update_date',TRUE),
					'job_up_st' => $this->input->post('job_up_st',TRUE),
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
		if($row['staff_kry']!=$cek['id_kry']){
			
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
	
	
	 public function Menu() {
        $this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        $this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
    }
	
	
	public function coba() {
        //$this->VIEW_FILE = "eoffice/register/admin"; // dynamic
        //$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		
		echo 'cakaakka';
    }
	
	
	public function booking_doc($cust_id=null){
		
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
		'doc_file'=>set_value('doc_file'), 
	   

	    
	);
        //$this->load->view('marketing/customer/st_cust_form', $data);
		$this->load->view($this->MAIN_VIEW, $load_resource);
        //$this->load->view('marketing/customer/st_cust_list', $data);
		
		
	}
	
	
	public function booking_doc_proses(){
		$this->form_validation->set_rules('doc_name', 'Nama Documment', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo 'form belum oke brow';
			$this->booking_doc($this->input->post('cust_id',TRUE));
		 }else {
			 
			$doc_name = str_replace(' ', '', ucwords($this->input->post('doc_name')));
			$and = '';
			$bk = $this->general_model->get_data_by_id('st_booking','cust_id',$this->input->post('cust_id',TRUE),$and);
			$code = $bk['bk_code'];
			
			$filename = $_FILES['uploadFile']['name'];
						
			$ext= substr(strrchr($filename, '.'), 1);
			$img_name = str_replace(' ', '_', ucwords($doc_name));
			
			$name_file_save1 = $img_name."-" .$code.".".$ext;
			$name_file = $img_name."-" .$code;
			$and = "AND doc_name='".$this->input->post('doc_name',TRUE)."'";
			$bk = $this->general_model->get_data_by_id('st_booking_doc','cust_id',$this->input->post('cust_id',TRUE),$and);
			
						
			$file_old = './file/'.$bk['doc_file'];
			if(file_exists($file_old)){
				unlink($file_old);
			}
			
		$config['upload_path'] = './file';
		$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx|xlsx';
		$config['max_size']     = 6000;
		$config['file_name'] = $name_file;

		$this->load->library('upload',$config);
			
		$field_name = "uploadFile";
		if (!$this->upload->do_upload($field_name)) {
			
			echo $this->session->set_flashdata('message',$this->upload->display_errors());
					redirect('marketing/Customer/')	;				
			
			}else {
				
								
				$data = array(
				
				'cust_id' => $this->input->post('cust_id',TRUE),
				'doc_name' => $this->input->post('doc_name',TRUE),
				'doc_file' => $name_file_save1,
				'cr_dt' => date("Y-m-d H:i:s"),
				'u_cr' => $this->session->userdata('u')
				
				);
				
				
				if(!empty($bk)){
					
					$data_up = array(				
					'doc_file' => $name_file_save1,
					'up_dt' => date("Y-m-d H:i:s"),
					'u_cr' => $this->session->userdata('u')
				
				);
				
				$where_doc = array('id'=>$bk['id']);
				
					//belum selesai
					if($this->general_model->update('st_booking_doc',$data_up,$where_doc)){
						$this->session->set_flashdata('message', 'File Document Berhasil Di update');
						
						redirect(site_url('marketing/FollowUp/DetailCustomer/'.$this->input->post('cust_id',TRUE).'#tab4'));
						
					}
					
					 
					
				}
				
				if($this->general_model->insert('st_booking_doc',$data)){
											
						$text = $sales['name_mark'].' INPUT BOOKING CUSTOMER '.$prj['project_name'].', Blok '.$this->input->post('project_blok',TRUE); 
						$data_activity = array ("marketing_id"=>$sales['id'],
												"actv_jn"=>'absen',
												"actv_text"=>$text,
												"cr_dt"=>date("Y-m-d h:i:sa")
												);
						if($this->general_model->insert('st_sales_activity',$data_activity)){
							 $this->session->set_flashdata('message', 'Anda berhasil Upload Dokument');
							  redirect(site_url('marketing/FollowUp/DetailCustomer/'.$this->input->post('cust_id',TRUE).'#tab4'));
							
						}else {
							$this->session->set_flashdata('message', 'Anda Input Booking Absensi');
							$this->absensi();
						}

					}
			}
			 
		}

	}
	
	
	public function _rules_vp() 
    {
	$this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
	$this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
	$this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	public function _rulesSelf() 
    {
	$this->form_validation->set_rules('dmm', 'dmm', 'trim|required');
	
    }


	
	// iki taroh di base ae
	

}
