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
            foreach ($tab_etapes as $etape) {

                $timestamp = $this->Miscellaneous_M->dateTimeToTimestamp($etape['date_depart'], $etape['heure_depart']);
                $etapeAInserer = array(
                    "nom_etape" => $etape['etape'],
                    "longueur_m" => (float)$etape['longueur'] * 1000,
                    "nb_coureurs_par_equipe" => $etape['nb_coureur'],
                    "num_etape" => $etape['rang'],
                    "date_heure_depart" => $timestamp
                );
                // echo "tmp => " . $timestamp;
                $numEtape = $etapeAInserer['num_etape'];
                $numEtapeBase = $this->Dao_M->selectWithCondition('etapes', "num_etape = '{$numEtape}' ");
                // sleep(1);
                // echo "<pre> ";
                // print_r($numEtapeBase);
                // echo "</pre> ";

                // show_error("-----------------------------");
                $sousCond = (count($numEtapeBase) > 0);
                //TOdO asina log(journal ny anomalie)
                if ($sousCond == false) {
                    $this->Dao_M->insert("etapes", $etapeAInserer);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception("update failed during import");
            }
            $tab_resultats = $this->Import_M->csvToArray($file_path_resultats)['assoc'];
            $condition2 = !empty($tab_resultats);
            if ($condition2) {
                $this->db->trans_start();
                foreach ($tab_resultats as $resultat) {
                    $genre = null;
                    if (strcasecmp($resultat['genre'], "F") == 0) {
                        $genre = 0;
                    } else {
                        $genre = 1;
                    }
                    $resultatAInserer = array(
                        "etape_rang" => $resultat['etape_rang'],
                        "num_dossard" => $resultat['numero_dossard'],
                        "nom_coureur" => $resultat['nom'],
                        "genre" => $genre,
                        "date_naissance" => $resultat['date_naissance'],
                        "equipe" => $resultat['equipe'],
                        "date_heure_arrive" => $resultat['arrivee']
                    );
                    $etape_rang = $resultatAInserer['etape_rang'];
                    $numDos = $resultat['numero_dossard'];
                    $resTest = $this->Dao_M->selectWithCondition('resultats', "etape_rang = '{$etape_rang}' and num_dossard = {$numDos} ");
                    //ToDo : implementation log
                    if (!(count($resTest)  > 0)) {
                        $this->Dao_M->insert("resultats", $resultatAInserer);
                    }
                }
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception("update failed during import");
                }
                return true;
            }
        }
    }
}
