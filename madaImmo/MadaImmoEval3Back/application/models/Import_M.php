<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function csvToArray($filename)
    {
        $dataArray = array();

        if (($handle = fopen($filename, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row == 0) {
                    // Normaliser les noms des colonnes en supprimant les espaces
                    $header = array_map([$this->Normalizer_M, 'normalizeWithSpace'], $data);
                } else {
                    // Créer un tableau associatif avec des données où les espaces sont conservés
                    $normalizedData = array_map([$this->Normalizer_M, 'normalize'], $data);
                    $dataArray['assoc'][$row] = array_combine($header, $normalizedData);
                    // Créer un tableau numérique avec des données où les espaces sont conservés
                    $dataArray['num'][$row] = $normalizedData;
                }
                $row++;
            }
            fclose($handle);
        }

        return !empty($dataArray) ? $dataArray : false;
    }

    public function importCSV()
    {
        // Gérer le fichier CSV envoyé
        if (!isset($_FILES['csv_file']['tmp_name'])) {
            $error = array('error' => 'Aucun fichier envoyé.');
            $this->load->view('pages/import_csv', $error);
            return false;
        }
        $file_path = $_FILES['csv_file']['tmp_name']; // Utiliser le chemin temporaire
        $this->csvToArray($file_path);
    }
    public function importProcess($file_path_etapes, $file_path_resultats)
    {
        $tab_etapes = $this->Import_M->csvToArray($file_path_etapes)['assoc'];

        $condition = !empty($tab_etapes);
        if ($condition) {
            $this->db->trans_start();

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception("update failed during import");
            }
            return true;
        }
    }
}
