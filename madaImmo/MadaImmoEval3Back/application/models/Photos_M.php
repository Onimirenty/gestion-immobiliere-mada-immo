<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Photos_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPhotosByidBien($id_bien)
    {
        return $this->Dao_M->selectWithCondition("v_photos_biens","id_bien = {$id_bien}");
    }
    public function getPhotosByReferenceBien($reference_bien)
    {
        return $this->Dao_M->selectWithCondition("v_type_bien_biens","reference_bien = {$reference_bien}");
    }
}
