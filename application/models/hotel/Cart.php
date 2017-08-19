<?php

class Cart extends CI_Model{
    
    var $booking = 'site_cart_reservation';
    var $addon = 'site_cart_reservation_addon';
    
    function get_booking($mysession_id)
    {
        $this->db->where('mysession_id', $mysession_id);
        $query = $this->db->get($this->booking);
        return $query->result();
    }
    
    function booking($arr)
    {
        $this->db->insert($this->booking, $arr);
        return $this->db->insert_id();
    }
    
    function booking_delete($mysession_id)
    {
        $this->db->where('mysession_id',$mysession_id);
        $this->db->delete($this->booking);
    }
    
    function get_addon($mysession_id)
    {
        $this->db->where('mysession_id',$mysession_id);
        $query = $this->db->get($this->addon);
        return $query->result();
    }
    
    function addon($arr)
    {
        $this->db->insert($this->addon, $arr);
        return $this->db->insert_id();
    }
    
    function addon_delete($mysession_id)
    {
        $this->db->where('mysession_id', $mysession_id);
        $this->db->delete($this->addon);
    }
    
}