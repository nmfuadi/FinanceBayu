<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_KpiSales extends CI_Model
{

    public $table = 'st_kpi_activity';
    public $table_set = 'st_kpi_sett';
    public $set_id = 'sett_id';
    public $kry_id = 'kry_id';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }




     function get_kpi_kry_id($params){

        $sql = "SELECT * FROM (
				SELECT kry_id,SUM(VALUE) AS perbulan,kpi_name,name_mark,kpi_value AS target,(SUM(`value`)/kpi_value*100) AS pencapaianpPerTask,((SUM(`value`)/kpi_value*100)/100*kpi_weight) AS total_pencapaian, kpi_weight  FROM st_kpi_activity a JOIN st_kpi_sett b 
				ON a.sett_id = b.id JOIN st_marketing c ON a.`kry_id` = c.id WHERE kpiDate BETWEEN ? AND ?
				GROUP BY a.`kry_id`,a.`sett_id`) a WHERE kry_id = ? ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }


    function get_kpi($params){

        $sql = "SELECT kry_id,FORMAT(SUM(total_pencapaian),1) AS kpi, name_mark FROM (
				SELECT kry_id,SUM(VALUE) AS perbulan,kpi_name,name_mark,kpi_value AS target,(SUM(`value`)/kpi_value*100) AS pencapaianpPerTask,((SUM(`value`)/kpi_value*100)/100*kpi_weight) AS total_pencapaian, kpi_weight  FROM st_kpi_activity a JOIN st_kpi_sett b 
				ON a.sett_id = b.id JOIN st_marketing c ON a.`kry_id` = c.id WHERE kpiDate BETWEEN ? AND ?
				GROUP BY a.`kry_id`,a.`sett_id`) a GROUP BY kry_id ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return NULL;
        }
    }



    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table_set)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table_set)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('kpi_name', $q);
	$this->db->or_like('kpi_value', $q);
	$this->db->or_like('kpi_weight', $q);
	$this->db->or_like('dt_cr', $q);
	$this->db->or_like('u_dt', $q);
	$this->db->from($this->table_set);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kpi_name', $q);
	$this->db->or_like('kpi_value', $q);
	$this->db->or_like('kpi_weight', $q);
	$this->db->or_like('dt_cr', $q);
	$this->db->or_like('u_dt', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table_set)->result();
    }


     function get_data_marketing() {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('active_st', '1');
		return $this->db->get('st_marketing')->result();
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

/* End of file M_SetKpi.php */
/* Location: ./application/models/M_SetKpi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-17 09:59:54 */
/* http://harviacode.com */