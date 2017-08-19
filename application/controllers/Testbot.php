 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testbot extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{	
		//$this->load->library("telegramlib");
		$API_KEY = '372290406:AAHZWBNyz459CbpMv6ClZ83bWJxMuGzDnto';
		$BOT_USERNAME = 'dodeagungBot';
		
		$telegram = $this->telegramlib->setBot($API_KEY, $BOT_USERNAME);
		

		

		$command_folder =  APPPATH.'third_party/Telegram/src/Commands/';
		$upload_path =  base_url().$this->settings->info->upload_path_relative."/telegram/";
		
			 // set up Upload pic path 
		$telegram->setUploadPath($upload_path);
		// Log Telegram messages
/* 		$telegram->setLogRequests(true);
		$telegram->setLogPath($BOT_NAME.'.log');
		$telegram->setLogVerbosity(1); */
		// Custom commands folder
		$telegram->addCommandsPath($command_folder);
		$telegram->handle();
	
	/* 	log_message("debug",$bot->handle(),false);
		log_message("debug",$bot->getBotUsername(),false);
		log_message("debug",$bot->getApiKey(),false);
		log_message("debug",$command,false);
		log_message("debug","masuk dode",false); */
		
	}
  

}

?>
