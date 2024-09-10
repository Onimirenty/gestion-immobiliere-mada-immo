<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Normalizer_M extends CI_Model
{

    public function normalizeWithSpace($chaine)
    {
        $chaine = str_replace(' ', '_', $chaine);
        $chaine = str_replace('-', '_', $chaine);
        $chaine = strtolower($chaine);

        // Éliminer les caractères spéciaux sauf '-', ',', '_', et '.' avant la translittération
        $chaine = preg_replace('/[^\\p{L}0-9 ,._-]/u', '', $chaine);

        // Normaliser les caractères accentués en caractères non accentués
        $chaine = @iconv('UTF-8', 'ASCII//TRANSLIT', $chaine);

        // Supprimer tout ce qui n'est pas une lettre de l'alphabet anglais, un chiffre, un espace, un tiret, une virgule, un underscore ou un point
        $chaine = preg_replace('/[^a-z0-9 ,._-]/', '', $chaine);

        return $chaine;
    }
    /*
     * tsy mielimine espace 
     */
    function normalize($chaine)
    {
        // Convertir en minuscules
        $chaine = mb_strtolower($chaine, 'UTF-8');

        // Carte de translittération personnalisée
        $translitTable = array(
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o',
            'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
            'ý' => 'y', 'ÿ' => 'y', 'œ' => 'oe', 'æ' => 'ae', 'ß' => 'ss', '’' => "'", '‘' => "'", '“' => '"',
            '”' => '"', '–' => '-', '—' => '-'
        );

        // Appliquer la translittération personnalisée
        $chaine = strtr($chaine, $translitTable);
        // echo "<pre> " . $chaine ."</pre>" ;
        
        /* Éliminer les caractères spéciaux sauf '-', ',', '_', '.', et l'apostrophe */
        // $chaine = preg_replace('/[^a-z0-9 ,._\'’-]/u','', $chaine);

        return $chaine;
    }
    function enleverLettre($chaine)
    {
        $chaine = mb_strtolower($chaine, 'UTF-8');
        $translitTable = array(
            'à' => '', 'á' => '', 'â' => '', 'ã' => '', 'ä' => '', 'ç' => '', 'è' => '', 'é' => '',
            'ê' => '', 'ë' => '', 'ì' => '', 'í' => '', 'î' => '', 'ï' => '', 'ñ' => '', 'ò' => '',
            'ó' => '', 'ô' => '', 'õ' => '', 'ö' => '', 'ù' => '', 'ú' => '', 'û' => '', 'ü' => '',
            'ý' => '', 'ÿ' => '', 'œ' => 'e', 'æ' => 'e', 'ß' => 's', '’' => "'", '‘' => "'", '“' => '"',
            '”' => '"', '–' => '-', '—' => '-'
        );
        $chaine = strtr($chaine, $translitTable);
        return $chaine;
    }
}
