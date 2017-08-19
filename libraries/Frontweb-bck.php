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
			$name = array
			(
      "visimisi"=>"Visi Misi",
      "legalitas"=>"Legalitas",
      "organisasi"=>"Organisasi",
      "registerpskk"=>"Pendaftaran Sertifikasi PSKK 2016",
      "asesor"=>"Team Asesor",
      "pemegangsertifikat"=>"List Pemegang Sertifikat",
      "alursertifikasi"=>"Alur Sertifikasi",
      "tempatuji"=>"Tempat Uji",
      "ourteam"=>"Team LSP Pariwisata Bali",
      "faq"=>"Frequently Asked Questions",
      "contactus"=>"Contact Us",
      "tentangkami"=>"Tentang LSP Pariwisata Bali",
      "clientkami"=>"Client LSP Pariwisata Bali",
			);
			$breadCrumb = array();
			$links = base_url();
			$val["link"] = $links;
			$val["name"] = "LSP Par Bali";
			$breadCrumb[] = $val;
			$uris = $CI->uri->segment_array();
			$was_sub = FALSE;
			foreach($uris as $key=>$eachuri)
			{
				$links = $links.$eachuri."/";
				if(isset($name[$eachuri]) && $name[$eachuri] == "displaynot")
				{
					if($eachuri == "subcategories")
					{$was_sub = "subcategories";}
					continue;
				}
				$check = FALSE;
				if(is_numeric($eachuri))
				{
					if($uris[1] == "categories" || $uris[1] == "subcategories")
					{
						$catname = "";
						foreach($this->categoryData as $data)
						{
							if($uris[1] == "subcategories" && $data["category_id"] == $eachuri)
							{
								$val["link"] = base_url()."categories/".$data["category_id"];
								$val["name"] = $data["category_name"];
								$breadCrumb[] = $val;
								$check = TRUE;
								break;
							}
							else if($data["category_id"] == $eachuri)
							{
								$catname = $data["category_name"];
								break;
							}
							else if(isset($data["sub_categories"]) && is_array($data["sub_categories"]))
							{
								foreach($data["sub_categories"] as $subs)
								{
									if($subs["category_id"] == $eachuri)
									{
										$catname = $subs["category_name"];
										break;
									}
								}
							}
						}
						$name[$eachuri] = $catname;
					}
					else
					{
						continue;
					}
					//echo "<pre>";print_r($this->categoryData);die;
				}
				if($check == TRUE)continue;
				$val["link"] = $links;
				if(isset($name[$eachuri]))$val["name"] = $name[$eachuri];
				else $val["name"] = ucfirst(urldecode($this->removeunderscores($eachuri)));
				$breadCrumb[] = $val;
			}
			return $breadCrumb;

		}
    public function removeunderscores($str)
  	{
  		return str_replace("_"," ",$str);
  	}



}

?>
