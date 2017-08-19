<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callback extends CI_Controller 
{

	public $project = null;

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("Admin_model");
		$this->load->model("Ipn_model");
		$this->load->model("user_model");
		$this->load->model("Duration_model");
		$this->config->set_item('csrf_protection', FALSE);

	}

	public function index() 
	{	

		exit();
	}

	public function notif() 
	{
		
		
		// selain dari ip 107.170.16.218 maka tidak diproses
		if($_SERVER['REMOTE_ADDR']!='107.170.16.218'){exit();}
		if($_POST['target']=='mutation'){
		  $bank        = $_POST['bank'];
		  $account     = $_POST['account'];
		  $date        = $_POST['date'];
		  $time        = $_POST['time'];
		  $description = $_POST['description'];
		  $type        = $_POST['type'];
		  $amount      = $_POST['amount'];
		  $balance     = $_POST['balance'];
		  #insertToDatabase
		}else if($_POST['target']=='balance'){
		  $bank       = $_POST['bank'];
		  $account    = $_POST['account'];
		  $balance    = $_POST['new'];
		  $last_check = $_POST['date_update'];
		}
		//updateKeDatabase
		$mesin_serialized = serialize($_POST);
		//paramether add date, in months
		$this->Ipn_model->log_mesin($mesin_serialized);
		
		//$amount = '133170.00';
		//$amount = "50338";
		// Invoice Payment
		//1. find user that has unique payment
		$amount = number_format((double)$amount , 2, '', '.');
		$payment=$this->Ipn_model->search_by_amount($amount);
		
		
		$paymentData = $payment->row();


		$paymentID = $paymentData->ID;
		$payment_num = $payment->num_rows();
		
		log_message('debug', $amount, false);

		 
		 
		//2. check whether only return exactly 1 unique value, others ignore.
		if ($payment_num==1){
			$this->Ipn_model->log_mesin("Tried to pay Funds ".$paymentData->amount.": ". " Userid:" . $paymentData->userid);
		
			// Get amount			
			//$amount = abs($amount);
			//$this->user_model->add_points($userid, 1);
			$stmt = "Payment Added to user:". $paymentData->userid.",".$amount;
			$this->Ipn_model->log_mesin($stmt); 
			
			//get data from duration plan
			$durationData = $this->Duration_model->get_duration_by_id($paymentData->idduration);
			$durationRow = $durationData->row();
			
			$datenow = date('m/d/Y h:i:s a', time());
			$monthservice = $durationRow->total_month;
			$exp_date = $this->common->addDate($datenow,$monthservice);
			
			//update payment log
			$this->Ipn_model->update_payment($paymentData->ID,array( 
				"amount" => $amount, 
				"payment_channel" => 'transfer '.$bank,
				"currency_code" => 'IDR',
				"is_pay" => 1,
				"date_pay" => $date,			
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
	}
	
}

?>