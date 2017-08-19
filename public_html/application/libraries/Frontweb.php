<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontweb
{

/*    public function nohtml($message)
    {
        $message = trim($message);
        $message = strip_tags($message);
        $message = htmlspecialchars($message, ENT_QUOTES);
        return $message;
    }*/
    public function getBreadCrumb()
		{
      $CI =& get_instance();
      $CI->load->helper("url");
			$name = array();
			$breadCrumb = array();
			$links = base_url();
			$val["link"] = $links;
			$val["name"] = "HOME";
			$breadCrumb[] = $val;
			$uris = $CI->uri->segment_array();
			$was_sub = FALSE;
			foreach($uris as $key=>$eachuri)
			{
				$links = $links.$eachuri."/";
				$val["link"] = $links;
				if(isset($name[$eachuri]))$val["name"] = $name[$eachuri];
				else $val["name"] = strtoupper(urldecode($this->removedes($eachuri)));
				$breadCrumb[] = $val;
			}
			return $breadCrumb;

		}
    public function removeunderscores($str)
  	{
  		return str_replace("_"," ",$str);
  	}

	public function removedes($str)
  	{
  		return str_replace("-"," ",$str);
  	}



}

?>
