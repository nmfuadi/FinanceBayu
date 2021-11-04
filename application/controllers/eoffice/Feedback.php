<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// load base class if needed
require_once( APPPATH . 'controllers/base/BaseSys.php' );

class Feedback extends AppBase {

    public function __construct() {
        parent::__construct();
		$this->load->model(array('m_feedback'));
    }

    public function index() {
        // LOAD css
        //$this->load_style("resource/assets_eoffice/css/style.unminified.css");
        // LOAD javascript
        //$this->load_javascript("resource/assets_eoffice/js/toastr.js");
        // LOAD BOTTOM js
        //$this->load_bottom_js("resource/assets_eoffice/js/toastr.js");
		$this->load->library(array('form_validation', 'session'));
        $this->form_validation->set_rules('alamatEmail', 'Alamat Email', 'required|regex_match[/^[a-z0-9A-Z@._]+$/]|callback__cek_email_member');
		$this->form_validation->set_rules('kodeRegiter', 'Kode Register', 'required|callback__cek_kode_training');
		$this->form_validation->set_error_delimiters('<div class="help-block form-text with-errors form-control-feedback">', '</div>');
        if ($this->form_validation->run()) {
			$kode = $this->input->post('kodeRegiter');
			$email = $this->input->post('alamatEmail');
			if (!is_null($dataKelasAktif = $this->m_feedback->getMemberActiveKelas($email, $kode)) ) {
				$dataSession = array(
					'feedback_jadwal_id' => $dataKelasAktif->row()->jadId,
					'feedback_jadwal_peserta_id' => $dataKelasAktif->row()->jadpesId,
					'feedback_jadwal_peserta_email' => $dataKelasAktif->row()->jadpesMemberEmail,
					'feedback_member_joinx_id' => $dataKelasAktif->row()->jadpesMemberJoinxId,
				);
				$this->session->set_userdata($dataSession);
				redirect('eoffice/Feedback/input');
			} 
			else {
				$this->session->set_flashdata('error_form', 'Anda belum mendaftarkan diri anda pada pelatihan yang anda ikuti saat ini.');
				redirect('eoffice/Feedback/index');
			}
		}
		else {
			$dataSession = array(
					'feedback_jadwal_id' => NULL,
					'feedback_jadwal_peserta_id' => NULL,
					'feedback_jadwal_peserta_email' => NULL,
					'feedback_member_joinx_id' => NULL,
				);
			$this->session->set_userdata($dataSession);
			$this->VIEW_FILE = "eoffice/feedback/index"; // dynamic
			$this->load->view($this->MAIN_VIEW, $this->load_resource()); // fix
		}		
    }
	
	public function input() {
		if($this->session->userdata('feedback_jadwal_id') == '' AND $this->session->userdata('feedback_jadwal_id') == NULL ){
			$this->session->set_flashdata('error_form', 'Silahkan isikan data dengan valid terlebih dahulu.');
			redirect('eoffice/Feedback/index');
		}
		
		$this->load->library(array('form_validation', 'session'));
        $this->form_validation->set_rules('alamatEmail', 'Alamat Email', 'required');
		$this->form_validation->set_rules('kodeRegiter', 'Kode Register', 'required');
		$this->form_validation->set_error_delimiters('<div class="help-block form-text with-errors form-control-feedback">', '</div>');
        if ($this->form_validation->run()) {
			
		}
		else {
			
			$tpl['pertanyaan_multiple_materi'] = $this->m_feedback->get_pertanyaan_multiple_materi();
            $tpl['pertanyaan_multiple_pelayanan'] = $this->m_feedback->get_pertanyaan_multiple_pelayanan();
            $tpl['pertanyaan_multiple_fasilitaslab'] = $this->m_feedback->get_pertanyaan_multiple_fasilitaslab();
            $tpl['pertanyaan_multiple_instruktur'] = $this->m_feedback->get_pertanyaan_multiple_instruktur();
            $tpl['pertanyaan_deskriptif'] = $this->feedback_model->get_pertanyaan_deskriptif();
			$this->load->view('eoffice/feedback/input', $tpl);
		}		
    }
	
	public function ajax() {
			
    }
	
	function _cek_kode_training($str) {
        if (is_null($this->m_feedback->getSesiCodeRegister($str))) {
            $this->form_validation->set_message('_cek_kode_training', 'Kode-Register tidak ditemukan.');
            return false;
        } else {
            return true;
        }
    }
	
	function _cek_email_member($srt) {
        if ($this->m_feedback->getMemberActive($srt)) {
            return true;
        } else {
            $this->form_validation->set_message('_cek_email_member', "Email yang anda masukkan belum terdaftar.");
            return false;
        }
    }
}
