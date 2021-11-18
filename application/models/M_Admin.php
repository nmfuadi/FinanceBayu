<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Admin extends CI_Model {
	
	function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

	function get_all_cov_params(){

    	$sql = "SELECT  * FROM cov_params";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_cov_result($params){
        $sql = "SELECT * FROM cov_result where range_bobot = ? and range_level = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
    function menu($params){

    	$sql = "SELECT  * FROM com_menu a
				JOIN com_rules b on a.rules_id = b.rules_id
				JOIN com_portal c on b.portal_id =  c.portal_id
				where a.rules_id =? and parent_id = ? and a.is_active = '1' order by number ASC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
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


    public function get_all_data_where($table,$where){		
		$sql = "SELECT * FROM $table WHERE $where";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}


    public function get_all_data_where_select($select,$table,$where){		
		$sql = "SELECT $select FROM $table WHERE $where";      
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
	}
	
	function get_self(){
        $sql = "SELECT * FROM cov_self_assesment where emp_id = 27";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	 function get_employe_by_id($params){
        $sql = "SELECT *,a.id as id_kry FROM jr_employe a 
				JOIN jr_departement b ON a.dptmn_id = b.id 
				JOIN jr_level c ON a.level_id = c.id
				JOIN com_user  d ON a.user_id = d.id_user WHERE a.user_id = ?
				";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_count_jobs_update($params){
        $sql = "SELECT COUNT(jobs_id) FROM jr_jobs_update WHERE jobs_id = ?
				";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
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
	
	
	
	 function get_jobs_by_id($params){
        $sql = "SELECT *,a.id as jobs_id FROM jr_jobs a 
				JOIN jr_employe b ON a.kry_id = b.id
				JOIN jr_departement c ON c.id = b.dptmn_id
				WHERE a.id = ?
				";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_jobs_by_user_id($params){
    	$sql = "SELECT *,a.id as jobs_id FROM jr_jobs a 
				JOIN jr_employe b ON a.kry_id = b.id
				WHERE b.user_id = ? AND archieve_st = 'no' order by a.cr_dt DESC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }



function get_jobs_by_user_id_ext_to($params){

    	$sql = "SELECT a.*,a.id AS jobs_id,a.jobs_tittle,b.emp_name AS to_kry,c.emp_name AS from_kry,d.dprt_name AS dprt_to, e.dprt_name AS dprt_from 
				FROM jr_jobs a 
				JOIN jr_employe b ON a.ext_kry_id = b.id
				JOIN jr_employe c ON a.ext_kry_from = c.id
				JOIN jr_departement d ON b.dptmn_id = d.id
				JOIN jr_departement e ON c.dptmn_id = e.id
				WHERE b.user_id = ? AND archieve_st = 'no' ORDER BY a.cr_dt DESC";
				
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
function get_jobs_by_user_id_ext_from2_total($params){

    	$sql = "SELECT COUNT(*) as 'total' FROM jr_jobs a 
				JOIN jr_employe b ON a.ext_kry_id = b.id
				JOIN jr_employe c ON a.ext_kry_from = c.id
				JOIN jr_departement d ON b.dptmn_id = d.id
				JOIN jr_departement e ON c.dptmn_id = e.id
				WHERE c.user_id = ? AND archieve_st = 'no'";
				
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }	
	
function get_jobs_by_user_id_ext_to_total($params){

    	$sql = "SELECT count(*) as total FROM jr_jobs a 
				JOIN jr_employe b ON a.ext_kry_id = b.id
				JOIN jr_employe c ON a.ext_kry_from = c.id
				JOIN jr_departement d ON b.dptmn_id = d.id
				JOIN jr_departement e ON c.dptmn_id = e.id
				WHERE b.user_id = ? AND archieve_st = 'no' AND ext_app IS null";
				
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }

function get_jobs_by_user_id_ext_from($params){

    	$sql = "SELECT a.*,a.id AS jobs_id,a.jobs_tittle,b.emp_name AS to_kry,c.emp_name AS from_kry,d.dprt_name AS dprt_to, e.dprt_name AS dprt_from FROM jr_jobs a 
				JOIN jr_employe b ON a.ext_kry_id = b.id
				JOIN jr_employe c ON a.ext_kry_from = c.id
				JOIN jr_departement d ON b.dptmn_id = d.id
				JOIN jr_departement e ON c.dptmn_id = e.id
				WHERE c.user_id = ? AND archieve_st = 'no' ORDER BY a.cr_dt DESC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }

	function get_all_departemen($params){

    	$sql = "Select * from jr_departement where id like ? order by order_no ASC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_notulen_by_dpt($params){
        $sql = "SELECT * FROM jr_notulen
				WHERE dprt_id = ? and (trash_st is null or trash_st not in ('1')) order by up_dt DESC
				";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_notulen_by_id($params){

    	$sql = "SELECT * FROM jr_notulen WHERE id = ?";
				
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	
	function get_jobs_by_user_id_archieve($params){

    	$sql = "SELECT *,a.id as jobs_id FROM jr_jobs a 
				JOIN jr_employe b ON a.kry_id = b.id
				WHERE b.user_id = ? AND archieve_st = 'yes' order by a.cr_dt DESC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	
	function get_jobs_by_dprtmn_id($params){

    	$sql = "SELECT *,a.id as jobs_id FROM jr_jobs a 
				JOIN jr_employe b ON a.kry_id = b.id
				JOIN jr_departement c ON c.id = b.dptmn_id
				WHERE b.dptmn_id = ? and archieve_st='no' order by a.cr_dt DESC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_update_jobs_by_id($params){
        $sql = "SELECT *,a.id AS up_jobs_id,a.kry_id as staff_kry FROM jr_jobs_update a 
				JOIN jr_jobs b ON a.jobs_id  = b.id
				JOIN jr_employe c ON a.kry_id = c.id
				JOIN jr_departement d ON c.dptmn_id = d.id
				WHERE a.id = ?
				";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_update_jobs_by_user_id($params){

    	$sql = "SELECT *,a.id AS up_jobs_id FROM jr_jobs_update a 
				JOIN jr_jobs b ON a.jobs_id  = b.id
				JOIN jr_employe c ON a.kry_id = c.id
				JOIN jr_departement d ON c.dptmn_id = d.id
				WHERE a.kry_id = ? ORDER BY a.cr_up DESC";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function get_update_jobs_by_jobs_id($params){

    	$sql = "SELECT *,a.id AS up_jobs_id FROM jr_jobs_update a
				JOIN jr_jobs b on a.jobs_id = b.id 
				JOIN jr_employe c ON a.kry_id = c.id
				JOIN jr_departement d ON c.dptmn_id = d.id
				WHERE jobs_id = ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function get_all_depertement(){

    	$sql = "SELECT * FROM jr_departement ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_all_depertement_vp(){

    	$sql = "SELECT a.id AS id_em,emp_name,dprt_name FROM jr_employe a JOIN jr_departement b ON a.dptmn_id = b.id  WHERE level_id IN (2,3) ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function get_all_depertement_byid($params){

    	$sql = "SELECT * FROM jr_departement where id = ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }


    
	
	
	
	function get_data_by_id($table, $column, $id,$and=null){
		$sql = "SELECT * FROM $table WHERE $column = ".$id.$and;
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}


    function get_data_by_mutation_id($table, $column, $id,$and=null){
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
	
	
	function data_departement($table, $column, $id,$and=null){
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
	
	
	function cek_absen($params){
        $sql = "SELECT count(*) as 'total' FROM st_absensi WHERE mrkt_id = ? AND DATE_FORMAT(cr_dt, '%Y-%m-%d')= ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	


function pertahun_bulan(){

    	$sql = "SELECT DATE_FORMAT(cr_up, '%Y-%m') AS bulan FROM st_cust
			 WHERE DATE_FORMAT(cr_up, '%Y') = DATE_FORMAT(NOW(),'%Y') 
			 GROUP BY DATE_FORMAT(cr_up, '%Y-%m') 
			ORDER BY DATE_FORMAT(cr_up, '%Y-%m') ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_absesnsi_perhari(){

    	$sql = "SELECT name_mark,jns_name,abs_activity,a.cr_dt AS jam_absen,latitude,longitude FROM st_absensi a 
				JOIN st_absensi_jns b ON a.abs_activity = b.id_jns_absn
				JOIN st_marketing c ON a.mrkt_id = c.id
				WHERE DATE_FORMAT(cr_dt, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function aktivitas_sales(){

    	$sql = "SELECT * FROM st_sales_activity a JOIN st_marketing b ON a.marketing_id = b.id 
				WHERE DATE_FORMAT(a.cr_dt, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d') 
				ORDER BY DATE_FORMAT(a.cr_dt, '%Y-%m-%d') DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }


	function pertahun_count($bulan){

    	$sql = "SELECT cust_stat,
				DATE_FORMAT(cr_up, '%Y-%m'),
				COUNT(*) as jml FROM st_cust WHERE DATE_FORMAT(cr_up, '%Y-%m') = '$bulan'
				GROUP BY cust_stat, DATE_FORMAT(cr_up, '%Y-%m')
				ORDER BY cust_stat, DATE_FORMAT(cr_up, '%Y-%m') ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	
	function data_customerBysourcePertahun_chart($bulan){

    	$sql = "SELECT name_sc,COUNT(source) AS data_from,DATE_FORMAT(a.cr_dt, '%Y-%m') AS tgl FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				WHERE DATE_FORMAT(a.cr_dt, '%Y-%m') = '$bulan'
				GROUP BY source,DATE_FORMAT(a.cr_dt, '%Y-%m')  
				ORDER BY name_sc ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function data_Konversicustomer_chart(){

    	$sql = "SELECT tot.name_sc as nama_source,tot.data_from,bookSum FROM
				(SELECT name_sc,COUNT(source) AS data_from
				FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				GROUP BY source
				ORDER BY name_sc ASC) tot

				JOIN (

				SELECT s.name_sc AS name_source,SUM(s.data_from) AS bookSum FROM 
				(SELECT name_sc,COUNT(source)AS data_from,cust_stat
				FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				WHERE cust_stat IN ('BOOKING','AKAD KREDIT','PEMBERKASAN')
				GROUP BY source,cust_stat
				ORDER BY name_sc ASC) s
				GROUP BY s.name_sc
				) book ON book.name_source = tot.name_sc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function sum_Konversicustomer_chart(){
        $sql = " 
					
				SELECT sum(tot.data_from) as total_data,sum(bookSum) total_book FROM
				(SELECT name_sc,COUNT(source) AS data_from
				FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				GROUP BY source
				ORDER BY name_sc ASC) tot

				JOIN (

				SELECT s.name_sc AS name_source,SUM(s.data_from) AS bookSum FROM 
				(SELECT name_sc,COUNT(source)AS data_from,cust_stat
				FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				WHERE cust_stat IN ('BOOKING','AKAD KREDIT','PEMBERKASAN')
				GROUP BY source,cust_stat
				ORDER BY name_sc ASC) s
				GROUP BY s.name_sc
				) book ON book.name_source = tot.name_sc

		";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function source_data(){

    	$sql = "SELECT *
				 FROM st_source order by name_sc ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }

// FInance Bayu Buana 
     // get total rows
     function total_rows($q = NULL) {
        $this->db->group_start();
        $this->db->or_like('amount', $q);
        $this->db->or_like('type_mutation', $q);
        $this->db->or_like('bank_name', $q);
        $this->db->or_like('bank_norek', $q);
        $this->db->or_like('remark', $q);
        $this->db->group_end();
        $this->db->where('posting_st', 'NO');
        $this->db->from('fin_mutation');
        $this->db->join('fin_bank', 'fin_mutation.bank_id = fin_bank.id');
       
            return $this->db->count_all_results();
        }
    
        // get data with limit and search
        function get_limit_data($limit, $start = 0, $q = NULL) {
            $this->db->order_by('trx_date', 'DESC');
            $this->db->select('fin_mutation.*,fin_mutation.id as mut_id,fin_bank.*');
            $this->db->group_start();
            $this->db->or_like('amount', $q);
            $this->db->or_like('type_mutation', $q);
            $this->db->or_like('bank_name', $q);
            $this->db->or_like('bank_norek', $q);
            $this->db->or_like('remark', $q);
            $this->db->group_end();
            $this->db->where('posting_st', 'NO');
            $this->db->join('fin_bank', 'fin_mutation.bank_id = fin_bank.id');
            $this->db->limit($limit, $start);
            return $this->db->get('fin_mutation')->result();
        }


         // get total rows
     function total_rows_jurnal($q = NULL) {
        $this->db->group_start();
        $this->db->or_like('amount', $q);
        $this->db->or_like('original_amount', $q);
        $this->db->or_like('type_mutation', $q);
        $this->db->or_like('bank_name', $q);
        $this->db->or_like('bank_norek', $q);
        $this->db->or_like('code', $q);
        $this->db->or_like('account_name', $q);
        $this->db->or_like('remark', $q);
        $this->db->group_end();
        $this->db->where('posting_st', 'YES');
        $this->db->from('fin_mutation');
        $this->db->join('fin_bank', 'fin_mutation.bank_id = fin_bank.id');
        $this->db->join('fin_account', 'fin_mutation.account_code = fin_account.code');
       
            return $this->db->count_all_results();
        }
    
        // get data with limit and search
        function get_limit_data_jurnal($limit, $start = 0, $q = NULL) {
            $this->db->order_by('trx_date', 'DESC');
            $this->db->select('fin_mutation.*,fin_mutation.id as mut_id,fin_bank.*,fin_account.*');
            $this->db->group_start();
            $this->db->or_like('amount', $q);
            $this->db->or_like('original_amount', $q);
            $this->db->or_like('type_mutation', $q);
            $this->db->or_like('bank_name', $q);
            $this->db->or_like('code', $q);
            $this->db->or_like('account_name', $q);
            $this->db->or_like('bank_norek', $q);
            $this->db->or_like('remark', $q);
            $this->db->group_end();
            $this->db->where('posting_st', 'YES');
            $this->db->join('fin_bank', 'fin_mutation.bank_id = fin_bank.id');
            $this->db->join('fin_account', 'fin_mutation.account_code = fin_account.code');
            $this->db->limit($limit, $start);
            return $this->db->get('fin_mutation')->result();
        }



        function cek_avail($table,$where,$value){
            $sql = "SELECT count(*) as 'total' FROM $table WHERE $where = $value";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        }



        function ReportCashflow($year = null,$cr= null){

            $sql = "select account_code,account_name,[January],[February],[March],[April],[May],[June],[July],[August],[September],[October],[November],[December] from 
                        (select YEAR(trx_date) as years,account_code,account_name,sum(amount) as uang ,DATENAME(MONTH, DATEADD(MONTH, 0,trx_date))as bulan from fin_mutation a
                        join fin_account b on a.account_code = b.code 
                        where posting_st = 'YES' And account_code <>'' and YEAR(trx_date)= '$year' and type_mutation = '$cr' 
                        GROUP BY account_code,account_name,YEAR(trx_date),DATENAME(MONTH, DATEADD(MONTH, 0,trx_date))) as a
                                PIVOT
                                (
                                    SUM(uang)
                                    FOR [bulan] IN ([January],[February],[March],[April],[May],[June],[July],[August],[September],[October],[November],[December])
                                ) AS P"; 
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        }



        function get_currancy_amount($st=null){

            $sql = "SELECT top 1 * FROM fin_kurs where kurs_code = '$st' order by kurs_date DESC   ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        } 

        function get_currancy_amount_bymont($st=null,$tgl=null){

            $sql = "SELECT top 1 * FROM fin_kurs where kurs_code = '$st' and datepart(month,kurs_date) = datepart(month,'$tgl') order by kurs_date DESC   ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        }


        function get_fin_by_id($table,$field,$st=null){

            $sql = "SELECT * FROM $table where $field = '$st'    ";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        }


        function get_sync_mutation($start=null,$end,$bank_id=null,$currancy=NULL){

            $sql = "SELECT * FROM fin_mutation where trx_date between '$start' AND '$end' AND bank_id LIKE '%$bank_id%' AND currancy = '$currancy' AND posting_st='YES'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            } else {
                return NULL;
            }
        }

//end bayu finance 
	
	
	function data_customerBysource_chart(){

    	$sql = "SELECT name_sc,COUNT(source) as data_from FROM st_cust a JOIN st_source b ON a.source = b.id_sc
				GROUP BY source";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function data_customerBysourcenByMont_chart($mont){

    	$sql = "SELECT name_sc,COUNT(source) AS data_from,DATE_FORMAT(a.cr_dt, '%Y-%m') AS tgl FROM st_cust a 
				JOIN st_source b ON a.source = b.id_sc
				WHERE data_from,DATE_FORMAT(a.cr_dt, '%Y-%m') = '$mont'
				GROUP BY source,DATE_FORMAT(a.cr_dt, '%Y-%m')  
				ORDER BY name_sc ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	
	
	 function customer_count($params){

    	$sql = "SELECT cust_stat, COUNT(*) AS 'jumlah' FROM st_cust WHERE sales_id = ? GROUP BY cust_stat ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function customer_count_all($st=null){

    	$sql = "SELECT cust_stat, COUNT(*) AS 'jumlah' FROM st_cust $st  ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	//method slider start
	
	  function slider_by_limit($params){

    	$sql = "SELECT  * FROM web_slider a JOIN web_cat_slide b ON a.cat_id = b.id_cat Order by a.cd LIMIT ?,?";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	function count_slide(){
	$sql = "SELECT count(*) as total FROM web_slider a JOIN web_cat_slide b ON a.cat_id = b.id_cat";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result['total'];
        } else {
            return NULL;
        }
    }
	
	
function cat_slide(){
	$sql = "SELECT  * FROM web_cat_slide";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function cek_slide($params){
        $sql = "SELECT count(*) as 'total' FROM web_slider WHERE cat_id = ? AND title = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function insert_slider ($params) {
        $sql = "INSERT INTO web_slider (id_slider,cat_id,title,description,file,cu,cd) VALUES (NULL,?,?,?,?,?,?)";
        return $this->db->query($sql, $params);
    } 
	
	
	function insert_self ($params) {
        $sql = "INSERT INTO cov_self_assesment (id,emp_id,resume,score,input_date) VALUES (NULL,?,?,?,?)";
        return $this->db->query($sql, $params);
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
	
	
	
	


}