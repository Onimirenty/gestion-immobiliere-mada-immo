<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ImportProcess_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTypeMaisonByName($name)
    {
        $sql = "nom='%s'";
        $sql = sprintf($sql, $name);
        return $this->Dao_M->selectWithCondition("type_maison", $sql);
    }
    public function getDevisTravailTypeMaisonByIdTravail($id)
    {
        $sql = "id_devis_travail_type_maison='%s'";
        $sql = sprintf($sql, $id);
        return $this->Dao_M->selectWithCondition("devis_travail_type_maison", $sql);
    }
    public function getFinitionByName($name)
    {
        $sql = "nom_finition='%s'";
        $sql = sprintf($sql, $name);
        return $this->Dao_M->selectWithCondition("finition", $sql);
    }
    public function getDevisTravailTypeMaisonClientByIdTravailANDIdClientAndIdFinitionANDByDate($idTravail,$idClient,$idFinition,$date)
    {
        $sql = "id_devis_travail_type_maison='%s' AND id_client='%s' AND id_finition ='%s' AND date_debut_travail='%s' ";
        $sql = sprintf($sql, $idTravail,$idClient,$idFinition,$date); 
        return $this->Dao_M->selectWithCondition("devis_travail_type_maison", $sql);
    }
    public function getFinitionByFinitionRate($name)
    {
        $sql = "pourcentage_augmentation='%s'";
        $sql = sprintf($sql, $name);
        return $this->Dao_M->selectWithCondition("finition", $sql);
    }
    public function getClientById($id)
    {
        $sql = "id_client='%s'";
        $sql = sprintf($sql, $id);
        return $this->Dao_M->selectWithCondition("client", $sql);
    }
}
