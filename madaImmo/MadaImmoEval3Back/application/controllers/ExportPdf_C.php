<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class ExportPdf_C  extends Prime_C
{
    public static $controller_name = 'ExportPdf_C';
    
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        if (!$this->session->userdata("LogInfo")) {
            redirect("/");
        }
        $this->load->model("Classement_M");
    }
    public function index()
    {
        $data['s'] = "UwU OwO UwO (-W-)";
        $data['classement'] = $this->Classement_M->getClassementEquipeGeneral()[0];
        // echo "<pre>";
        // print_r($data['classement']);
        // echo "</pre>";
        // show_error("-----");

        $this->load->view('static/header');
        $this->load->view('pages/ExportPdf_V', $data);
        $this->load->view('static/footer');
    }
}
