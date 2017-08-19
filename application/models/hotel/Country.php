<?php

class Country extends CI_Model {

    var $table = 'site_country';

    function get() {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
