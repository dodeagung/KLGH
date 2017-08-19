 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installbot extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
	}


	public function index()
	{
		$this->load->library("telegramlib");
		$API_KEY = '372290406:AAHZWBNyz459CbpMv6ClZ83bWJxMuGzDnto';
		$BOT_USERNAME = 'dodeagungBot';
		$hook_url = 'https://bossforexsignal.com/testbot';
		$bot = $this->telegramlib->setBot($API_KEY, $BOT_USERNAME);

				// Set webhook
		$result = $bot->setWebhook($hook_url);
		if ($result->isOk()) {
			echo $result->getDescription();
		}else{
			echo "gagal";	
		}
	}
  

}

?>
