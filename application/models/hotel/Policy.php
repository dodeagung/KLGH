<?php

class Policy extends CI_Model {

    var $table = 'site_policy';

    function insert($arr) {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($policy_id, $arr) {
        $this->db->where('policy_id', $policy_id);
        $this->db->update($this->table, $arr);
    }

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_id($policy_id) {
        $this->db->where('policy_id', $policy_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
