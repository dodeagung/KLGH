<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class CurrencyConverter{
    public function __construct()
    {
       	 $this->CI =& get_instance();
		 $this->CI->load->model("admin_model");
    }   

  
    private function _getRates($fromCurrency, $toCurrency){
		$ratio = $this->CI->admin_model->getRatioCurrency($fromCurrency,$toCurrency);
		return $ratio->rates;
    }
	 public function convert($fromCurrency, $toCurrency, $amount, $saveIntoDb = 1, $hourDifference = 1) {
		 $rate = $this->_getRates($fromCurrency, $toCurrency);
		 $value = (double)$rate * (double)$amount;
		 return number_format((double)$value, 0, '', '');
	 }

 }

?>
