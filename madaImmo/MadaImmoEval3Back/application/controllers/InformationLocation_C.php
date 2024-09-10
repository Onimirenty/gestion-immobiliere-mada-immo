<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');

// use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\ImageManager;

class InformationLocation_C extends Prime_C
{
    public static $controller_name = 'InformationLocation_C';

    public function __construct()
    {
        parent::__construct();
        require_once FCPATH . 'vendor/autoload.php';
        require_once  'vendor/autoload.php';

        $this->load->model('InformationLocation_M');
        $this->load->model('Photos_M');
        $this->load->model('Bien_M');


    }
    public function index()
    {
        $data['information_location'] = $this->InformationLocation_M->getAllInformationLocation();
        $data['titre_page'] = "Détails sur les habitations";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $this->load->view('static/header', $data);
        $this->load->view('pages/Information_location_v', $data);
        $this->load->view('static/footer');
    }


    public function voirPhotos()
    {
        $reference = $this->input->get('var');
        $photos = $this->InformationLocation_M->getPhotosByReferenceBien($reference);
        $data['bien'] = $this->Bien_M->getBienByReferenceBien($reference);

        foreach ($photos as $photo) {
            $imagePath = FCPATH . $photo['url'];

            $imageManager = new ImageManager();
            try {
                $image = $imageManager->make($imagePath);
                $image->save($imagePath, 60);
                // echo 'Image optimisée avec succès!';
            } catch (Exception $e) {
                echo 'Erreur d\'optimisation : ' . $e->getMessage();
            }
        }

        $data['photos'] = $photos;
        $data['titre_page'] = "Affichage de photos et description des habitations";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['titre_page'] = "Images de " . $data['bien'][0]['nom_bien'];
        $this->load->view('pages/photos_bien_V', $data);
    }
}
