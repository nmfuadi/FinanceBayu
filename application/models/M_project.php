<?php

class M_project extends CI_Model {
	
	// constructor
    function __construct() {
        parent::__construct();
    }
	
	
	public function get_all_project_limit($params){		
		$sql = "SELECT * FROM st_project where st_active = '1' ORDER BY u_date DESC LIMIT ?,?";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	
	function get_total_project_limit() {
        $sql = "SELECT COUNT(*)'total' FROM st_project where st_active = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
	
	
}