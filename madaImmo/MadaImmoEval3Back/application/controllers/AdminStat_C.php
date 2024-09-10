<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class AdminStat_C extends Prime_C
{
    public static $controller_name = 'AdminStat_C';
    public function __construct()
    {
        parent::__construct();
        /* load les model necessaire
        $this->load->model();
        */
        $this->load->model('Proprietaire_M');
        $this->load->model('AdminStat_M');
    }
    public function index()
    {
    }

    public function gainAdmin()
    {
        if (isset($_SESSION['AdminInfo'])) {
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            if ($date_debut == null) {
                $date_debut = '1900-01-01';
            }
            if ($date_fin == null) {
                $date_fin = '2100-01-01';
            }
            $data['chiffre_affaires'] = $this->AdminStat_M->getDetailGainAdmin($date_debut, $date_fin);
            $data['chiffre_d_affaires'] = $this->AdminStat_M->getGainAdmin($date_debut, $date_fin)[0]['gain_admin'];
            $data['titre_page'] = "Le gain d''argent des administrateurs";
            $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
            $this->load->view('static/header', $data);
            $this->load->view('pages/GainAdmin_V', $data);
            $this->load->view('static/footer');
        } else {
            redirect('Login_C/proprietaireForm');
        }
    }
    public function chiffreAffaire()
    {
        if (isset($_SESSION['AdminInfo'])) {
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            if ($date_debut == null) {
                $date_debut = '1900-01-01';
            }
            if ($date_fin == null) {
                $date_fin = '2100-01-01';
            }
            $data['chiffre_affaires'] = $this->AdminStat_M->getDetailGainAdmin($date_debut, $date_fin);
            $data['chiffre_d_affaires'] = $this->AdminStat_M->getChiffreAffaireTotal($date_debut, $date_fin)[0]['chiffre_affaire_total'];

            $data['titre_page'] = "Chiffre d''affaire de Mada Immo";

            $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);

            $this->load->view('static/header', $data);
            $this->load->view('pages/ChiffreAffaire_V', $data);
            $this->load->view('static/footer');
        } else {
            redirect('Login_C/proprietaireForm');
        }
    }
}
