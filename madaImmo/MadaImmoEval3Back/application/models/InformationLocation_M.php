<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InformationLocation_M extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TypeBien_M');
        $this->load->model('Bien_M');
        $this->load->model('Locataire_M');
        $this->load->model('proprietaire_M');
        $this->load->model('Location_M');
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
                    'email_locataire' => $rec->email_locataire
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
    public function getInformationLocationByReference($reference)
    {
        return $this->Dao_M->selectWithCondition("v_information_Location", "reference_bien = '{$reference}'");
    }
    public function getPhotosByReferenceBien($reference)
    {
        return $this->Dao_M->selectWithCondition("v_photos_biens", "reference_bien = '{$reference}'");
    }
    // public function insertProcessLocationDansInfoLocation($id_location_bien,$id_bien,$id_locataire, $date_debut, $duree_mois)
    // {
    //     $TypeBien = $this->TypeBien_M;
    //     $Bien = $this->Bien_M;
    //     $Locataire = $this->Locataire_M;
    //     $Proprio = $this->proprietaire_M;

    //     $LocataireInstance = $Locataire->getLocataireByIdLocataire($id_locataire)[0];
    //     $bienInstance= $Bien->getBienByIdBien($id_bien)[0];
    //     $typeBienInstance = $TypeBien->getTypeBienByIdBien($id_bien)[0];
    //     $ProprioInstance = $Proprio->getProprietaireByIdBien($id_bien)[0];      

    //     $locationInstance = $this->Location_M->getLocationBienByIdLocation($id_location_bien)[0];
    //     $reference_bien = $bienInstance['reference_bien'];

    //     $date_fin = date('Y-m-d', strtotime($locationInstance['date_debut'] . ' + ' . $locationInstance['duree_mois'] . ' months'));
    //     $info_location = array(
    //         "reference_bien"=>$reference_bien,
    //         "type_bien"=>$typeBienInstance['type_bien'],
    //         "loyer_mensuel"=> $bienInstance['loyer_par_mois'],
    //         "commission" => $typeBienInstance['commission'],
    //         "date_debut" =>$locationInstance['date_debut'],
    // "duree_mois" =>$locationInstance['duree_mois'],
    // "contact_proprietaire"=>$ProprioInstance['contact'],
    // "id_location_bien"=>$id_location_bien,
    // "email_locataire"=>$LocataireInstance['email'],
    // "gain_proprio" => $bienInstance['loyer_mensuel'] * (1 - $typeBienInstance['commission']),
    // "gain_mada_immo" =>$bienInstance['loyer_mensuel'] * $typeBienInstance['commission'],
    // "loyer_locataire"  =>$bienInstance['loyer_mensuel']
    // "date_fin" => $date_fin,
    // "mois" =>   
    // "annee" 
    // "numero_mois"
    //     );



    // }
}
