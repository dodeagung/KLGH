<?php

Class Reservation extends CI_Model{
    
    var $table = 'site_reservation';

    function get_email_and_id($id, $email)
    {
        $this->db->where('id',$id);
        $this->db->where('email',$email);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_email($email, $page)
    {
        $limit = 10;
        $start = $page * $limit - $limit;

        $sql = "SELECT * ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE email = '$email' ";
        $sql .= "ORDER BY id DESC ";
        $sql .= "LIMIT $start, $limit ";
        $query = $this->db->query($sql);
        $data['rows'] = $query->result();

        $sql = "SELECT COUNT(*) AS num ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE email = '$email' ";
        $query = $this->db->query($sql);
        $rs = $query->result();

        $data['item'] = $rs[0]->num;
        $data['pages'] = ceiL($rs[0]->num/$limit);

        return $data;

    }

    function get_member_id($member_id, $page)
    {
        $limit = 10;
        $start = $page * $limit - $limit;

        $sql = "SELECT * ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE member_id = '$member_id' ";
        $sql .= "ORDER BY id DESC ";
        $sql .= "LIMIT $start, $limit ";
        $query = $this->db->query($sql);
        $data['rows'] = $query->result();

        $sql = "SELECT COUNT(*) AS num ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE member_id = '$member_id' ";
        $query = $this->db->query($sql);
        $rs = $query->result();

        $data['item'] = $rs[0]->num;
        $data['pages'] = ceiL($rs[0]->num/$limit);

        return $data;

    }
    
    function get_id($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    function get_id_session($id, $mysession_id)
    {
        $this->db->where('id',$id);
        $this->db->where('mysession_id', $mysession_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    function get($page)
    {
        $q = $this->input->get('q');
        $limit = 50;
        $start = $page * $limit - $limit;
        $sql = "SELECT * ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE 1 ";
        if($q){
            $sql .= "AND ( ";
            $sql .= "id = '$q' OR email = '$q'";
            $sql .= ")";
        }
        $sql .= "ORDER BY id DESC ";
        $sql .= "LIMIT $start, $limit ";
        $query = $this->db->query($sql);
        $data['rows'] = $query->result();
        
        $sql = "SELECT COUNT(*) AS num ";
        $sql .= "FROM $this->table ";
        $sql .= "WHERE 1 ";
        if($q){
            $sql .= "AND ( ";
            $sql .= "id = '$q' OR email = '$q'";
            $sql .= ")";
        }
        $query = $this->db->query($sql);
        $rs = $query->result();
        $data['items'] = $rs[0]->num;
        $data['pages'] = ceil($rs[0]->num/$limit);
        return $data;
    }
    
    function insert($arr)
    {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }
    
    function update($id, $arr)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table, $arr);
    }
}