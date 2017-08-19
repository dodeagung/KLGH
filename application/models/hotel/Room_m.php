<?php

class Room_m extends CI_Model {

    var $table = 'site_rooms';
    var $tablestatusroom = 'site_room_status';

    function insert($arr) {

        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($room_id, $arr) {
        $this->db->where('id', $room_id);
        $this->db->update($this->table, $arr);
    }

    function delete($room_id) {
        $this->db->where('room_id', $room_id);
        $this->db->delete($this->table);
    }

    function get_id($room_id) {
        $this->db->where('id', $room_id);
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
	
	public function get_content_rooms($datatable)
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
                site_rooms.thumbnail image, 
                site_rooms.ext_image ext_image, 
                site_rooms.name name,
                site_rooms.code code,
                site_rooms_type.type type,
                site_room_status.status status
               ")
			->join("users", "users.ID = site_rooms.userid")
			->join("site_room_status", "site_room_status.id = site_rooms.userid")
			->join("site_rooms_type", "site_rooms_type.id = site_rooms.type")
			->limit($datatable->length, $datatable->start)
			->get($this->table);
	}

    public function get_content_room($id)
    {
        return $this->db
            ->where("site_rooms.id", $id)
            ->select("
                    site_rooms.id id,
                    site_rooms.status idstatus,
                    site_rooms.type idtype,
                    site_rooms.description,
                    site_rooms.code code,,
                    site_rooms.thumbnail image,
                    site_rooms.ext_image ext_image,
                    site_rooms.name name,
                    site_rooms_type.type typename,
                    site_room_status.status statusname")
            ->join("users", "users.ID = site_rooms.userid")
            ->join("site_room_status", "site_room_status.id = site_rooms.userid")
            ->join("site_rooms_type", "site_rooms_type.id = site_rooms.type")
            ->get($this->table);
    }  

    public function get_room_type()
    {
        return $this->db->get("site_rooms_type");
    }  

    public function get_room_status()
    {
        return $this->db->get("site_room_status");
    }

    public function get_imagebyIDRoom($id,$isthumbnail=0)
    {
        return $this->db
            ->where("room_id", $id)
            ->where("$isthumbnail", $isthumbnail)
            ->get("site_rooms_image");
    }   

     public function get_imagebyIDImage($id)
    {
        return $this->db->where("id", $id)->get("site_rooms_image");
    }
    
    public function add_image($data)
    {
        $this->db->insert("site_rooms_image", $data);
    }

    public function delete_image($id)
    {
        $this->db->where("ID", $id)->delete("site_rooms_image");
    }

    function isexistRoom($idRoom) {
        $s = $this->db
            ->where("id", $idRoom)
            ->select("COUNT(*) as num")
            ->get($this->table);
        $r = $s->row();
        if(isset($r->num)) return $r->num;
        return 0;
    }

    public function getAllRoom()
    {
        $query = $this->db
            ->select("
                site_rooms.*,
                    site_house.name house_name")
            ->join("users", "users.ID = site_rooms.userid")
            ->join("site_house", "site_house.id = site_rooms.idhouse")
            ->get($this->table);

        foreach ($query->result_array() as $arrRoom){
            $resArr[$arrRoom['house_name']][] = $arrRoom;
        }

        return $resArr;

    } 


   public function getUnavailableByRoomId($roomId, $now)
    {
        $certainDate = new DateTime($now->format('Y-m-d'));
        $startDate = $certainDate->modify('-1 month')->format('Y-m-17');
        $endDate = $certainDate->modify('+2 months')->format('Y-m-13');

        $sql = "SELECT DATE_FORMAT(certain_date, '%m-%d-%Y') AS certain_date,
                status,description
            FROM
                site_room_unavailable
            WHERE
                room_id = ".$roomId." AND
                (certain_date BETWEEN '".$startDate."' AND '".$endDate."')";
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function getCustomPriceByRoomId($roomId, $now)
    {
        $certainDate = new DateTime($now->format('Y-m-d'));
        $startDate = $certainDate->modify('-1 month')->format('Y-m-17');
        $endDate = $certainDate->modify('+2 months')->format('Y-m-13');

        $sql = "SELECT DATE_FORMAT(certain_date, '%m-%d-%Y') AS certain_date,
                price
            FROM
                site_room_custom_price
            WHERE
                room_id = ".$roomId." AND
                (certain_date BETWEEN '".$startDate."' AND '".$endDate."')";
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function deleteCalendarSelected($roomId,$calendarSelected)
    {
            
            $statement = "DELETE FROM
                             site_room_unavailable
                          WHERE
                            room_id = '".$roomId."' AND
                            certain_date = '".$calendarSelected."'";
            $query = $this->db->query($statement);
           // echo $this->db->last_query();die;
            return $query;
        // }

    }



    public function insertUnavailableRoom($roomid,$date,$status,$desc)
    {
        $statement = "
               INSERT INTO
                   site_room_unavailable
               VALUES(
                   '',
                   '".$roomid."',                   
                   '".$date."',                   
                   '".$status."',
                   '".$desc."'
               )";

            $query = $this->db->query($statement);

            return $query;
    }   

    public function insertRoomCustomPrice($roomid,$date,$price)
    {
        $statement = "
               INSERT INTO
                   site_room_custom_price
               VALUES(
                   '',
                   '".$roomid."',                   
                   '".$date."',                   
                   ".$price."
               )";

            $query = $this->db->query($statement);

            return $query;
    }
}