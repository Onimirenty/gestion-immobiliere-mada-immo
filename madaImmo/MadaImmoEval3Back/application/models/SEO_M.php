<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SEO_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getMetadataByTitrePage($name)
    {
        return $this->Dao_M->selectWithCondition("v_page_metadata", "titre='{$name}'");
    }
    public function getMetadataBaliseByTitrePage($name)
    {
        $metadata = $this->getMetadataByTitrePage($name);
        if ($metadata) {
            $metaTags = '';
            foreach ($metadata as $meta) {
                $metaTags .= '<meta name="' . htmlspecialchars($meta['attribut'], ENT_QUOTES, 'UTF-8') . '" content="' . htmlspecialchars($meta['valeur'], ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
            }
            return $metaTags;
        } else {
            return '<!-- Aucune métadonnée disponible pour cette page -->';
        }
    }
}
