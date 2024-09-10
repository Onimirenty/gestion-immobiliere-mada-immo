<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Miscellaneous_M extends CI_Model
{

    function numberToLetter($number)
    {
        if ($number < 1 || $number > 6) {
            throw new Exception("Invalid number. Number must be between 1 and 6.");
        }
        $letters = array("one", "two", "three", "four", "five", "six");
        return $letters[$number - 1];
    }

    function timestampToDateTime($timestamp)
    {
        $datetime = new DateTime($timestamp);
        return [
            'date' => $datetime->format('Y-m-d'),
            'time' => $datetime->format('H:i:s')
        ];
    }
    function dateTimeToTimestamp($date, $time)
    {
        // Convertir la date au format attendu (jour/mois/année -> année-mois-jour)
        $date_format = DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $datetime = $date_format . ' ' . $time;
        $timestamp = new DateTime($datetime);
        return $timestamp->format('d-m-Y H:i:s');
    }
    function refreshAllMV()
    {
        $this->Dao_M->refreshMV("mv_categories_coureurs");
        $this->Dao_M->refreshMV("mv_classement_par_temps");
        $this->Dao_M->refreshMV("mv_classement_general");
        sleep(0.5);
    }



    function containsDuplicateInteger($array)
    {
        $countArray = array(); // Tableau associatif pour compter les occurrences
        foreach ($array as $value) {
            if (isset($countArray[$value])) {
                // Si le nombre existe déjà dans le tableau associatif, on incrémente son compteur
                $countArray[$value]++;
            } else {
                // Sinon, on initialise son compteur à 1
                $countArray[$value] = 1;
            }

            // Si un nombre a déjà été rencontré plus d'une fois, on retourne vrai
            if ($countArray[$value] >= 2) {
                return true;
            }
        }
        // Si aucun nombre n'a été rencontré plus d'une fois, on retourne faux
        return false;
    }
    function get_repeated_values($array)
    {
        $count = [];

        // Compte les occurrences de chaque valeur
        foreach ($array as $value) {
            if (isset($count[$value])) {
                $count[$value]++;
            } else {
                $count[$value] = 1;
            }
        }

        // Filtre les valeurs qui apparaissent plus d'une fois
        $repeated_values = [];
        foreach ($count as $value => $occurrences) {
            if ($occurrences > 1) {
                $repeated_values[$value] = $occurrences;
            }
        }
        return $repeated_values;
    }
    function has_repeated_values($array) {
        $count = [];
        
        // Compte les occurrences de chaque valeur
        foreach ($array as $value) {
            if (isset($count[$value])) {
                return true; // Retourne true dès qu'une répétition est trouvée
            }
            $count[$value] = 1;
        }
        
        return false;
    }
}
