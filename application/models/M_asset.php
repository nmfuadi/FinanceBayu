<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_asset extends CI_Model {
	
	function  __construct() {
        // Call the Model constructor
        parent::__construct();
		
		
		
    }
	
	
	// Fungsi untuk menampilkan semua data gambar
	public function view(){
		return $this->db->get('asset_corporate')->result();
	}

	public function get_all_asset_limit($params){		
		$sql = "SELECT * FROM asset_data where   status_photo_l = 'no' or status_photo_a ='no' ORDER BY supplier_name ASC LIMIT ?,?";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	
	
	public function supplier (){		
		$sql = "SELECT supplier_name FROM asset_data GROUP BY supplier_name";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	
	
	
	 function get_total_asset_limit() {
        $sql = "SELECT COUNT(*)'total' FROM asset_data where   status_photo_l = 'no' or status_photo_a ='no'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
	
	
	
	
	public function data_asset_excel($params){		
		$sql = "SELECT * FROM asset_data WHERE supplier_name = ? AND status_photo_a = 'yes' AND DATE LIKE ? order by date asc";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	public function data_asset_excel_no_genba($params){		
		$sql = "SELECT * FROM asset_data WHERE supplier_name = ? AND status_photo_a = 'no'";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	public function data_asset_plate($params){		
		$sql = "SELECT * FROM asset_data WHERE label_st ='missed' AND supplier_name = ? AND status_photo_a = 'yes' AND DATE LIKE ? order by date asc";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	

	
	public function get_asset_by_photo_limit($params){		
		$sql = "SELECT * FROM asset_data  where   status_photo_l = 'yes' or status_photo_a ='yes' ORDER BY `date` DESC  LIMIT ?,?";      
        $query = $this->db->query($sql,$params);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	public function get_asset_backup($params){		
		$sql = "SELECT * FROM asset_data  where   bak_st = '0'  LIMIT 0,$params";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	public function count_bak(){		
		$sql = "
			SELECT
			(CASE
			WHEN bak_st ='0' THEN 'Asset Belum Di Backup'
			WHEN bak_st ='1' THEN 'Asset Sukses Di Backup'
			ELSE 'Asset Belum Genba'
			END) AS bak,
			COUNT(*) AS 'jumlah' FROM asset_data GROUP BY bak_st
		";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	
	 function get_total_asset_by_photo_limit() {
        $sql = "SELECT COUNT(*)'total' FROM asset_data where  status_photo_l = 'yes' or status_photo_a ='yes' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
	
	
	
	
	function search_asset_by_id($params){
		$sql = "SELECT * FROM asset_data WHERE asset_fams like ? OR part_number like ? OR asset_desc like ?";
		$query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function get_asset_by_id($params){
		$sql = "SELECT * FROM asset_data WHERE asset_fams = ?";
		$query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function get_user_one(){
		$sql = "SELECT * FROM users ORDER BY ID DESC LIMIT 1";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function get_date (){
		
		$sql = "SELECT DATE_FORMAT(DATE, '%Y-%m-%d') AS tanggal FROM asset_data GROUP BY DATE";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
		
		
	}
	
	
	function get_row(){
		$sql = "SHOW COLUMNS FROM asset_data WHERE FIELD= 'physic'";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	function get_bak(){
		$sql = "SHOW COLUMNS FROM asset_data WHERE FIELD= 'bak_st'";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	
	function get_users() {
        $sql = "SELECT COUNT(*)'total' FROM users";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
	
	
	function get_table($params){
			
		$sql = "SELECT TABLE_NAME 
				FROM INFORMATION_SCHEMA.TABLES
				WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='".$params."' AND table_name = 'asset_data'";
		$query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function get_table_user($params){
			
		$sql = "SELECT TABLE_NAME 
				FROM INFORMATION_SCHEMA.TABLES
				WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='".$params."' AND table_name = 'users'";
		$query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function get_row_running(){
		$sql = "SHOW COLUMNS FROM asset_data WHERE FIELD= 'asset_status'";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	function get_row_freetext(){
		$sql = "SHOW COLUMNS FROM asset_data WHERE FIELD= 'freeText1'";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
	}
	
	
	function creeate_tbl_user () {
        $sql = "
				CREATE TABLE `users`( `id` INT NOT NULL AUTO_INCREMENT, `username` VARCHAR(100), `password` VARCHAR(500), `email` VARCHAR(50), `phone` VARCHAR(15), `cr_date` DATETIME, PRIMARY KEY (`id`) ); 
		";
        return $this->db->query($sql);
	}
	
	
	function get_all_asset_corporate($params) {
        $sql = "SELECT * FROM asset_pysical a 
                JOIN asset_corporate b ON a.id_cor = b.id_cor WHERE a.asset_id like %?";
                
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
    }
	
	function update_after_backup ($params) {
        $sql = "UPDATE asset_data  SET  		bak_st = '1'
												WHERE asset_fams = '".$params."'";
        return $this->db->query($sql);
	}
	
	function update_not_asset ($params) {
        $sql = "UPDATE asset_data  SET  photo_asset = '',
																status_photo_a = 'yes', 
																date = '".date("Y-m-d")."'
																WHERE asset_fams = '".$params."'";
        return $this->db->query($sql);
	}
	
	
	function insert_users ($params) {
        $sql = "INSERT INTO `users` (`username`, `password`, `email`, `phone`, `cr_date`) VALUES (?,?,?,?,?);";
        return $this->db->query($sql,$params);
	}
	
 function update_asset ($params) {
        $sql = "UPDATE asset_data  SET  photo_asset = ?,
										status_photo_a = ?, 
										location  = ?,
										physic = ?,
										label_st = ?, 
										label_jn = ?,
										asset_status=?,
										remark =?,
										date  = ?,
										bak_st =?,
										freeText1=?
										WHERE asset_fams = ?";
        return $this->db->query($sql, $params);
		
		
    }
	
	
	 function update_eris ($params) {
        $sql = "UPDATE asset_data  SET  
										location  = ?,
										physic = ?,
										label_st = ?, 
										label_jn = ?,
										remark =?
										WHERE asset_fams = ?";
        return $this->db->query($sql, $params);
		
		
    }
	
	
	function update_asset_ceklis ($params) {
        $sql = "UPDATE asset_data  SET  
																 
																
																physic = ?,
																label_st = ?, 
																label_jn = ?,
																asset_status=?,
																remark =?
														WHERE asset_fams = ?";
        return $this->db->query($sql, $params);
    }

	
	function update_label ($params) {
        $sql = "UPDATE asset_data  SET  photo_label = ?,
																status_photo_l = ?,
																date  = ?,
																freeText2=?
																
																WHERE asset_fams = ?";
        return $this->db->query($sql, $params);
    }
	
	function update_label_u ($params) {
        $sql = "UPDATE asset_data  SET  photo_label =?,
																status_photo_l =?,
																label_jn  =?,
																label_st = ?
																																
																WHERE asset_fams =?";
        return $this->db->query($sql, $params);
    }
	
	
	function alter_tabel () {
        $sql = "ALTER TABLE `asset_data`	CHANGE `date` `date` DATETIME NULL, 
				ADD COLUMN `physic` VARCHAR(50) NULL AFTER `date`, 
				ADD COLUMN `label_st` ENUM('exist','missed') NULL AFTER `physic`, 
				ADD COLUMN `label_jn` ENUM('plat','sticker') NULL AFTER `label_st`; ";
        return $this->db->query($sql);
    }
	
	function add_colouum_freetext () {
        $sql = "ALTER TABLE `asset_data`	CHANGE `date` `date` DATETIME NULL, 
				ADD COLUMN `freeText1` VARCHAR(500) NULL AFTER `bak_st`, 
				ADD COLUMN `freeText2` VARCHAR(500) NULL AFTER `freeText1`;	 ";
        return $this->db->query($sql);
    }
	
	function alter_bak () {
        $sql1 = "ALTER TABLE `asset_data` ADD COLUMN `bak_st` ENUM('0','1','2') NULL ;";
		$sql2 =		"update asset_data set bak_st = '0' where status_photo_a ='yes';";
		$sql3 =		"update asset_data set bak_st = '2' where status_photo_a ='no';";
		$this->db->trans_start();
		$this->db->query( $sql1);
		$this->db->query( $sql2);
		$this->db->query( $sql3);
		return $this->db->trans_complete(); 
         
    }
	
	
	
	function alter_tabel_label(){
		
		$sql = "ALTER TABLE `asset_data` CHANGE `label_jn` `label_jn` ENUM('plat','sticker','plate_large','plate_small','plate_mini') CHARSET latin1 COLLATE latin1_swedish_ci NULL,
				ADD COLUMN `asset_status` ENUM('running','running_out') NULL AFTER `label_jn`;";
		return $this->db->query($sql);
	}
	
	
	
}
