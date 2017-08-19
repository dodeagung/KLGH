<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Settings 
{

	var $info=array();

	var $version = "1.0";

	public function __construct() 
	{
		$CI =& get_instance();
		$site = $CI->db->select("site_name,site_desc,site_email,
			upload_path_relative, upload_path, site_logo, site_logo_other, favicon, ext_site_logo, ext_site_logo_other, ext_favicon, register,
			 disable_captcha, date_format, avatar_upload, file_types,
			 twitter_consumer_key, twitter_consumer_secret, disable_social_login,
			 facebook_app_id, facebook_app_secret, google_client_id,
			 google_client_secret, file_size,post_front_num, image_front_num, paypal_email, paypal_currency,
			 payment_enabled, payment_symbol, global_premium, install,
			 login_protect, activate_account, default_user_role,
			 secure_login, comments, menu_highlight")
		->where("ID", 1)
		->get("site_settings");
		
		if($site->num_rows() == 0) {
			$CI->template->error(
				"You are missing the site settings database row."
			);
		} else {
			$this->info = $site->row();
		}
	}

}

?>