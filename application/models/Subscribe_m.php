<?php
class Subscribe_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database("default");
	}

	function addNewUser($data)
	{
		//echo "<pre>";print_r($date);die;


		if((!$this->isExistEmail($data["email"])))
		{
			$this->db->insert("contact_subcription",$data);
			return TRUE;
		}

	}
  public function isExistEmail($email)
	{
		$s=$this->db->where("email", $email)->get("contact_subcription");
		if ($s->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
















}
?>
