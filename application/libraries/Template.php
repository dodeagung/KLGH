<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	var $cssExternal=array();
	var $jsExternal=array();
	var $arrjs='';
	var $arrcss='';
		var $csrfhash;
	var $cssincludes;
	var $sidebar;
	var $responsive_sidebar;
	var $layout = "layout/layout_admin.php";
	var $data = array();
	var $error_layout = 0;
	var $error_view = "error/error.php";
	var $page_title = "";

	public function loadContent($view,$data=array(),$die=0)
	{
		$CI =& get_instance();
		$site = array();
		$site['cssincludes'] = $this->cssincludes;
		foreach($this->data as $k=>$v) {
			$site[$k] = $v;
		}
		foreach($this->data as $k=>$v) {
			$data[$k] = $v;
		}
		$site['content'] = $CI->load->view($view,$data,true);
		if($this->sidebar) {
			$site['sidebar'] = $CI->load->view($this->sidebar,$data,true);
		}

		if($this->page_title) {
			$site['page_title'] = $this->page_title;
		}

		//load CSS array
		foreach ($this->cssExternal as $css){
			$this->arrcss .= $CI->load->view($css,'',true);
		}
		$site['cssExternal'] = $this->arrcss;
		
		//load JS array
		$jsdata['hash'] = $this->csrfhash;
		foreach ($this->jsExternal as $js){
			$this->arrjs .= $CI->load->view($js,$jsdata,true);
		}
		$site['jsExternal'] = $this->arrjs;

		if($this->responsive_sidebar) {
			$site['responsive_sidebar'] = $CI->load
				->view($this->responsive_sidebar,$data,true);
		}
		$CI->load->view($this->layout, $site);
		if($die) die($CI->output->get_output());
	}

	public function loadAjax($view,$data=array(),$die=0)
	{
		$CI =& get_instance();
		$site = array();
		$site['cssincludes'] = $this->cssincludes;
		$CI->load->view($view,$data);
		if($die) die($CI->output->get_output());
	}

	public function set_page_title($title)
	{
		$this->page_title = $title;
	}

	public function loadSidebar($view)
	{
		$this->sidebar = $view;
	}

	public function loadResponsiveSidebar($view)
	{
		$this->responsive_sidebar = $view;
	}

	public function set_error_layout($error)
	{
		$this->error_layout = $error;
	}

	public function set_error_view($view)
	{
		$this->error_view = $view;
	}

	public function set_layout($view)
	{
		$this->layout = $view;
	}

	public function loadData($key, $data)
	{
		$this->data[$key] = $data;
	}

	public function loadExternal($code)
	{
		$this->cssincludes = $code;
	}

	public function error($message)
	{
		if(!$this->error_layout) {
			$this->loadContent($this->error_view,array(
				"message" => $message),1);
		} else {
			$this->loadContent($this->error_view,array(
				"message" => $message),1);
		}
	}

	public function errori($msg)
	{
		echo "ERROR: " . $msg;
		exit();
	}

	public function jsonError($msg)
	{
		echo json_encode(array("error"=>1, "error_msg" => $msg));
		exit();
	}

	public function loadExternalCSS($code)
	{
		$this->cssExternal = $code;
	}
	public function loadExternalJs($code)
	{
		$this->jsExternal = $code;
	}

}

?>
