<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jobs_update_model extends CI_Model
{

    public $table = 'jr_jobs_update';
	public $jr_employe = 'jr_employe';
	public $com_user = 'com_user';
	public $id_user = 'id_user';
    public $id_employe = 'id';
	public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('jobs_id', $q);
	$this->db->or_like('kry_id', $q);
	$this->db->or_like('jobs_up_descr', $q);
	$this->db->or_like('pic', $q);
	$this->db->or_like('job_up_st', $q);
	$this->db->or_like('cr_dt', $q);
	$this->db->or_like('cr_up', $q);
	$this->db->or_like('u_cr', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('jobs_id', $q);
	$this->db->or_like('kry_id', $q);
	$this->db->or_like('jobs_up_descr', $q);
	$this->db->or_like('pic', $q);
	$this->db->or_like('job_up_st', $q);
	$this->db->or_like('cr_dt', $q);
	$this->db->or_like('cr_up', $q);
	$this->db->or_like('u_cr', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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
	
	function update_profile($id, $data)
    {
        $this->db->where($this->id_employe, $id);
        $this->db->update($this->jr_employe, $data);
    }
	
		function update_passwords($id, $data)
    {
        $this->db->where($this->id_user, $id);
        $this->db->update($this->com_user, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Jobs_update_model.php */
/* Location: ./application/models/Jobs_update_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-21 09:49:00 */
/* http://harviacode.com */