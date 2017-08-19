<?php
class Site_slugs_m extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function create($item)
	{
		$data = array(
			'controller' => $item['controller'],
			'slug' => $item['slug'],
			'keywords' => $item['keywords']
			 );

		$this->db->insert('site_slugs', $data);
	}


function getbyController($controller)
	{
		$this->db->select('*');
		$this->db->from('site_slugs');
		$this->db->where('controller', $controller);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row(); 
		}
	}
	function get_by_controller($controller)
	{
		$this->db->select('*');
		$this->db->from('site_slugs');
		$this->db->where('controller', $controller);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row();
		}
	}	
	
	function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('site_slugs');
		$this->db->where('id', $id);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row();
		}
	}

	function get_all()
	{
		$this->db->select('*');
		$this->db->from('site_slugs');
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->result_array();
		}
	}

	function updatebycontroller($controller, $item)
	{
		$data = array(
			'controller' => $item['controller'],
			'slug' => $item['slug'],
			'keywords' => $item['keywords']
			 );

		$this->db->where('controller', $controller);
		$this->db->update('site_slugs', $data);
	}	
	
	function update($id, $item)
	{
		$data = array(
			'controller' => $item['controller'],
			'slug' => $item['slug'],
			'keywords' => $item['keywords']
			 );

		$this->db->where('id', $id);
		$this->db->update('site_slugs', $data);
	}

	function deletebycontroller($controller)
	{
		$this->db->where('controller', $controller);
		$this->db->delete('site_slugs');
	}	
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('site_slugs');
	}
	function get_by_column($key1,$key2,$id,$tipe)
	{
		//tipe = none(untuk exact search)
		$this->db->select('*');
		$this->db->from('jabatan_uji');
		$this->db->like($key1, $id, $tipe);
		$this->db->or_like($key2, $id, $tipe);
		$query = $this->db->get();
		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->result_array();
		}
	}
}
