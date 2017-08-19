<?php

class Addon extends CI_Model {

    var $table = 'site_addon';

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_id($addon_id) {
        $this->db->where('addon_id', $addon_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function insert($arr) {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($addon_id, $arr) {
        $this->db->where('addon_id', $addon_id);
        $this->db->update($this->table, $arr);
    }

    function delete($addon_id) {
        $this->db->where('addon_id', $addon_id);
        $this->db->delete($this->table);
    }

}
