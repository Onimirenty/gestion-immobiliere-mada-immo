<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Locataire_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertLocataire( $associative_array)
    {
        return $this->Dao_M->insert("locataire", $associative_array);
    }
    public function getAllLocataire()
    {
        return $this->Dao_M->getAll("locataire");
    }
    public function getLocataireByEmail($email)
    {
        return $this->Dao_M->selectWithCondition("locataire","email='{$email}'");
    }
    //     public function getAllLocataire()
    // {
    //     return $this->Dao_M->getAll("locataire");
    // }
    public function getLocataireByIdLocataire($id)
    {
        return $this->Dao_M->selectWithCondition("locataire","id_locataire='{$id}'");
    }
}
