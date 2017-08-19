<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trans extends CI_Controller 
{

	public $project = null;

	public function __construct() 
	{
		parent::__construct();


	}

	public function index() 
	{	

		exit();
	}

	public function midtrans() 
	{	

		$this->load->library('rest');
		$config = array('server' 			=> 'https://api.sandbox.midtrans.com/v2',
				'api_key'			=> 'VT-client-k5EY6FtbCu6AnoYm',
				'api_name'		=> 'M103197',
				'http_user' 		=> 'VT-server-5pUiu0wA-AsCjFZdX7SIwVa3',
				'http_pass' 		=> '',
				'http_auth' 		=> 'basic',
				//'ssl_verify_peer' => TRUE,
				//'ssl_cainfo' 		=> '/certs/cert.pem'
				);

		// Run some setup
		$this->rest->initialize($config);

		// Pull in an array of tweets
		print_r ($this->rest->get('/v2/token'));
	}	
	
	public function curlmidtrans() 
	{	
		$this->load->library('Restclient/Restclient');

        $this->load->helper('url');

        $json = $this->restclient->POST('https://api.sandbox.midtrans.com/v2/example-1424936368/status');

        $this->restclient->debug();
	}
	
		
	
}

?>