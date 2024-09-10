<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class DataImport_C extends Prime_C
{
    public static $controller_name = 'AdminStat_C';

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Normalizer_M");
        $this->load->model("Import_M");
        $this->load->model("ImportProcess_M");
        $this->load->model("InformationLocation_M");


        $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['titre_page'] = "Importation des données depuis des CSV";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['titre_page'] = "Import de donnees ,ajoute type bien ,bien et commission";
        $this->load->view('static/header', $data);
        $this->load->view('pages/import_csv', $data);
        $this->load->view('static/footer');
    }

    public function importCSVFile()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 10000; // Taille maximale en kilobytes

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('csv_file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('pages/import_csv', $error);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/' . $file_data['file_name'];
            $csvTab = $this->csvToArray($file_path);
            if ($csvTab) {
                // echo "Importation réussie";
                print_r($csvTab['assoc'][1]['nombre random']);
                echo "<br>";
                print_r($csvTab['num'][1]);
            } else {
                echo "Erreur lors de l'importation";
            }
        }
    }

    public function importCSV()
    {
        $this->load->model('ImportProcess_M');
        if (!isset($_FILES['biens']['tmp_name']) && !isset($_FILES['locations']['tmp_name']) && !isset($_FILES['typeBien']['tmp_name'])) {
            $error = array('error' => 'Aucun fichier envoyé.');
            $this->load->view('pages/import_csv', $error);
            return;
        }
        $file_path_typeBien = $_FILES['typeBien']['tmp_name'];
        $file_path_biens = $_FILES['biens']['tmp_name'];
        $file_path_locations = $_FILES['locations']['tmp_name'];

        $tab_type_bien = $this->Import_M->csvToArray($file_path_typeBien)['assoc'];
        $tab_bien = $this->Import_M->csvToArray($file_path_biens)['assoc'];
        $tab_location = $this->Import_M->csvToArray($file_path_locations)['assoc'];

        $this->db->trans_start();
        $insert_type_bien_status = $this->ImportProcess_M->insertTypeBien($tab_type_bien);
        if ($insert_type_bien_status) {
            $insert_bien_status = $this->ImportProcess_M->insertBiens($tab_bien);
            if ($insert_bien_status) {
                $insert_location_status = $this->ImportProcess_M->insertLocation($tab_location);
                if ($insert_location_status) {
                    try {
                        $this->InformationLocation_M->insertInformationLocation();
                    } catch (Exception $e) {
                        echo "Failed to populate Information Location table: " . $e->getMessage();
                    }
                    $this->db->trans_commit();
                    $this->db->trans_complete();
                    
                    $data['titre_page'] = "Importation des données depuis des CSV";
                    $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
                    $data['titre_page'] = "Import de donnees ,ajoute type bien ,bien et commission";


                    $this->load->view('static/header', $data);
                    $this->load->view('pages/Reset_V');
                    $this->load->view('static/footer');
                }
            }
        } else {
            throw new Exception("Dual import failed in controller DataImport ligne 70 ");
        }
    }
}
    /*
function square($n) {
    return $n * $n;
}
$a = [1, 2, 3, 4, 5];
$b = array_map('square', $a);
print_r($b); // Affiche [1, 4, 9, 16, 25]

2. fopen()

Description :
fopen() est utilisée pour ouvrir un fichier ou un URL dans un mode spécifique.

Arguments :

    filename: Le chemin vers le fichier ou l'URL.
    mode: Le mode dans lequel le fichier sera ouvert, 
    par exemple 'r' pour lecture seule,
    'w' pour écriture (efface tout contenu existant), etc.
$handle = fopen("data.txt", "r");


3. fgetcsv()

Description :
fgetcsv() lit une ligne à partir du fichier pointé par le handle et la parse en tant que champs CSV.

Arguments :
    handle: La ressource de fichier (file handle) retournée par fopen().
    length: Optionnel, spécifie la longueur maximale de la ligne à lire.
    separator: Optionnel, le caractère utilisé pour séparer les champs (défaut est la virgule ,).

while ($data = fgetcsv($handle, 1000, ",")) {
    // traitement de $data
}
*/
