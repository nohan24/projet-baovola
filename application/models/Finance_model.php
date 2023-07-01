<?php
class Finance_model extends CI_Model
{
    public function select_v_mouvement_financier()
    {
        $sql="select * from v_mouvement_financier";
        $query=$this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }

    public function select_v_charge()
    {
        $sql="select * from v_charge";
        $query=$this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }

    public function select_v_vente()
    {
        $sql="select * from v_vente";
        $query=$this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }
    public function insertVente($Date_transac,$Libelle,$Quantite,$UniteId,$Unitaire){
        $query=	$this->db->query(sprintf("insert into transac(etat,Date_transac,Libelle,Quantite,UniteId,Unitaire) values(7,'%s','%s',%s,%s,%s)"
        ,$Date_transac,$Libelle,$Quantite,$UniteId,$Unitaire));
    }
    public function insertCharge($Date_transac,$Libelle,$Quantite,$UniteId,$Unitaire){
        $query=	$this->db->query(sprintf("insert into transac(etat,Date_transac,Libelle,Quantite,UniteId,Unitaire) values(6,'%s','%s',%s,%s,%s)"
        ,$Date_transac,$Libelle,$Quantite,$UniteId,$Unitaire));
    }
    public function getUnite(){
        $sql="select * from unite";
        $query=$this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }
}
?>