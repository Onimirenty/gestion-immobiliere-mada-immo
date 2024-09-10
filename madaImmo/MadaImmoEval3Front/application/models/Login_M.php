<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function hasSessionBeenVerifed()
    {
        return $this->session->userdata("LogInfo");
    }
    public function getCorrespondingLocataire($email/*, $mdp*/)
    {
        // $sql = "select* from locataire where email='%s' and mdp='%s'";
        // $sql = sprintf($sql, $email, $mdp);

        $sql = "select* from locataire where email='%s' ";
        $sql = sprintf($sql, $email);
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result_array() as $row) {
            $result = $row;
        }
        return $result;
    }
    public function getCorrespondingProprietaire($conatct)
    {
        $sql = "select* from proprietaire where contact='%s' ";
        $sql = sprintf($sql, $conatct);
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result_array() as $row) {
            $result = $row;
        }
        return $result;
    }
    public function getCodexAdmin($mot)
    {
        // Récupérer les trois premiers caractères de la chaîne
        $troisPremiers = substr($mot, 0, 3);
        if ($troisPremiers === 'mir') {
            return true;
        } else {
            return false;
        }
    }

    public function getCorrespondingAdmin($nom, $mdp)
    {
        // $email = substr($email, 3);        
        $sql = "select* from admin where nom='%s' and mdp='%s'";
        $sql = sprintf($sql, $nom, $mdp);
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result_array() as $row) {
            $result = $row;
        }
        return $result;
    }
}
