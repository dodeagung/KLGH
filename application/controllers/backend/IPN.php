<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IPN extends CI_Controller 
{

	public $project = null;

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("ipn_model");
		$this->load->model("user_model");
		$this->load->model("Admin_model");
		$this->load->model("Duration_model");
		$this->config->set_item('csrf_protection', FALSE);

	}

	public function index() 
	{	

		exit();
	}

	public function process2() 
	{
		require_once('paypal/config.php');
		$this->ipn_model->log_ipn("Attempted to pay Funds");
		// Read the post from PayPal system and add 'cmd'   
		$req = 'cmd=_notify-validate';  

		// Store each $_POST value in a NVP string: 1 string encoded 
		// and 1 string decoded   
		$ipn_email = '';  
		$ipn_data_array = array();
		foreach ($_POST as $key => $value)   
		{   
		 $value = urlencode(stripslashes($value));   
		 $req .= "&" . $key . "=" . $value;   
		 $ipn_email .= $key . " = " . urldecode($value) . '<br />';  
		 $ipn_data_array[$key] = urldecode($value);
		}

		// Store IPN data serialized for RAW data storage later
		$ipn_serialized = serialize($ipn_data_array);
		 log_message('debug', $ipn_serialized, false); 
		 
		 
		// Validate IPN with PayPal
		require_once('paypal/validate.php');

		// Load IPN data into PHP variables
		require_once('paypal/parse-ipn-data.php');

		$ipn_log_data['ipn_data_serialized'] = $ipn_serialized;

		if((strtoupper($txn_type) == 'WEB_ACCEPT')||(strtoupper($txn_type) == 'SEND_MONEY')) {
			$this->ipn_model->log_ipn($ipn_log_data['ipn_data_serialized']);
			// Invoice Payment
			$userid = intval($this->common->nohtml($custom));
			$id = intval($item_number);
			$this->ipn_model->log_ipn("Tried to pay Funds ($mc_gross): " . 
				$id . " Userid:" . $userid);

			// Get amount
			$amount = abs($mc_gross);
			$amount = (double)$amount;
			// Invoice Payment
		//1. find user that has unique payment
		$payer_email = $this->common->nohtml($payer_email);
		$payment=$this->ipn_model->search_by_amount($amount,$payer_email);
		
		$paymentData = $payment->row();
		
		$paymentID = $paymentData->ID;
		$payment_num = $payment->num_rows();

		log_message('debug', $payer_email, false);
		log_message('debug', $paymentID, false);
		log_message('debug', $payment_num, false);
		log_message('debug', $amount, false);
		log_message('debug', $paymentData->email, false);
		
		 
		 
		//2. check whether only return exactly 1 unique value, others ignore.
		if ($payment_num==1){
			$this->ipn_model->log_mesin("Tried to pay Funds ".$paymentData->amount.": ". " Userid:" . $paymentData->userid);
		
			// Get amount			
		
						//get data from duration plan
			$durationData = $this->Duration_model->get_duration_by_id($paymentData->idduration);
			$durationRow = $durationData->row();
			
			$stmt = "Payment Added to user:". $paymentData->userid.",".$amount;
			$this->ipn_model->log_mesin($stmt);
			$datenow = date('m/d/Y h:i:s a', time());
			$monthservice = $durationRow->total_month;
			$exp_date = $this->common->addDate($datenow,$monthservice);
			//update payment log
			
			$this->ipn_model->update_payment($paymentData->ID,array( 
				"amount" => $amount, 
				"payment_channel" => 'transfer paypal',
				"currency_code" => 'USD',
				"is_pay" => 1,
				"date_pay" => date('Y-m-d', time()),			
				"exp_service" => $exp_date			
				)
			); 


	

			//get data from duration plan
			$planData = $this->Admin_model->get_payment_plan($paymentData->idplan);
			$planRow = $planData->row();
			
			
			

			//send email notification bayar
			$msg = $this->load->view('layout/email/payment_success', '', true);
			$msg = str_replace("%_expdate",$exp_date,$msg);			

			$msg = str_replace("%_code",$planRow->name,$msg);	
			//$paymentData->email = 'dode.agung.asmara@gmail.com';
			$this->common->send_email("Confirmation Payment BossForexSignal.com", $msg, $paymentData->email); 				
		}
		//in the future, tambahkan notif ke customer yg di pending ini untuk mendapatkan email manual aktivasi agar mereka tidak menunggu email auto notif
			
			
			
			
			
			
			
			
			
			
			
			
			/* 
			
			
			
			
			$this->user_model->add_points($userid, $amount);
			$this->ipn_model->log_ipn("Payment Added to user: $userid, $amount");
			$this->ipn_model->add_payment(array(
				"userid" => $userid, 
				"amount" => $amount, 
				"timestamp" => time(), 
				"payment_channel" => 'paypal', 
				"is_pay" => 1, 
				"transfer_proof" => "automatic", 
				"email" => $this->common->nohtml($payer_email)
				)
			); */
		}
	}

}

?>