<?php

class Facility_m extends CI_Model {

 
    function isexistRoomFacility($idroom,$idfacility) {
        $s = $this->db
            ->where("idroom", $idroom)
            ->where("idfacility", $idfacility)
            ->select("COUNT(*) as num")
            ->get("site_room_facility");
        $r = $s->row();
        if(isset($r->num)) return $r->num;
        return 0;
    }   

     function isexistFacility($idfacility) {
        $s = $this->db
            ->where("id", $idfacility)
            ->select("COUNT(*) as num")
            ->get("site_facility");
        $r = $s->row();
        if(isset($r->num)) return $r->num;
        return 0;
    }


    

    public function get_facility()
    {
        return $this->db->get("site_facility");
    }   

    public function get_facilitybyID($id)
    {
        return $this->db
            ->where("site_facility.id", $id)
            ->get("site_facility");
    }

        //facility segmen

    public function get_facilitybyIDRoom($id)
    {
        return $this->db
            ->where("site_rooms.id", $id)
            ->select("
                    site_rooms.id id,
                    site_room_facility.id idroomfacility,
                    site_facility.id idfacility,
                    site_facility.name,
                    site_facility.description
            ")
            ->from("site_room_facility")
            ->join("site_facility", "site_facility.id = site_room_facility.idfacility")
            ->join("site_rooms", "site_rooms.id = site_room_facility.idroom")
            ->get();
    }  

    public function add_newfacility($data)
    {
        $datafacility = array(
            "name" => $data['name'],
            "description" => $data['description']
            );
        $idfacility = $this->db->insert("site_facility", $datafacility);
        $dataroomfacility = array(
            "idroom" => $data['idroom'],
            "idfacility" => $this->db->insert_id()
        );
        $this->db->insert("site_room_facility", $dataroomfacility);
    }

    public function add_room_facility($data)
    {
        $arrayData = array(
            'idroom' =>$data["roomid"], 
            'idfacility' => $data["facilityid"]
        );
        $this->db->insert("site_room_facility", $arrayData);
    }
}
