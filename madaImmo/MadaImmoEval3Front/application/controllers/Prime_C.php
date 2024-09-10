<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prime_C extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        /* load les model necessaire
        $this->load->model()
        */
            if(!$this -> session -> userdata("LogInfo")) {
                redirect("/");
            }
    }

}