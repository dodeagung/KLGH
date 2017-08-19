 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("content_model");
		$this->load->library("pagination");
		$this->load->helper("url");
	}


	public function index()
	{
		$this->all();
	}
  
	public function all()
	{ 
		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$categories = $this->content_model->get_post_categories();
		
		$post_all = $this->content_model->get_post_front($this->settings->info->post_front_num);	

		$signals = $this->content_model->get_images(2,0);
		$data = array(
			"posts" => $post_all->result(),
			"signals" => $signals->result(),
			"categories" => $categories->result(),
			"recentposts" => $recentposts->result(),
			"signal_num" => $signals->num_rows()
			);
		$this->templatefront->loadExternalJs(
			array('frontpage/js/jsLoadMore')
		);
		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/signal_timeline_view', $data);
	}
	public function loadmoredata()
	{
		$element='';
		$isnext = true;	
		$limit=$this->input->get('limit');
		$offset=$this->input->get('offset');
		//EDIT HERE	
		$signals = $this->content_model->get_images($limit,$offset);
		$signals = $signals->result();
		
		$signalnext = $this->content_model->get_images($limit,($offset+$limit));
		if ($signalnext->num_rows() == 0){
			$isnext = false;	
		}
			
		foreach ($signals as $sig): 
		   $element = $element.'<li class="timeline-inverted">
			  <div class="timeline-badge primary"><a>'.$this->common->date_time($sig->timestamp,"d").'<span>'.$this->common->date_time($sig->timestamp,"M").'</span></a></div>
			  <div class="timeline-panel">
				<div class="blog-entry post-1">
				 <div class="blog-entry-grid hover-direction  popup-gallery clearfix">
				  <ul class="grid-post">
					 <li>
					  <div class="portfolio-item timeline-signal">
					   <img class="img-responsive" src="'.$this->settings->info->upload_path_relative.$sig->image.'_600x600.'.$sig->ext_image.'" alt="">
						 <div class="portfolio-caption">
					<div class="portfolio-overlay">
						<a class="portfolio-img" title="'.$sig->title.'" href="'.$this->settings->info->upload_path_relative.$sig->image.'_600x600.'.$sig->ext_image.'"><i class="fa fa-plus"></i></a>
						<a href="'.site_url("signal/withid/".$sig->ID."/". $this->security->get_csrf_hash()).'"><i class="fa fa-link"></i></a>
					</div>
						  </div>
						 </div>
					  </li>
					</ul>
			  </div>
			  <div class="entry-title mt-30 mb-20">
				 <i class="fa fa-th"></i>
				 <h4>'.$this->common->limitString($sig->title,62).'</h4>
				 <p>'.$sig->summary.'</p>
			  </div>
			  <div class="entry-meta">
				<a href="#"><i class="fa fa-user"></i> By BossForexSignal.com</a>
				<a href="#"><i class="fa fa-folder-open"></i>'.$sig->catname.'</a>
			  </div>
	
			  <div class="entry-share clearfix">

					<div class="share small pull-right">
				   <a class="share-button" href="#">
					  <i class="fa fa-share-alt"></i>
				   </a>
					  <ul>
						<li>
							<a href="http://www.facebook.com/share.php?u='.urlencode(site_url("signal/withid/".$sig->ID)).'&title='.urlencode($sig->title).'">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li>
							<a href="http://twitter.com/home?status='.urlencode($sig->title).'+'.urlencode(site_url("signal/withid/".$sig->ID)).'">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
						<li>
							<a href="https://plus.google.com/share?url='.urlencode(site_url("signal/withid/".$sig->ID)).'">
								<i class="fa fa-google-plus"></i>
							</a> 
						</li> 
					   </ul>
				   </div>
			  </div>
			 </div>
			</div>
		  </li>';
		endforeach;
		
		
		
		$data = array(
					"view"=>$element, 
					"offset" => $offset+$limit,
					"limit" => $limit,
					"isnext" => $isnext
				);
		echo json_encode($data);
	}
  
  
  function search() {
 
        $search = ($this->input->post("filter_assesor"))? $this->input->post("filter_assesor") : "";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        $config = array();
        $config['base_url'] = site_url("assesor/search/$search");
        $config['total_rows'] = $this->lsp_manage_model->get_total_asesor_count($search);
        $config['per_page'] = 5;
        $config["uri_segment"] = 4 ;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
        if($search=="")$config["num_links"] = 3;
        // integrate bootstrap pagination
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';



        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get books list
        $data['results'] = $this->lsp_manage_model-> get_assesor_pagination($config["per_page"], $page, $search);
        $data['links'] = $this->pagination->create_links();


        //load element
        $this->templatefront->loadElement(
          array('frontpage/includes/sidebar','frontpage/includes/faqpskk')
        );
          $this->templatefront->loadExternalJs(
      			array('frontpage/js/loadAssesorJS')
      		);

          $data["keyword"] = $search;
        //load view
         $this->templatefront->loadContent('frontpage/asesor_view',$data);
    }
	
	public function withid($idsignal,$hash='')
	{
/* 		if($hash != $this->security->get_csrf_hash()) {
			redirect(site_url());			
		} */ 
		$this->load->model('content_model');

		//load all necessary model 
		$post_all = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$signal = $this->content_model->get_content_gallery($idsignal);
		$categories = $this->content_model->get_post_categories();

		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/signal_single_view', array(
			"signal" => $signal->row(),
			"posts" => $post_all->result(),
			"categories" => $categories->result(),
			"recentposts" => $recentposts->result(),
		));

	}

}

?>
