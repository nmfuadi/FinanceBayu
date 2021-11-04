<?php

// load base class if needed
require_once( APPPATH . 'controllers/base/OperatorLoginBase.php' );

class OperatorLogin extends ApplicationBase {

    // constructor
    public function __construct() {
        // parent constructor
        parent::__construct();
        // load global
        $this->load->library('form_validation');
    }

    /**
     * Login Form
     * 
     * @param string $status
     */
    public function index($status = "") {
        // set template content
        $this->template->assign("template_content", "login/operator/form");
        // bisnis proses
        if (!empty($this->com_user)) {
            // redirect
            redirect($this->com_user['default_page']);
        } else {
            $this->template->assign("login_st", $status);
        }
        // output
        parent::display();
    }

    /**
     * Login Process
     * 
     * Handle XHR and non-XHR request
     */
    public function login_process() {
        // response
        $response = array(
            "login" => array(
                "status" => false,
                "message" => null
            ),
            "rdr" => null
        );
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
                    // locked user
                    $response['login']['message'] = "Your account has been locked, Please contact your administrator to activate your account.";
                    $response['rdr'] = 'login/operatorlogin/index/locked';
                } else {
                    // set session
                    $users = array(
                        "user_id" => $result['user_id'],
                        "user_name" => $result['user_name'],
                        "role_nm" => $result['role_nm'],
                        "default_page" => $result['default_page']
                    );
                    $this->session->set_userdata('session_operator', $users);
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
                    $response['login']['status'] = true;
                    $response['login']['message'] = "";
                    $response['rdr'] = $result['default_page'];
                }
            } else {
                // output
                $response['login']['message'] = "Incorrect username or password. Please try again.";
                $response['rdr'] = 'login/operatorlogin/index/error';
            }
        } else {
            // default error
            $response['login']['message'] = "Incorrect username or password. Please try again.";
            $response['rdr'] = 'login/operatorlogin/index/error';
        }

        // response handle
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            // rewrite redirect
            $response['rdr'] = site_url($response['rdr']);
            // display
            echo json_encode($response);
            exit();
        } else {
            redirect($response['rdr']);
        }
    }

    /**
     * Logout Process
     */
    public function logout_process() {
        // unset session 
        $this->session->unset_userdata('session_operator');
        // output
        redirect('login/operatorlogin');
    }

}
