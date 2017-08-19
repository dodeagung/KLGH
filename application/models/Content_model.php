<?php

class Content_Model extends CI_Model
{

	public function get_categories()
	{
		return $this->db->get("content_categories");
	}

	public function get_category($id)
	{
		return $this->db->where("ID", $id)->get("content_categories");
	}

	public function delete_category($id)
	{
		$this->db->where("ID", $id)->delete("content_categories");
	}

	public function add_category($data)
	{
		$this->db->insert("content_categories", $data);
	}

	public function update_category($id, $data)
	{
		$this->db->where("ID", $id)->update("content_categories", $data);
	}

//post category

	public function get_post_categories()
	{
		return $this->db->get("content_post_categories");
	}

	public function get_post_category($id)
	{
		return $this->db->where("ID", $id)->get("content_post_categories");
	}

	public function delete_post_category($id)
	{
		$this->db->where("ID", $id)->delete("content_post_categories");
	}

	public function add_post_category($data)
	{
		$this->db->insert("content_post_categories", $data);
	}

	public function update_post_category($id, $data)
	{
		$this->db->where("ID", $id)->update("content_post_categories", $data);
	}

//gallery category

	public function get_gallery_categories()
	{
		return $this->db->get("content_gallery_categories");
	}

	public function get_gallery_category($id)
	{
		return $this->db->where("ID", $id)->get("content_gallery_categories");
	}

	public function delete_gallery_category($id)
	{
		$this->db->where("ID", $id)->delete("content_gallery_categories");
	}

	public function add_gallery_category($data)
	{
		$this->db->insert("content_gallery_categories", $data);
	}

	public function update_gallery_category($id, $data)
	{
		$this->db->where("ID", $id)->update("content_gallery_categories", $data);
	}
	
//album

	public function get_content_galleries_albums($id, $datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_galleries.title",
			"content_galleries.summary",
			"content_gallery_albums.name"
			)
		);

		return $this->db
			->where("content_galleries.albumid", $id)
			->select("content_galleries.title, content_galleries.image,
				content_galleries.last_updated, content_galleries.userid,
				content_galleries.summary, content_galleries.albumid,
				content_galleries.comments, content_galleries.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_gallery_albums.name as catname")
			->join("users", "users.ID = content_galleries.userid")
			->join("content_gallery_albums", "content_gallery_albums.ID = content_galleries.albumid")
			->limit($datatable->length, $datatable->start)
			->get("content_galleries");
	}

	public function get_albums()
	{
		return $this->db->get("content_gallery_albums");
	}

	public function get_album($id)
	{
		return $this->db->where("ID", $id)->get("content_gallery_albums");
	}

	public function delete_album($id)
	{
		$this->db->where("ID", $id)->delete("content_gallery_albums");
	}

	public function add_album($data)
	{
		$this->db->insert("content_gallery_albums", $data);
	}

	public function update_album($id, $data)
	{
		$this->db->where("ID", $id)->update("content_gallery_albums", $data);
	}

public function get_gallery_albums()
	{
		return $this->db->get("content_gallery_albums");
	}

	public function get_gallery_album($id)
	{
		return $this->db->where("ID", $id)->get("content_gallery_albums");
	}

	public function delete_gallery_album($id)
	{
		$this->db->where("ID", $id)->delete("content_gallery_albums");
	}

	public function add_gallery_album($data)
	{
		$this->db->insert("content_gallery_albums", $data);
	}

	public function update_gallery_album($id, $data)
	{
		$this->db->where("ID", $id)->update("content_gallery_albums", $data);
	}
	
	
	
	

//start House property details
	public function get_house_sliders($id=null)
	{
		if (isset($id)){
			return $this->db->where("ID", $id)->get("house_slider");
		}
		return $this->db->get("house_slider");
	}

	
	public function delete_house_slider($id)
	{
		$this->db->where("ID", $id)->delete("house_slider");
	}

	public function add_house_slider($data)
	{
		$this->db->insert("house_slider", $data);
	}

	public function update_house_sliders($id, $data)
	{
		$this->db->where("ID", $id)->update("house_slider", $data);
	}	

	public function get_house_facility($id)
	{
		return $this->db->select("site_facility.*")
			->where('site_rooms.id',$id)
			->join("site_room_facility", "site_room_facility.idroom = site_rooms.id")	
			->join("site_facility", "site_room_facility.idfacility = site_facility.id")
			->order_by("site_facility.name", "ASC")
			->get("site_rooms");
		
	}

//end House property details

