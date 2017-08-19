<?php
//header('Access-Control-Allow-Origin: *');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }
		$this->template->loadData("activeLink",
			array("home" => array("general" => 1)));

			$this->load->library('Frontweb');

	}

	public function index()
	{
		$this->contact();

	}



		

	public function contact()
	{
		$this->load->model('content_model');

		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/contact_view', array(
			"posts" => $recentposts->result()
			) );

	}	
	
	public function submit()
	{		
		$name = $this->input->get('name');
		$email = $this->input->get('email');
		$message = $this->input->get('message');
		$msg = $this->load->view('layout/email/email_contact_view', '', true);
		$msg = str_replace("%_name",$name,$msg);	
		$msg = str_replace("%_email",$email,$msg);	
		$msg = str_replace("%_phone",$phone,$msg);	
		$msg = str_replace("%_message",$message,$msg);	
		$this->common->send_email("Contact BossForexSignal.com by ".$name, $msg, $email);
		$json_arr = array( 
				"response" => "Message was sent successfully"
			);

		echo json_encode( $json_arr );
	}
	
	public function submit2()
	{	
		
	
		
		$this->load->library('form_validation');
		$config = array(
				 array(
	                 'field'   => 'name',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'
	              ),
			 		array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                  ), 
					array(
						'field'   => 'message',
						'label'   => 'Message',
						'rules'   => 'trim|required'
									)
            );
		
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{						
			$this->load->model('content_model');
			$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);

			$this->templatefront->loadData("activeLink",array("home" => 1));
			$this->templatefront->loadContent('frontpage/contact_view', array(
				"posts" => $recentposts->result(),
				"datakirim" => $_POST
			));
		}
		else
		{

				echo "masuk";
	/* 			$activate_code = md5(rand(1,10000000000) . "fhsf" . rand(1,100000));
				$insertData['activate_code'] = $activate_code;
				$iduser= $this->register_model->add_user($insertData);
				if($iduser)
				{
					$dataview['invoice_no'] = $this->common->generateInvoice('BossFX',$deadline->format("y"),$idpaket,$iduser);
					
					$datapayment = array( 
								"invoice_no" => $dataview['invoice_no'], 
								"userid" => $iduser,
								"idplan" => $idpaket,
								"idduration" => $_POST['dosID'],
								"amount" => $amount,
								"currency_code" => $currency_code,
								"email" =>  $insertData["email"],
								"deadline_pay" =>  $deadline->format("Y-m-d H:i:s"),
								"exp_service" =>$this->common->addDate($datenow,$dos->total_month)
								
							);
							
					$idpayment=$this->Ipn_model->add_payment($datapayment);
					
					$this->templatefront->loadData("activeLink",array("registrasi" => 1));
					$this->templatefront->loadExternalCSS(
						array('frontpage/css/cssJoin')
					);
					$detail_akun = $this->Account_model->get_accounttipe($currency_code);
					$detail_akun = $detail_akun->row();
					$datapayment['rekening'] = $detail_akun;
					$datapayment['tipe_payment'] = $str;
					$datapayment['deadline'] = $deadline->format("l, d F Y H:i:s")	;
					$datapayment['currency_symbol'] = $currency_symbol;
					$datapayment['amountUSD'] = $amountUSD;
					
					$msg = $this->load->view('layout/email/email_confirm_view', '', true);
					
					//Replace Email Template
					$name_cust = $insertData['first_name']." ".$insertData['last_name'];
					$msg = str_replace("%_name_cust",$name_cust,$msg);				
					
					//$site_link = site_url("join/confirm/").$iduser."/".$idpayment."/".$activate_code;
					$site_link = "https://bossfxsignalpro.com";
					$msg = str_replace("%_site_link",$site_link,$msg);

					$now = new DateTime($datenow);					
					$msg = str_replace("%_dateorder",$now->format("l, d F Y"),$msg);

					$dur = $dos->duration;
					$msg = str_replace("%_plan_duration",$dur,$msg);
					
					$bank = $detail_akun->bank;
					$msg = str_replace("%_bank",$bank,$msg);
					
					$account_no = $detail_akun->account_no;
					$msg = str_replace("%_account_no",$account_no,$msg);					
					
					$account_name = $detail_akun->account_name;
					$msg = str_replace("%_account_name",$account_name,$msg);
					
					$expired = $datapayment['deadline'];
					$msg = str_replace("%_expired",$expired,$msg);
					
					$invoice = $datapayment['invoice_no'];
					$msg = str_replace("%_invoice",$invoice,$msg);
					
					$product = $plans->name;
					$msg = str_replace("%_product",$product,$msg);
					
					$price = (($currency_code=='IDR')?$this->common->formatIDR($amount):($currency_symbol." ".$amount));
					$msg = str_replace("%_price",$price,$msg);		


					$priceUSD = "USD ".$amountUSD;
					$msg = str_replace("%_USD",$priceUSD,$msg);
					
					
					$this->common->send_email("Confirm Order BossFX",
						 $msg, $insertData['email']);
					$this->templatefront->set_layout('layout/layout_featurejoin');
					$this->templatefront->loadContent('frontpage/confirm_view',$datapayment);
					
				} */
				

		}

	}
	 
	
	
	
}

?>
