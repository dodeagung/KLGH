<?php

class Creditcard extends CI_Model {

    public function get() {

        $arr[] = 'Visa';
        $arr[] = 'Master Card';
        return $arr;
    }

}
