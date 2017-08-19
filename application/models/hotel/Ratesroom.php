<?php

class Ratesroom extends CI_Model {

    var $table = 'site_rates_rooms';

    function insert($rate_id, $room_id, $date1, $date2, $rate) {

        $sql = "DELETE ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE rate_id = '$rate_id' ";
        $sql .= "AND room_id = '$room_id' ";
        $sql .= "AND rate_date >= '$date1' ";
        $sql .= "AND rate_date <= '$date2' ";
        $this->db->query($sql);

        $days = ceil((strtotime($date2) - strtotime($date1)) / 86400);
        list($y, $m, $d) = explode('-', $date1);
        $n = 0;
        while ($n <= $days) {

            $rate_date = date('Y-m-d', mktime(0, 0, 0, $m, $d + $n, $y));

            $items[] = "('$rate_id', '$room_id', '$rate_date', '$rate' , NOW())";
            $n++;
        }

        $sql = "INSERT INTO " . $this->table . " (rate_id,room_id, rate_date, rate, entered) VALUES ";
        $sql .= implode(',', $items);
        $this->db->query($sql);
    }

    function get_month($rate_id, $room_id, $month, $year) {
        $rates = array();
        $sql = "SELECT * ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE room_id = '$room_id' ";
        $sql .= "AND rate_id = '$rate_id' ";
        $sql .= "AND rate_date >= '" . date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)) . "' ";
        $sql .= "AND rate_date < '" . date('Y-m-d', mktime(0, 0, 0, $month + 1, 1, $year)) . "' ";
        $sql .= "ORDER BY rate_date ";
        $query = $this->db->query($sql);
        $rs = $query->result();
        foreach ($rs as $index => $value) {
            $rates[$value->rate_date] = $value->rate;
        }
        return $rates;
    }

    function update($rate_id, $room_id, $date1, $date2, $rate) {

        $sql = "DELETE ";
        $sql .= "FROM " . $this->table . " ";
        $sql .= "WHERE rate_id = '$rate_id' ";
        $sql .= "AND room_id = '$room_id' ";
        $sql .= "AND rate_date >= '$date1' ";
        $sql .= "AND rate_date <= '$date2' ";
        $this->db->query($sql);

        foreach ($rate as $index => $value) {
            $arr['room_id'] = $room_id;
            $arr['rate_id'] = $rate_id;
            $arr['rate_date'] = $index;
            $arr['rate'] = $value;
            $arr['entered'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $arr);
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    function delete_by_rate($rate_id) {
        $this->db->where('rate_id', $rate_id);
        $this->db->delete($this->table);
    }

    function get($room_id, $rate_id) {
        $this->db->order_by('rate_date', 'asc');
        $this->db->where('rate_id', $rate_id);
        $this->db->where('room_id', $room_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function clear() {
        $sql = "DELETE FROM " . $this->table . " ";
        $sql .= "WHERE rate_date < '" . date('Y-m-d') . "'";
        $this->db->query($sql);
    }

}
