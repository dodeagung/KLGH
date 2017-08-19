<?php

class Property extends CI_Model {

    var $table = 'site_property';

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function insert($arr) {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($id, $arr) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $arr);
    }

}
