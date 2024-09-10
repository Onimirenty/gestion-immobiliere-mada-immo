<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Prime_C.php');
class Locataire_C extends Prime_C {
    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        /* load les model necessaire
        ToDO :$this->load->model()
        */
        if(!$this -> session -> userdata("LogInfo")) {
            redirect("/");
        }
    }

}