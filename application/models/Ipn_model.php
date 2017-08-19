<?php

class IPN_Model extends CI_Model 
{
		public function formatInsertData($postData)
	{
		$retData = array
		(
			"invoice_no"=>(isset($postData["invoice_no"]))?$postData["invoice_no"]:'',
			"userid"=>(isset($postData["userid"]))?$postData["userid"]:'',
			"email"=>(isset($postData["email"]))?$postData["email"]:'',
			"amount"=>(isset($postData["amount"]))?$postData["amount"]:'',
			"currency_code"=>(isset($postData["currency_code"]))?$postData["currency_code"]:'',
			"timestamp"=>(isset($postData["timestamp"]))?$postData["timestamp"]:0,
			"email"=>(isset($postData["email"]))?$postData["email"]:'',
			"email_paypal"=>(isset($postData["emailpaypal"]))?$postData["emailpaypal"]:'',
			"deadline"=>(isset($postData["deadline"]))?$postData["deadline"]:'',
			"username"=>(isset($postData["username"]))?$postData["username"]:'',
			"is_pay"=>(isset($postData["is_pay"]))?$postData["is_pay"]:0,
			"transfer_proof"=>(isset($postData["transfer_proof"]))?$postData["transfer_proof"]:'',
			"date_pay"=>(isset($postData["date_pay"]))?$postData["date_pay"]:''    
		);

		return $retData;	
	} 
	
	public function log_ipn($ipn) 
	{
		$this->db->insert("ipn_log", array(
			"data" => $ipn, 
			"timestamp" => time(), 
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}	
	
	public function log_mesin($data) 
	{
		$this->db->insert("mesinotomatis_log", array(
			"data" => $data, 
			"timestamp" => time(), 
			"IP" => $_SERVER['REMOTE_ADDR']
			)
		);
	}

	public function cek_log_mesin($data) 
	{
		$this->db->get("mesinotomatis_log")
		->like("users.last_name", $search)
		->get("users");
	}

	public function add_payment($data) 
	{
		$this->db->insert("payment_logs", $data);
		return $this->db->insert_id();
	}
	
	public function search_by_amount($amount,$email='') 
	{
		$q = $this->db->select("*")
			->where("is_pay",0);
		if ($email != ''){
		   $q =	$q->where("email_paypal",$email);
		}
		
		return $q->where("amountsum", $amount)
		->get("payment_logs");
		 
	}
	
	public function update_payment($id, $data) {
		$this->db->where("ID", $id)->update("payment_logs", $data);
	}
	
}

?>