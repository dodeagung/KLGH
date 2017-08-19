<?php

class Currency extends CI_Model {

    var $table = 'site_currency';

    function get() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function get_code($code) {
        $this->db->where('code', $code);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function update($id, $arr) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $arr);
    }
    
    function get_active()
    {
        $this->db->where('active',1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    
    public function cc($currency, $value, $from, $to)
    {
                    
        $money = ($value/$currency[$from]) * $currency[$to];
        return number_format($money,0,".",",");
    }

}
