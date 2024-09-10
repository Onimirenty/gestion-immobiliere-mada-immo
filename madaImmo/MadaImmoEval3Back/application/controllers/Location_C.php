<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');

class Location_C extends Prime_C
{
    public static $controller_name = 'Location_C';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Location_M');
        $this->load->library('form_validation');
    }

    // Afficher le formulaire
    public function create()
    {
        $data['biens'] = $this->Location_M->get_biens_disponibles();
        $data['locataires'] = $this->Location_M->get_locataires();
        $data['titre_page'] = "Formulaire d''insertion de nouvelle location";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['titre_page'] = "Assignation de domicile a un client";
        $data['script'] = "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>";
        $this->load->view('static/header', $data);
        $this->load->view('pages/LocationForm_V', $data);
        $this->load->view('static/footer');
    }

    // Gérer la soumission du formulaire
    public function store()
    {
        $this->form_validation->set_rules('id_bien', 'Bien', 'required');
        $this->form_validation->set_rules('id_locataire', 'Locataire', 'required');
        $this->form_validation->set_rules('date_debut', 'Date de début', 'required');
        $this->form_validation->set_rules('duree_mois', 'Durée (mois)', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_bien' => $this->input->post('id_bien'),
                'id_locataire' => $this->input->post('id_locataire'),
                'date_debut' => $this->input->post('date_debut'),
                'duree_mois' => $this->input->post('duree_mois'),
                'reference_bien' => $this->Location_M->get_bien_reference($this->input->post('id_bien'))
            );
            $this->Location_M->add_location($data);
            redirect('Location_C/success');
        }
    }

    // Gérer la soumission du formulaire via AJAX
    public function store_ajax()
    {
        $this->form_validation->set_rules('id_bien', 'Bien', 'required');
        $this->form_validation->set_rules('id_locataire', 'Locataire', 'required');
        $this->form_validation->set_rules('date_debut', 'Date de début', 'required');
        $this->form_validation->set_rules('duree_mois', 'Durée (mois)', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 'error', 'message' => validation_errors()];

            log_message('error', 'Validation Error: ' . validation_errors());
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        $data = array(
            'id_bien' => $this->input->post('id_bien'),
            'id_locataire' => $this->input->post('id_locataire'),
            'date_debut' => $this->input->post('date_debut'),
            'duree_mois' => $this->input->post('duree_mois'),
            'reference_bien' => $this->Location_M->get_bien_reference($this->input->post('id_bien'))
        );

        if ($this->Location_M->add_location($data)) {
            $response = ['status' => 'success', 'message' => 'Location ajoutée avec succès.'];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $response = ['status' => 'error', 'message' => 'Échec de l\'ajout de la location.'];
            log_message('error', 'Database Error: Échec de l\'ajout de la location.');
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }



    // Page de succès
    public function success()
    {
        $data['titre_page'] = "succes location";
        $this->load->view('static/header', $data);
        $this->load->view('pages/location_success');
        $this->load->view('static/footer');
    }
}
