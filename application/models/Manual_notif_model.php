<?php

class Manual_notif_model extends CI_Model 
{

	
	public function add_notif($data) 
	{
		$this->db->insert("manual_notif_log", $data);
		return $this->db->insert_id();
	}
	
	public function formatInsertData($postData)
	{
		$retData = array
		(
			"sender"=>(isset($postData["sender"]))?$postData["sender"]:'',
			"invoiceno"=>(isset($postData["invoiceno"]))?$postData["invoiceno"]:'',
			"destination"=>(isset($postData["bank"]))?$postData["bank"]:'',
			"email"=>(isset($postData["email"]))?$postData["email"]:'',
			"amount"=>(isset($postData["amount"]))?$postData["amount"]:'',
			"date_transfer"=>(isset($postData["date_transfer"]))?$postData["date_transfer"]:'',
			"printout"=>(isset($postData["printout"]))?$postData["printout"]:'',
			"timestamp"=>(isset($postData["timestamp"]))?$postData["timestamp"]:time()	    
		);

		return $retData;	
	} 
	
} 

?>