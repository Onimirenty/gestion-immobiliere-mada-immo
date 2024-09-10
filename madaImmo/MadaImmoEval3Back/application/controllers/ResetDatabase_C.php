<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class ResetDatabase_C extends Prime_C
{
    public static $controller_name = 'ResetDatabase_C';


    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data['titre_page'] = "reinitialisation de la base de donnees";
        $this->load->view('static/header', $data);
        $this->load->view('pages/Reset_V');
        $this->load->view('static/footer');
    }

    public function execute()
    {
        $result = $this->Dao_M->reset_database();
        if ($result) {
            $this->session->set_flashdata('message', 'Base de données réinitialisée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de la réinitialisation de la base de données.');
        }

        $data['titre_page'] = "succes reinitialisation";
        $this->load->view('static/header', $data);
        $this->load->view('pages/accueil');
        $this->load->view('static/footer');
    }
}
