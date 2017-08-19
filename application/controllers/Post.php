 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("content_model");
		$this->load->library("pagination");
		$this->load->helper("url");
	}


	public function index($categories=null)
	{	
		//echo $categories;die;
		$this->all($categories);
	}
  
	public function all($categories=null)
	{
		$search =  "";
	   $jml_row=(!isset($categories))?$this->content_model->get_total_post_count($search):$this->content_model->get_total_post_count($search,$categories);
/* 	   echo($categories);
	   echo($jml_row);
	   echo ($this->db->last_query());die;	 */
	   //if($jml_row==0)redirect();	
       $config = array();
	   $config["base_url"] = (!isset($categories))?(base_url() . "post/all/$categories"):(base_url() . "post/all/");
       $config["total_rows"] = $jml_row;
       $config["per_page"] = 4;
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
       $config["uri_segment"] = (!isset($categories))?3:4;
       $config["num_links"] = 4;
       $this->pagination->initialize($config);
       $page = ($this->uri->segment($config["uri_segment"])) ? $this->uri->segment($config["uri_segment"]) : 0;
	   
		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$catObj= $this->content_model->get_post_categories();
		//echo $categories;
		$post_all = $this->content_model->get_post_front($this->settings->info->post_front_num,$categories);
		$result = $this->content_model->
                   get_post_pagination($config["per_page"], $page,$search,$categories);
		$data = array(
			"posts" => $post_all->result(),
			"categories" => $catObj->result(),
			"recentposts" => $recentposts->result(),
			"links" => $this->pagination->create_links(),
			"results" => $result 
			);
			
		//print_r	($result);
		$this->templatefront->set_layout('layout/layout_featurefront');	
		$this->templatefront->loadData("activeLink",array("home" => 1));
		$this->templatefront->loadContent('frontpage/post_all_view', $data);
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
	
	public function withid($idpost,$hash='')
	{
		
		$this->load->model('content_model');
	
		//load all necessary model 
		$post_all = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$recentposts = $this->content_model->get_post_front($this->settings->info->post_front_num);
		$posts = $this->content_model->get_content_post($idpost);
		$categories = $this->content_model->get_post_categories();
		$postbyCategories = $this->content_model->get_content_postbyCategories($posts->row()->idCategory,$posts->row()->ID);

		$this->templatefront->loadData("activeLink",array("home" => 1));

		//get post comment	
		$array_all_id = array();
		$result = $this->content_model->get_post_comment_byparent($idpost);
		$resArray = $result->result_array(); 
		foreach ($resArray as $res) {
			array_push($array_all_id, $res['parentid']); 
		}
		$resArray = $result->result_array();
		$comments = $this->common->in_parent(0,$idpost,$array_all_id);
		//end get comment
		//echo $this->db->last_query();
		//echo"<pre>";print_r($array_all_id);die;
	
		$this->templatefront->loadExternalJs(
      			array('frontpage/js/jsPostComment')
      		);
			
		$this->templatefront->loadExternalCSS(
      			array('frontpage/css/cssPostComment')
      		);	
		$this->templatefront->loadContent('frontpage/post_view', array(
			"post" => $posts->row(),
			"posts" => $post_all->result(),
			"categories" => $categories->result(),
			"postbyCategories" => $postbyCategories->result(),
			"recentposts" => $recentposts->result(),
			"comments" => $comments,
			));

	}
	
	public function addcomment()
	{
		//print_r($_GET);die;
		$this->load->helper('security');
		//if(empty($_POST))redirect(base_url(),"refresh");
		$this->load->library('form_validation');
		$_GET["parentid"] = $this->common->nohtml($_GET["parentid"]);
		$_GET["postid"] = $this->common->nohtml($_GET["postid"]);
		$_GET["email"] = $this->common->nohtml($_GET["email"]);
		$_GET["name"] = $this->common->nohtml($_GET["name"]);
		$_GET["message"] = $this->common->nohtml($_GET["message"]);
		$config = array(
	         array(
	                 'field'   => 'name',
	                 'label'   => 'Your Name',
	                 'rules'   =>'trim|required'
	              ),
					array(
						'field'   => 'email',
						'label'   => 'Email',
						'rules'   => 'trim|required|valid_email'
					),
			 		array(
                     'field'   => 'message',
                     'label'   => 'Message',
                     'rules'   => 'trim|required'
                  )
          );
		$insertData = $this->content_model->formatInsertDataComment($this->input->get());
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			//echo "apakah masuk?";
			
			$message = form_error('name')."<br>".form_error('email')."<br>".form_error('message');
				
				
			$arr = array(
				'success' => "FALSE",
				'message' => $message

			);
			
			echo json_encode($arr);
		}
		else
		{			
			$userid = $this->content_model->add_post_comment($insertData);
			//get post comment	
			$array_all_id = array();
			$result = $this->content_model->get_post_comment_byparent($_GET["postid"]);
			$resArray = $result->result_array(); 
			foreach ($resArray as $res) {
				array_push($array_all_id, $res['parentid']); 
			}
			$resArray = $result->result_array();
			$comments = $this->common->in_parent(0,$_GET["postid"],$array_all_id);
			//end get comment
			
			
			$arr = array(
				'success' => 'TRUE',
				'comment' => $comments 
				);
			echo json_encode($arr);
		}

	}
	

}

?>
