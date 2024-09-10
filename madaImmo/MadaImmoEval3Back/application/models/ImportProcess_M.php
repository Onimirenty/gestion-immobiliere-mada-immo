<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImportProcess_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proprietaire_M');
        $this->load->model('TypeBien_M');
        $this->load->model('Locataire_M');
        $this->load->model('Bien_M');
        // $this->load->model();
    }
    public function insertTypeBien($tab_type_bien)
    {
        $condition = true;
        foreach ($tab_type_bien as $value) {
            $type_bien = $this->TypeBien_M->getTypeBienByNomType($value['type']);
            if ($type_bien != null || !empty($type_bien)) {
                continue;
            }
            // print_r($value);
            $pourcentageTexte = $this->Miscellaneous_M->enleverPourcent($value['commission']);
            $commission =  $this->Miscellaneous_M->texteEnDouble($pourcentageTexte);
            // echo $pourcentageTexte ."<br>";
            // echo $commission ."<br>";
            // show_error("");
            $commission = number_format($commission / 100, 4, '.', '');
            $type_bien = array(
                "nom_type_bien" => $value['type'],
                "commission" => $commission
            );
            $condition = $condition && $this->Dao_M->insert("type_bien", $type_bien);
        }
        if ($condition == false) {
            return false;
        }
        return $condition;
    }
    public function insertBiens($tab_bien)
    {
        $condition = true;
        $tab = $tab_bien;
        foreach ($tab as $value) {
            $proprietaire = $this->Proprietaire_M->getProprietaireByContact($value['proprietaire']);
            if ($proprietaire == null || empty($proprietaire)) {
                $proprietaire = array(
                    "contact" => $value['proprietaire']
                );
                $status = true;
                $status = $this->Proprietaire_M->insertProprietaire($proprietaire);
                $proprietaire = $this->Proprietaire_M->getProprietaireByContact($value['proprietaire']);
                if ($status == false) {
                    throw new Exception("Error Processing Request", 1);
                }
            }
            $id_prorietaire = $proprietaire[0]['id_proprietaire'];
            $type_bien = $this->TypeBien_M->getTypeBienByNomType($value['type']);
            if ($type_bien == null || empty($type_bien)) {
                $type_bien = array(
                    "nom_type_bien" => $value['type'],
                    "commission" => 0
                );
                $status = true;
                $status = $this->TypeBien_M->insertTypeBien($type_bien);
                if ($status == false) {
                    throw new Exception("Error Processing Request", 1);
                }
            }

            $id_type_bien = $this->TypeBien_M->getTypeBienByNomType($value['type'])[0]['id_type_bien'];
            $bat = array(
                "reference_bien" => $value['reference'],
                "nom_bien" => $value['nom'],
                "description_bien" => $value['description'],
                "region" => $value['region'],
                "loyer_par_mois" => $value['loyer_mensuel'],
                "id_proprietaire" => $id_prorietaire,
                "id_type_bien" => $id_type_bien
            );
            $condition = $condition && $this->Dao_M->insert("biens", $bat);
        }
        if ($condition == false) {
            // throw new Exception("Erreur dans Dao_M insertTabCsv", 1);
            return false;
        }
        return $condition;
    }
    public function insertLocation($tab_bien)
    {
        $condition = true;
        foreach ($tab_bien as $value) {
            $locataire = $this->Locataire_M->getLocataireByEmail($value['client']);
            if ($locataire == null || empty($locataire)) {
                $locataire = array(
                    "email" => $value['client']
                );
                $status = true;
                $status = $this->Locataire_M->insertLocataire($locataire);
                $locataire = $this->Locataire_M->getLocataireByEmail($value['client']);
                if ($status == false) {
                    throw new Exception("Error Processing Request", 1);
                }
            }
            $id_locataire = $locataire[0]['id_locataire'];

            $bien = $this->Bien_M->getBienByReferenceBien($value['reference'])[0];
            if ($bien == null || empty($bien)) {
                throw new Exception("le bien rechercher n'existe pas importe process", 1);
            }
            $id_bien = $bien['id_bien'];
            $location = array(
                "reference_bien" => $value['reference'],
                "id_locataire" => $id_locataire,
                "id_bien" => $id_bien,
                "date_debut" => $value['date_debut'],
                "duree_mois" => $value['duree_mois']
            );
            $condition = $condition && $this->Dao_M->insert("location_bien", $location);
        }
        if ($condition == false) {
            // throw new Exception("Erreur dans Dao_M insertTabCsv", 1);
            return false;
        }
        return $condition;
    }
}

            // $id_type_bien
            // print_r($proprietaire);
            // echo $id_type_bien;
            // show_error("UwU");