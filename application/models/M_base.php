<?php

class M_base extends CI_Model {

    protected $db_local = NULL;
    protected $db_online = NULL;

    function __construct() {
        parent::__construct();
        // base load app
        $this->_load();
    }

    protected function _load($db_config = "") {
        $this->db_local = $this->load->database($db_config, TRUE);
    }

    protected function _onload($db_config = "") {
        $this->db_online = $this->load->database($db_config, TRUE);
    }

}
