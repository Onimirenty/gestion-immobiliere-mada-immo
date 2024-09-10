<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminStat_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getDetailGainAdmin($date_debut, $date_fin)
    {
        // Extract the month and year from the start and end dates
        $date_debut_truncated = date('Y-m-d', strtotime($date_debut));
        $date_fin_truncated = date('Y-m-d', strtotime($date_fin));
        // Prepare the SQL query with explicit type casting
        $sql = "SELECT * FROM information_location 
                WHERE DATE_TRUNC('month', date_debut::date) BETWEEN DATE_TRUNC('month', ?::date) AND DATE_TRUNC('month', ?::date)";
        $query = $this->db->query($sql, array($date_debut_truncated, $date_fin_truncated));
        return $query->result_array();
    }

    public function getGainAdmin($date_debut, $date_fin)
    {
        $query = $this->db->query("SELECT * FROM f_get_gain_admin(?, ?)", array($date_debut, $date_fin));
        return $query->result_array();
    }
    public function getChiffreAffaireTotal($date_debut, $date_fin)
    {
        $query = $this->db->query("SELECT * FROM f_get_chiffre_affaire_total(?, ?)", array($date_debut, $date_fin));
        return $query->result_array();
    }
}
