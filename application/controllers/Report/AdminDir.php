<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseReport.php' );

class AdminDir extends AppBase {
	protected $rules = 4;
	 

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_Admin');
		$this->load->model('JobsModel');
      	$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		
		
			$user_id = $this->session->userdata('u');
			$session_rules = $this->session->userdata('rules');
		
		
    }

    public function index() {
		
	
        $this->VIEW_FILE = "Report/admin/adminVp"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		$load_resource['judul'] = 'LIST';
		$load_resource['jobs'] = $this->M_Admin->get_jobs_by_user_id($this->session->userdata('u'));
		$load_resource['tot'] = $this->M_Admin->get_jobs_by_user_id_ext_to_total($this->session->userdata('u'));
		$load_resource['tot_from'] = $this->M_Admin->get_jobs_by_user_id_ext_from2_total($this->session->userdata('u'));
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function notulen() {
		
		$this->VIEW_FILE = "Report/Staff/viewAllJobs"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		
		$css= base_url().'resource/assets_eoffice/table.css';
		
		$id = $this->input->get('dept');
		$dprt = $id!=null ? $id : '%%';
		$jobst= $this->M_Admin->get_all_departemen('%%');
		$jobs= $this->M_Admin->get_all_departemen($dprt);
		$html = '
										<form action="'.site_url('Report/AdminDir/notulen').'" class="form-horizontal" method="get"> 
                                        <div class="form-body">
                                            <h3 class="box-title"><?php echo $subtitle ?></h3>
                                            <hr class="m-t-0 m-b-40">
                                                                                        <!--/row-->
                                           
											<div class="row">
                                               	<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">SEARCH BY DEPARTEMENT </label>
                                                        <div class="col-md-9">
                                                            <select  name="dept" class="form-control">
																 <option value="">Select Departement Name</option>
																 <option value="">ALL Departement</option>';
														
																foreach ($jobst as $dp){
																	
														$html .= '<option value="'.$dp['id'].'">'.$dp['dprt_name'].'</option>';
																	
																}
								

															
                                                               
										$html .=  '</select> </div>
                                                    </div>
                                                </div>
												<div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                             	<button type="submit" class="btn btn-primary">SEARCH</button> 
																<a href="#" class="btn btn-default">Cancel</a>
															<br/>
                                                        </div>
                                                    </div>
                                                </div>
													
                                                </div>
												</div>
                                            <!--/row-->                                          
                                            <hr class="m-t-0 m-b-40">
                                            <!--/row-->
											<div class="form-actions">
                                            <div class="row">
                                                
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
											
                                        </div>
                                        
                                    </form>';
		$html .= '			
			<!DOCTYPE html>
			
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
			<link rel="stylesheet" href="'.$css.'">			
			<table class="responstable">
  			  <tr>
				<th width="3%">NO</th>
				<th width="15%">Division</th>
				<th width="62">Subject</th>			
			  </tr>';
		$no = 1;
		if(!empty($jobs)){
			foreach($jobs as $jb){
			
			
				$html .= '
				
					<tr>
						<td>'.$no.'</td>
						<td><h3>'.$jb['dprt_name'].'</h3></td>				
				';
				
				$html .= '<td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalADD'.$jb['id'].'">Add Note '.$jb['dprt_name'].'</button><br/><br/>';
				$html .= '
							<div class="modal fade" id="ModalADD'.$jb['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1'.$jb['id'].'">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">'.$jb['dprt_name'].'</h4> </div>
                                        <div class="modal-body">
                                            <form action="'.site_url('Report/AdminDir/NotulenCreate').'" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8"> 
												<input type="hidden" class="form-control" value="'.$jb['id'].'" id="recipient-name1" name="dprt_id">
												   <div class="form-group">
                                                    <label for="recipient-name" class="control-label">TITLE:</label>
                                                    <input type="text" class="form-control" value="" id="recipient-name1" name="tittle"> </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">DETAIL</label>
                                                    <textarea class="form-control" name="description" id="editoradd'.$jb['id'].'" placeholder="PROGRESS DETAIL"></textarea>
                                                </div>
												 <div class="form-group">
                                                    <label for="message-text" class="control-label">STATUS</label>
                                                    <select  name="notulen_st" class="form-control">
                                                                <option value="DONE_CLOSE">COMPLETE</option>
                                                                <option value="DONE_REVIEW">REVIEW</option>
																 <option value="PROGRESS" >PROGRESS</option>
																 <option value="DUE_DATE" >DUE DATE</option>
																 <option value="HOLD">HOLD</option>
                                                            </select>
                                                </div>
												<div class="form-group">
                                                    <label for="recipient-name" class="control-label">TARGET:</label>
                                                     <input class="form-control" type="date" name="target" value="" /></div>
												<div class="form-group">
                                                    <label for="recipient-name" class="control-label">NOTES:</label>
                                                     <input class="form-control" type="text" name="note" value="" /></div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">SAVE</button>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
							
				';
				$html .= "<script> 
									CKEDITOR.replace( 'editoradd".$jb['id']."' );
								</script>";
				
			$note = $this->M_Admin->get_notulen_by_dpt($jb['id']);
			
			if(!empty($note)){
				foreach($note as $notes){
						$sel ='';
					if($notes['notulen_st']=='DONE_REVIEW'){
				
						$st = ' <span class="label label-primary m-l-5">REVIEW</span>';
						$DONE_REVIEW = 'selected';
						$DONE_CLOSE = '';
						$PROGRESS = '';
						$HOLD = '';
						$DUE_DATE = '';
					}elseif($notes['notulen_st']=='DONE_CLOSE'){
						
						$st = '<span class="label label-success m-l-5">COMPLETE</span>';
						$DONE_REVIEW = '';
						$DONE_CLOSE = 'selected';
						$PROGRESS = '';
						$HOLD = '';
						$DUE_DATE = '';
					}elseif($notes['notulen_st']=='PROGRESS'){
						
						$st = '<span class="label label-info m-l-5">PROGRESS</span>';
						$DONE_REVIEW = '';
						$DONE_CLOSE = '';
						$PROGRESS = 'selected';
						$HOLD = '';
						$DUE_DATE = '';
					}elseif($notes['notulen_st']=='HOLD'){
						
						$st = '<span class="label label-warning m-l-5">HOLD</span>';
						$DONE_REVIEW = '';
						$DONE_CLOSE = '';
						$PROGRESS = '';
						$HOLD = 'selected';
						$DUE_DATE = '';
					}else {
						$st = '<span class="label label-danger m-l-5">DUE DATE</span>';
						
						$DONE_REVIEW = '';
						$DONE_CLOSE = '';
						$PROGRESS = '';
						$HOLD = '';
						$DUE_DATE = 'selected';
					}
					
						
						$html .= ' 			
											<div class="panel panel-default">
											  <div class="panel-heading">
												<h4 class="panel-title">
												  <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$notes['id'].'">'.$notes['tittle'].'</a>
												</h4>
											  </div>
											  <div id="collapse'.$notes['id'].'" class="panel-collapse collapse">
												<div class="ribbon ribbon-right ribbon-danger">Due Date : '.$notes['target'].'</div>
												<div class="panel-body">'.$notes['description'].'</div>
												<div class="panel-footer">'.$st.'
												<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModalEDIT'.$notes['id'].'"><i class="fa fa-edit"></i></button>
												
												<a href="'.site_url('Report/AdminDir/NotulenDelete/').$notes['id'].'" id="confirmation" class="btn btn-danger  pull-right"  ><i class="fa fa-trash"></i></a><hr/>
												<br/><br/>
											 Notes : '.$notes['note'].'
											</div>
											  </div>
											  
											  
											</div>';
							
							
							
										
										
								
                            
                            $html .='<div class="modal fade" id="ModalEDIT'.$notes['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1'.$notes['id'].'">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">'.$notes['tittle'].'</h4> </div>
                                        <div class="modal-body">
                                           <form action="'.site_url('Report/AdminDir/NotulenEdit').'" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">
												<input type="hidden" class="form-control" value="'.$notes['id'].'" id="recipient-name1" name="id">
												   <div class="form-group">
                                                    <label for="recipient-name" class="control-label">TITLE:</label>
                                                    <input type="text" class="form-control" value="'.$notes['tittle'].'" id="recipient-name1" name="tittle"> </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">DETAIL</label>
                                                    <textarea class="form-control" name="description"  placeholder="PROGRESS DETAIL">'.$notes['description'].'</textarea>
                                                </div>
												 <div class="form-group">
                                                    <label for="message-text" class="control-label">DETAIL</label>
                                                    <select  name="notulen_st" class="form-control">
                                                                <option value="DONE_CLOSE"'.$DONE_CLOSE.'>COMPLETE</option>
                                                                <option value="DONE_REVIEW" '.$DONE_REVIEW.'>REVIEW</option>
																 <option value="PROGRESS" '.$PROGRESS.'>PROGRESS</option>
																 <option value="DUE_DATE" '.$DUE_DATE.'>DUE DATE</option>
																 <option value="HOLD" '.$HOLD.'>HOLD</option>
                                                            </select>
                                                </div>
												<div class="form-group">
                                                    <label for="recipient-name" class="control-label">TARGET:</label>
                                                     <input class="form-control" type="date" name="target" value="'.$notes['target'].'" /></div>
												<div class="form-group">
                                                    <label for="recipient-name" class="control-label">NOTES:</label>
                                                     <input class="form-control" type="text" name="note" value="'.$notes['note'].'" /></div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">SAVE</button>
                                            
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
											
										
									
						';
						
						$html .= "<script> 
									CKEDITOR.replace( 'editor".$notes['id']."' );
								</script>";
					
						
						
							
					
				
								
			}
			}
			
			$html .= '</td></tr>';
			$no++;
		}
		}
		
		
		$html .= '</table>
				<!-- partial -->
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
			
			';
		$html .="<script type='text/javascript'>
										$('#confirmation').on('click', function () {
											return confirm('Are you sure?');
										});
									</script>";
		
		$load_resource['html']= $html;
		
		 $this->load->view($this->MAIN_VIEW, $load_resource); // fix
        
    }
	
	
		
	public function NotulenCreate(){
		
		 $this->_rules_nutulen();
		
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Error Create Not Complite');
           redirect(site_url('Report/AdminDir/notulen?dept='.$this->input->post('dprt_id',TRUE)));
        } else {
            $data = array(
		'dprt_id' =>$this->input->post('dprt_id',TRUE) ,
		'tittle' => $this->input->post('tittle',TRUE),
		'description' => $this->input->post('description',TRUE),
		'target' => $this->input->post('target',TRUE),
		'note' => $this->input->post('note',TRUE),
		'notulen_st' => $this->input->post('notulen_st',TRUE),
		'cr_dt' => date("Y-m-d H:i:s"),
		'up_dt' => date("Y-m-d H:i:s")
		
	    );

            $this->JobsModel->insert_notulen($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Report/AdminDir/notulen?dept='.$this->input->post('dprt_id',TRUE)));
        }
    }
	
	public function NotulenEdit(){
		
		 $this->_rules_nutulen();
		$dprt = $this->M_Admin->get_notulen_by_id($this->input->post('id', TRUE));
		
        if ($this->form_validation->run() == FALSE) {
           redirect(site_url('Report/AdminDir/notulen?dept='.$dprt['dprt_id']));
        } else {
			
			echo $this->input->post('description',TRUE);
			exit();
            $data = array(
		'tittle' => $this->input->post('tittle',TRUE),
		'description' => $this->input->post('description',TRUE),
		'target' => $this->input->post('target',TRUE),
		'note' => $this->input->post('note',TRUE),
		'notulen_st' => $this->input->post('notulen_st',TRUE),
		'up_dt' => date("Y-m-d H:i:s")
	    );
		
		

            $this->JobsModel->update_notulen($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Report/AdminDir/notulen?dept='.$dprt['dprt_id']));
        }
	}
	
	public function NotulenDelete($id){
		

	
			
            $data = array(
		'trash_st' => '1',
		'up_dt' => date("Y-m-d H:i:s")
	    );
			$dprt = $this->M_Admin->get_notulen_by_id($id);
			
            $this->JobsModel->update_notulen($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
             redirect(site_url('Report/AdminDir/notulen?dept='.$dprt['dprt_id']));
        
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
			
		
		if(!empty($this->input->post('dept',TRUE))){
			
			$id_dept = $this->input->post('dept',TRUE);
			
		}else {
			
			$id_dept  = $emp['dptmn_id'];
		}
		
		$jobs = $this->M_Admin->get_jobs_by_dprtmn_id($id_dept);
		
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
						<td><b>Task Code: '.$jb['jobs_code'].'</b><br/>'.$jb['jobs_tittle'].'<br/> Task Range:<br/>'.$jb['jobs_start'].' to '.$jb['jobs_end'].'<br/>'.$jobs_stat.'</td>
						<td>'.$jb['jobs_desc'].'</td>
						<td>'.$jb['emp_name'].'</td>
						<td></td>
					 </tr>
				
				';
				
			$jobs_up = $this->M_Admin->get_update_jobs_by_jobs_id($jb['jobs_id']);
			
			if(!empty($jobs_up)){
				foreach($jobs_up as $up){
					
					if($up['job_up_st']=='inprogress'){
				
						$job_up_st = ' <label class="label label-table label-warning">IPROGRESS</label>';
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
	
	public function _rules_nutulen() 
    {
	$this->form_validation->set_rules('tittle', 'Notulen tittle', 'trim|required');
	
    }
	
	
	public function _rules() 
    {
	$this->form_validation->set_rules('jobs_tittle', 'jobs tittle', 'trim|required');
	$this->form_validation->set_rules('jobs_desc', 'jobs desc', 'trim|required');
	$this->form_validation->set_rules('jobs_stat', 'jobs stat', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
	
	
	public function ReportTask() {
			
		
       $this->VIEW_FILE = "Report/Vp/VexcelReport"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['dept'] = $this->M_Admin->get_all_depertement();
		$load_resource['data'] = array(
			'title' => 'view Report All Departement',
			'subtitle' => 'Please Select Departement To View Report',
            'button' => 'View Report',
            'action' => site_url('Report/AdminDir/ViewAllTask')
			);
		
			
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function exelReport() {
			
		
       $this->VIEW_FILE = "Report/Vp/VexcelReport"; // dynamic
		$load_resource = $this->load_resource(); // digawe ngene ikie
		$load_resource['CONTOH'] = 'Namaku Fuad';
		
		$load_resource['dept'] = $this->M_Admin->get_all_depertement();
		$load_resource['data'] = array(
			'title' => 'Generate Excel Report All Departement',
			'subtitle' => 'Please Select Departement To Export Excel',
            'button' => 'Generate Report',
            'action' => site_url('Report/AdminDir/coba_loop')
			);
		
			
		
		
        $this->load->view($this->MAIN_VIEW, $load_resource); // fix
    }
	
	
	public function coba_loop (){
	 
		
		$css= base_url().'resource/assets_eoffice/table.css';
		$emp= $this->M_Admin->get_employe_by_id($this->session->userdata('u'));
		
		if(!empty($this->input->post('dept',TRUE))){
			
			$id_dept = $this->input->post('dept',TRUE);
			
		}else {
			
			$id_dept  = $emp['dptmn_id'];
		}
		
		$jobs = $this->M_Admin->get_jobs_by_dprtmn_id($id_dept);
	
		
		$html = '
			<!DOCTYPE html>
			
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
			<link rel="stylesheet" href="'.$css.'">
			
			<table border ="1" class="responstable">
  			  <tr>
				<th height ="50" align="center">NO</th>
				<th height ="20" align="center">TASK TITLE</th>
				<th height ="20" align="center">TASK DETAIL</th>
				<th height ="20" align="center">DUEDATE/DATE UPDATE</th>
				<th height ="20" align="center">PIC </th>
				<th height ="20" align="center">STATUS</th>
				<th height ="20" align="center">PICTURE/FILE</th>
			  </tr>
		';
		$no = 1;
		if(!empty($jobs)){
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
						<td>'.$jb['jobs_tittle'].'</td>
						<td>'.$jb['jobs_desc'].'</td>
						<td>'.$jb['jobs_start'].' to '.$jb['jobs_end'].'</td>
						<td>'.$jb['emp_name'].'</td>
						<td>'.$jobs_stat.'</td>
						<td></td>
					 </tr>
				
				';
				
			$jobs_up = $this->M_Admin->get_update_jobs_by_jobs_id($jb['jobs_id']);
			
			if(!empty($jobs_up)){
				foreach($jobs_up as $up){
					
					if($up['job_up_st']=='inprogress'){
				
						$job_up_st = ' <label class="label label-table label-warning">IPROGRESS</label>';
					}elseif($up['job_up_st']=='done'){
						
						$job_up_st = ' <label class="label label-table label-success">DONE</label>';
						
					}else {
						
						$job_up_st = ' <label class="label label-table label-danger">HOLD</label>';
					}
					
					if(!empty($up['pic'])){
						
						$extension= substr(strrchr($up['pic'], '.'), 1);
						
							
							$picture ='<a href="'.base_url('file/'.$up['pic']).'" class="btn btn-primary"> Download File '.$extension.' </a>';
						
					}else {
						
						$picture='';
					}
				
				$html .= '
				
					<tr>
						<td></td>
						<td></td>
						<td>'.$up['jobs_up_descr'].'</td>
						<td>Processing Date : '.$up['update_date'].'</td>
						<td> '.$up['emp_name'].'</td>
						<td> '.$job_up_st.'</td>
						<td>'.$picture.'</td>
					 </tr>
				
				';
				
			}
			}
			
			
			$no++;
		}
		}
		
		
		$html .= '</table>
				<!-- partial -->
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
			
			';
		$dpt = $this->M_Admin->get_all_depertement_byid($id_dept);
		$load_resource['dd'] = str_replace(" ","_",$dpt['dprt_desc']).'.xls';
		$load_resource['html']= $html;
	
		$this->load->view('Report/Vp/excel', $load_resource);
	
	}
	
	

	
	
	// iki taroh di base ae
	

}
