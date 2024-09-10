<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bien_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getBienBycontact($contact)
    {
        return $this->Dao_M->selectWithCondition("", "contact='{$contact}' ");
    }
    public function getBienByIdBien($id)
    {
        return $this->Dao_M->selectWithCondition("biens", "id_bien='{$id}' ");
    }
    public function getBienByReferenceBien($reference)
    {
        return $this->Dao_M->selectWithCondition("biens", "reference_bien='{$reference}' ");
    }
    
}
