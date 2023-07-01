<?php
class Tableau_model extends CI_Model
{
    public function getStat($produit)
    {
        $t1 = $this->getLocal($produit);
        $t2 = $this->getExport($produit);
        $t3 = $this->getPerte($produit);
        $result = array($t1, $t2, $t3);
        return json_encode($result);
    }

    public function getPerte($produit)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT coalesce(SUM(quantite),0) as qtt FROM sortie_stock WHERE type_sortie=3 and produitid=$produit and EXTRACT(YEAR FROM date_sortie)= extract(year from now()) and EXTRACT(MONTH FROM date_sortie) = $i GROUP BY produitid, type_sortie";
            $query = $this->db->query($sql);
            if ($query->row_array()['qtt'] == null) {
                array_push($result, 0);
            } else {
                array_push($result, doubleval($query->row_array()['qtt']));
            }
        }
        return $result;
    }

    public function getLocal($produit)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT coalesce(SUM(quantite),0) as qtt FROM sortie_stock WHERE type_sortie=1 and produitid=$produit and EXTRACT(YEAR FROM date_sortie)= extract(year from now()) and EXTRACT(MONTH FROM date_sortie) = $i GROUP BY produitid, type_sortie";
            $query = $this->db->query($sql);
            if ($query->row_array()['qtt'] == null) {
                array_push($result, 0);
            } else {
                array_push($result, doubleval($query->row_array()['qtt']));
            }
        }
        return $result;
    }

    public function getExport($produit)
    {
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT coalesce(SUM(quantite),0) as qtt FROM sortie_stock WHERE type_sortie=2 and produitid=$produit and EXTRACT(YEAR FROM date_sortie)= extract(year from now()) and EXTRACT(MONTH FROM date_sortie) = $i GROUP BY produitid, type_sortie";
            $query = $this->db->query($sql);
            if ($query->row_array()['qtt'] == null) {
                array_push($result, 0);
            } else {
                array_push($result, doubleval($query->row_array()['qtt']));
            }
        }
        return $result;
    }
}
