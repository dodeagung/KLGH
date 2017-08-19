<?php

class Account_Model extends CI_Model 
{

	public function get_accounts() 
	{
		return $this->db->get("bank_account");
	}

	public function get_account($id) 
	{
		return $this->db->where("ID", $id)->get("bank_account");
	}	
	
	public function get_accounttipe($tipe) 
	{
		return $this->db->like("tipe_currency", $tipe,'both')->get("bank_account");
	}

	public function update_plan($id, $data) 
	{
		$this->db->where("ID", $id)->update("bank_account", $data);
	}


}

?>