<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("content_model");
		$this->load->model("user_model");
	//	$this->load->helper(array('form', 'url'));
		if (!$this->user->loggedin) $this->template->error(lang("error_1"));
		if(!$this->common->has_permissions(array(
				"admin", "content_manager", "content_worker"), $this->user)) {
				$this->template->error(lang("error_81"));
		}
	}


	public function index()
	{
		$this->template->loadData("activeLink",
			array("content" => array("general" => 1)));

		$this->template->loadContent("content/index.php", array(
			)
		);
	}

	public function upload()
    {
        $callback = 'null';
        $url = '';
        $get = [];

        // for form action, pull CKEditorFuncNum from GET string. e.g., 4 from
        // /ckeditor-form/upload?CKEditor=content&CKEditorFuncNum=4&langCode=en
        // Convert GET parameters to PHP variables
        $qry = $_SERVER['REQUEST_URI'];
        parse_str(substr($qry, strpos($qry, '?') + 1), $get);
		$this->load->library("upload");
		
        if (!isset($_POST) || !isset($get['CKEditorFuncNum'])) {
            $msg = 'CKEditor instance not defined. Cannot upload image.';
        } else {
            $callback = $get['CKEditorFuncNum'];
			if ($_FILES['upload']['size'] > 0) {
				$this->upload->initialize(array(
				   "upload_path" => $this->settings->info->upload_path."/ck-editor/",
				   "overwrite" => FALSE,
				   "max_filename" => 300,
				   "encrypt_name" => TRUE,
				   "remove_spaces" => TRUE,
				   "allowed_types" => "png|gif|jpeg|jpg",
				   "max_size" => $this->settings->info->file_size,
				));
				if (!$this->upload->do_upload('upload')) {
					$msg = $this->upload->display_errors();
				}else{
					$msg = "File uploaded successfully!";
				}

				$data = $this->upload->data();
				$url = site_url().$this->settings->info->upload_path."/ck-editor/".$data['file_name'];
			}else{
				$msg = "File belum di select vroh";
			}
			//$msg=$_FILES['upload'][''];
        }

        // Callback function that inserts image into correct CKEditor instance
        $output = '<html><body><script type="text/javascript">' .
            'window.parent.CKEDITOR.tools.callFunction(' .
            $callback .
            ', "' .
            $url .
            '", "' .
            $msg .
            '");</script></body></html>';

        echo $output;
    }
	
	
	public function content_page()
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("content_pages.last_updated", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"content_pages.title" => 0
				 ),
				 3 => array(
				 	"content_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
				 ),
				 5 => array(
				 	"content_pages.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_pages_count()
		);
		$pages = $this->content_model->get_content_pages($this->datatables);

		foreach($pages->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'" class="page-image">',
				$r->title,
				$r->summary,
				$r->catname,
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				date($this->settings->info->date_format, $r->last_updated),
				'<a href="'.site_url("backend/frontpage/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_448").'"><span class="glyphicon glyphicon-list"></span></a> <a href="'.site_url("backend/content/edit_frontpage/" . $r->ID).'" class="btn btn-warning btn-xs" title="'.lang("ctn_55").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("backend/content/delete_frontpage/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_317").'\')" title="'.lang("ctn_57").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function delete_page($id, $hash)
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$page = $this->content_model->get_content_page($id);
		if($page->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$page = $page->row();
		if($page->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$page->image);
		
		$this->content_model->delete_page($id);
		$this->session->set_flashdata("globalmsg", lang("success_43"));
		redirect(site_url("backend/content"));
	}

	public function edit_page($id)
	{
		$id = intval($id);
		$page = $this->content_model->get_content_page($id);
		if($page->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$page = $page->row();

		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("general" => 1)));


		if($page->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}

		$categories = $this->content_model->get_categories();
		$user_roles = $this->user_model->get_user_roles();

		$roles = $this->content_model->get_page_roles($id);
		$groups = $this->content_model->get_page_groups($id);
		$plans = $this->content_model->get_page_plans($id);

		$this->template->loadContent("content/edit_page.php", array(
			"categories" => $categories,
			"user_roles" => $roles,
			"groups" => $groups,
			"plans" => $plans,
			"page" => $page
			)
		);


	}

	public function edit_page_pro($id)
	{
		$this->load->model("funds_model");
		$id = intval($id);
		$page = $this->content_model->get_content_page($id);
		if($page->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$page = $page->row();

		if($page->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}

		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$content = $this->lib_filter->go($this->input->post("content"));
		$categoryid = intval($this->input->post("categoryid"));
		$comments = intval($this->input->post("comments"));
		$user_roles = $this->input->post("user_roles");
		$user_groups = $this->input->post("user_groups");
		$premium_plans = $this->input->post("premium_plans");
		$type = intval($this->input->post("type"));
		$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		$loggedin = intval($this->input->post("loggedin"));

		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get category
		$category = $this->content_model->get_category($categoryid);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}

		// Check user roles
		$roles= array();
		if($user_roles) {
			foreach($user_roles as $role) {
				$role = intval($role);
					if($role > 0) {
					$user_role = $this->user_model->get_user_role($role);
					if($user_role->num_rows() == 0) {
						$this->template->error(lang("error_85"));
					}
				}
				$roles[] = $role;
			}
		}

		// Check user groups
		$groups= array();
		if($user_groups) {
			foreach($user_groups as $group) {
				$group = intval($group);
					if($group > 0) {
					$user_group = $this->user_model->get_user_group($group);
					if($user_group->num_rows() == 0) {
						$this->template->error(lang("error_86"));
					}
				}
				$groups[] = $group;
			}
		}

		// Check Premium Plans
		$plans= array();
		if($premium_plans) {
			foreach($premium_plans as $plan) {
				$plan = intval($plan);
					if($plan > 0) {
					$plan_r = $this->funds_model->get_plan($plan);
					if($plan_r->num_rows() == 0) {
						$this->template->error(lang("error_87"));
					}
				}
				$plans[] = $plan;
			}
		}

		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/frontpage/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = "/frontpage/".$data['file_name'];
		} else {
			$image= $page->image;
		}

		// Add page
		$this->content_model->update_page($id, array(
			"title" => $title,
			"image" => $image,
			"summary" => $summary,
			"content" => $content,
			"comments" => $comments,
			"categoryid" => $categoryid,
			"timestamp" => time(),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"type" => $type,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin
			)
		);

		// Wipe old user roles
		$this->content_model->delete_page_roles($id);

		// Add user role restrictions
		foreach($roles as $roleid) {
			$this->content_model->add_page_roles(array(
				"pageid" => $id,
				"roleid" => $roleid
				)
			);
		}

		$this->content_model->delete_page_groups($id);

		// Add user role restrictions
		foreach($groups as $groupid) {
			$this->content_model->add_page_groups(array(
				"pageid" => $id,
				"groupid" => $groupid
				)
			);
		}

		$this->content_model->delete_page_plans($id);

		// Add user role restrictions
		foreach($plans as $planid) {
			$this->content_model->add_page_plans(array(
				"pageid" => $id,
				"planid" => $planid
				)
			);
		}


		$this->session->set_flashdata("globalmsg", lang("success_44"));
		redirect(site_url("backend/content"));
	}

	public function add_page()
	{
		$this->load->model("funds_model");
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("general" => 1)));

		$categories = $this->content_model->get_categories();
		$user_roles = $this->user_model->get_user_roles();
		$groups = $this->user_model->get_user_groups_all();
		$premium_plans = $this->funds_model->get_plans();
		$this->template->loadContent("content/add_page.php", array(
			"categories" => $categories,
			"user_roles" => $user_roles,
			"premium_plans" => $premium_plans,
			"groups" => $groups
			)
		);
	}

	public function add_page_pro()
	{
		$this->load->model("funds_model");
		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$content = $this->lib_filter->go($this->input->post("content"));
		$categoryid = intval($this->input->post("categoryid"));
		$comments = intval($this->input->post("comments"));
		$user_roles = $this->input->post("user_roles");
		$user_groups = $this->input->post("user_groups");
		$premium_plans = $this->input->post("premium_plans");
		$type = intval($this->input->post("type"));
		$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		$loggedin = intval($this->input->post("loggedin"));

		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get category
		$category = $this->content_model->get_category($categoryid);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}

		// Check user roles
		$roles= array();
		if($user_roles) {
			foreach($user_roles as $role) {
				$role = intval($role);
					if($role > 0) {
					$user_role = $this->user_model->get_user_role($role);
					if($user_role->num_rows() == 0) {
						$this->template->error(lang("error_85"));
					}
				}
				$roles[] = $role;
			}
		}

		// Check user groups
		$groups= array();
		if($user_groups) {
			foreach($user_groups as $group) {
				$group = intval($group);
					if($group > 0) {
					$user_group = $this->user_model->get_user_group($group);
					if($user_group->num_rows() == 0) {
						$this->template->error(lang("error_86"));
					}
				}
				$groups[] = $group;
			}
		}

		// Check Premium Plans
		$plans= array();
		if($premium_plans) {
			foreach($premium_plans as $plan) {
				$plan = intval($plan);
					if($plan > 0) {
					$plan_r = $this->funds_model->get_plan($plan);
					if($plan_r->num_rows() == 0) {
						$this->template->error(lang("error_87"));
					}
				}
				$plans[] = $plan;
			}
		}

		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/frontpage/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = "/frontpage/".$data['file_name'];
		} else {
			$image= "page_default.png";
		}

		// Add page
		$pageid = $this->content_model->add_page(array(
			"title" => $title,
			"image" => $image,
			"summary" => $summary,
			"content" => $content,
			"comments" => $comments,
			"categoryid" => $categoryid,
			"timestamp" => time(),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"type" => $type,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin
			)
		);

		// Add user role restrictions
		foreach($roles as $roleid) {
			$this->content_model->add_page_roles(array(
				"pageid" => $pageid,
				"roleid" => $roleid
				)
			);
		}

		// Add user role restrictions
		foreach($groups as $groupid) {
			$this->content_model->add_page_groups(array(
				"pageid" => $pageid,
				"groupid" => $groupid
				)
			);
		}

		// Add premium plans restrictions
		foreach($plans as $planid) {
			$this->content_model->add_page_plans(array(
				"pageid" => $pageid,
				"planid" => $planid
				)
			);
		}

		$this->session->set_flashdata("globalmsg", lang("success_45"));
		redirect(site_url("backend/content"));
	}

	public function categories()
	{
		$this->template->loadData("activeLink",
			array("content" => array("categories" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$categories = $this->content_model->get_categories();

		$this->template->loadContent("content/categories.php", array(
			"categories" => $categories
			)
		);
	}


	public function add_category()
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= "default.png";
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->add_category(array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("backend/content/categories"));
	}

	public function delete_category($id, $hash)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$category = $this->content_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}
		$category = $category->row();
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$category->image);
		$this->content_model->delete_category($id);
		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("backend/content/categories"));
	}
	public function edit_category($id)
	{
		$this->template->loadData("activeLink",
			array("content" => array("categories" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$category = $this->content_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$category = $category->row();
		$this->template->loadContent("content/edit_category.php", array(
			"category" => $category
			)
		);
	}
	public function edit_category_pro($id)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$category = $this->content_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$category = $category->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
					 "upload_path" => $this->settings->info->upload_path."/category/",
					 "overwrite" => FALSE,
					 "max_filename" => 300,
					 "encrypt_name" => TRUE,
					 "remove_spaces" => TRUE,
					 "allowed_types" => "png|gif|jpeg|jpg",
					 "max_size" => $this->settings->info->file_size,
				));

				if (!$this->upload->do_upload()) {
					$this->template->error(lang("error_21")
					.$this->upload->display_errors());
				}

				$data = $this->upload->data();

				$image = "/category/".$data['file_name'];
		} else {
			$image= $category->image;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->update_category($id, array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_48"));
		redirect(site_url("backend/content/categories"));
	}


//SLIDER
	public function sliders()
	{
		//for activate active link
		$this->template->loadData("activeLink",
			array("content" => array("slider" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$sliders = $this->content_model->get_sliders();
	//	echo "<pre>";print_r($sliders);die;
		$this->template->loadContent("content/sliders.php", array(
			"sliders" => $sliders
			)
		);
	}

	public function add_slider()
	{
		
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/sliders/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();
			//this slider 1950 x 860
			$this->common->resizecropImageCI($data,50,50);
			$this->common->resizecropImageCI($data,1950,860);
			$this->common->resizecropImageCI($data,755,331);
			$namafile=explode(".",$data['file_name']);
			
		    $image = '/sliders/'.$namafile[0];
		} else {
			$image= "default.png";
			$namafile=explode(".",$image);
			$image= $namafile[0] ;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->add_slider(array(
			"name" => $name,
			"description" => $desc,
			"image" => $image,
			"ext_image" => $namafile[1]
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("backend/content/sliders"));
	}


	public function delete_slider($id, $hash)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$slider = $this->content_model->get_slider($id);
		if($slider->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}
		
		$slider = $slider->row();
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$slider->image);
		$this->content_model->delete_slider($id);
		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("backend/content/sliders"));
	}


	public function edit_slider($id)
	{
		$this->template->loadData("activeLink",
			array("content" => array("slider" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$slider = $this->content_model->get_slider($id);
		if($slider->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$slider = $slider->row();
		$this->template->loadContent("content/edit_slider.php", array(
			"slider" => $slider
			)
		);
	}



	public function edit_slider_pro($id)
	{
		
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$slider = $this->content_model->get_slider($id);
		if($slider->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$slider = $slider->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {

			$dataupload = array(
		       "upload_path" => $this->settings->info->upload_path."/sliders/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    );
			
			$this->upload->initialize($dataupload);			
			
			

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }
			
			

		    $data = $this->upload->data();
			//this slider 1950 x 860
			$this->common->resizecropImageCI($data,50,50);
			$this->common->resizecropImageCI($data,1950,860);
			$this->common->resizecropImageCI($data,755,331);
			$namafile=explode(".",$data['file_name']);
		    $image = '/sliders/'.$namafile[0];

		} else {
			$namafile=explode(".",$slider->image);
			$image= $namafile[0] ;
			$namafile[1]=$slider->ext_image;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->update_slider($id, array(
			"name" => $name,
			"description" => $desc,
			"image" => $image,
			"ext_image" => $namafile[1]
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_48"));
		redirect(site_url("backend/content/sliders"));
	}
	
	//POST
	
	
	public function post()
	{
		$this->template->loadData("activeLink",
			array("content" => array("post" =>  array("manage" => 1))));

		$this->template->loadContent("content/posts.php", array(
			)
		);
	}	
	
	public function gallery()
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery" =>  array("manage" => 1))));

		$this->template->loadContent("content/galleries.php", array(
			)
		);
	}	
	
	public function image_front()
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery" =>  array("manageimagefront" => 1))));

		$this->template->loadContent("content/image_front.php", array(
			)
		);
	}

	public function content_post()
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("content_posts.last_updated", "desc");

		// Set post ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"content_posts.title" => 0
				 ),
				 3 => array(
				 	"content_post_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
				 ),
				 5 => array(
				 	"content_posts.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_posts_count()
		);
		$posts = $this->content_model->get_content_posts($this->datatables);

		foreach($posts->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'_100x67.'.$r->ext_image.'" class="post-image" width = "100px">',
				$r->title,
				$r->summary,
				$r->catname,
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				date($this->settings->info->date_format, $r->last_updated),
				'<a href="'.site_url("backend/post/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_448").'"><span class="glyphicon glyphicon-list"></span></a> <a href="'.site_url("backend/content/edit_post/" . $r->ID).'" class="btn btn-warning btn-xs" title="'.lang("ctn_55").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("backend/content/delete_post/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_317").'\')" title="'.lang("ctn_57").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function delete_post($id, $hash)
	{
		$this->load->model("site_slugs_m");
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$post = $this->content_model->get_content_post($id);
		if($post->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$post = $post->row();
		if($post->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}
		
		// remove slug
		$controller = 'post/withid/'.$id;
		$this->site_slugs_m->deletebycontroller($controller);		
		
		// update Comment to 1 / no parent ID
		$this->content_model->update_post_comment_byIdPost($id,array(
			"postid" => "1"
		));
		
		
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$post->image);
		$this->content_model->delete_post($id);
		$this->session->set_flashdata("globalmsg", lang("success_43"));
		redirect(site_url("backend/content/post"));
	}

	public function create_link(){
		$this->load->helper('security');
		$this->load->library('form_validation');
		
	
		
		$_GET["title"] = $this->common->nohtml($_GET["title"]);
		
		
		if ($_GET["title"]!="")
		{
		
			$slug_link = $this->common->create_slug_string($_GET["title"]);
				
			$arr = array(
				'success' => "TRUE",
				'link' => $slug_link
			);
			
			echo json_encode($arr);
		}
		else
		{			
			$arr = array(
				'success' => 'FALSE',
				'comment' => "No String" 
				);
			echo json_encode($arr);
		}
		
	}
	public function edit_post($id)
	{
		$this->load->model("site_slugs_m");
		$id = intval($id);
		$post = $this->content_model->get_content_post($id);
		if($post->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$post = $post->row();
		$controller = 'post/withid/'.$id;
		$slug = $this->site_slugs_m->get_by_controller($controller);
		
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/custom/jsPost.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("post" => array("manage" => 1))));



		$post_categories = $this->content_model->get_post_categories();
		$post_albums = $this->content_model->get_post_categories();
		

		$this->template->loadContent("content/edit_post.php", array(
			"post_categories" => $post_categories,
			"post" => $post,
			"link" => $slug
			)
		);


	}

	public function edit_post_pro($id)
	{
		$this->load->model("funds_model");
		$this->load->model("site_slugs_m");
		$id = intval($id);
		$post = $this->content_model->get_content_post($id);
		if($post->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$post = $post->row();
		
		$date_post = $this->common->nohtml($this->input->post("date_post"));
		if(!$this->common->validateDate($date_post)) {
			$this->template->error(lang("error_109"));
		}	

		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$content = $this->lib_filter->go($this->input->post("content"));
		//$content = $this->input->post("content");
		$post_categoryid = intval($this->input->post("categoryid"));
		$comments = intval($this->input->post("comments"));
		$user_roles = $this->input->post("user_roles");
		$user_groups = $this->input->post("user_groups");
		$premium_plans = $this->input->post("premium_plans");
		$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		$loggedin = intval($this->input->post("loggedin"));

		$summary = $this->common->limitString($summary,150);
		
		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get post_category
		$post_category = $this->content_model->get_post_category($post_categoryid);
		if($post_category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}

		

		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/post/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();
			$this->common->resizecropImageCI($data,600,600);
			$this->common->resizecropImageCI($data,100,67);
			$this->common->resizecropImageCI($data,300,201);
			$this->common->resizecropImageCI($data,755,331);
			$namafile=explode(".",$data['file_name']);
		    
		    $image = "/post/".$namafile[0];
		} else {
			$namafile=explode(".",$post->image);
			
			$image= $namafile[0] ;
			$namafile[1] = $post->ext_image;
			
		}

		// Add slug
		$controller = 'post/withid/'.$id;
		$slug = ($this->common->issulgable($this->common->nohtml($this->input->post("slug"))))?$this->common->nohtml($this->input->post("slug")):$controller;
		$this->site_slugs_m->updatebycontroller($controller, array(
			'controller' => $controller,
			'slug' => $slug,
			'keywords' => $this->common->nohtml($this->input->post("slug"))
		));
		
		// Add post
		$this->content_model->update_post($id, array(
			"title" => $title,
			"image" => $image,
			"ext_image" => $namafile[1],
			"summary" => $summary,
			"content" => $content,
			"comments" => $comments,
			"categoryid" => $post_categoryid,
			"timestamp" => strtotime($date_post),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin
			)
		);

	

		$this->session->set_flashdata("globalmsg", lang("success_44"));
		redirect(site_url("backend/content/post"));
	}

	public function add_post()
	{
		$this->load->model("funds_model");
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/custom/jsPost.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("post" => 1)));

		$post_categories = $this->content_model->get_post_categories();
		$user_roles = $this->user_model->get_user_roles();
		$groups = $this->user_model->get_user_groups_all();
		$premium_plans = $this->funds_model->get_plans();
		$this->template->loadContent("content/add_post.php", array(
			"categories" => $post_categories,
			"user_roles" => $user_roles,
			"premium_plans" => $premium_plans,
			"groups" => $groups
			)
		);
	}

	public function add_post_pro()
	{
		$this->load->model("site_slugs_m");
		$this->load->model("funds_model");
		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$date_post = $this->common->nohtml($this->input->post("date_post"));
		$content = $this->lib_filter->go($this->input->post("content"));
		$post_categoryid = intval($this->input->post("categoryid"));
		$comments = intval($this->input->post("comments"));
		$loggedin = intval($this->input->post("loggedin"));
		
		$summary = $this->common->limitString($summary,150);
		
		if(!$this->common->validateDate($date_post)) {
			$this->template->error(lang("error_109"));
		}	

		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get post_category
		$post_category = $this->content_model->get_post_category($post_categoryid);
		if($post_category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}

		if($this->input->post("seo_title")==""){
			$seo_title = $this->common->nohtml($this->input->post("title"));
		}else{
			$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		}
		
		if($this->input->post("seo_description")==""){
			$seo_desc = $this->common->nohtml($this->input->post("title"));
		}else{
			$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		}

		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/post/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();
			$this->common->resizecropImageCI($data,600,600);
			$this->common->resizecropImageCI($data,100,67);
			$this->common->resizecropImageCI($data,300,201);
			$this->common->resizecropImageCI($data,755,331);
			$namafile=explode(".",$data['file_name']);
			
		    $image = "/post/".$data['file_name'];
			$namafile=explode(".",$image);
			$image= $namafile[0] ;
		} else {
			$image= "default.png";
			$namafile=explode(".",$image);
			$image= $namafile[0] ;
		}
		

		
		// Add post
		$data_post=array(
			"title" => $title,
			"image" => $image,
			"ext_image" => $namafile[1],
			"summary" => $summary,
			"content" => $content,
			"comments" => $comments,
			"categoryid" => $post_categoryid,
			"timestamp" => strtotime($date_post),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin
			);
		$postid = $this->content_model->add_post($data_post);

				// Add slug
		$controller = 'post/withid/'.$postid;
		$slug = ($this->common->issulgable($this->common->nohtml($this->input->post("slug"))))?$this->common->nohtml($this->input->post("slug")):$controller;
		$this->site_slugs_m->create(array(
			'controller' => $controller,
			'slug' => $slug,
			'keywords' => $this->common->nohtml($this->input->post("slug"))
		));
		
		$this->session->set_flashdata("globalmsg", lang("success_45"));
		redirect(site_url("backend/content/post"));
	}

	public function post_categories()
	{
		$this->template->loadData("activeLink",
			array("content" => array("post" => array("category" => 1))));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$post_categories = $this->content_model->get_post_categories();

		$this->template->loadContent("content/post_categories.php", array(
			"categories" => $post_categories
			)
		);
	}


	public function add_post_category()
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= "default.png";
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->add_post_category(array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("backend/content/post_categories"));
	}

	public function delete_post_category($id, $hash)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$post_category = $this->content_model->get_post_category($id);
		if($post_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}
		
		$post_category = $post_category->row();
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$post_category->image);

		$this->content_model->delete_post_category($id);
		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("backend/content/post_categories"));
	}
	public function edit_post_category($id)
	{
		$this->template->loadData("activeLink",
			array("content" => array("post_categories" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$post_category = $this->content_model->get_post_category($id);
		if($post_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$post_category = $post_category->row();
		$this->template->loadContent("content/edit_post_category.php", array(
			"category" => $post_category
			)
		);
	}
	public function edit_post_category_pro($id)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$post_category = $this->content_model->get_post_category($id);
		if($post_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$post_category = $post_category->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
					 "upload_path" => $this->settings->info->upload_path."/cat_post/",
					 "overwrite" => FALSE,
					 "max_filename" => 300,
					 "encrypt_name" => TRUE,
					 "remove_spaces" => TRUE,
					 "allowed_types" => "png|gif|jpeg|jpg",
					 "max_size" => $this->settings->info->file_size,
				));

				if (!$this->upload->do_upload()) {
					$this->template->error(lang("error_21")
					.$this->upload->display_errors());
				}

				$data = $this->upload->data();

				$image = "/cat_post/".$data['file_name'];
		} else {
			$image= $post_category->image;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->update_post_category($id, array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_48"));
		redirect(site_url("backend/content/post_categories"));
	}
	
	public function content_gallery()
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("content_galleries.last_updated", "desc");

		// Set gallery ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"content_galleries.title" => 0
				 ),
				 3 => array(
				 	"content_gallery_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
				 ),
				 5 => array(
				 	"content_galleries.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_galleries_count()
		);
		$galleries = $this->content_model->get_content_galleries($this->datatables);

		foreach($galleries->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'_100x67.'.$r->ext_image.'" class="gallery-image" width = "100px">',
				$r->title,
				$r->albumname,
				$r->catname,
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				date($this->settings->info->date_format, $r->last_updated),
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_448").'"><span class="glyphicon glyphicon-list"></span></a> <a href="'.site_url("backend/content/edit_gallery/" . $r->ID).'" class="btn btn-warning btn-xs" title="'.lang("ctn_55").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("backend/content/delete_gallery/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_317").'\')" title="'.lang("ctn_57").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function content_image_front()
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("content_galleries.last_updated", "desc");

		// Set gallery ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"content_galleries.title" => 0
				 ),
				 3 => array(
				 	"content_gallery_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
				 ),
				 5 => array(
				 	"content_galleries.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_galleries_count()
		);
		$galleries = $this->content_model->get_content_galleries($this->datatables);
		//print_r("image front".($r->galleries));
		//print_r(($this->settings->info->image_front_num));die;
		foreach($galleries->result() as $r) {
			//print_r("image front".($r->image_front));die;
			
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'_100x67.'.$r->ext_image.'" class="gallery-image" width = "100px">',
				$r->title, 
				$r->albumname,
				$r->catname,
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				date($this->settings->info->date_format, $r->last_updated),
				'<a href="'.site_url("backend/content/add_front/" . $r->ID. "/" . $this->security->get_csrf_hash(). "/" .(!$r->image_front)).'" class="btn '.(($r->image_front == true)?"btn-success":"btn-default").' btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_504").'">
					<span class="glyphicon '.(($r->image_front == true)?"glyphicon-ok":"glyphicon-picture").'  "></span>
				</a>
				<a href="'.site_url("backend/content/delete_gallery/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_317").'\')" title="'.lang("ctn_57").'" data-toggle="tooltip" data-placement="bottom">
					<span class="glyphicon glyphicon-trash"></span>
				</a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function delete_gallery($id, $hash)
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$gallery = $gallery->row();
		if($gallery->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$gallery->image);
		$this->content_model->delete_gallery($id);
		$this->session->set_flashdata("globalmsg", lang("success_43"));
		redirect(site_url("backend/content/gallery"));
	}
	
	public function add_front($id, $hash, $action=null)
	{
		if($action==null)$action="0";
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		
		if(($this->content_model->get_total_images_front_count($id) >= $this->settings->info->image_front_num) && ($action == "1")){
			$this->template->error(lang("error_106"));
		}
				
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_107"));
		}
		
		$gallery = $gallery->row();
		if($gallery->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}
		
		$this->content_model->update_gallery($id, array(
			"image_front" => $action
			)
		);

		if($action){
			$this->session->set_flashdata("globalmsg", lang("success_53"));
		}else{
			$this->session->set_flashdata("globalmsg", lang("success_54"));
		}
		redirect(site_url("backend/content/image_front"));
	}

	public function edit_gallery($id)
	{
		$id = intval($id);
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$gallery = $gallery->row();


		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("general" => 1)));


		if($gallery->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}

		$gallery_categories = $this->content_model->get_gallery_categories();
		$gallery_albums = $this->content_model->get_gallery_albums();

		$this->template->loadContent("content/edit_gallery.php", array(
			"gallery_categories" => $gallery_categories,
			"gallery_albums" => $gallery_albums,
			"gallery" => $gallery
			)
		);


	}

	public function edit_gallery_pro($id)
	{
		$id = intval($id);
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_82"));
		}
		$gallery = $gallery->row();

		if($gallery->userid != $this->user->info->ID) {
			// Check permission
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
				$this->template->error(lang("error_81"));
			}
		}

		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$content = $this->lib_filter->go($this->input->post("content"));
		$gallery_categoryid = intval($this->input->post("categoryid"));
		$gallery_albumid = intval($this->input->post("albumid"));
		$comments = intval($this->input->post("comments"));
		$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		$loggedin = intval($this->input->post("loggedin"));

		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get gallery_category
		$gallery_category = $this->content_model->get_gallery_category($gallery_categoryid);
		if($gallery_category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}		
		
		// Get gallery_albums
		$gallery_album = $this->content_model->get_gallery_album($gallery_albumid);
		if($gallery_album->num_rows() == 0) {
			$this->template->error(lang("error_105"));
		}


		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/gallery/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();
			$this->common->resizecropImageCI($data,600,600);
			$this->common->resizecropImageCI($data,100,67);
			$this->common->resizecropImageCI($data,300,201);
			$this->common->resizecropImageCI($data,214,213);
			$namafile=explode(".",$data['file_name']);

		    $image = "/gallery/".$namafile[0];
		} else {
			$namafile=explode(".",$gallery->image);
			$image= $namafile[0];
			$namafile[1] = $post->ext_image;
		}

		// Add gallery
		$this->content_model->update_gallery($id, array(
			"title" => $title,
			"image" => $image,
			"ext_image" => $namafile[1],
			"summary" => $summary,
			"comments" => $comments,
			"categoryid" => $gallery_categoryid,
			"albumid" => $gallery_albumid,
			"timestamp" => time(),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin
			)
		);



		$this->session->set_flashdata("globalmsg", lang("success_44"));
		redirect(site_url("backend/content/gallery"));
	}

	public function add_gallery()
	{
		$this->load->model("funds_model");
		$this->template->loadExternal(
			'</script><link href="'.base_url().'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="'.base_url().
			'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>'
		);
		$this->template->loadData("activeLink",
			array("content" => array("gallery" => array("manage" => 1))));

		$gallery_categories = $this->content_model->get_gallery_categories();
		$albums = $this->content_model->get_gallery_albums();
		$this->template->loadContent("content/add_gallery.php", array(
			"categories" => $gallery_categories,
			"albums" => $albums
			)
		);
	}

	public function add_gallery_pro()
	{
		$title = $this->common->nohtml($this->input->post("title"));
		$summary = $this->common->nohtml($this->input->post("summary"));
		$gallery_categoryid = intval($this->input->post("categoryid"));
		$gallery_albumid = intval($this->input->post("albumid"));
		$comments = intval($this->input->post("comments"));
		$Displayimage = intval($this->input->post("Displayimage"));
		$seo_title = $this->common->nohtml($this->input->post("seo_title"));
		$seo_desc = $this->common->nohtml($this->input->post("seo_description"));
		$loggedin = intval($this->input->post("loggedin"));

		if(empty($title)) {
			$this->template->error(lang("error_83"));
		}

		// Get gallery_category
		$gallery_category = $this->content_model->get_gallery_category($gallery_categoryid);
		if($gallery_category->num_rows() == 0) {
			$this->template->error(lang("error_84"));
		}

		

		// Upload image
		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path."/gallery/",
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();
			$this->common->resizecropImageCI($data,600,600);
			$this->common->resizecropImageCI($data,100,67);
			$this->common->resizecropImageCI($data,300,201);
			$this->common->resizecropImageCI($data,214,213);
			$namafile=explode(".",$data['file_name']);

		    $image = "/gallery/".$namafile[0];
		} else {
			$image= "default.png";
			$namafile=explode(".",$image);
			$image= $namafile[0];
		}

		// Add gallery
		$galleryid = $this->content_model->add_gallery(array(
			"title" => $title,
			"image" => $image,
			"ext_image" => $namafile[1],
			"summary" => $summary,
			"comments" => $comments,
			"categoryid" => $gallery_categoryid,
			"albumid" => $gallery_albumid,
			"timestamp" => time(),
			"userid" => $this->user->info->ID,
			"last_updated" => time(),
			"last_updated_userid" => $this->user->info->ID,
			"seo_title" => $seo_title,
			"seo_description" => $seo_desc,
			"loggedin" => $loggedin,
			"displayimage" => $Displayimage
			)
		);


		$this->session->set_flashdata("globalmsg", lang("success_45"));
		redirect(site_url("backend/content/gallery"));
	}

	public function gallery_categories()
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery" => array("category" => 1))));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$gallery_categories = $this->content_model->get_gallery_categories();

		$this->template->loadContent("content/gallery_categories.php", array(
			"categories" => $gallery_categories
			)
		);
	}


	public function add_gallery_category()
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= "default.png";
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->add_gallery_category(array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("backend/content/gallery_categories"));
	}

	public function delete_gallery_category($id, $hash)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		if($id == 1) {
			$this->template->error(lang("error_108"));
		}
		$gallery_category = $this->content_model->get_gallery_category($id);
		if($gallery_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}
		$gallery_category = $gallery_category->row();
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$gallery_category->image);
		$this->content_model->delete_gallery_category($id);
		$this->content_model->update_gallery($id,array(
			"categoryid" => '1'
			),"categoryid");
		
		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("backend/content/gallery_categories"));
	}
	
	public function edit_gallery_category($id)
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery_categories" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$gallery_category = $this->content_model->get_gallery_category($id);
		if($gallery_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$gallery_category = $gallery_category->row();
		$this->template->loadContent("content/edit_gallery_category.php", array(
			"category" => $gallery_category
			)
		);
	}
	
	
	public function edit_gallery_category_pro($id)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$gallery_category = $this->content_model->get_gallery_category($id);
		if($gallery_category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$gallery_category = $gallery_category->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
					 "upload_path" => $this->settings->info->upload_path."cat_gallery",
					 "overwrite" => FALSE,
					 "max_filename" => 300,
					 "encrypt_name" => TRUE,
					 "remove_spaces" => TRUE,
					 "allowed_types" => "png|gif|jpeg|jpg",
					 "max_size" => $this->settings->info->file_size,
				));

				if (!$this->upload->do_upload()) {
					$this->template->error(lang("error_21")
					.$this->upload->display_errors());
				}

				$data = $this->upload->data();

				$image = "cat_gallery".$data['file_name'];
		} else {
			$image= $gallery_category->image;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->update_gallery_category($id, array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_48"));
		redirect(site_url("backend/content/gallery_categories"));
	}
	
	
	
	//Album
	
	public function gallery_albums()
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery" => array("album" => 1))));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$gallery_albums = $this->content_model->get_gallery_albums();

		$this->template->loadContent("content/gallery_albums.php", array(
			"albums" => $gallery_albums
			)
		);
	}


	public function add_gallery_album()
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= "default.png";
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->add_gallery_album(array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_46"));
		redirect(site_url("backend/content/gallery_albums"));
	}

	public function delete_gallery_album($id, $hash)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		if($id == 1) {
			$this->template->error(lang("error_108"));
		}
		$gallery_album = $this->content_model->get_gallery_album($id);
		
		//echo "<pre>" ; print_r($gallery_album);die;
		if($gallery_album->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}
		
		$gallery_album = $gallery_album->row();
		if($slider->image != "default.png")unlink ($this->settings->info->upload_path_relative.$gallery_album->image);
		
		$this->content_model->delete_gallery_album($id);
		$this->content_model->update_gallery($id,array(
			"albumid" => '1'
			),"albumid");
				
		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("backend/content/gallery_albums"));
	}
	
	public function edit_gallery_album($id)
	{
		$this->template->loadData("activeLink",
			array("content" => array("gallery_albums" => 1)));
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>'
		);
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$gallery_album = $this->content_model->get_gallery_album($id);
		if($gallery_album->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$gallery_album = $gallery_album->row();
		$this->template->loadContent("content/edit_gallery_album.php", array(
			"album" => $gallery_album
			)
		);
	}
	
	
	public function edit_gallery_album_pro($id)
	{
		if(!$this->common->has_permissions(array(
			"admin", "content_manager"), $this->user)) {
			$this->template->error(lang("error_81"));
		}
		$id = intval($id);
		$gallery_album = $this->content_model->get_gallery_album($id);
		if($gallery_album->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$gallery_album = $gallery_album->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->lib_filter->go($this->input->post("desc"));

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array(
					 "upload_path" => $this->settings->info->upload_path."/album/",
					 "overwrite" => FALSE,
					 "max_filename" => 300,
					 "encrypt_name" => TRUE,
					 "remove_spaces" => TRUE,
					 "allowed_types" => "png|gif|jpeg|jpg",
					 "max_size" => $this->settings->info->file_size,
				));

				if (!$this->upload->do_upload()) {
					$this->template->error(lang("error_21")
					.$this->upload->display_errors());
				}

				$data = $this->upload->data();
				
				
				

				$image = "/album/".$data['file_name'];
		} else {
			$image= $gallery_album->image;
		}

		if(empty($name)) {
			$this->template->error(lang("error_88"));
		}

		$this->content_model->update_gallery_album($id, array(
			"name" => $name,
			"description" => $desc,
			"image" => $image
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_48"));
		redirect(site_url("backend/content/gallery_albums"));
	}
	
	


}

?>
