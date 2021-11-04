<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	
	function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }


    function cek_login($params){

    	$sql = "SELECT *,b.rules_id as rules,c.portal_id as portal FROM com_user a 
				JOIN com_rules_det d on d.user_id = a.id_user
				JOIN com_rules b ON d.rules_id = b.rules_id
				JOIN com_portal c ON b.portal_id = c.portal_id
				WHERE username =? AND passwords =? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }


    function result_user($params){
        $sql = "SELECT * FROM user WHERE username = ? AND password = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }



}