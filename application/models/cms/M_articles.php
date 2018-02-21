<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_articles extends CI_Model {

	private $table;
	private $data;
	private $data_like;
	private $primary_key='id';
	private $pageof=20;
	public function __construct() {
		parent::__construct();
		$this->table='articles';
        if (!isset($this->data )) 
		   $this->data = new stdClass();
		if (!isset($this->data_like )) 
		   $this->data_like = new stdClass();
	}
	public function get_by_key($id) {
		$id = intval($id);
		$get = $this->db->where($this->primary_key,$id)
		->get($this->table);
		if($get->num_rows() != 1) {
			return FALSE;
		}
		$this->data = $get->row();
		return clone $this;
	}
	public function set_pageof($num=20){
		$this->pageof = (int)$num;
		return  $this;
	}
	public function get_meta($tag) {
		if(isset($this->data->$tag)) {
			return $this->data->$tag;
		}
		return FALSE;
	}
	public function set_orderby($name,$sort='asc')
	{
		$this->db->order_by($name,$sort);
		return  $this;
	}
	public function select($select){
		$this->db->select($select);
		return $this;
	}
    // Hàm set dữ liệu //
	public function set_meta($tag,$value) {
		if(isset($this->data->$tag)) {
			$this->data->$tag = $value;
			return $this;
		}
		return FALSE;
	}
	public function set($tag,$value){
		$this->data->$tag = $value;
		return $this;
	}
	public function set_like($tag,$value){

		$this->data_like->$tag = $value;
		return $this;
    }
    // Hàm set chuỗi dữ liệu //
	public function sets($array) {

		foreach ($array as $k => $v) {
			if(isset($this->data->$k)) {
				$this->data->$k = $v;
			}
			else{
				$this->data->$k =  $v;
			}
		}
		return $this;
	}
    // Logic fucntion 
	public function save() {
        //return false;
        $primary = $this->primary_key;
        //var_dump($this->data->id);
		$this->db->where($this->primary_key,  $this->data->$primary)
		->update($this->table,  $this->data);
		return TRUE;
	}
    // Xóa product
	public function delete() {
        $primary = $this->primary_key;
		$this->db->where($this->primary_key,  $this->data->$primary)
		->update($this->table,array('trash'=>1));
		return TRUE;
	}
    // Thêm
	public function add($data) {
		$this->db->insert($this->table,$data);
		return TRUE;
	}
	public function add_id($data) {
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    //
    public function data(){
        return $this->data;
    }
   
   // Lây data 
	public function get() {
		if($this->data){
	       	$get = $this->db->where((array)$this->data)->get($this->table);
	       }
	       else{
	       	$get = $this->db->get($this->table);
	       }
	       if($get->num_rows() == 0) {
		      return FALSE;
	       }
	       return $get->row();
	}
	public function page($index=1){
		if($index){
			if($index-1){
				$this->db->limit(($index-1) * $this->pageof ,$index * $this->pageof  );
			}
			else{
				$this->db->limit($this->pageof);
			}
		}
		return $this;
	}
	public function counts(){
		if($this->data){
	 		$this->db->where((array)$this->data);
	 	}
	 	$this->db->from($this->table);
	      	return $this->db->count_all_results();
	}
	public function gets(){
		   /*if($this->data_like){
		   	$this->db->where_like((array)$this->data_like);
		   }*/
	       if($this->data){
	       	$get = $this->db->where((array)$this->data)->get($this->table);
	       }
	       else{
	       	$get = $this->db->get($this->table);
	       }
	       if($get->num_rows() == 0) {
		return FALSE;
	       }
	       return $get->result();
	}
   
}