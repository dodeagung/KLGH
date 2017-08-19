<?php

class Tax extends CI_Model {

    var $table = 'site_tax';

    function insert($arr) {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($id, $arr) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $arr);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
