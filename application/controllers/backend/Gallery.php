<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("content_model");
		$this->load->model("user_model");

		//if (!$this->user->loggedin) $this->template->error(lang("error_1"));

	}

	public function index() 
	{
		$this->template->loadData("activeLink", 
			array("content" => array("galleries" => 1)));

		$this->template->loadContent("gallery/index.php", array(
			)
		);
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
				 	"content_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
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
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'" class="gallery-image">',
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'">'.$r->title.'</a>',
				'<a href="'.site_url("backend/gallery/view_album/" . $r->categoryid).'">'.$r->image."</a>",
				'<a href="'.site_url("backend/gallery/view_cat/" . $r->categoryid).'">'.$r->catname."</a>",
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_448").'"><span class="glyphicon glyphicon-list"></span></a>'
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
				 	"content_categories.name" => 0
				 ),
				 4 => array(
				 	"users.username" => 0
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
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'" class="gallery-image">',
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'">'.$r->title.'</a>',
				$r->summary,
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_448").'"><span class="glyphicon glyphicon-list"></span></a>'
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function view($id, $gallery_int =0) 
	{
		$this->template->loadExternal(
			'<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
			</script>
			'
		);
		$gallery_int = intval($gallery_int);
		$this->template->loadData("activeLink", 
			array("content" => array("galleries" => 1)));
		$id = intval($id);
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_90"));
		}

		$gallery = $gallery->row();
		if($gallery->loggedin) {
			if (!$this->user->loggedin) $this->template->error(lang("error_1"));
		}
		if(!empty($gallery->seo_title)) {
			$this->template->loadData("gallery_title", $gallery->seo_title);
		}

		if(!empty($gallery->seo_description)) {
			$this->template->loadData("gallery_desc", $gallery->seo_description);
		}

		if($gallery->loggedin) {
			// Check user roles
			$roles = $this->content_model->get_gallery_user_roles($id);
			// Check user has all roles
			$required = "<b>".lang("error_91")."</b>: ";
			$role_flag = false;;
			if($roles->num_rows() == 0) {
				$role_flag = true;
			} else {
				foreach($roles->result() as $r) {
					$required .= $r->name . ", ";
					if($r->ID == $this->user->info->user_role) {
						$role_flag = true;
					}
				}
			}

			$required .= "<br /><br /><b>".lang("error_92")."</b>: ";
			
		}

		$comments = array();
		if($gallery->comments && $this->settings->info->comments) {
			$comments = $this->content_model->get_gallery_comments($id, $gallery_int);

			$this->load->library('pagination');
			$config['base_url'] = site_url("backend/gallery/view/" . $id);
			$config['total_rows'] = $this->content_model
				->get_comment_count($id);
			$config['per_gallery'] = 10;
			$config['uri_segment'] = 4;

			include (APPPATH . "/config/gallery_config.php");
			$this->pagination->initialize($config); 

		
		}

		$this->template->loadContent("gallery/view.php", array(
			"page" => $gallery,
			"comments" => $comments
			)
		);
	}

	public function categories() 
	{
		$this->template->loadData("activeLink", 
			array("content" => array("gallery" => array("view" => 1))));

		$categories = $this->content_model->get_gallery_categories();

		$this->template->loadContent("gallery/cats.php", array(
			"categories" => $categories
			)
		);
	}

	public function view_cat($id) 
	{
		$this->template->loadData("activeLink", 
			array("content" => array("gallery" => array("view" => 1))));
		$id = intval($id);
		$category = $this->content_model->get_gallery_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$category = $category->row();

		$this->template->loadContent("gallery/view_cat.php", array(
			"category" => $category
			)
		);

	}	
	
	public function view_album($id) 
	{
		$this->template->loadData("activeLink", 
			array("content" => array("gallery" => array("viewalbum" => 1))));
		$id = intval($id);
		$category = $this->content_model->get_gallery_album($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_89"));
		}

		$category = $category->row();

		$this->template->loadContent("gallery/view_album.php", array(
			"category" => $category
			)
		);

	}

	public function cat_gallery($id) 
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
				 	"content_galleries.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_galleries_cat_count($id)
		);
		$galleries = $this->content_model->get_content_galleries_cat($id, $this->datatables);

		foreach($galleries->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'" class="gallery-image">',
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'">'.$r->title.'</a>',
				$r->summary,
				date($this->settings->info->date_format, $r->last_updated),
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp))
			);
		}
		echo json_encode($this->datatables->process());
	}
	
	//ALBUM
	
	public function albums() 
	{
		$this->template->loadData("activeLink", 
			array("content" => array("gallery" => array("viewalbum" => 1))));

		$albums = $this->content_model->get_albums();

		$this->template->loadContent("gallery/albums.php", array(
			"albums" => $albums
			)
		);
	}


	public function album_gallery($id) 
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
				 	"content_galleries.last_updated" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->content_model
				->get_total_galleries_cat_count($id)
		);
		$galleries = $this->content_model->get_content_galleries_albums($id, $this->datatables);

		foreach($galleries->result() as $r) {
			$this->datatables->data[] = array(
				'<img src="'.base_url().$this->settings->info->upload_path_relative."/".$r->image.'" class="gallery-image">',
				'<a href="'.site_url("backend/gallery/view/" . $r->ID).'">'.$r->title.'</a>',
				$r->summary,
				date($this->settings->info->date_format, $r->last_updated),
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp))
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function add_comment($id) 
	{
		if(!$this->settings->info->comments) {
			$this->template->error(lang("error_98"));
		}
		if (!$this->user->loggedin) $this->template->error(lang("error_1"));
		$id = intval($id);
		$gallery = $this->content_model->get_content_gallery($id);
		if($gallery->num_rows() == 0) {
			$this->template->error(lang("error_90"));
		}

		$gallery = $gallery->row();
		if(!empty($gallery->seo_title)) {
			$this->template->loadData("gallery_title", $gallery->seo_title);
		}

		if(!empty($gallery->seo_description)) {
			$this->template->loadData("gallery_desc", $gallery->seo_description);
		}

		// Check user roles
		$roles = $this->content_model->get_gallery_user_roles($id);
		// Check user has all roles
		$required = "<b>".lang("error_91")."</b>: ";
		$role_flag = false;;
		if($roles->num_rows() == 0) {
			$role_flag = true;
		} else {
			foreach($roles->result() as $r) {
				$required .= $r->name . ", ";
				if($r->ID == $this->user->info->user_role) {
					$role_flag = true;
				}
			}
		}

		$required .= "<br /><br /><b>".lang("error_92")."</b>: ";
		// Check user group
		$group_flag = false;
		$groups = $this->content_model->get_gallery_user_groups($id);
		$user_groups = $this->user_model->get_user_groups($this->user->info->ID);
		if($groups->num_rows() == 0) {
			$group_flag = true;
		} else {
			foreach($groups->result() as $r) {
				$required .= $r->name . ", ";
				foreach($user_groups->result() as $rr) {
					if($r->groupid == $rr->groupid) {
						$group_flag = true;
					}
				}
			}
		}

		// Check premium Plans
		$required .= "<br /><br /><b>".lang("error_93")."</b>: ";
		$plans_flag = false;
		$plans = $this->content_model->get_gallery_user_plans($id);
		if($plans->num_rows() == 0) {
			$plans_flag = true;
		} else {
			foreach($plans->result() as $r) {
				$required .= $r->name . ", ";
				if($r->planid == $this->user->info->premium_planid) {
					$plans_flag = true;
				}
			}
		}

		if($gallery->type) {
			if(!$role_flag) {
				$this->template->error(lang("error_94") . " <br /><br />" . $required);
			}
			if(!$group_flag) {
				$this->template->error(lang("error_95") . " <br /><br />" . $required);
			}
			if(!$plans_flag) {
				$this->template->error(lang("error_96") . " <br /><br />" . $required);
			}
		} else {
			if(!$role_flag && !$group_flag && !$plans_flag) {
				$this->template->error(lang("error_97") . " <br /><br />" . $required);
			}
		}

		if(!$gallery->comments) {
			$this->template->error(lang("error_98"));
		}

		$message = $this->lib_filter->go($this->input->post("message"));
		if(empty($message)) {
			$this->template->error(lang("error_99"));
		}

		$this->content_model->add_comment(array(
			"userid" => $this->user->info->ID,
			"comment" => $message,
			"galleryid" => $id,
			"timestamp" => time()
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_49"));
		redirect(site_url("backend/gallery/view/" . $id));
			
	}

	public function delete_comment($id, $hash) {
		if (!$this->user->loggedin) $this->template->error(lang("error_1"));
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$comment = $this->content_model->get_comment($id);
		if($comment->num_rows() == 0) {
			$this->template->error(lang("error_100"));
		}
		$comment = $comment->row();
		if($comment->userid != $this->user->info->ID) {
			if(!$this->common->has_permissions(array(
				"admin", "content_manager"), $this->user)) {
					$this->template->error(lang("error_101"));
			}
		}

		$this->content_model->delete_comment($id);
		$this->session->set_flashdata("globalmsg", lang("success_50"));
		redirect(site_url("backend/gallery/view/" . $comment->galleryid));
	}

}

?>