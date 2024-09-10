<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class ListeLocation_C extends Prime_C
{
    public static $controller_name = 'ListeLocation_C';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InformationLocation_M');
        $this->load->model('Location_M');
    }
    public function index()
    {
        $data['listeLocation'] = $this->Location_M->getListeLocation();
        $data['titre_page'] = 'Détails sur les habitations';
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['titre_page'] = "Listes des maisons loue";
        $this->load->view('static/header', $data);
        $this->load->view('pages/ListeLocation_V', $data);
        $this->load->view('static/footer');
        echo "<script>";
        echo "const listeLocation = " . json_encode($data['listeLocation']) . ";";
        echo "listeLocation.forEach(function(info) { ajouterLocationDansIndexDB(info); });";
        echo "</script>";
    }
    public function detailsLocation($var)
    {
        $this->load->model('Comparaison_M');
        $reference = $var;
        // $max=$this->Comparaison_M->getMax();
        $color=$this->Comparaison_M->ColorizeIfInRange(500000,'red');
        // echo "<pre>";
        // print_r($max);
        // echo $color;
        // echo "</pre>";
        // show_error("dd");
        // $data['color'] = $color;
        $data['information_locations'] = $this->InformationLocation_M->getInformationLocationByReference($reference);
        $data['titre_page'] = "Détails sur les habitations";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['script'] = "
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js\"></script>
        
";
        $this->load->view('static/header', $data);
        $this->load->view('pages/DetailsLocation_V', $data);
        $this->load->view('static/footer');
    }
}
