<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templatefront
{

	var $cssincludes=array();
	var $jsincludes=array();
	var $bread_crumb=array();
	var $sidebar;
	var $arrjs='';
	var $arrcss='';
	var $faqpskk;
	var $csrfhash;
	var $elements=array();
	var $searchbar;
	var $responsive_sidebar;
	var $layout_featurefront = 'layout/layout_featurefront.php';
	var $layout_tour = 'layout/layout_tour.php';
	var $data = array();
	var $error_layout = 0;
	var $error_view = "error/error.php";
	var $page_title = "LSP Pariwisata Bali - Independent - Reliable - Traceable";
	var $author = "nonaManis";

	public function loadContent($view,$data=array(),$die=0)	{
		$CI =& get_instance();
		$site = array();
		$CI->load->model("site_slugs_m");
		$CI->load->library('Frontweb');
		//load css array
		foreach ($this->cssincludes as $css){
			$this->arrcss .= $CI->load->view($css,'',true);

		}
		$site['cssincludes'] = $this->arrcss;
		//load js array

		$jsdata['hash'] = $this->csrfhash;
		foreach ($this->jsincludes as $js){
			$this->arrjs .= $CI->load->view($js,$jsdata,true);
		}
	//	print_r($this->jsincludes);die;

		$site['jsincludes'] = $this->arrjs;
		//load breadcrumb menu
		$data['breadCrumb'] = $CI->frontweb->getBreadCrumb();

		foreach($this->data as $k=>$v) {
			$data[$k] = $v;
		}

		foreach ($this->elements as $element){
			$link_el = explode('/',$element);
			$name = end($link_el);
			$data[$name] = $CI->load->view($element,$data,true);
		}


		$site['content'] = $CI->load->view($view,$data,true);

		if($this->page_title) {
			$site['page_title'] = $this->page_title;
		}
		if($this->author) {
			$site['author'] = $this->author;
		}

		if($this->responsive_sidebar) {
			$site['responsive_sidebar'] = $CI->load
				->view($this->responsive_sidebar,$data,true);
		}
		//load dan throw slug menu from here
		$site['slugs_data'] = $CI->site_slugs_m->get_all();
		$CI->load->view($this->layout_featurefront, $site);
		if($die) die($CI->output->get_output());
	}

	public function loadContentTour($view,$data=array(),$die=0)	{
		$CI =& get_instance();
		$site = array();
		$site['content'] = $CI->load->view($view,$data,true);

		if($this->page_title) {
			$site['page_title'] = $this->page_title;
		}
		if($this->author) {
			$site['author'] = $this->author;
		}

		$CI->load->view($this->layout_tour, $site);
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


	public function loadElement($elements)
	{

		$this->elements = $elements;
	}


	public function loadSearchbar($view)
	{
		$this->searchbar = $view;
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
		$this->layout_featurefront = $view;
	}

	public function loadData($key, $data)
	{
		$this->data[$key] = $data;
	}

	public function loadExternalCSS($code)
	{
		$this->cssincludes = $code;
	}
	public function loadExternalJs($code)
	{
		$this->jsincludes = $code;
	}
	public function setcsrfhash($hash)
	{
		$this->csrfhash = $hash;

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

}

?>
