<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Join extends CI_Controller
{
	public $redirect = "";
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("user_model");
		$this->load->model("funds_model");
		$this->load->model("user_model");
		$this->load->model("duration_model");
		$this->load->model("register_model");
		$this->load->model("content_model");

/*		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }*/
		$this->template->loadData("activeLink",
			array("homie" => array("general" => 1)));

			$this->load->library('Frontweb');
	}

	public function index()
	{
		$this->package();
      //redirect( base_url() );
	}

	public function convertcurrency()
	{
		
		$val = $this->input->get('value');
		$format = $this->input->get('format');
		$origin = $this->input->get('origin');
		
		$result = $this->common->formatIDR($this->currencyconverter->convert($origin , $format, $val, 0, 0)); 
		 $json_arr = array( 
				"res" => $result,
				"format" => $format = $this->input->get('format')
			);

      echo json_encode( $json_arr );
		
		
	}	

	public function package()
	{
		
		$this->templatefront->loadExternalCSS(
			array('frontpage/css/cssJoin')
		);		
		$data["plan"] = $this->admin_model->get_payment_plans();
		
		$this->templatefront->loadData("activeLink",array("registrasi" => 1));
		$this->templatefront->set_layout('layout/layout_featurefront');
		$this->templatefront->loadContent('frontpage/paket_view',$data);
	}	
	
	public function pembayaran()
	{
		
		$this->templatefront->loadExternalCSS(
			array('frontpage/css/cssJoin')
		);		
		
		$this->templatefront->loadData("activeLink",array("registrasi" => 1));
		$this->templatefront->set_layout('layout/layout_featurefront');
		//$this->templatefront->loadContent('frontpage/payment_view');
		$this->templatefront->loadContent('frontpage/confirm_view');
	}



	

	public function plan($plan)
	{
		$plans = $this->funds_model->get_plan($plan);
		$planselected=$plans->row();
		
		if($plans->num_rows()==0) {
			redirect(site_url("join"));			
		} 

		$dur = $this->duration_model->get_duration();	
		$duration = $dur;	

		$data["planselected"]=$planselected;		
		$data["dos"]=$duration; 
	

		
		$listDos = array();
		$planpriceonduration=array();
		$totalplanpriceonduration=array();
		
		foreach($duration as $key=>$ds){
			$planpriceonduration[$key] = number_format(floor((1-($ds->discount/100)) * $planselected->cost),2);
			$totalplanpriceonduration[$key] = number_format(($planpriceonduration[$key] * $ds->total_month),2);
			//listDos[$key] = $ds->duration. " (price plan USD ".$planpriceonduration[$key].")";
		}
		$data['listDos']=$listDos; 
		$data['planpriceonduration']=$planpriceonduration;
		$data['totalplanpriceonduration']=$totalplanpriceonduration;
		
		//load captcha
		$this->load->helper("captcha");
		$rand = rand(400,999);
		$_SESSION['cb'] = $rand;
		$vals = array(
		    'word' => $rand,
		    'img_path' => './theme_backend/images/captcha/',
    		'img_url' => base_url() . 'theme_backend/images/captcha/',
		    'img_width' => 90,
		    'img_height' => 41,
		    'expiration' => 7200,
			'word_length'   => 3,
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
				)
		    );

		$data["cap"] = create_captcha($vals);
		$data["phonecode"] = json_decode($this->common->phonecode(),true);
		$data["dial_code"] = "+62";
		
		//print_r($data["phonecode"]);die;
