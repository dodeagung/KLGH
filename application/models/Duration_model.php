<?php

class Duration_Model extends CI_Model 
{

	public function get_duration() 
	{
		return $this->db->select("*")->get("duration_plan")->result(); 
	} 		
	
	public function get_duration_by_id($id) 	
	{		
		return $this->db->where("ID", $id)->get("duration_plan");	
	} 
} 

?>