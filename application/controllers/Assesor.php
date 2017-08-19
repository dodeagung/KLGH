 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assesor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	//	$this->load->model("content_model");
		$this->load->model("lsp_manage_model");
		$this->load->model("user_model");
      $this->load->library("pagination");
      $this->load->helper("url");
/*		if (!$this->user->loggedin) $this->template->error(lang("error_1"));
		if(!$this->common->has_permissions(array(
				"admin", "content_manager", "content_worker"), $this->user)) {
				$this->template->error(lang("error_81"));
		}
*/	}


	public function index()
	{
    $this->all();

  }
    //echo $this->uri->segment(1);die;
	public function all()
	{
    //echo $this->uri->segment(1);die;
      $search =  "";
       $config = array();
       $config["base_url"] = base_url() . "assesor/all";
       $config["total_rows"] = $this->lsp_manage_model->get_total_asesor_count();
       $config["per_page"] = 5;
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
       $config["uri_segment"] = 3;
       $config["num_links"] = 3;
       $this->pagination->initialize($config);
       $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
       $data["results"] = $this->lsp_manage_model->
                   get_assesor_pagination($config["per_page"], $page);
       $data["links"] = $this->pagination->create_links();
       $this->templatefront->loadElement(
         array('page/includes/sidebar','page/includes/faqpskk')
       );
       $this->templatefront->loadExternalJs(
         array('page/js/loadAssesorJS')
       );
       $data["keyword"] = $search;
       $this->templatefront->loadContent('page/asesor_view',$data);
  }

  function search() {
        // get search string
        $search = ($this->input->post("filter_assesor"))? $this->input->post("filter_assesor") : "";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
      //  echo $search;die;
        // pagination settings
        $config = array();
        $config['base_url'] = site_url("backend/assesor/search/$search");
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
          array('page/includes/sidebar','page/includes/faqpskk')
        );
          $this->templatefront->loadExternalJs(
      			array('page/js/loadAssesorJS')
      		);

          $data["keyword"] = $search;
        //load view
         $this->templatefront->loadContent('page/asesor_view',$data);
    }

	public function viewAsesor_bck()
	{
    $this->templatefront->loadElement(
      array('page/includes/sidebar','page/includes/faqpskk')
    );
    $this->templatefront->loadExternalJS(array('page/js/loadtukJS'));
    $this->templatefront->loadExternalCSS(array('page/css/loadtukCSS'));

    $this->templatefront->loadContent('page/tempatuji_view');
	}

  public function table_assesor()
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("asesor.last_updated", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
					"asesor.idasesor" => 0
				 ),
				 3 => array(
					"asesor.name" => 0
				)
			)
		);

		$this->datatables->set_total_rows(
			$this->lsp_manage_model->get_total_asesor_count()
		);
		$asesor = $this->lsp_manage_model->get_assesor_table($this->datatables);

		foreach($asesor->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/assesors/".$r->image.'" class="page-image">',
        $r->no_reg,
				$r->name,
				$r->nama_departemen
			);
		}
		echo json_encode($this->datatables->process());
	}


}

?>
