<?php
defined('BASEPATH') or exit('No direct script access allowed');

class proprietaire_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertProprietaire( $associative_array)
    {
        return $this->Dao_M->insert("proprietaire", $associative_array);
    }
    public function getAllProprietaire()
    {
        return $this->Dao_M->getAll("proprietaire");
    }
    public function getProprietaireByContact($contact)
    {
        return $this->Dao_M->selectWithCondition("proprietaire","contact='{$contact}'");
    }
    public function getProprietaireByIdBien($id_bien)
    {
        return $this->Dao_M->selectWithCondition('v_liste_biens_proprietaires', "id_bien={$id_bien}");
    }
    public function getProprietaireByReferenceBien($ref_bien)
    {
        return $this->Dao_M->selectWithCondition('v_liste_biens_proprietaires', "reference_bien={$ref_bien}");
    }
}
