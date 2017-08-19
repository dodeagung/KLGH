<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Telegramlib{ 
	
    function __construct() { 
		//Telegram 		
		require_once APPPATH.'third_party/Telegram/vendor/autoload.php';
		require_once APPPATH.'third_party/Telegram/src/Telegram.php';
		require_once APPPATH.'third_party/Telegram/src/TelegramLog.php';

		
		

    }
	
	public function setBot($API,$BOTUSERNAME) {
		// Create Telegram API object
		return new Longman\TelegramBot\Telegram($API, $BOTUSERNAME);
	}		
	
/* 	public function requestHandle() {
		// Create Telegram API object
		return new Longman\TelegramBot\Request();
	}	 */	
	

	
	
}
