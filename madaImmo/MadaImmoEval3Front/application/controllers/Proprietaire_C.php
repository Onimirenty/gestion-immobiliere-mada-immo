<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class Proprietaire_C extends Prime_C
{
    public function __construct()
    {
        parent::__construct();
        /* load les model necessaire
        $this->load->model();
        */
        $this->load->model('Proprietaire_M');
    }
    public function index()
    {
    }
    public function listeBiens()
    {
        if (isset($_SESSION['ProprietaireInfo'])) {
            $proprio = $_SESSION['ProprietaireInfo'];
            $contact = $proprio['contact'];
            $data['biens'] = $this->Proprietaire_M->getProprieteByContactProprietaire($contact);
            $this->load->view('static/header');
            $this->load->view('pages/proprio/ListeBiens_V', $data);
            $this->load->view('static/footer');
        } else {
            show_error("erreur de session proprio_c");
        }
    }
    public function chiffreAffaires()
    {
        if (isset($_SESSION['ProprietaireInfo'])) {
            $proprio = $_SESSION['ProprietaireInfo'];
            $contact = $proprio['contact'];
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            if ($date_debut == null) {
                $date_debut = '1900-01-01';
            }
            if ($date_fin == null) {
                $date_fin = '2100-01-01';
            }
            $data['chiffre_affaires'] = $this->Proprietaire_M->getDetailChiffreAffairesByContactProprietaireAndDates($contact, $date_debut, $date_fin);
            $data['chiffre_d_affaires'] = $this->Proprietaire_M->getChiffreAffairesProprietaires($date_debut, $date_fin, $contact)[0]['chiffre_affaires'];
            // echo "<br> <pre>";
            // print_r($this->Proprietaire_M->get_chiffre_affaires_proprietaires($date_debut, $date_fin, $contact));
            // echo "<br> </pre>";

            // show_error("");

            $this->load->view('static/header');
            $this->load->view('pages/proprio/ChiffreAffaires_V', $data);
            $this->load->view('static/footer');
        } else {
            redirect('Login_C/proprietaireForm');
        }
    }
}
