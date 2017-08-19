 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webhook extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->load->library("telegramlib");
		$bot=$this->telegramlib->setbot("400109290:AAFAhjQuZrbBFxhGW9O8ZBjraFsIl325naY","maniknewbot","manikbot");
		$tg = $this->telegramlib->receiverData($bot->id);
		
		log_message("debug","masuk broh",false);
		//To reply a command:
		if($tg->text_command("start")){
		  $tg->send
			->text("Hi!")
		  ->send();
		}
		
		//To reply a user message:

		if($tg->text_has("are you alive")){
		  $tg->send
			->text("Yes!")
		  ->send();
		}
	}
  

}

?>
