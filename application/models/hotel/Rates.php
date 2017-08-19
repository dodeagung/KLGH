<?php

class Rates extends CI_Model {

    var $table = 'site_rates';

    function insert($arr) {
        $this->db->insert($this->table, $arr);
        return $this->db->insert_id();
    }

    function update($rate_id, $arr) {
        $this->db->where('rate_id', $rate_id);
        $this->db->update($this->table, $arr);
    }

    function delete($rate_id) {
        $this->db->where('rate_id', $rate_id);
        $this->db->delete($this->table);
    }

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_id($rate_id) {
        $this->db->where('rate_id', $rate_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_type() {

        $items[] = 'Rack Rate';
        $items[] = 'Promotional Rate';
        $items[] = 'Package Rate';

        return $items;
    }

}
