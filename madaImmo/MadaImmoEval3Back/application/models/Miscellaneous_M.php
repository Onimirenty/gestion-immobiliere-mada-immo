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

    function enleverPourcent($texte)
    {
        // Utilise str_replace pour remplacer le caractère '%' par une chaîne vide
        $texte_sans_pourcent = str_replace('%', '', $texte);
        return $texte_sans_pourcent;
    }
    function convertirEnEntier($texte)
    {
        // Supprime les espaces blancs en début et fin de chaîne
        $texte = trim($texte);
        // Utilise intval pour convertir le texte en entier
        return intval($texte);
        // // Exemple d'utilisation
        // $texte = "123";
        // $nombre = convertirEnEntier($texte);
        // echo $nombre; // Affichera: 123
    }
    public function texteEnDouble($texte)
    {
        // Supprime les espaces blancs en début et fin de chaîne
        $texte = trim($texte);

        // Utilise str_replace pour s'assurer que les virgules sont remplacées par des points (pour les décimales)
        $texte = str_replace(',', '.', $texte);

        // Utilise floatval pour convertir le texte en nombre flottant
        $nombre = floatval($texte);

        // Utilise sprintf pour formater le nombre avec 4 chiffres après la virgule
        $nombre_formate = sprintf("%.4f", $nombre);

        // Retourne le nombre formaté comme double
        // return (float)$nombre_formate;
        return number_format($nombre, 4, '.', '');
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
    function has_repeated_values($array)
    {
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
