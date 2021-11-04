<?php

// load base class if needed
require_once( APPPATH . 'controllers/base/AdminLoginBase.php' );

class Adminlogin extends ApplicationBase {

    // constructor
    public function __construct() {
        // parent constructor
        parent::__construct();
        // load global
        $this->load->library('form_validation');
    }

    // landing page
    public function index($status = "") {
        // set template content
        $this->template->assign("template_content", "login/admin/form");
        // bisnis proses
        if (!empty($this->com_user)) {
            // still login
            $this->template->assign("login_st", 'still');
        } else {
            $this->template->assign("login_st", $status);
        }
        // output
        parent::display();
    }

    // login process
    public function login_process() {
        // set rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|max_length[30]');
        // process
        if ($this->form_validation->run() !== FALSE) {
            // params
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('pass'));
            // get user detail
            $result = $this->m_site->get_user_login($username, $password, $this->portal_id);
            // check
            if (!empty($result)) {
                // cek lock status
                if ($result['lock_st'] == '1') {
                    // output
                    redirect('login/adminlogin/index/locked');
                }
                // set session
                $users = array("user_id" => $result['user_id'], "user_name" => $result['user_name'], "role_nm" => $result['role_nm']);
                $this->session->set_userdata('session_admin', $users);
                // delete login time
                $this->m_site->delete_user_login_by_date($result['user_id']);
                // insert login time
                $params = array(
                    "user_id" => $result['user_id'],
                    "login_date" => date("Y-m-d H:i:s"),
                    "ip_address" => $_SERVER['REMOTE_ADDR']
                );
                $this->m_site->save_user_login($params);
                // redirect
                redirect($result['default_page']);
            } else {
                // output
                redirect('login/adminlogin/index/error');
            }
        } else {
            // default error
            redirect('login/adminlogin/index/error');
        }
        // output
        redirect('login/adminlogin');
    }

    // logout process
    public function logout_process() {
        $this->session->unset_userdata('session_admin');
        // output
        redirect('login/adminlogin');
    }

}
