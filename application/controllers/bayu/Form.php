<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BayuFormBase.php');

class Form extends AppBase {

    public function __construct() {
        parent::__construct();
		//$this->cek_absen(); 
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->model('general_model');
		$this->load->library('pagination');
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->load->library(array('recaptcha','form_validation'));
		ini_set('memory_limit',-1);
		
    }
	

    public function index() {
        $this->VIEW_FILE = "bayu/form"; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['data'] = array(
            'button' => 'Submit',
			'action' => site_url('bayu/Form/Proses'),
			'recaptcha_html' => $this->recaptcha->render()
			
			);
		$this->load->view($this->MAIN_VIEW, $load_resource); // fix	
    }
	
	
	public function Flight() {
        $this->VIEW_FILE = "bayu/flight"; // dynamic
		$load_resource = $this->load_resource();
		$load_resource['data'] = array(
            'button' => 'Submit',
			'action' => site_url('bayu/Form/Proses'),
			'recaptcha_html' => $this->recaptcha->render()
			
			);
		$this->load->view($this->MAIN_VIEW, $load_resource); // fix	
    }
	
	 public function Proses() {
		 
		 	//set form validation
        $this->form_validation->set_rules('fullName', 'fullName', 'required');
       	//$this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
        //set message form validation
        //$this->form_validation->set_message('required', '{field} is required.');
        //$this->form_validation->set_message('callback_getResponseCaptcha', '{field} {g-recaptcha-response} harus diisi. ');
        if($this->form_validation->run() == TRUE)
        {

            //kondisi jika recaptcha dan form validasi terpenusi
			
			
			$datetime = date("Y-m-d H:i:s");
			$mobile = str_replace([' ','-','+'],'',$this->input->post('phoneNum',TRUE));
			$q = $this->input->post('q',TRUE);
			$t = $this->input->post('q',TRUE)=='Flight' ? 'Flight' :'';
			$mail = $this->input->post('email',true);
			$names = $this->input->post('fullName',TRUE);
			$hotel_check_in = $this->input->post('check_in',TRUE);
			$hotel_check_out = $this->input->post('check_out',TRUE);
			$hotel_total_room = $this->input->post('room',TRUE);
			$hotel_room_type= $this->input->post('type',TRUE);
			$aditional_require = $this->input->post('message',TRUE);
			$flight_type = $this->input->post('JourneyType',TRUE);
			$flight_depart = $this->input->post('depart',TRUE);
			$flight_arrival = $this->input->post('arrival',TRUE);
			$flight_depart_date = $this->input->post('depart_date',TRUE);
			$flight_return_date = $this->input->post('return_date',TRUE);
			$flight_airline = $this->input->post('airline_name',TRUE);
			$flight_class = $this->input->post('class',TRUE);
			
			$data = array(
				'names'=>$names,
				'mobile_no' => $mobile,
				'email' => $mail,
				'hotel_check_in' =>$hotel_check_in,
				'hotel_check_out' => $hotel_check_out,
				'hotel_total_room' => $hotel_total_room,
				'hotel_room_type' => $hotel_room_type,
				'aditional_require' => $aditional_require,
				'flight_type' => $flight_type,
				'flight_depart' => $flight_depart,
				'flight_arrival' => $flight_arrival,
				'flight_depart_date' => $flight_depart_date,
				'flight_return_date' => $flight_return_date,
				'flight_airline' => $flight_airline,
				'flight_class' => $flight_class,
				'ip'=>$_SERVER['REMOTE_ADDR'],
				'input_date' => $datetime
			);
					$config = Array(
                       	'mailtype'    => 'html',
						'charset'     => 'utf-8',
						'protocol'    => 'smtp',
						'smtp_host'   => 'smtp.gmail.com',
						'smtp_user'   => 'alert.travewell@gmail.com',  // Email gmail
						'smtp_pass'   => 'kucing18',  // Password gmail
						'smtp_crypto' => 'ssl',
						'smtp_port'   => 465,
						'crlf'    => "\r\n",
						'newline' => "\r\n"
                    );
			
         //Load email library 
         $this->load->library('email',$config); 
		
	if($q == 'Flight'){
		
		$dataMail = '
									<table align="left">
														<tr>
															<th  align="left">Name</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$names.'</td>
														</tr>
														<tr>
															<th  align="left">Mobile No</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$mobile.'</td>
														</tr>
														<tr>
															<th  align="left">Email</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$mail.'</td>
														</tr>
														<tr>
															<th  align="left">One Way / Return</th>
															<th  align="left"></th>
															<td align="left">:</td>
															<td  align="left">'.$flight_type.'</td>
														</tr>
														<tr>
															<th  align="left">Depart From</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$flight_depart.'</td>
														</tr>
														<tr>
															<th  align="left">Depart To</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$flight_arrival.'</td>
														</tr>
														<tr>
															<th align="left">Depart Date</th>
															<th align="left"></th>
															<td  align="left">:</td>
															<td align="left">'.$flight_depart_date.'</td>
														</tr>
														
														<tr>
															<th  align="left">Return Date</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$flight_return_date.'</td>
														</tr>
														
														<tr>
															<th  align="left">Airline Name</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$flight_airline.'</td>
														</tr>
														
														<tr>
															<th  align="left">Class</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$flight_class.'</td>
														</tr>
														
														<tr>
															<th  align="left">Additional Requirments</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$aditional_require.'</td>
														</tr>

													</table>
		';
	}else {
		
		$dataMail = '
									<table align="left">
														<tr>
															<th  align="left">Name</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$names.'</td>
														</tr>
														<tr>
															<th  align="left">Mobile No</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$mobile.'</td>
														</tr>
														<tr>
															<th  align="left">Email</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$mail.'</td>
														</tr>
														<tr>
															<th align="left">Check In Date</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td align="left">'.$hotel_check_in.'</td>
														</tr>
														<tr>
															<th  align="left">Check Out Date</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$hotel_check_out.'</td>
														</tr>
														<tr>
															<th  align="left">Total Room</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$hotel_total_room.'</td>
														</tr>
														<tr>
															<th align="left">Room Type</th>
															<th  align="left"></th>
															<td  align="left">:</td>
															<td  align="left">'.$hotel_room_type.'</td>
														</tr>
														
														<tr>
															<th  align="left">Additional Requirments</th>
															<th  align="left"></th>
															<td align="left">:</td>
															<td  align="left">'.$aditional_require.'</td>
														</tr>
														</table>';
	}
		
		$message = 
	<<<EOF
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
	<!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<!--[if !mso]><!-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<![endif]-->
	<title></title>
	<!--[if !mso]><!-->
	<!--<![endif]-->
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
	</style>
	<style type="text/css" id="media-query">
		@media (max-width: 520px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col_cont {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num2 {
				width: 16.6% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num5 {
				width: 41.6% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num7 {
				width: 58.3% !important;
			}

			.no-stack .col.num8 {
				width: 66.6% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.no-stack .col.num10 {
				width: 83.3% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}

			.img-container.big img {
				width: auto !important;
			}
		}
	</style>
</head>

<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
	<!--[if IE]><div class="ie-browser"><![endif]-->
	<table class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" cellpadding="0" cellspacing="0" role="presentation" width="100%" bgcolor="#FFFFFF" valign="top">
		<tbody>
			<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
					<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->
					<div style="background-color:transparent;">
						<div class="block-grid " style="min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
							<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
								<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
								<!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
								<div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
									<div class="col_cont" style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<div class="img-container center autowidth big" align="center" style="padding-right: 0px;padding-left: 0px;">
												<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img class="center autowidth" align="center" border="0" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/BeeFree/beefree-kx5vxccb2vl/BAYU%20BUANA_LOGO_HORIZONTAL_COLOR_1600.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 500px; max-width: 100%; display: block;" width="500">
												<!--[if mso]></td></tr></table><![endif]-->
											</div>
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
							</div>
						</div>
					</div>
					<div style="background-color:transparent;">
						<div class="block-grid " style="min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
							<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
								<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:500px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
								<!--[if (mso)|(IE)]><td align="center" width="500" style="background-color:transparent;width:500px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
								<div class="col num12" style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
									<div class="col_cont" style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<table cellpadding="0" cellspacing="0" role="presentation" width="100%" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top">
												<tr style="vertical-align: top;" valign="top">
													<td style="word-break: break-word; vertical-align: top; padding-bottom: 0px; padding-left: 0px; padding-right: 0px; padding-top: 0px; text-align: center; width: 100%;" width="100%" align="center" valign="top">
														<h1 style="color:#555555;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:23px;font-weight:normal;letter-spacing:normal;line-height:120%;text-align:center;margin-top:0;margin-bottom:0;"><strong>Email From Customer $q</strong></h1>
													</td>
												</tr>
											</table>
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
											<div style="color:#393d47;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
												<div class="txtTinyMce-wrapper" style="font-size: 14px; line-height: 1.2; color: #393d47; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 17px;">
													<p style="margin: 0; font-size: 14px; line-height: 1.2; word-break: break-word; mso-line-height-alt: 17px; margin-top: 0; margin-bottom: 0;">Berikut Adalah data calon customer $q</p> 
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<div style="font-size:16px;text-align:center;font-family:Arial, Helvetica Neue, Helvetica, sans-serif">
												<div class="our-class">
													<hr />
														$dataMail
													<hr />

												</div>
											</div>
											
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
							</div>
						</div>
					</div>
					<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
				</td>
			</tr>
		</tbody>
	</table>
	<!--[if (IE)]></div><![endif]-->
</body>

</html>
	
EOF;
		;
        $from_email = 'no-replay@bayubuanatravel.com';
         $this->email->from($from_email, 'Request From -'.$names); 
         $this->email->to($this->input->post('email'));
         $this->email->subject($names.'- Email Request '.$q); 
         $this->email->message($message); 
   
         //Send mail 
				if($this->email->send()){
					
					if ($this->general_model->insert('bayu_form',$data)){
									
									
									echo $this->session->set_flashdata('message', '<div class="alert alert-success">
												  <strong>Success!</strong> Data Anda Telah Kami simpan, * Kami akan segera menghubungi Anda dalam waktu maksimal 24 Jam.
												</div>');
											   redirect('bayu/Form/'.$t);
									
								}else {
									
									echo $this->session->set_flashdata('message', "<div class='danger'>
								  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
								ERROR, DATA BELUM TERSIMPAN MOHON DI ULANGI
								</div>");
									redirect('bayu/Form/'.$t);
								}
					
				} 
										
			
			
        }else{
			echo $this->session->set_flashdata('message', "<div class='danger'>
				  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
				MOHON DI ISI SEMUA DATA ANDA
				</div>");
         redirect('bayu/Form/'.$t);
		 
	 }
	 }
	 
	 
	 public function getResponseCaptcha($str)
    {
        $this->load->library('recaptcha');
        $response = $this->recaptcha->verifyResponse($str);
        if ($response['success'])
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('getResponseCaptcha', '%s is required.' );
            return false;
        }
    }
	
	
	
    
	
	/* public function index(){

		if(!empty($this->session->userdata('username')) and $this->session->userdata('level') == 2){
			redirect('asset');
		}else {

			$this->load->view('home/v_login');
		}	
		
	}



	

	function logout(){
		$this->session->sess_destroy();

		redirect('login');
	}
	*/
	
	
	

    
	
	 
    }


	
	
	