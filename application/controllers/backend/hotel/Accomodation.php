<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accomodation extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("hotel/room_m");
        $this->load->model("hotel/facility_m");
        $this->load->model("hotel/room_unavailable_m");
        $this->load->model("user_model");
        if (!$this->user->loggedin)
            $this->template->error(lang("error_1"));
        if (!$this->common->has_permissions(array(
            "admin",
            "content_manager",
            "content_worker"
        ), $this->user)) {
            $this->template->error(lang("error_81"));
        }
    }
    
    
    public function index()
    {
        
        $this->template->loadData("activeLink", array(
            "content" => array(
                "general" => 1
            )
        ));
        $this->setting();
        
    }
    
    public function room()
    {
        $this->template->loadData("activeLink", array(
            "accomodation" => array(
                "room" => 1
            )
        ));
        
        $this->template->loadContent("Accomodation/rooms.php", array());
        
    }
    
    public function room_plan()
    {
        $this->template->loadData("activeLink", array(
            "accomodation" => array(
                "room" => 1
            )
        ));
        
        //===================
        $this->template->loadExternalCSS(array(
            'accomodation/css/cssAccomodation'
        ));
        
        $this->template->loadExternalJs(array(
            'accomodation/js/jsAccomodation'
        ));
        
        $roomDomainArray = $this->room_m->getAllRoom();
        $currentDate = "'".(str_pad(((int)date('m') - 1 == -1 ? 11 : (int)date('m') - 1) , 2, '0', STR_PAD_LEFT) .'-'.date('Y'))."'";
        
       // echo "<pre>"; print_r( $currentDate );die; //test
        $this->template->loadContent("Accomodation/room_plan.php", array(
            'roomDomainArray' => $roomDomainArray,
            'currentDateval' => $currentDate
        ));
        
    }
    
    
    
    
    
    public function room_list()
    {
        $this->load->library("datatables");
        
        $this->datatables->set_default_order("site_rooms.updated", "desc");
        
        // Set post ordering options that can be used
        $this->datatables->ordering(array(
            1 => array(
                "site_rooms.name" => 0
            ),
            2 => array(
                "site_rooms.status" => 0
            )
        ));
        
        $this->datatables->set_total_rows($this->room_m->get_total_posts_count());
        $rooms = $this->room_m->get_content_rooms($this->datatables);
        //print_r($this->db->last_query());die;
        foreach ($rooms->result() as $r) {
            $this->datatables->data[] = array(
                '<img src="' . base_url() . $this->settings->info->upload_path_relative . "/" . $r->image . '.' . $r->ext_image . '" class="post-image" width = "100px">',
                $r->name,
                $r->type,
                $r->status,
                '<a href="' . site_url("backend/hotel/accomodation/edit_room/" . $r->id) . '" class="btn btn-warning btn-xs" title="' . lang("ctn_55") . '" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="' . site_url("backend/hotel/accomodation/delete_room/" . $r->id . "/" . $this->security->get_csrf_hash()) . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . lang("ctn_317") . '\')" title="' . lang("ctn_57") . '" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>'
            );
        }
        echo json_encode($this->datatables->process());
    }
    
    public function add_room()
    {
        $this->load->model("funds_model");
        $this->template->loadExternal('<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
            </script><link href="' . base_url() . 'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="' . base_url() . 'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'theme_backend/scripts/custom/jsPost.js"></script>');
        $this->template->loadData("activeLink", array(
            "content" => array(
                "post" => 1
            )
        ));
        
        $post_categories = $this->content_model->get_post_categories();
        $user_roles      = $this->user_model->get_user_roles();
        $groups          = $this->user_model->get_user_groups_all();
        $premium_plans   = $this->funds_model->get_plans();
        $this->template->loadContent("content/add_post.php", array(
            "categories" => $post_categories,
            "user_roles" => $user_roles,
            "premium_plans" => $premium_plans,
            "groups" => $groups
        ));
    }
    
    public function add_room_pro()
    {
        $this->load->model("site_slugs_m");
        $this->load->model("funds_model");
        $title           = $this->common->nohtml($this->input->post("title"));
        $summary         = $this->common->nohtml($this->input->post("summary"));
        $date_post       = $this->common->nohtml($this->input->post("date_post"));
        $content         = $this->lib_filter->go($this->input->post("content"));
        $post_categoryid = intval($this->input->post("categoryid"));
        $comments        = intval($this->input->post("comments"));
        $loggedin        = intval($this->input->post("loggedin"));
        
        $summary = $this->common->limitString($summary, 150);
        
        if (!$this->common->validateDate($date_post)) {
            $this->template->error(lang("error_109"));
        }
        
        if (empty($title)) {
            $this->template->error(lang("error_83"));
        }
        
        // Get post_category
        $post_category = $this->content_model->get_post_category($post_categoryid);
        if ($post_category->num_rows() == 0) {
            $this->template->error(lang("error_84"));
        }
        
        if ($this->input->post("seo_title") == "") {
            $seo_title = $this->common->nohtml($this->input->post("title"));
        } else {
            $seo_title = $this->common->nohtml($this->input->post("seo_title"));
        }
        
        if ($this->input->post("seo_description") == "") {
            $seo_desc = $this->common->nohtml($this->input->post("title"));
        } else {
            $seo_desc = $this->common->nohtml($this->input->post("seo_description"));
        }
        
        // Upload image
        $this->load->library("upload");
        
        if ($_FILES['userfile']['size'] > 0) {
            $this->upload->initialize(array(
                "upload_path" => $this->settings->info->upload_path . "/post/",
                "overwrite" => FALSE,
                "max_filename" => 300,
                "encrypt_name" => TRUE,
                "remove_spaces" => TRUE,
                "allowed_types" => "png|gif|jpeg|jpg",
                "max_size" => $this->settings->info->file_size
            ));
            
            if (!$this->upload->do_upload()) {
                $this->template->error(lang("error_21") . $this->upload->display_errors());
            }
            
            $data = $this->upload->data();
            $this->common->resizecropImageCI($data, 600, 600);
            $this->common->resizecropImageCI($data, 100, 67);
            $this->common->resizecropImageCI($data, 300, 201);
            $this->common->resizecropImageCI($data, 755, 331);
            $namafile = explode(".", $data['file_name']);
            
            $image    = "/post/" . $data['file_name'];
            $namafile = explode(".", $image);
            $image    = $namafile[0];
        } else {
            $image    = "default.png";
            $namafile = explode(".", $image);
            $image    = $namafile[0];
        }
        
        
        
        // Add post
        $data_post = array(
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
        $postid    = $this->content_model->add_post($data_post);
        
        // Add slug
        $controller = 'post/withid/' . $postid;
        $slug       = ($this->common->issulgable($this->common->nohtml($this->input->post("slug")))) ? $this->common->nohtml($this->input->post("slug")) : $controller;
        $this->site_slugs_m->create(array(
            'controller' => $controller,
            'slug' => $slug,
            'keywords' => $this->common->nohtml($this->input->post("slug"))
        ));
        
        $this->session->set_flashdata("globalmsg", lang("success_45"));
        redirect(site_url("backend/content/post"));
    }
    
    
    public function edit_room($id)
    {
        $id   = intval($id);
        $room = $this->room_m->get_content_room($id);
        if ($room->num_rows() == 0) {
            $this->template->error(lang("error_82"));
        }
        $room = $room->row();
        
        $this->template->loadExternal('<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js">
            </script><link href="' . base_url() . 'theme_backend/scripts/libraries/chosen/chosen.min.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="' . base_url() . 'theme_backend/scripts/libraries/chosen/chosen.jquery.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'theme_backend/scripts/custom/jsPost.js"></script>');
        $this->template->loadData("activeLink", array(
            "accomodation" => array(
                "room" => 1
            )
        ));
        
        
        
        $room_type    = $this->room_m->get_room_type();
        $room_status  = $this->room_m->get_room_status();
        $image        = $this->room_m->get_imagebyIDRoom($id);
        $facility     = $this->facility_m->get_facilitybyIDRoom($id);
        $listfacility = $this->facility_m->get_facility();
        //echo $this->db->last_query();die;
        $this->template->loadContent("Accomodation/edit_room.php", array(
            "room_type" => $room_type,
            "room_status" => $room_status,
            "room" => $room,
            "image" => $image,
            "facility" => $facility,
            "listfacility" => $listfacility
        ));
        
        	
    }
    
    public function edit_room_pro($id)
    {
        $this->load->model("site_slugs_m");
        $idroom   = intval($id);
        $room = $this->room_m->get_content_room($idroom);
        if ($room->num_rows() == 0) {
            $this->template->error(lang("error_82"));
        }
        $code = $room->row();
        
        $code           = $this->common->nohtml($this->input->post("code"));
        $name           = $this->common->nohtml($this->input->post("name"));
        $idtype         = $this->common->nohtml($this->input->post("idtype"));
        $idstatus         = $this->common->nohtml($this->input->post("idstatus"));
        $description         = $this->lib_filter->go($this->input->post("description"));

        
        
        
        // Upload image
        $this->load->library("upload");
        
        if ($_FILES['userfile']['size'] > 0) {
            $this->upload->initialize(array(
                "upload_path" => $this->settings->info->upload_path . "/room/",
                "overwrite" => FALSE,
                "max_filename" => 300,
                "encrypt_name" => TRUE,
                "remove_spaces" => TRUE,
                "allowed_types" => "png|gif|jpeg|jpg",
                "max_size" => $this->settings->info->file_size
            ));
            
            if (!$this->upload->do_upload()) {
                $this->template->error(lang("error_21") . $this->upload->display_errors());
            }
            
            $data = $this->upload->data();
            $this->common->resizecropImageCI($data, 100, 67);
            $this->common->resizecropImageCI($data, 300, 201);
            $this->common->resizecropImageCI($data, 755, 331);
            $namafile = explode(".", $data['file_name']);
            
            $image = "/room/" . $namafile[0];
        } else {
            $namafile = explode(".", $post->image);
            
            $image       = $namafile[0];
            $namafile[1] = $post->ext_image;
            
        }
        
        // // Add slug
        // $controller = 'post/withid/' . $id;
        // $slug       = ($this->common->issulgable($this->common->nohtml($this->input->post("slug")))) ? $this->common->nohtml($this->input->post("slug")) : $controller;
        // $this->site_slugs_m->updatebycontroller($controller, array(
        //     'controller' => $controller,
        //     'slug' => $slug,
        //     'keywords' => $this->common->nohtml($this->input->post("slug"))
        // ));
        
        // Add post
        $this->room_m->update($idroom, array(
            "code" => $code,
            "name" => $name,
            "thumbnail" => $image,
            "ext_image" => $namafile[1],
            "description" => $description,
            "type" => $idtype
        ));
        
        
        
        $this->session->set_flashdata("globalmsg", lang("success_44"));
         redirect(site_url("backend/hotel/accomodation/edit_room/" . $idroom));
    }
    
    public function add_image()
    {
        
        if (!$this->common->has_permissions(array(
            "admin",
            "content_manager"
        ), $this->user)) {
            $this->template->error(lang("error_81"));
        }
        
        $name   = $this->common->nohtml($this->input->post("name"));
        $idroom = intval($this->input->post("idroom"));
        $desc   = $this->lib_filter->go($this->input->post("desc"));
        
        $this->load->library("upload");
        if ($_FILES['userfile']['size'] > 0) {
            
            $this->upload->initialize(array(
                "upload_path" => $this->settings->info->upload_path . "/room/",
                "overwrite" => FALSE,
                "max_filename" => 300,
                "encrypt_name" => TRUE,
                "remove_spaces" => TRUE,
                "allowed_types" => "png|gif|jpeg|jpg",
                "max_size" => $this->settings->info->file_size
            ));
            
            if (!$this->upload->do_upload()) {
                $this->template->error(lang("error_21") . $this->upload->display_errors());
            }
            
            $data = $this->upload->data();
            //this slider 1950 x 860
            $this->common->resizecropImageCI($data, 50, 50);
            $this->common->resizecropImageCI($data, 755, 331);
            $namafile = explode(".", $data['file_name']);
            
            $image = '/room/' . $namafile[0];
        } else {
            $image    = "default.png";
            $namafile = explode(".", $image);
            $image    = $namafile[0];
        }
        
        if (empty($name)) {
            $this->template->error(lang("error_88"));
        }
        
        $this->room_m->add_image(array(
            "room_id" => $idroom,
            "name" => $name,
            "description" => $desc,
            "image" => $image,
            "ext_image" => $namafile[1]
        ));
        $this->session->set_flashdata("globalmsg", lang("success_46"));
        redirect(site_url("backend/hotel/accomodation/edit_room/" . $idroom));
    }
    
    public function delete_image($id, $idroom, $hash)
    {
        if (!$this->common->has_permissions(array(
            "admin",
            "content_manager"
        ), $this->user)) {
            $this->template->error(lang("error_81"));
        }
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
        }
        
        $image = $this->room_m->get_imagebyIDRoom($idroom);
        
        $imagenum = $image->num_rows();
        
        $id    = intval($id);
	    $image = $this->room_m->get_imagebyIDImage($id);
	    if ($image->num_rows() == 0) {
	        $this->template->error(lang("error_89"));
	    }
	    
	    $image = $image->row();
	    if ($image->image != "default")
	    //delete using Array Map
	    array_map('unlink', glob($this->settings->info->upload_path_relative . $image->image . "*." . $image->ext_image));
	    $this->room_m->delete_image($id);
	    $this->session->set_flashdata("globalmsg", "Image Was Successfully Deleted");
        
        redirect(site_url("backend/hotel/accomodation/edit_room/" . $idroom));
    }
    
    
    public function add_newfacility()
    {
        
        if (!$this->common->has_permissions(array(
            "admin",
            "content_manager"
        ), $this->user)) {
            $this->template->error(lang("error_81"));
        }
        
        $name   = $this->common->nohtml($this->input->post("name"));
        $idroom = intval($this->input->post("idroom"));
        $desc   = $this->lib_filter->go($this->input->post("desc"));
        
        if (empty($name)) {
            $this->template->error(lang("error_88"));
        }
        
        $this->facility_m->add_newfacility(array(
            "idroom" => $idroom,
            "name" => $name,
            "description" => $desc
        ));
        $this->session->set_flashdata("globalmsg", "Addon Facility just added");
        redirect(site_url("backend/hotel/accomodation/edit_room/" . $idroom));
    }
    
    public function add_facilityAjax()
    {
        
        $this->load->helper('security');
        $this->load->model("hotel/facility_m");
        
        $_GET["facilityid"] = $this->common->nohtml($_GET["facilityid"]);
        $isexistFacility    = $this->facility_m->isexistFacility($_GET["facilityid"]);
        
        $_GET["roomid"] = $this->common->nohtml($_GET["roomid"]);
        $isexistRoom    = $this->room_m->isexistRoom($_GET["roomid"]);
        
        $isexistRoomFacility = $this->facility_m->isexistRoomFacility($_GET["roomid"], $_GET["facilityid"]);
        
        
        if (($isexistRoomFacility != 0) || ($isexistFacility == 0) || ($isexistRoom == 0)) {
            
            
            $message = "Something went Wrong!";
            
            
            $arr = array(
                'success' => "FALSE",
                'message' => $message
                
            );
            
            echo json_encode($arr);
        } else {
            
            $this->facility_m->add_room_facility($_GET);
            
            $facility = $this->facility_m->get_facilitybyID($_GET["facilityid"]);
            $fct      = $facility->row();
            $list     = "<tr class='listfacility'>
                      <td>" . $fct->name . "</td> 
                      <td>" . $fct->description . "</td> 
                      <td><a href='" . site_url('backend/hotel/accomodation/edit_facility/' . $fct->id) . "' class='btn btn-warning btn-xs' data-toggle='tooltip' data-placement='bottom' title='" . lang('ctn_55') . "'><span class='glyphicon glyphicon-cog'></span></a> <a href='" . site_url('backend/hotel/accomodation/delete_facility/' . $fct->id . '/' . $_GET["roomid"] . '/' . $this->security->get_csrf_hash()) . "' class='btn btn-danger btn-xs' onclick='return confirm('" . lang('ctn_317') . "')' data-toggle='tooltip' data-placement='bottom' title='" . lang('ctn_57') . "'><span class='glyphicon glyphicon-trash'></span></a></td>
                    </tr>";
            
            
            //echo "<pre>"; print_r( $list );die; //test 
            
            $arr = array(
                'success' => 'TRUE',
                'list' => $list
            );
            echo json_encode($arr);
        }
        
    }

    
    public function get_navigate()
    {
        
        $roomId     = $this->input->get("room_id");
        $roomDomain = $this->room_m->get_id($roomId);
        
        if (!(sizeof($roomDomain) != 0)) {
            $result['status']  = 'false';
            $result['message'] = 'Room not found.';
            echo json_encode($result);
            exit();
        }
        
        $month = $this->input->get('month');
        $year  = $this->input->get('year');
        
        $certainDate = new DateTime($year . '-' . str_pad(((int) $month + 1 == 13 ? 1 : (int) $month + 1), 2, '0', STR_PAD_LEFT) . '-01');
        
        $roomUnavailableArray = $this->room_m->getUnavailableByRoomId($roomDomain[0]->id, $certainDate);
        $roomCustomPriceArray = $this->room_m->getCustomPriceByRoomId($roomDomain[0]->id, $certainDate);
        
        $result['status']    = 'true';
        $result['dataEvent'] = $this->renderEvent($roomDomain, $roomUnavailableArray, $roomCustomPriceArray, $certainDate);
        
        // because month in javascript start from 0(jan) - 11(des)
        $result['month'] = str_pad(((int) $certainDate->format('m') - 1 == -1 ? 11 : (int) $certainDate->format('m') - 1), 2, '0', STR_PAD_LEFT);
        $result['year']  = $certainDate->format('Y');
        
        echo json_encode($result);
        exit();
        
    }
    
    public function update_plan()
    {
        
        $roomId     = $this->input->get('room_id');
        $roomDomain = $this->room_m->get_id($roomId);
        
        if (!(sizeof($roomDomain) != 0)) {
            $result['status']  = 'false';
            $result['message'] = 'Room not found.';
            echo json_encode($result);
            exit();
        }
        
        $roomStatus       = $this->input->get('room_status');
        $roomPrice        = $this->input->get('room_price');
        $currentDate      = $this->input->get('current_date');
        $calendarSelected = $this->input->get('calendar_selected');
        
       
        $dataArray = array();
        $roomUnvailableDomainArray = array();
        $roomCustomPriceDomainArray = array();


        $calendarSelectedArray = explode(',', $calendarSelected);
        list($month, $year) = explode('-', $currentDate);
        
        //WRITE HERE!!!	

        foreach ($calendarSelectedArray as $calendarSelected) {
        	//ech
        	$this->room_m->deleteCalendarSelected($roomId,$calendarSelected);	
            if ($roomStatus == 'renovation') {
                 $this->room_m->insertUnavailableRoom($roomId,$calendarSelected,'renovation','renov');
            }elseif ($roomStatus == 'block') {
	       		 $this->room_m->insertUnavailableRoom($roomId,$calendarSelected,'block','block');
	       	}elseif($roomPrice != '') {
                $this->room_m->insertRoomCustomPrice($roomId,$calendarSelected,$roomPrice);
            }

        }
        

        
       
        $certainDate = new DateTime($year . '-' . str_pad(((int) $month + 1 == 13 ? 1 : (int) $month + 1), 2, '0', STR_PAD_LEFT) . '-01');
        $roomUnavailableArray = $this->room_m->getUnavailableByRoomId($roomDomain[0]->id, $certainDate);
        $roomCustomPriceArray = $this->room_m->getCustomPriceByRoomId($roomDomain[0]->id, $certainDate);
        
        
        $result['status']    = 'true';
        $result['message']   = 'Data has been saved.';
      	$result['dataEvent'] = $this->renderEvent($roomDomain, $roomUnavailableArray, $roomCustomPriceArray, $certainDate);
 
        // because month in javascript start from 0(jan) - 11(des)
        $result['month'] = str_pad(((int) $certainDate->format('m') - 1 == -1 ? 11 : (int) $certainDate->format('m') - 1), 2, '0', STR_PAD_LEFT);
        $result['year']  = $certainDate->format('Y');
        
    
        echo json_encode($result);
        exit();
       
    }


    public function get_room()
    {
        
        
        $roomId     = $this->input->get("room_id");
        $roomDomain = $this->room_m->get_id($roomId);
        
        if (!(sizeof($roomDomain) != 0)) {
            $result['status']  = 'false';
            $result['message'] = 'Room not found.';
            echo json_encode($result);
            exit();
        }
        
        $certainDate          = new DateTime();
        $roomUnavailableArray = $this->room_m->getUnavailableByRoomId($roomDomain[0]->id, $certainDate);
        
        
        
        $roomCustomPriceArray = $this->room_m->getCustomPriceByRoomId($roomDomain[0]->id, $certainDate);
        
        $result['status']    = 'true';
        $result['dataEvent'] = $this->renderEvent($roomDomain, $roomUnavailableArray, $roomCustomPriceArray, $certainDate);
        // because month in javascript start from 0(jan) - 11(des)
        $result['month']     = str_pad(((int) $certainDate->format('m') - 1 == -1 ? 11 : (int) $certainDate->format('m') - 1), 2, '0', STR_PAD_LEFT);
        $result['year']      = $certainDate->format('Y');
        
        echo json_encode($result);
        exit();
    }


    private function renderEvent($roomDomain, $roomUnavailableArray, $roomCustomPriceArray, $certainDate)
    {
        $result['event'] = array();
        $now             = new DateTime();
        
        foreach ($roomUnavailableArray as $roomUnavailable) {
            $result['event'][$roomUnavailable['certain_date']]['status'] = $roomUnavailable['status'];
            if(isset($result['event'][$roomUnavailable['certain_date']]['description'])){
                $result['event'][$roomUnavailable['certain_date']]['description'] = $result['event'][$roomUnavailable['certain_date']]['description'].",".$roomUnavailable['description'];
            }else{
                $result['event'][$roomUnavailable['certain_date']]['description'] = $roomUnavailable['description'];
            }
        }
        foreach ($roomCustomPriceArray as $roomCustomPrice) {
            $result['event'][$roomCustomPrice['certain_date']]['price'] = $roomCustomPrice['price'];
        }
        
        $result['price0']  = $roomDomain[0]->price_sun;
        $result['price1']  = $roomDomain[0]->price_mon;
        $result['price2']  = $roomDomain[0]->price_tue;
        $result['price3']  = $roomDomain[0]->price_wed;
        $result['price4']  = $roomDomain[0]->price_thu;
        $result['price5']  = $roomDomain[0]->price_fri;
        $result['price6']  = $roomDomain[0]->price_sat;
        //            if ($now->format('m-Y') == $certainDate->format('m-Y')) {
        //                $result['canBack'] = false;
        //            }
        //            else {
        $result['canBack'] = true;
        //            }
        $result['canNext'] = true;
        
        return $result;
        
    }
    
}

?>
