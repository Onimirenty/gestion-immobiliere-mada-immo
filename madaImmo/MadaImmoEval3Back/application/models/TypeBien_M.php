<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TypeBien_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTypeBienById($id)
    {
        return $this->Dao_M->selectWithCondition("type_bien", "id_type_bien={$id}");
    }
    public function getTypeBienByNomType($nom)
    {
        return $this->Dao_M->selectWithCondition("type_bien", "nom_type_bien='{$nom}' ");
    }
    public function insertTypeBien($associative_array)
    {
        return $this->Dao_M->insert("type_bien", $associative_array);
    }
    public function getTypeBienByIdBien($id_bien)
    {
        return $this->Dao_M->selectWithCondition('v_type_bien_biens', "id_bien={$id_bien}");
    }
    public function getTypeBienByReferenceBien($ref_bien)
    {
        return $this->Dao_M->selectWithCondition('v_type_bien_biens', "reference_bien={$ref_bien}");
    }
}
