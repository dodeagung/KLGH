<?php

class Rooms extends CI_Model {

    var $table = 'site_rooms';
    var $tablestatusroom = 'site_room_status';

    function insert($arr) {

        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($room_id, $arr) {
        $this->db->where('room_id', $room_id);
        $this->db->update($this->table, $arr);
    }

    function delete($room_id) {
        $this->db->where('room_id', $room_id);
        $this->db->delete($this->table);
    }

    function get_id($room_id) {
        $this->db->where('room_id', $room_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_limit($limit)
    {
        $sql = "SELECT * FROM $this->table WHERE status = 1 LIMIT $limit ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
	
	public function get_total_posts_count()
	{
		$s = $this->db->select("COUNT(*) as num")->get($this->table);
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	public function get_content_room($datatable)
	{
		$datatable->db_order();
		$datatable->db_search(array(
			$this->table.".name",
			"site_rooms_type.type",
            $this->tablestatusroom.".status",
			)
		);

		return $this->db
			->select("
                site_rooms.id id,
                site_rooms_image.image image, site_rooms_image.ext_image ext_image, 
               site_rooms.name name,site_rooms_type.type type,site_room_status.status status
               ")
			->join("users", "users.ID = site_rooms.userid")
			->join("site_room_status", "site_room_status.id = site_rooms.userid")
			->join("site_rooms_image", "site_rooms_image.room_id = site_rooms.id")
			->join("site_rooms_type", "site_rooms_type.id = site_rooms.type")
			->limit($datatable->length, $datatable->start)
			->get($this->table);
	}
	

}
