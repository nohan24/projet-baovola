<?php
class Tableau_model extends CI_Model
{
    public function getStat()
    {
        $result=[];
        for($i=0;$i<12;$i++)
        {
            $sql="SELECT produitid, SUM(quantite) FROM sortie_stock WHERE EXTRACT(MONTH FROM date_sortie) = "+$i+" GROUP BY produitid, type_sortie";
            $query=$this->db->query($sql);
            $result[$i]=$query->result_array();
        }
        return $result;
    }
}