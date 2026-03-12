<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comparaison_M extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getMin()
    {
        return $this->Dao_M->lastRow("comparaison","id_comparaison")['min']; 
    }
    public function getMax()
    {
        return $this->Dao_M->lastRow("comparaison","id_comparaison")['max']; 
    }
    public function InRange($value)
    {
        $max = $this->getMax();
        $min = $this->getMin();
        if($value<=$max && $value >= $min)
        {
            return true;
        }
        return false;
    }
    public function ColorizeIfInRange($value,$colore)
    {
        $condition=$this->InRange($value);
        if($condition == true)
        {
            return $colore;
        }
        return 'black';
    }
}
