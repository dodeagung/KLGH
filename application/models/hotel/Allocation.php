<?php

class Allocation extends CI_Model {

    var $table = 'site_rooms_allocation';

    function insert($room_id, $date1, $date2, $allocation) {

        $items = array();
        $days = (strtotime($date2) - strtotime($date1)) / 86400;

        $sql = "DELETE ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE 1 ";
        $sql .= "AND room_id = '$room_id' ";
        $sql .= "AND allocation_date >= '$date1' ";
        $sql .= "AND allocation_date <= '$date2' ";
        $this->db->query($sql);
        list($y, $m, $d) = explode('-', $date1);
        $n = 0;
        while ($n <= $days) {
            $allocation_date = date('Y-m-d', mktime(0, 0, 0, $m, $d + $n, $y));
            $items[] = "('$room_id', '$allocation_date', '$allocation' , NOW())";
            $n++;
        }

        if (count($items)) {
            $sql = "INSERT INTO " . $this->table . " (room_id, allocation_date, allocation, entered) VALUES ";
            $sql .= implode(',', $items);
            $this->db->query($sql);
        }
    }

    function get_momth($month, $year) {

        $data = array();

        $date1 = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $date2 = date('Y-m-d', mktime(0, 0, 0, $month + 1, 1, $year));
        $sql = "SELECT * ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE allocation_date >= '$date1' ";
        $sql .= "AND allocation_date < '$date2' ";
        $query = $this->db->query($sql);
        $rs = $query->result();

        foreach ($rs as $index => $value) {
            $data[$value->allocation_date] = $value->allocation;
        }

        return $data;
    }

    function update($room_id, $month, $year, $allocation) {

        $date1 = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $date2 = date('Y-m-d', mktime(0, 0, 0, $month + 1, 1, $year));

        $sql = "DELETE ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE room_id = '$room_id' ";
        $sql .= "AND allocation_date >= '$date1' ";
        $sql .= "AND allocation_date < '$date2'";
        $this->db->query($sql);

        foreach ($allocation as $index => $value) {

            $arr['room_id'] = $room_id;
            $arr['allocation_date'] = $index;
            $arr['allocation'] = $value;

            $this->db->insert($this->table, $arr);
        }
    }

    function clear() {
        $this->db->where('allocation_date < ', date('Y-m-d'));
        $this->db->delete($this->table);
    }

    function get($room_id) {
        $this->db->order_by('allocation_date', 'asc');
        $this->db->where('room_id', $room_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    function booking($room_id, $allocation_date , $num)
    {
        $sql = "UPDATE $this->table ";
        $sql .= "SET allocation = allocation - $num ";
        $sql .= "WHERE room_id = '$room_id' ";
        $sql .= "AND allocation_date = '$allocation_date' ";
        $this->db->query($sql);
    }

}
