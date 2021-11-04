<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Customer extends CI_Model
{

    public $table = 'st_cust';
	public $marketing = 'st_marketing';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
	
	
	function get_project(){

    	$sql = "SELECT  * FROM st_project where st_active = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	function get_source(){

    	$sql = "SELECT  * FROM st_source where st_active = '1'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }
	
	
	
	function get_dataCustomer($params) {
        $id_branch = $params[0];
        $product_nm = $params[1];
		$unit_id =$params[2];
        $limit_start = $params[3];
        $limit_end = $params[4];

        
        $sql = "'
		GROUP BY a.mdc_id";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
	
	
	function gettot_dataStockHarga($params) {
        $id_branch = $params[0];
        $product_nm = $params[1];
		$unit_id =$params[2];

        
        $sql = " SELECT COUNT(t.mdc_name) as total FROM 
				(SELECT a.mdc_id, mdc_name,prod_unit_nm,SUM(qty_in-qty_out) AS stok, ROUND (AVG(price),0) AS harga_jual_satuan, 
				 ROUND (AVG(purchase_price_unit),0) AS 'harga_beli_satuan'  FROM mst_medicine a 
				JOIN price_unit b ON a.mdc_id = b.mdc_id 
				JOIN stock_flow_medicine c ON b.price_id = c.price_id
				JOIN prod_unit d ON d.id_prod_unit = a.unit_stock
				WHERE c.stock_st = 'belum_habis' and mdc_name like '$product_nm'
				GROUP BY a.mdc_id) AS t";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
	
	
	function get_data_by_id($table, $column, $id){
		$sql = "SELECT * FROM $table WHERE $column = $id";
		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
		
	}
	
	function insert_activity($table_name, $array_data) { // array_where unused but use in programming
        return $this->db->insert($table_name, $array_data);
    }
	

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
	function get_marketing_by_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get($this->marketing)->row();
    }
    
    // get total rows
    function total_rows($q = NULL,$sales_id=NULL,$st=null) {
		
   $like = "(cust_name like '%$q%' or cust_phone like '%$q%')";
        $this->db->order_by('cr_dt', $this->order);
		$this->db->where('sales_id', $sales_id);
		$this->db->like('cust_stat',$st);
		$this->db->where($like);		
		$this->db->from('st_cust');
		$this->db->join ('st_source', 'st_cust.source = st_source.id_sc' , 'INNER'); 
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$sales_id=NULL,$st=null) {
		$like = "(cust_name like '%$q%' or cust_phone like '%$q%')";
        $this->db->order_by('cr_dt', $this->order);
		$this->db->where('sales_id', $sales_id);
		$this->db->like('cust_stat',$st);
		$this->db->where($like);		
		$this->db->from('st_cust');
		$this->db->join ('st_source', 'st_cust.source = st_source.id_sc' , 'INNER');
		$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file M_Customer.php */
/* Location: ./application/models/M_Customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-14 07:42:22 */
/* http://harviacode.com */