<?php

class general_model extends CI_Model {

    // constructor
    function __construct() {
        parent::__construct();
    }
	
	
	public function get_all_data($table){		
		$sql = "SELECT * FROM $table";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	function Get_detail_customer2($cust_id=null) {

        $this->db->order_by('st_cust.cr_up', 'DESC');
		$this->db->where('st_cust.id', $cust_id);
		$this->db->from('st_cust');
		$this->db->join ('st_source', 'st_cust.source = st_source.id_sc' , 'INNER');
		$this->db->join ('st_marketing', 'st_marketing.id = st_cust.sales_id' , 'INNER');
		$this->db->join ('st_booking', 'st_booking.cust_id = st_cust.id' , 'LEFT');
		return $this->db->get()->row();
	}
	
	
	function Get_detail_customer($cust_id=null){
		$sql = "SELECT *,st_booking.id as BookingId,st_cust.id as cusid FROM `st_cust` 
		INNER JOIN `st_source` ON `st_cust`.`source` = `st_source`.`id_sc` 
		INNER JOIN `st_marketing` ON `st_marketing`.`id` = `st_cust`.`sales_id` 
		LEFT JOIN `st_booking` ON `st_booking`.`cust_id` = `st_cust`.`id` 
		LEFT JOIN st_project ON st_project.id = st_booking.project_id
		WHERE `st_cust`.`id` = '$cust_id' ORDER BY `st_cust`.`cr_up` DESC";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
	function Get_followup($cust_id=null){
		$sql = "SELECT * FROM st_followup_det a JOIN st_cust b ON a.cust_id = b.id WHERE a.cust_id = '$cust_id' ORDER BY `a`.`cr_dt` DESC";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
	function Get_dokument($cust_id=null){
		$sql = "SELECT * FROM st_booking_doc a JOIN st_cust b ON a.cust_id = b.id WHERE a.cust_id = '$cust_id' ORDER BY `a`.`cr_dt` DESC";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
	function Get_bicek($cust_id=null){
		$sql = "SELECT * FROM st_bi_checking WHERE book_id like '$cust_id' ORDER BY cr_up DESC";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
	
	function get_queue(){
		$sql = "SELECT queue_up FROM st_queue";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}

    // is exist data
    function is_existdata($table, $column, $data) {
        $retval = TRUE;
        $sql = "SELECT COUNT(*)'total' FROM $table WHERE UPPER($column) = '$data'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if ($result['total'] == 0) {
                $retval = FALSE;
            }
        } else {
            $retval = FALSE;
        }
        return $retval;
    }
	
	 function count_all($field,$table) {
        $retval = TRUE;
        $sql = "SELECT COUNT($field)'total' FROM $table";
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }

    // check is used
    function is_used($table, $column, $id) {
        $retval = TRUE;
        $sql = "SELECT COUNT(*)'total' FROM $table WHERE $column = '$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if ($result['total'] == 0) {
                $retval = FALSE;
            }
        } else {
            $retval = FALSE;
        }
        return $retval;
    }
	
	function get_data_by_id($table, $column, $id,$and=null){
		$sql = "SELECT * FROM $table WHERE $column = $id.$and";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
		
    // function get autocomplete
    function get_autocomplete($table, $column) {
        $retval = "";
        $sql = "SELECT GROUP_CONCAT(DISTINCT($column) ORDER BY $column ASC)'list' FROM $table";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();

            $temp = explode(",", $result['list']);
            if (count($temp) > 0) {
                $idx = 0;
                foreach ($temp as $arr) {
                    if ($idx == 0) {
                        $retval .= '"' . $arr . '"';
                    } else {
                        $retval .= ',"' . $arr . '"';
                    }
                    $idx++;
                }
            }
        }

        return $retval;
    }

    // get id
    function _get_id() {
        $time = microtime(true);
        $id = str_replace('.', '', $time);
        return $id;
    }

    // insert query
    function insert($table_name, $array_data, $array_where = NULL) { // array_where unused but use in programming
        return $this->db->insert($table_name, $array_data);
    }

    function insert_return($table_name, $array_data, $array_where = NULL) { // array_where unused but use in programming
        if ($this->db->insert($table_name, $array_data)) {
            return $this->db->insert_id();
        }
    }

    //insert batch
    function insert_batch($table, $params) {
        $this->db->trans_start();
        $this->db->insert_batch($table, $params);
        $this->db->trans_complete();
        return ($this->db->trans_status() == FALSE) ? FALSE : TRUE;
    }

    // update query
    function update($table_name, $array_data, $array_where) {
        $this->db->where($array_where);
        return $this->db->update($table_name, $array_data);
    }

    // delete query
    function delete($table_name, $array_where) {
        $this->db->where($array_where);
        return $this->db->delete($table_name);
    }

    // get last auto increment in table
    function get_last_autoincrement($table) {
        $dbname = $this->db->database;
        $sql = "SELECT `AUTO_INCREMENT` AS'id' FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['id'];
        } else {
            return "0";
        }
    }

    //get dynamic data
    function get_data($table, $where=null) {
        $sql = "SELECT * FROM $table " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // get option for select
    function get_option($table, $column1, $column2, $where) {
        $retval = array();
        $sql = "SELECT CONCAT($column1,'-',$column2)'opt' FROM $table " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $retval['opt'] = $query->result_array();
        }

        $retval['maxchar'] = $this->get_maxchar_incolumn($table, $column2);

        return $retval;
    }

    // function get ID
    function get_ID($table, $column_select, $where_column, $where_value) {
        $retval = null;
        $sql = "SELECT $column_select'id' FROM $table WHERE $where_column = '$where_value'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $retval = $query->row_array();
            $retval = $retval['id'];
        }
        return $retval;
    }

    // 4ND : 01/08/2017 07:17 get total max char in column
    function get_maxchar_incolumn($table, $column) {
        $retval = 0;
        $sql = "SELECT MAX(LENGTH($column))'total' FROM $table";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $retval = $query->row_array();
            $retval = $retval['total'];
        }
        return $retval;
    }

    // 4ND : 4/25/2018 4:45 PM
    function get_last_number($table = null, $column = null) {
        $retval = 1;
        $sql = "SELECT IFNULL($column,1) AS 'no' 
                FROM $table 
                ORDER BY $column DESC LIMIT 0,1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $retval = $result['no'] + 1;
        }
        return $retval;
    }

    function get_dt($table_name = null, $select = NULL, $where = array(), $limit = NULL, $offset = NULL, $order = array()) {
        if (!is_null($select)) {
            $this->db->select($select);
        }
        if (!is_null($where)) {
            foreach ($where as $col => $val) {
                if (preg_match("/(<=|>=|=|<|>)(\s*)(.+)/i", trim($val), $matches))
                    $this->db->where($col . ' ' . $matches[1], $matches[3]);
                else
                    $this->db->where($col . ' LIKE', '%' . $val . '%');
            }
        }

        if (!empty($order)) {
            foreach ($order as $col => $val) {
                $ordered = (isset($val)) ? $val : 'ASC';
                $this->db->order_by($col, $val);
            }
        }

        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) {
            if ($limit == 0 && $offset == 1) {
                $result = $query->row_array();
            } else {
                $result = $query->result_array();
            }

            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }

}
