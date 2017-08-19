<?php
class Subscribes extends CI_Controller
{
	public $redirect = "";
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");

		$this->template->loadData("activeLink",
			array("homie" => array("general" => 1)));
      $this->load->model("subscribe_m");

	}

	public function index()
	{
		//$this->viewRegistrationForm();
      redirect( base_url());
	}

	public function submit()
	{

		if(empty($_POST))redirect(base_url(),"refresh");
		$datasub=$this->formatInsertData($_POST);
		$this->subscribe_m->addNewUser($datasub);
		$this->templatefront->loadExternalCSS(
				array('frontpage/css/layerslider')
			);
		$this->templatefront->loadExternalJs(
				array('frontpage/js/jsRegister')
			);

        $dataview["email"]=$datasub["email"];
        $dataview["message"]="Sukses Subscription, Mohon tunggu kabar dari kami ya.";
        $dataview["link"]='';
        $this->templatefront->loadContent('frontpage/success_register_view',$dataview);

	}

	private function formatInsertData($postData)
	{
		date_default_timezone_set(date_default_timezone_get());
		//$date2 = DateTime::createFromFormat('d/m/Y', now());

		$retData = array
		(
				"email"=>$postData["email_newsletter"],
				"type"=>"Pariwisata",
				"date"=>date("Y-m-d H:i:s")
		);

		return $retData;
	}


}
?>
