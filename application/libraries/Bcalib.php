<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BCAlib {

    private $bcalibs;

    function __construct() {
        /* require_once( APPPATH . 'third_party/BCA/bca.php' ); */

        $this->bcalibs = new \BCA\bca;
    }

  //fungsi ini untuk ovveride kalau ada yang memasuakkan nilai array pada parameter url
/*     public function __call($method, $url) {
        if (method_exists($this, $method)) {
            if ($this->seostats->setUrl($url[0])) {
                return call_user_func_array(array($this, $method),array());
            }

            return false;
        }
    } */

}
