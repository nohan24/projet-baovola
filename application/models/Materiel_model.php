<?php 
    class Materiel_model extends CI_Model {
        public function insertFournisseur($nomFournisseur,$coordonne,$adresse){
            $sql = "insert into fournisseur values(default,%s,%s,%s)";
            $this->db->query(sprintf($sql,$this->db->escape($nomFournisseur,$coordonne,$adresse)));
        }


        public function selectFournisseur_id($id){
            $this->db->select('*');
            $this->db->from("fournisseur");
            $this->db->where("idFournisseur",$id);
            return $this->db->get()->result_array();
        }
        public function selectFournisseur(){
            $this->db->select('*');
            $this->db->from("fournisseur");
            return $this->db->get()->result_array();
        }

        public function deleteFournisseur($id){
            $sql = "delete * from fournisseur where FournisseurId=%s" ;
            $this->db->query(sprintf($sql,$id));
        }
        public function updateFournisseur($nomFournisseur,$coordonne,$adresse,$id){
            $sql = "update fournisseur set  Nom=%s,Coordonne=%s,Adresse=%s where FournisseurId=%s" ;
            $this->db->query(sprintf($sql,$nomFournisseur,$coordonne,$adresse,$id));
        }
        public function achatMateriel($idFournisseur,$nom_materiel,$date_achat,$type_materiel,$quantite,$prix_unitaire ){
            $sql = "insert into achat_materiel values(default,%s,%s,%s,%s,%s,%s)";
            $this->db->query(sprintf($sql,$this->db->escape($idFournisseur,$nom_materiel,$date_achat,$type_materiel,$quantite,$prix_unitaire)));
        }
        public function locationMateriel($idFournisseur,$nom_materiel,$date_debut,$duree,$quantite,$prix_unitaire_jour ){
            $sql = "insert into location_materiel values(default,%s,%s,%s,%s,%s,%s)";
            $this->db->query(sprintf($sql,$this->db->escape($idFournisseur,$nom_materiel,$date_debut,$duree,$quantite,$prix_unitaire_jour)));
        }
        public function selectAchatMateriel(){
            $this->db->select('*');
            $this->db->from("v_achat_materiel");
            return $this->db->get()->result_array();
        }

        public function deleteAchatMateriel($id){
            $sql = "delete * from achat_materiel where FournisseurId=%s" ;
            $this->db->query(sprintf($sql,$id));
        }

     
    }