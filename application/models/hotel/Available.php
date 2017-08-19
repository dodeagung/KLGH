<?php


class Available extends CI_Model{
    
    var $allocation_table = 'site_rooms_allocation';
    var $rate_table = 'site_rates';
    var $room_table = 'site_rooms';
    var $room_rate_table = 'site_rates_rooms';
    
    function get()
    {
        $alloc = array();
        $available = array();
        $stamp1 = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $stamp2 = mktime(0,0,0,date('m')+2,1,date('Y'));
        $date_start = date('Y-m-d',$stamp1);
        $date_end = date('Y-m-d',$stamp2);
        $sql = "SELECT * ";
        $sql .= "FROM ".$this->allocation_table." ";
        $sql .= "WHERE  allocation_date >= '$date_start' ";
        $sql .= "AND allocation_date < '$date_end' ";
        $sql .= "AND allocation > 0 ";
        $sql .= "ORDER BY allocation_date ASC ";
        $query = $this->db->query($sql);
        $rs = $query->result();
        foreach($rs as $value){
            if($value->allocation > 0){
                $alloc[$value->allocation_date] = $value->allocation;
            } 
        }
        $days = ($stamp2 - $stamp1) / 86400;
        $n = 0;
        while($n <= $days){
            $stamp = date('Y-m-d', $stamp1 + ($n *86400));
            if(isset($alloc[$stamp])){
                $available[$stamp] = $alloc[$stamp];
            }
            $n++;
        }
        return $available;
    }
    
    function check_rate($checkin, $checkout)
    {   
        $stamp = strtotime($checkin) - mktime(0,0,0,date('m'),date('d'),date('Y'));
        $cutoff = $stamp/86400;
        
        $sql = "SELECT * ";
        $sql .= "FROM $this->rate_table ";
        $sql .= "WHERE cutoff < '$cutoff'";
        $sql .= "AND status = 1 ";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function check_room($adults, $child)
    {
        $sql = "SELECT * ";
        $sql .= "FROM ".$this->room_table." ";
        $sql .= "WHERE 1 ";
        #$sql .= "AND $this->room_table.capacity >= '".( $adults+ $child)."' ";
        $sql .= "AND $this->room_table.adults >= '$adults' ";
        $sql .= "AND $this->room_table.child >= '$child' ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function available_room($room_id, $checkin, $checkout, $rooms)
    {
        $available = array();
        $datetime = date('Y-m-d',strtotime($checkin));
        list($y,$m,$d) = explode('-',$datetime);
        
        $cutoff = (strtotime($checkin) - mktime(0,0,0,date('m'),date('d'),date('Y'))) / 86400;
        
        $sql = "SELECT * FROM $this->rate_table WHERE status = 1 ";
        $query = $this->db->query($sql);
        $rs = $query->result();
        foreach($rs as $value){
            $cutoff_rate[$value->rate_id] = $value->cutoff;
        }
        
        $nights = (strtotime($checkout) - strtotime($checkin)) / 86400;
        $n = 0;
        while($n < $nights){
            
            $thedate = date('Y-m-d',mktime(0,0,0,$m,$d+$n,$y));

            $sql = "SELECT * \n";
            $sql .= "FROM $this->room_rate_table, ".$this->allocation_table." \n";
            $sql .= "WHERE ".$this->room_rate_table.".room_id = ".$this->allocation_table.".room_id \n";
            $sql .= "AND ".$this->room_rate_table.".rate_date = ".$this->allocation_table.".allocation_date \n";
            $sql .= "AND $this->room_rate_table.rate_date = '".$thedate."' \n";
            $sql .= "AND $this->allocation_table.allocation >= '$rooms' ";
            $sql .= "AND ".$this->room_rate_table.".room_id = '$room_id' \n";
            
            #echo '<pre>'.$sql.'</pre>';
            $query = $this->db->query($sql);
            $rs = $query->result();
            if(isset($rs[0]->id)){
                if($cutoff > $cutoff_rate[$rs[0]->rate_id]){
                    $available[] = 'AVAILABLE';
                }else{
                    $available[] = 'NOT AVAILABLE';
                }
            }else{
                $available[] = 'NOT AVAILABLE';
            }
             
            $n++;
        }

        #echo '<pre>';
        #print_r($available);
        #echo '</pre>';

        if(in_array('NOT AVAILABLE', $available)){
            return false;  
        }else{
            return true;
        }
    }

    
    function check_price($room_id, $rate_id, $checkin, $checkout, $rooms)
    {
        $available = array();
        $datetime = date('Y-m-d',strtotime($checkin));
        list($y,$m,$d) = explode('-',$datetime);
        $nights = (strtotime($checkout) - strtotime($checkin)) / 86400;
        $n = 0;
        while($n < $nights){
            
            $thedate = date('Y-m-d',mktime(0,0,0,$m,$d+$n,$y));
            
            $sql = "SELECT * ";
            $sql .= "FROM $this->room_rate_table, ".$this->allocation_table." ";
            $sql .= "WHERE ".$this->room_rate_table.".room_id = '$room_id' ";
            $sql .= "AND ".$this->room_rate_table.".room_id = ".$this->allocation_table.".room_id ";
            $sql .= "AND ".$this->room_rate_table.".rate_id = '$rate_id' ";
            $sql .= "AND $this->room_rate_table.rate_date = '".$thedate."' ";
            $sql .= "AND $this->allocation_table.allocation_date = $this->room_rate_table.rate_date ";
            $sql .= "AND $this->allocation_table.allocation >= '$rooms' ";
            $query = $this->db->query($sql);
            $rs = $query->result();
            if(isset($rs[0]->id)){
                $available['available'][] = 'AVAILABLE';
                $available['rate'][] = $rs[0]->rate * $rooms;
                $available[$thedate] = $rs;
            }else{
                $available['available'][] = 'NOT AVAILABLE';
            }
                    
            $n++;
        }
        
        return $available;
        
    }
    
}