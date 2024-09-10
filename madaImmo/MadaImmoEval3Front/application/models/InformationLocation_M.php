<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InformationLocation_M extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function insertInformationLocation()
    {
        $this->db->trans_start();

        $query = $this->db->query("SELECT * FROM v_liste_location_details");

        foreach ($query->result() as $rec) {
            $date_fin = date('Y-m-d', strtotime($rec->date_debut . ' + ' . $rec->duree_mois . ' months'));
            $data = array(
                'reference_bien' => $rec->reference_bien,
                'type_bien' => $rec->type_bien,
                'loyer_mensuel' => $rec->loyer_mensuel,
                'commission' => $rec->commission,
                'date_debut' => $rec->date_debut,
                'duree_mois' => $rec->duree_mois,
                'contact_proprietaire' => $rec->contact_proprietaire,
                'id_location_bien' => $rec->id_location_bien,
                'gain_proprio' => $rec->loyer_mensuel,
                'gain_mada_immo' => $rec->loyer_mensuel,
                'loyer_locataire' => $rec->loyer_mensuel * 2,
                'date_fin' => $date_fin,
                'mois' => $rec->mois,
                'annee' => $rec->annee,
                'numero_mois' => 1,
                'email_locataire' => $rec->email_locataire
            );
            $this->db->insert('information_location', $data);


            for ($i = 2; $i <= $rec->duree_mois; $i++) {
                $date_debut_new = date('Y-m-d', strtotime($rec->date_debut . ' + ' . ($i - 1) . ' months'));
                $data = array(
                    'reference_bien' => $rec->reference_bien,
                    'type_bien' => $rec->type_bien,
                    'loyer_mensuel' => $rec->loyer_mensuel,
                    'commission' => $rec->commission,
                    'date_debut' => $date_debut_new,
                    'duree_mois' => $rec->duree_mois,
                    'contact_proprietaire' => $rec->contact_proprietaire,
                    'id_location_bien' => $rec->id_location_bien,
                    'gain_proprio' => $rec->loyer_mensuel * (1 - $rec->commission),
                    'gain_mada_immo' => $rec->loyer_mensuel * $rec->commission,
                    'loyer_locataire' => $rec->loyer_mensuel,
                    'date_fin' => $date_fin,
                    'mois' => date('n', strtotime($date_debut_new)),
                    'annee' => date('Y', strtotime($date_debut_new)),
                    'numero_mois' => $i,

                );
                $this->db->insert('information_location', $data);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Error in transaction');
        }
    }

    public function getAllInformationLocation()
    {
        $query = $this->db->get('v_information_location');
        return $query->result();
    }
    public function getInformationLocation($date_debut, $date_fin, $email)
    {
        $query = $this->db->query("SELECT * FROM f_get_info_location(?, ?) WHERE email_locataire = ?", array($date_debut, $date_fin, $email));
        return $query->result_array();
    }
}
