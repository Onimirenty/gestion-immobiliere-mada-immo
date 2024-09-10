<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RouterMirenty_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getRoute($route, $controller)
    {
        if ("back" == $route) {
            return "http://127.0.0.1/webproject/ultimateRaceBackOffice/" . $controller;
        }
        return "http://127.0.0.1/webproject/ultimateRaceFrontOffice/" . $controller;
    }
}
