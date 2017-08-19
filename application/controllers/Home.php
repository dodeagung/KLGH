<?php
//header('Access-Control-Allow-Origin: *');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }
		$this->template->loadData("activeLink",
			array("home" => array("general" => 1)));

			$this->load->library('Frontweb');

	}

	public function index()
	{
		$this->viewHomePage();

	}



	public function viewHomePage()
	{
		$this->load->model('content_model');

		//load all necessary model 
		$sliders = $this->content_model->get_sliders();
		$posts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$galleries = $this->content_model->get_images_front($this->settings->info->image_front_num,false);
		
		$categories = $this->content_model->get_distinc_cat_images_front($this->settings->info->image_front_num);
		
		$this->templatefront->loadData("activeLink",array("home" => 1));

		$this->templatefront->loadContent('frontpage/home_view', array(
			"posts" => $posts->result(),
			"sliders" => $sliders,
			"galleries" => $galleries->result(),
			"categories" => $categories->result(),
			));

	}

	public function property($idproperty)
	{
		$this->load->model('content_model');

		//load all necessary model 
		$facility = $this->content_model->get_house_facility($idproperty);
		$sliders = $this->content_model->get_house_sliders($idproperty);
		$posts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$galleries = $this->content_model->get_images_front($this->settings->info->image_front_num,false);
		
		$categories = $this->content_model->get_distinc_cat_images_front($this->settings->info->image_front_num,$idproperty);

		$this->templatefront->loadExternalJS(
			array('frontpage/js/jsPlugin')
		);		
		
		$this->templatefront->loadData("activeLink",array("home" => 1));

		$this->templatefront->loadContent('frontpage/property_view', array(
			"posts" => $posts->result(),
			"facility" => $facility->result(),
			"sliders" => $sliders,
			"galleries" => $galleries->result(),
			"categories" => $categories->result(),
			));

	}
	
	public function about()
	{
		$this->load->model('content_model');

		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/aboutus_view', array(
			"posts" => $recentposts->result()
			) );
	}	
	
	public function tos()
	{
		$this->load->model('content_model');

		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/tos_view', array(
			"posts" => $recentposts->result()
			) );
	}	


	
	
}

?>
