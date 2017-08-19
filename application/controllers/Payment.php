<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller
{
	public $redirect = "";
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("user_model");
		$this->load->model("perusahaan_m");
		$this->load->model("jabatan_uji_m");
		$this->load->model("applicant_m");
		$this->load->model("funds_model");
		$this->load->model("user_model");
		$this->load->model("Manual_notif_model");
		$this->load->model("Ipn_model"); 

/*		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }*/
		$this->template->loadData("activeLink",
			array("homie" => array("general" => 1)));

			/* $this->load->library('Frontweb'); */
	}

	public function index()
	{
		//$this->manual_notif();
		redirect( base_url() );
	}
	
	public function notif() {
		$this->load->helper('form');
		$this->templatefront->loadExternalCSS(
			array('frontpage/css/cssJoin','frontpage/css/cssNotifmanual')
		);
		$this->templatefront->loadExternalJS(
			array('frontpage/js/jsNotifmanual')
		); 
		$data['selectdata'] = array (
			'BRI' => "Bank BRI",
			'Mandiri' => "Bank Mandiri",
			'BCA' => "Bank BCA",
			'BNI' => "Bank BNI"
		);
		$this->templatefront->set_layout('layout/layout_featurejoin');		
		$this->templatefront->loadContent('frontpage/manual_confirm_view', $data);

	}	
	
	
	public function submit()
	{	
		$this->load->model("Ipn_model");
		$this->load->model("Account_model");
		$this->load->model("Manual_notif_model");
			
		if (!isset($_POST))redirect(site_url("payment/notif"));
		

		$this->load->library('form_validation');
		$config = array(
				 array(
	                 'field'   => 'sender',
	                 'label'   => 'Sender Name',
	                 'rules'   => 'trim|required'
	              ),		
				  array(
	                 'field'   => 'invoiceno',
	                 'label'   => 'Invoice Nomor',
	                 'rules'   => 'trim|required'
	              ),	     
				  array(
	                 'field'   => 'amount',
	                 'label'   => 'Amount Transfer',
	                 'rules'   => 'trim|required'
	              ), 
			 		array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                  ),		
				  array(
                     'field'   => 'date_transfer',
                     'label'   => 'Date Transfer',
                     'rules'   => 'trim|required'
                  )
            );

		$insertData = $this->Manual_notif_model->formatInsertData($_POST);
		$this->form_validation->set_error_delimiters('','');
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$dataset['selectbank']=$_POST['bank'];
			$dataset['selectdata'] = array (
				'BRI' => "Bank BRI",
				'Mandiri' => "Bank Mandiri",
				'BCA' => "Bank BCA",
				'BNI' => "Bank BNI"
			);
			$this->templatefront->loadExternalCSS(
			array('frontpage/css/cssJoin','frontpage/css/cssNotifmanual')
			);
			$this->templatefront->loadExternalJS(
				array('frontpage/js/jsNotifmanual')
			); 
			$this->templatefront->set_layout('layout/layout_featurejoin');		
			$this->templatefront->loadContent('frontpage/manual_confirm_view',$dataset);
			
		}
		else
		{
			//if using library upload, make sure you use form_open_multipart on view
			$this->load->library("upload");
			//print_r($_FILES);die;
			if ($_FILES['userfile']['size'] > 0) {
				$this->upload->initialize(array(
				   "upload_path" => $this->settings->info->upload_path."payment_screenshot/",
				   "overwrite" => FALSE,
				   "max_filename" => 300,
				   "encrypt_name" => TRUE,
				   "remove_spaces" => TRUE,
				   "allowed_types" => $this->settings->info->file_types,
				   "max_size" => 200000,
				   "xss_clean" => TRUE
				));

				if (!$this->upload->do_upload('userfile')) {
					echo "error upload";exit;
				}

				$data = $this->upload->data();

				$insertData['printout'] = $data['file_name'];
			} else {
				$insertData['printout']= $this->settings->info->site_logo;
			}	
			
			$iduser= $this->Manual_notif_model->add_notif($insertData);
				
				if($insertData['destination']=='paypal'){
					//cek di log paypal
					//update payment log kalau ketemu, kalau tidak email ke pengelola
					//send email ke customer
				}else{
					//cek di log mesinotmatis
					//$this->cek_log_mesin($insertData);
					//update payment log kalau ketemu, kalau tidak email ke pengelola
					//send email ke customer
					
				}	
				
				
				$msg = $this->load->view('layout/email/email_notif_manual', '', true);
					
				//Replace Email Template

				$msg = str_replace("%_bank",$insertData['destination'],$msg);
				$msg = str_replace("%_sender",$insertData['sender'],$msg);
				$msg = str_replace("%_invoice",$insertData['invoiceno'],$msg);
				$msg = str_replace("%_price",$insertData['amount'],$msg);
				$msg = str_replace("%_datetransfer",$insertData['date_transfer'],$msg);
				
				//send mail	
				$adminEmail = "bossfxsignal@gmail.com";
				$this->common->send_email("Manual Konfirmasi a/n ".$insertData['sender'], $msg, $adminEmail);
				
				$this->templatefront->set_layout('layout/layout_featurejoin');
				$this->templatefront->loadContent('frontpage/manual_confirm_success');	
				
				
		}
	}
	public function cek_log_mesin($data)
	{
		//check database contain like data and proper date transfer
		//get data then unserialize
		//update payment_log that match log data

		
		
	}		
	
	
	

	


	
}
?>
