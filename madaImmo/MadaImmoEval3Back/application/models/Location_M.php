<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // Obtenir les biens disponibles
    public function get_biens_disponibles()
    {
        $query = $this->db->query("SELECT * FROM v_liste_biens_proprietaires");
        return $query->result();
    }

    // Obtenir les locataires
    public function get_locataires()
    {
        $query = $this->db->query("SELECT id_locataire, email FROM locataire");
        return $query->result();
    }

    // Ajouter une nouvelle location
    public function add_location($data)
    {
        return $this->db->insert('location_bien', $data);
    }

    // Obtenir la référence du bien
    public function get_bien_reference($id_bien)
    {
        $query = $this->db->select('reference_bien')
            ->from('biens')
            ->where('id_bien', $id_bien)
            ->get();
        $row = $query->row();
        return $row ? $row->reference_bien : null;
    }
    public function getLocationBienByIdLocation($id)
    {
        return $this->Dao_M->selectWithCondition("location_bien", "id_location_bien={$id}");
    }
    public function getListeLocation()
    {
        return $this->Dao_M->getAll("v_liste_location_details");
    }
}