//start slider
	public function get_sliders()
	{
		return $this->db->get("content_slider");
	}

	public function get_slider($id)
	{
		return $this->db->where("ID", $id)->get("content_slider");
	}

	public function delete_slider($id)
	{
		$this->db->where("ID", $id)->delete("content_slider");
	}

	public function add_slider($data)
	{
		$this->db->insert("content_slider", $data);
	}

	public function update_slider($id, $data)
	{
		$this->db->where("ID", $id)->update("content_slider", $data);
	}
//end slider
	public function add_page($data)
	{
		$this->db->insert("content_pages", $data);
		return $this->db->insert_id();
	}	
	
	
	public function add_post($data)
	{
		$this->db->insert("content_posts", $data);
		return $this->db->insert_id();
	}	
	
	public function add_gallery($data)
	{
		$this->db->insert("content_galleries", $data);
		return $this->db->insert_id();
	}

	public function add_page_roles($data)
	{
		$this->db->insert("content_page_roles", $data);
	}

	public function add_page_groups($data)
	{
		$this->db->insert("content_page_groups", $data);
	}

	public function add_page_plans($data)
	{
		$this->db->insert("content_page_plans", $data);
	}

	public function get_total_pages_cat_count($id)
	{
		$s = $this->db->where("categoryid", $id)
			->select("COUNT(*) as num")->get("content_pages");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_total_images_front_count($id)
	{
		$s = $this->db->where("image_front", true)
			->select("COUNT(*) as num")->get("content_galleries");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	public function get_images($limit,$offset)
	{
		return $this->db->select("			
				content_gallery_albums.name galname,
				content_gallery_albums.description galdesc,
				content_gallery_categories.name catname,
				content_gallery_categories.description catdesc,
				content_galleries.ID ID,
				content_galleries.image image,
				content_galleries.ext_image,
				content_galleries.timestamp timestamp,
				content_galleries.title title,
				content_galleries.summary summary")
			->join("content_gallery_categories", "content_galleries.categoryid = content_gallery_categories.ID")
			->join("content_gallery_albums", "content_galleries.albumid = content_gallery_albums.ID")
			->limit($limit, $offset)
			->order_by("content_galleries.timestamp", "DESC")
			->get("content_galleries");
					
	}	
	
	public function get_images_front($limit,$isdefined=true)
	{
		if($isdefined){
			$q = $q = $this->db->select("			
					content_gallery_albums.name galname,
					content_gallery_albums.description galdesc,
					content_gallery_categories.name catname,
					content_gallery_categories.description catdesc,
					content_galleries.image image,content_galleries.ext_image,
					content_galleries.title title,
					content_galleries.timestamp timestamp,
					content_galleries.summary summary")
					->where("image_front", $isdefined);
		}else{
			$q = $this->db->select("			
				content_gallery_albums.name galname,
				content_gallery_albums.description galdesc,
				content_gallery_categories.name catname,
				content_gallery_categories.description catdesc,
				content_galleries.image image,content_galleries.ext_image,
				content_galleries.title title,
				content_galleries.timestamp timestamp,
				content_galleries.summary summary");
			}
		
		return $q->join("content_gallery_categories", "content_galleries.categoryid = content_gallery_categories.ID")
			->join("content_gallery_albums", "content_galleries.albumid = content_gallery_albums.ID")
			->limit($limit, 0)
			->order_by("content_galleries.timestamp", "DESC")
			->get("content_galleries");
					
	}	


	
	public function get_distinc_cat_images_front($limit)
	{
		return $this->db->where("image_front", true)
			->join("content_gallery_categories", "content_galleries.categoryid = content_gallery_categories.ID")
			->join("content_gallery_albums", "content_galleries.albumid = content_gallery_albums.ID")
			->limit($limit, 0)
			->distinct("content_gallery_categories.name")
			->select("
				content_gallery_categories.name catname,
			
			")->group_by("content_gallery_categories.name")
			->get("content_galleries");
			//return $this->db->get("content_slider");
		//echo $this->db->last_query();die;	
		
	}	
	
	public function get_total_posts_cat_count($id)
	{
		$s = $this->db->where("categoryid", $id)
			->select("COUNT(*) as num")->get("content_posts");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}	
	
	public function get_total_galleries_cat_count($id)
	{
		$s = $this->db->where("categoryid", $id)
			->select("COUNT(*) as num")->get("content_galleries");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_page_user_roles($id)
	{
		return $this->db
			->select("user_roles.ID, user_roles.name, user_roles.admin,
				user_roles.admin_members, user_roles.admin_settings,
				user_roles.admin_payment, user_roles.banned,
				user_roles.content_manager,
				user_roles.content_worker")
			->where("content_page_roles.pageid", $id)
			->join("user_roles", "user_roles.ID = content_page_roles.roleid")
			->get("content_page_roles");
	}

	public function get_page_user_groups($id)
	{
		return $this->db
			->select("content_page_groups.ID, content_page_groups.groupid,
				content_page_groups.pageid,
				user_groups.name")
			->where("content_page_groups.pageid", $id)
			->join("user_groups", "user_groups.ID = content_page_groups.groupid")
			->get("content_page_groups");
	}

	public function get_page_user_plans($id)
	{
		return $this->db
			->select("content_page_plans.ID, content_page_plans.pageid,
				content_page_plans.planid,
				payment_plans.name")
			->where("content_page_plans.pageid", $id)
			->join("payment_plans", "payment_plans.ID = content_page_plans.planid")
			->get("content_page_plans");
	}

	public function get_content_pages_cat($id, $datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_pages.title",
			"content_pages.summary",
			"content_categories.name"
			)
		);

		return $this->db
			->where("content_pages.categoryid", $id)
			->select("content_pages.title, content_pages.image,
				content_pages.last_updated, content_pages.userid,
				content_pages.summary, content_pages.categoryid,
				content_pages.comments, content_pages.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_categories.name as catname")
			->join("users", "users.ID = content_pages.userid")
			->join("content_categories", "content_categories.ID = content_pages.categoryid")
			->limit($datatable->length, $datatable->start)
			->get("content_pages");
	}	
	
	public function get_content_posts_cat($id, $datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_posts.title",
			"content_posts.summary",
			"content_post_categories.name"
			)
		);

		return $this->db
			->where("content_posts.categoryid", $id)
			->select("content_posts.title, content_posts.image,content_posts.ext_image,
				content_posts.last_updated, content_posts.userid,
				content_posts.summary, content_posts.categoryid,
				content_posts.comments, content_posts.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_categories.name as catname")
			->join("users", "users.ID = content_posts.userid")
			->join("content_post_categories", "content_post_categories.ID = content_posts.categoryid")
			->limit($datatable->length, $datatable->start)
			->get("content_posts");
	}	
	
	public function get_content_galleries_cat($id, $datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_galleries.title",
			"content_galleries.summary",
			"content_gallery_categories.name"
			)
		);

		return $this->db
			->where("content_galleries.categoryid", $id)
			->select("content_galleries.title, content_galleries.image,
				content_galleries.last_updated, content_galleries.userid,
				content_galleries.summary, content_galleries.categoryid,
				content_galleries.comments, content_galleries.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_gallery_categories.name as catname,
				content_gallery_albums.name as albumname")
			->join("users", "users.ID = content_galleries.userid")
			->join("content_gallery_categories", "content_gallery_categories.ID = content_galleries.categoryid")
			->join("content_gallery_albums", "content_gallery_albums.ID = content_galleries.albumid")
			->limit($datatable->length, $datatable->start)
			->get("content_galleries");
	}

	public function get_total_pages_count()
	{
		$s = $this->db->select("COUNT(*) as num")->get("content_pages");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_content_pages($datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_pages.title",
			"content_pages.summary",
			"content_categories.name"
			)
		);

		return $this->db
			->select("content_pages.title, content_pages.image,
				content_pages.last_updated, content_pages.userid,
				content_pages.summary, content_pages.categoryid,
				content_pages.comments, content_pages.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_categories.name as catname")
			->join("users", "users.ID = content_pages.userid")
			->join("content_categories", "content_categories.ID = content_pages.categoryid")
			->limit($datatable->length, $datatable->start)
			->get("content_pages");
	}

	public function get_content_page($id)
	{
		return $this->db
			->where("content_pages.ID", $id)
			->select("content_pages.title, content_pages.image,
				content_pages.last_updated, content_pages.userid,
				content_pages.summary, content_pages.categoryid,
				content_pages.loggedin,
				content_pages.comments, content_pages.ID, content_pages.content,
				content_pages.type, content_pages.seo_title,
				content_pages.seo_description,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_categories.name as catname")
			->join("users", "users.ID = content_pages.userid")
			->join("content_categories", "content_categories.ID = content_pages.categoryid")
			->get("content_pages");
	}

	public function delete_page($id)
	{
		$this->db->where("ID", $id)->delete("content_pages");
	}

	public function get_total_posts_count()
	{
		$s = $this->db->select("COUNT(*) as num")->get("content_posts");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_content_posts($datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_posts.title",
			"content_posts.summary",
			"content_post_categories.name"
			)
		);

		return $this->db
			->select("content_posts.title, content_posts.image,content_posts.ext_image,
				content_posts.last_updated, content_posts.userid,
				content_posts.summary, content_posts.categoryid,
				content_posts.comments, content_posts.ID,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_categories.name as catname")
			->join("users", "users.ID = content_posts.userid")
			->join("content_post_categories", "content_post_categories.ID = content_posts.categoryid")
			->limit($datatable->length, $datatable->start)
			->get("content_posts");
	}
	//consider to delete this one
	public function get_posts($string = null)
	{
		
		return $this->db->like("content_post_categories.name",$string,'both')
		->join("content_post_categories", "content_posts.categoryid = content_post_categories.ID")->select("
				content_posts.id id,
				content_posts.title title,
				content_posts.summary summary,
				content_posts.timestamp timestamp,
				content_posts.image image, content_posts.ext_image,
				content_posts.seo_title keyword,
				content_post_categories.name category,
			
			")->get("content_posts");
			
	}	
	
	public function get_post_pagination($limit, $start, $search="",$categories=null)
	{
		if ($search == "NIL") $search = "";

		$stmt= $this->db
			->select("content_posts.title, content_posts.image,content_posts.timestamp,
				content_posts.last_updated, content_posts.userid,
				content_posts.summary, content_posts.categoryid idCategory,
				content_posts.loggedin,
				content_posts.comments, content_posts.ID, content_posts.content,
				content_posts.seo_title,
				content_posts.seo_description,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_categories.name as catname")
			->join("users", "users.ID = content_posts.userid") 
			->join("content_post_categories", "content_post_categories.ID = content_posts.categoryid");
			if(isset($categories)){
				$stmt = $stmt
					->where("content_post_categories.ID", $categories);
			}elseif($search != ""){
				$stmt = $stmt
				->group_start() //gunakan ini untuk grouping query (LIKE)
				->like('content_posts.content',$search)
				->or_like('content_posts.title',$search)
				->group_end();
			}	
			$stmt = $stmt
				->limit($limit, $start)
				->order_by("content_posts.timestamp", "DESC")
				->get("content_posts")->result();
			
			return $stmt;
		}
	
public function get_total_post_count($search = "",$categories=null)
	{
		$stmt= $this->db
			->select("COUNT(*) as num")
			->join("users", "users.ID = content_posts.userid")
			->join("content_post_categories", "content_posts.categoryid = content_post_categories.ID");
		if(isset($categories)){
			$stmt = $stmt
				->where("content_post_categories.ID", $categories);
		}elseif($search != ""){
			$stmt = $stmt
			->group_start() //gunakan ini untuk grouping query (LIKE)
			->like('content_posts.content',$search)
			->or_like('content_posts.title',$search)
			->group_end();
		}	
		$stmt = $stmt
			  ->get("content_posts");
		$r = $stmt->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	public function get_post_front($limit,$categories=null)
	{
		
		$stmt =  $this->db->select("
				content_posts.id id,
				content_posts.title title,
				content_posts.summary summary,
				content_posts.content content,
				content_posts.timestamp timestamp,
				content_posts.image image,
				content_posts.ext_image,
				content_posts.seo_title keyword,
				content_post_categories.name catname,
			")	
		->join("content_post_categories", "content_posts.categoryid = content_post_categories.ID");
		if(isset($categories)){
			$stmt = $stmt
				->where("content_post_categories.ID", $categories);
		}	
		
		return $stmt
			->limit($limit, 0)
			->get("content_posts");
			
	}
	
	public function get_content_post($id)
	{
		return $this->db
			->where("content_posts.ID", $id)
			->select("content_posts.title, content_posts.image,content_posts.ext_image,
				content_posts.last_updated, content_posts.userid,
				content_posts.summary, content_posts.categoryid idCategory,
				content_posts.loggedin,content_posts.timestamp,
				content_posts.comments, content_posts.ID, content_posts.content,
				content_posts.seo_title,
				content_posts.seo_description,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_categories.name as catname")
			->join("users", "users.ID = content_posts.userid")
			->join("content_post_categories", "content_post_categories.ID = content_posts.categoryid")
			->get("content_posts");
	}	
	
	public function get_content_postbyCategories($idCategories,$idexcept)
	{
		return $this->db
			->where("content_post_categories.ID", $idCategories)
			->where_not_in("content_posts.ID", $idexcept)
			->select("content_posts.title, 
				content_posts.image,content_posts.ext_image,
				content_posts.last_updated, content_posts.userid,
				content_posts.summary, content_posts.categoryid,
				content_posts.timestamp timestamp,
				content_posts.loggedin,
				content_posts.comments, content_posts.ID id, content_posts.content,
				content_posts.seo_title,
				content_posts.seo_description,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_categories.name as catname")
			->join("users", "users.ID = content_posts.userid")
			->join("content_post_categories", "content_post_categories.ID = content_posts.categoryid")
			->get("content_posts");
	}

	public function delete_post($id)
	{
		$this->db->where("ID", $id)->delete("content_posts");
	}
	
	public function get_total_galleries_count()
	{
		$s = $this->db->select("COUNT(*) as num")->get("content_galleries");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_content_galleries($datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			"users.username",
			"content_galleries.title",
			"content_galleries.summary",
			"content_gallery_categories.name"
			)
		);

		return $this->db
			->select("content_galleries.title, content_galleries.image,content_galleries.ext_image,
				content_galleries.last_updated, content_galleries.userid,
				content_galleries.summary, content_galleries.categoryid,
				content_galleries.comments, content_galleries.ID,
				content_galleries.image_front,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_gallery_albums.name as albumname,
				content_gallery_categories.name as catname")
			->join("users", "users.ID = content_galleries.userid")
			->join("content_gallery_categories", "content_gallery_categories.ID = content_galleries.categoryid")
			->join("content_gallery_albums", "content_gallery_albums.ID = content_galleries.albumid")
			->limit($datatable->length, $datatable->start)
			->get("content_galleries");
	}

	public function get_content_gallery($id)
	{
		return $this->db
			->where("content_galleries.ID", $id)
			->select("content_galleries.title, content_galleries.image,content_galleries.ext_image,
				content_galleries.last_updated, content_galleries.userid,
				content_galleries.summary, content_galleries.categoryid,
				content_galleries.albumid,
				content_galleries.loggedin,
				content_galleries.comments, content_galleries.ID,content_galleries.timestamp, 
				content_galleries.type, content_galleries.seo_title,
				content_galleries.seo_description,
				users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_gallery_categories.name as catname")
			->join("users", "users.ID = content_galleries.userid")
			->join("content_gallery_categories", "content_gallery_categories.ID = content_galleries.categoryid")
			->get("content_galleries");
	}

	public function delete_gallery($id)
	{
		$this->db->where("ID", $id)->delete("content_galleries");
	}
	
	public function get_page_roles($pageid)
	{
		return $this->db
			->select("user_roles.ID, user_roles.name, content_page_roles.ID as cid")
			->join("content_page_roles", "content_page_roles.roleid = user_roles.ID AND content_page_roles.pageid = " . $pageid, "left outer")
			->get("user_roles");
	}

	public function get_page_groups($pageid)
	{
		return $this->db
			->select("user_groups.ID, user_groups.name, content_page_groups.ID as cid")
			->join("content_page_groups", "content_page_groups.groupid = user_groups.ID AND content_page_groups.pageid = " . $pageid, "left outer")
			->get("user_groups");
	}

	public function get_page_plans($pageid)
	{
		return $this->db
			->select("payment_plans.ID, payment_plans.name, content_page_plans.ID as cid")
			->join("content_page_plans", "content_page_plans.planid = payment_plans.ID AND content_page_plans.pageid = " . $pageid, "left outer")
			->get("payment_plans");
	}

	public function delete_page_roles($id)
	{
		$this->db->where("pageid", $id)->delete("content_page_roles");
	}

	public function delete_page_groups($id)
	{
		$this->db->where("pageid", $id)->delete("content_page_groups");
	}

	public function delete_page_plans($id)
	{
		$this->db->where("pageid", $id)->delete("content_page_plans");
	}

	public function update_page($id, $data)
	{
		$this->db->where("ID", $id)->update("content_pages", $data);
	}

	public function get_page_comments($id, $page)
	{
		return $this->db
			->select("users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_page_comments.ID, content_page_comments.comment,
				content_page_comments.timestamp")
			->where("content_page_comments.pageid", $id)
			->join("users", "users.ID = content_page_comments.userid")
			->order_by("content_page_comments.ID", "DESC")
			->limit(10, $page)
			->get("content_page_comments");
	}

	public function get_comment_count($id)
	{
		$s = $this->db
			->where("pageid", $id)
			->select("COUNT(*) as num")
			->get("content_page_comments");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function add_comment($data)
	{
		$this->db->insert("content_page_comments", $data);
	}

	public function get_comment($id)
	{
		return $this->db->where("ID", $id)->get("content_page_comments");
	}

	public function delete_comment($id)
	{
		$this->db->where("ID", $id)->delete("content_page_comments");
	}
	
	public function update_post($id, $data)
	{
		$this->db->where("ID", $id)->update("content_posts", $data);
	}

	
	
	public function get_post_comments($id, $post)
	{
		return $this->db
			->select("users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_post_comments.ID, content_post_comments.comment,
				content_post_comments.timestamp")
			->where("content_post_comments.postid", $id)
			->join("users", "users.ID = content_post_comments.userid")
			->order_by("content_post_comments.ID", "DESC")
			->limit(10, $post)
			->get("content_post_comments");
	}

	public function get_post_comment_count($id)
	{
		$s = $this->db
			->where("postid", $id)
			->select("COUNT(*) as num")
			->get("content_post_comments");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
		public function formatInsertDataComment($data)
	{
		$retData = array
		(
			"postid"=>(isset($data["postid"]))?$data["postid"]:'',
			"parentid"=>(isset($data["parentid"]))?$data["parentid"]:'',
			"comment_name"=>(isset($data["name"]))?$data["name"]:'',
			"comment_email"=>(isset($data["email"]))?$data["email"]:'',
			"comment_body"=>(isset($data["message"]))?$data["message"]:'',
			"timestamp" => time(),
		);

		return $retData;	
	} 
	public function add_post_comment($data)
	{
		$this->db->insert("content_post_comments", $data);
	}

	public function get_post_comment($id)
	{
		return $this->db
			->select("users.ID as userid, users.username as username, users.avatar as avatar,
				users.online_timestamp,
				content_post_comments.ID, content_post_comments.comment_body as comment,
				content_post_comments.timestamp as timestamp")
			->where("content_post_comments.postid", $id)
			->join("users", "users.ID = content_post_comments.userid")
			->order_by("content_post_comments.timestamp", "DESC")
			->get("content_post_comments");
	}
	
	public function get_post_comment_byparent($idpost,$parentid=null) 
	{
		$q = $this->db
			->select("users.ID as userid, users.username as username,
				users.online_timestamp,
				content_post_comments.ID comment_id,content_post_comments.parentid, content_post_comments.avatar avatar, content_post_comments.comment_body as comment_body,
				content_post_comments.comment_name as comment_name,
				content_post_comments.timestamp as timestamp")
			->where("content_post_comments.postid", $idpost);
			if (isset($parentid)){
				$q = $q->where("content_post_comments.parentid", $parentid);
			}
			return $q->join("users", "users.ID = content_post_comments.userid")
			->order_by("content_post_comments.timestamp", "DESC")
			->get("content_post_comments");
	}

	
	public function update_post_comment_byIdPost($idpost,$data)
	{
		$this->db->where("postid", $idpost)->update("content_post_comments",$data);
	}	
	
	public function delete_post_comment($id)
	{
		$this->db->where("ID", $id)->delete("content_post_comments");
	}
	
	public function update_gallery($id, $data, $column = null)
	{
		if ($column == null){
			$column = "ID";
		}
		$this->db->where($column, $id)->update("content_galleries", $data);
	}

	public function get_gallery_comments($id, $gallery)
	{
		return $this->db
			->select("users.ID as userid, users.username, users.avatar,
				users.online_timestamp,
				content_gallery_comments.ID, content_gallery_comments.comment,
				content_gallery_comments.timestamp")
			->where("content_gallery_comments.galleryid", $id)
			->join("users", "users.ID = content_gallery_comments.userid")
			->order_by("content_gallery_comments.ID", "DESC")
			->limit(10, $gallery)
			->get("content_gallery_comments");
	}

	public function get_gallery_comment_count($id)
	{
		$s = $this->db
			->where("galleryid", $id)
			->select("COUNT(*) as num")
			->get("content_gallery_comments");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	
	public function add_gallery_comment($data)
	{
		$this->db->insert("content_gallery_comments", $data);
	}

	public function get_gallery_comment($id)
	{
		return $this->db->where("ID", $id)->get("content_gallery_comments");
	}

	public function delete_gallery_comment($id)
	{
		$this->db->where("ID", $id)->delete("content_gallery_comments");
	}
	
	

}

?>
