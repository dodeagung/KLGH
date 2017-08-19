<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'VT-server-5pUiu0wA-AsCjFZdX7SIwVa3', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => 132000, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 132000,
		  'quantity' => 1,
		  'name' => "Bronze Signal"
		);



		// Optional
		$item_details = array ($item1_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "I Dewa Gede",
		  'last_name'     => "Agung Asmara",
		  'address'       => "Denpasar",
		  'city'          => "Bali",
		  'postal_code'   => "80351",
		  'phone'         => "087822063853",
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "A.A. Gede ",
		  'last_name'     => "Mahendra",
		  'address'       => "Denpasar",
		  'city'          => "Bali",
		  'postal_code'   => "80352",
		  'phone'         => "087822063853",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => "I Dewa Gede",
		  'last_name'     => "Agung Asmara",
		  'email'         => "dode.agung.asmara@gmail.com",
		  'phone'         => "087822063853",
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Fill transaction details
		$transaction = array(
		  'transaction_details' => $transaction_details,
		  'customer_details' => $customer_details,
		  'item_details' => $item_details,
		);
		//error_log(json_encode($transaction));
		$snapToken = $this->midtrans->getSnapToken($transaction);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }
}
