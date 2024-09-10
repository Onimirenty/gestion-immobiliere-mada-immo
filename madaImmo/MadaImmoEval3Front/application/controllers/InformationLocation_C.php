<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class InformationLocation_C extends Prime_C
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('InformationLocation_M');
    }
    public function index()
    {
        if (isset($_SESSION['LocataireInfo'])) {
            $locataire = $_SESSION['LocataireInfo'];
            $email = $locataire['email'];
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            if ($date_debut == null) {
                $date_debut = '1900-01-01';
            }
            if ($date_fin == null) {
                $date_fin = '2100-01-01';
            }
            // $data['chiffre_affaires'] = $this->Proprietaire_M->getDetailChiffreAffairesByContactProprietaireAndDates($contact, $date_debut, $date_fin);
            // $data['chiffre_d_affaires'] = $this->Proprietaire_M->getChiffreAffairesProprietaires($date_debut, $date_fin, $contact)[0]['chiffre_affaires'];

            $data['information_location'] = $this->InformationLocation_M->getInformationLocation($date_debut, $date_fin, $email);
            $this->load->view('static/header');
            $this->load->view('pages/Information_location_v', $data);
            $this->load->view('static/footer');
        }
    }
}