/* 		$this->templatefront->loadExternalCSS(
			array('frontpage/css/cssJoin') 
		);		*/
		
 		$this->templatefront->loadExternalJS(
			array('frontpage/js/jsJoin','frontpage/js/jsSubmit')
		);  
		$this->templatefront->loadData("activeLink",array("registrasi" => 1));
		$this->templatefront->set_layout('layout/layout_featurefront');
		$this->templatefront->loadContent('frontpage/form_view',$data);
		
	}
	
	public function submit()
	{	
		$this->load->model("Ipn_model");
		$this->load->model("Account_model");
		$idpaket = $this->common->nohtml($this->input->post("paket"));
		//kalau dia free, dosID masukkan saja 1 dulu
		$iddos = ($idpaket == 1)?"1":$this->common->nohtml($this->input->post("dosID"));
		$payment_method = $this->common->nohtml($this->input->post("payment_method"));
	
		//get plan data
		$plans = $this->funds_model->get_plan($idpaket);
		$plans = $plans->row();	

		//get duration data
		$duration  = $this->duration_model->get_duration_by_id($iddos);
		$dos=$duration->row();
		
		$currency_code = 'USD'; 
		//get Amount
		$planprice = number_format(floor((1-($dos->discount/100)) * $plans->cost),2);
		$amount = number_format(($planprice * $dos->total_month),2);
		
		
		date_default_timezone_set('Asia/Makassar');
		$datenow = date('m/d/Y h:i:s a', time());
		$deadline = new DateTime($datenow);
		$deadline->modify("+12 hours");
		$currency_symbol = '$';
		
		$str = "Direct Transfer";
		$amountUSD = $amount;
		if($payment_method == 'bank'){
			$amountUSD = $amount;
			$amount = $this->currencyconverter->convert('USD', 'IDR', $amount, 0, 0);
			$currency_code = 'IDR';
			$currency_symbol = 'Rp';
			$str = "Direct Transfer";	
		}elseif($payment_method == 'paypal'){
			$str = "Transfer Paypal"; 
			$currency_symbol = '$';
		}  
		
		$_POST["first_name"] = $this->common->nohtml($_POST["first_name"]);
		$_POST["email"] = $this->common->nohtml($_POST["email"]);
		$_POST["emailpaypal"] = $this->common->nohtml($_POST["emailpaypal"]);
		$_POST["phone"] = $this->common->nohtml($_POST["phone"]);
		$_POST["address_1"] = $this->common->nohtml($_POST["address_1"]);
		$_POST["state"] = $this->common->nohtml($_POST["state"]);
		
		$this->load->library('form_validation');
		$config = array(
				 array(
	                 'field'   => 'first_name',
	                 'label'   => 'First Name',
	                 'rules'   => 'trim|required'
	              ),
			 		array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                  ),			 
				  array(
                     'field'   => 'emailpaypal',
                     'label'   => 'Email Paypal',
                     'rules'   => 'trim|valid_email|callback_check_paypal_email'
                  ),		
				  array(
                     'field'   => 'phone',
                     'label'   => 'Phone',
                     'rules'   => 'trim|required'
                  ),
					array(
						'field'   => 'address_1',
						'label'   => 'Addres 1',
						'rules'   => 'trim|required'
									),
					array(
                     'field'   => 'state',
                     'label'   => 'State',
                     'rules'   => 'trim|required'
					)

            );
		$_POST['username'] = $_POST['email'];
		$insertData = $this->register_model->formatInsertData($_POST);
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($config);
		$captcha = $this->input->post("captcha");
		if ($this->form_validation->run() == FALSE || !isset($_POST['check_agree']) || ($captcha != $_SESSION['cb']) )
		{		
				if ($captcha != $_SESSION['cb']) {
					$data["captchastat"] = "error! not match!";
				}
				if($captcha==""){
					$data["captchastat"] = "captcha is empty!";
				}
				
						//load captcha
				$this->load->helper("captcha");
				$rand = rand(400,999);
				$_SESSION['cb'] = $rand;
				$vals = array(
					'word' => $rand,
					'img_path' => './theme_backend/images/captcha/',
					'img_url' => base_url() . 'theme_backend/images/captcha/',
					'img_width' => 90,
					'img_height' => 41,
					'expiration' => 7200,
					'word_length'   => 3,
					'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

					'colors'        => array(
						'background' => array(255, 255, 255),
						'border' => array(255, 255, 255),
						'text' => array(0, 0, 0),
						'grid' => array(255, 40, 40)
						)
					);

				$data["cap"] = create_captcha($vals);
				$data["phonecode"] = json_decode($this->common->phonecode(),true);
				$data["dial_code"] = $this->common->nohtml($_POST["phonecode"]);
				$planselected=$plans;
				$duration  = $this->duration_model->get_duration();	
				$data['dosID'] = $_POST['dosID'];
				$data["planselected"]=$planselected; 		
				$data["dos"]=$duration; 
				$planpriceonduration=array();
				$totalplanpriceonduration=array();
				foreach($duration as $key=>$ds){
					$planpriceonduration[$key] = number_format(floor((1-($ds->discount/100)) * $planselected->cost),2);
					$totalplanpriceonduration[$key] = number_format(($planpriceonduration[$key] * $ds->total_month),2);
					
				}
				
				$data['nochecked'] = (isset($_POST['check_agree']))?null:'1';
				$data['payment_method']=$payment_method;
				$data['datakirim']=$_POST;
				$data['planpriceonduration']=$planpriceonduration;
				$data['totalplanpriceonduration']=$totalplanpriceonduration;
				$data["planselected"]=$planselected;

				$this->templatefront->loadExternalJS(
					array('frontpage/js/jsJoin')
				);  
				$this->templatefront->loadData("activeLink",array("registrasi" => 1));
				$this->templatefront->set_layout('layout/layout_featurefront');
				$this->templatefront->loadContent('frontpage/form_view',$data);
			
		}
		else
		{
				$activate_code = md5(rand(1,10000000000) . "fhsf" . rand(1,100000));
				$insertData['activate_code'] = $activate_code;
				$iduser= $this->register_model->add_user($insertData);
				if($iduser)
				{
					$dataview['invoice_no'] = $this->common->generateInvoice('BossFX',$deadline->format("y"),$idpaket,$iduser);
					$coderand = mt_rand(10,99);
					$codeunik = ($payment_method=="bank")?$coderand:floatval($coderand/100);
					
					$datapayment = array( 
								"invoice_no" => $dataview['invoice_no'], 
								"userid" => $iduser,
								"idplan" => $idpaket,
								"idduration" => $iddos,
								"amount" => $amount,
								"amountsum" => ($amount+$codeunik),
								"code_unique" => $codeunik,
								"currency_code" => $currency_code,
								"email" =>  $insertData["email"],
								"payment_channel" =>  $this->input->post("payment_method"),
								"email_paypal" =>  $this->input->post("emailpaypal"),
								"deadline_pay" =>  $deadline->format("Y-m-d H:i:s"),
								"exp_service" =>$this->common->addDate($datenow,$dos->total_month),					
								"is_pay" =>($idpaket==1)?1:0								
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
					$datapayment['payment_method'] = $payment_method;
					
					//DEFINE EMAIL TEMPLATE
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
					
					$price = (($currency_code=='IDR')?$this->common->formatIDR($datapayment['amountsum']):($currency_symbol." ".$datapayment['amountsum']));
					$msg = str_replace("%_price",$price,$msg);		

					$basicfee = (($currency_code=='IDR')?$this->common->formatIDR($datapayment['amount']):($currency_symbol." ".$datapayment['amount']));
					$msg = str_replace("%_basicfee",$basicfee,$msg);		


					$priceUSD = ($payment_method == 'bank')?("(USD ".$amountUSD.")"):"";
					$msg = str_replace("%_USD",$priceUSD,$msg);
					
					$datapayment['amountwithcode'] = $datapayment['amountsum'];
					
					//if free Signal
					if ($idpaket==1){
						
						$datenow = date('m/d/Y h:i:s a', time());
						
						//get data from duration plan
						$durationData = $this->duration_model->get_duration_by_id($datapayment['idduration']);
						$durationRow = $durationData->row();	

						//get data from duration plan
						$planData = $this->admin_model->get_payment_plan($datapayment['idplan']);
						$planRow = $planData->row();
						
						
						$monthservice = $durationRow->total_month;
						$exp_date = $this->common->addDate($datenow,$monthservice);

						//send email notification bayar
						$msg = $this->load->view('layout/email/payment_free_success', '', true);
						
						$msg = str_replace("%_expdate",$exp_date,$msg);			

						$msg = str_replace("%_code",$planRow->name,$msg);	
						
						$this->common->send_email("Registration Confirm BossForexSignal.com", $msg, $datapayment['email']);
					}else{

						if ($payment_method == 'bank'){
							$str = "<span class='total-space'>Unique Code</span> <br />";
							$msg = str_replace("%_uniquecolumn",$str,$msg);	
						
							$str = "<span class='total-space'>".$datapayment["code_unique"]."</span> <br />";
							$msg = str_replace("%_uniqueprice",$str,$msg);		

							$listrekening = "<td class='mini-block' style='font-size:19px;'>
									<span class='header-sm'>											<img alt='Logo BCA' src='https://s4.postimg.org/7c4zo2eql/BCA.png' style='height: 32px'></span><br />
									No. Rekening: 7725233124<br />
									a.n: Anak Agung Gede Mahendra<br />
									Berita : ".$datapayment['invoice_no']."<br /><br />
									<!--
									<span class='header-sm'><img alt='Logo BNI' src='https://s12.postimg.org/a2oz91wd9/BNI.png' style='height: 32px'></span><br />
									No. Rekening: 0551260982<br />
									a.n: Anak Agung Gede Mahendra<br />
									Berita : ".$datapayment['invoice_no']."<br /><br />
									
									<span class='header-sm'><img alt='Logo MANDIRI' src='https://s15.postimg.org/g7je51ct7/MANDIRI.png' style='height: 52px'></span><br />
									No. Rekening: 145-00-1174348-7<br />
									a.n: Anak Agung Gede Mahendra<br />
									Berita : ".$datapayment['invoice_no']."<br /><br />

									<span class='header-sm'><img alt='Logo BRI' src='https://s2.postimg.org/k614bo2wp/BRI.png' style='height: 32px'></span><br />
									No. Rekening: 0557-01-000229-56-4<br />
									a.n: Anak Agung Gede Mahendra<br />
									Berita : ".$datapayment['invoice_no']."<br /><br />
									-->
								  </td>";
							$msg = str_replace("%_listrekening",$listrekening,$msg);
							$msg = str_replace("%_totalharga",$this->common->formatIDR($datapayment['amountwithcode']),$msg);	
							$notif = "<td class='free-text'>
									Pastikan melakukan pembayaran sesuai dengan tagihan ".$datapayment['invoice_no']." (<b>".$this->common->formatIDR($datapayment['amountwithcode'])."</b>) agar dapat diproses oleh sistem secara otomatis. <br><br>
									</td>";
							$msg = str_replace("%_notif",$notif,$msg);	
						}else{
							$str = "<span class='total-space'>Unique Code</span> <br />";
							$msg = str_replace("%_uniquecolumn",$str,$msg);
						
							$str = "<span class='total-space'>".$datapayment["code_unique"]."</span> <br />";
							$msg = str_replace("%_uniqueprice",$str,$msg);

		
							$listrekening = "<span>
										<img alt='Logo Paypal' src='https://s23.postimg.org/9rb3w0fwb/paypal.png' style='margin: auto;display:block;'>
									</span><br />
									<div style='margin: auto;text-align:center;font-size: 14px;'>
										Paypal Account : <a href='https://paypal.me/bossfxsignal/".$datapayment['amountsum']."'><b>bossfxsignal@gmail.com</b></a><br/><br/>
										For direct action, you could use link below: <br/><br/>
										<div class='border-radius: 25px;border: 2px solid #73AD21;'>
											<a href='https://paypal.me/bossfxsignal/".$datapayment['amountsum']."' style='color:blue'><b>https://paypal.me/bossfxsignal/".$datapayment['amountsum']."</b></a>
										</div>
									</div>
									";
							$msg = str_replace("%_listrekening",$listrekening,$msg);
							$msg = str_replace("%_totalharga",$datapayment['amountsum'],$msg);
							
							$notif = "";
							$msg = str_replace("%_notif",$notif,$msg);	
						}
						
						$this->common->send_email("Confirm Order BossForexSignal.com",
							 $msg, $insertData['email']);
					
					}
					$this->templatefront->set_layout('layout/layout_featurejoin');
					$this->templatefront->loadContent('frontpage/confirm_view',$datapayment);
				}
		}
	}
	 
	public function konfirm() {
		$this->templatefront->loadExternalCSS(
					array('frontpage/css/cssJoin')
				);
		$this->templatefront->loadContent('frontpage/confirm_view');
	}	
	
	public function manual_notif() {
		$this->templatefront->loadExternalCSS(
					array('frontpage/css/cssJoin')
				);
		$this->templatefront->loadContent('frontpage/confirm_view');
	}
	

	public function bcaakses() {
		
		$this->load->library('bca');
		$this->bca->index();
	}
	
	
	
	public function check_email_validation($str) 
	{
		if (filter_var($str, FILTER_VALIDATE_EMAIL)){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_email_validation', $str." ".lang("error_108"));
            return FALSE;
		} 
	}		
	
/* 	public function kirim_email() {
		$this->common->send_email_bck("test", "test", "dode.agung.asmara@gmail.com");
	} */ 
	public function check_paypal_email($str,$payment) 
	{
		$payment = $this->input->post("payment_method");
		$str = $this->input->post("emailpaypal");
		if($payment == "paypal" && empty($str)){
			$this->form_validation->set_message('check_paypal_email', 'If using paypal, this field should not empty !');
			return FALSE;
		}else{
			return true; 
		}
		
	}	


	
}
?>
