    <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proprietaire_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getProprieteByContactProprietaire($contact)
    {
        return $this->Dao_M->selectWithCondition("v_liste_biens_proprietaires_avec_disponibilite", "contact_proprietaire='{$contact}'");
    }

    public function getDetailChiffreAffairesByContactProprietaireAndDates($contact, $date_debut, $date_fin)
    {
        // Extract the month and year from the start and end dates
        $date_debut_truncated = date('Y-m-d', strtotime($date_debut));
        $date_fin_truncated = date('Y-m-d', strtotime($date_fin));

        // Prepare the SQL query with explicit type casting
        $sql = "SELECT * FROM information_location 
                WHERE contact_proprietaire = ? 
                AND DATE_TRUNC('month', date_debut::date) BETWEEN DATE_TRUNC('month', ?::date) AND DATE_TRUNC('month', ?::date)";

        $query = $this->db->query($sql, array($contact, $date_debut_truncated, $date_fin_truncated));
        return $query->result_array();
    }



    public function getChiffreAffairesProprietaires($date_debut, $date_fin, $contact)
    {
        $query = $this->db->query("SELECT * FROM f_get_chiffre_affaires_proprietaires(?, ?) WHERE contact_proprietaire = ?", array($date_debut, $date_fin, $contact));
        return $query->result_array();
    }
}
