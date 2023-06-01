<?php 
    class Stock_model extends CI_Model {
        public function insertProduit($nomProduit){
            $requete=array("Nom_produit"=>$nomProduit);
            $this->db->insert('produit',$requete);
        }

        public function getProduit(){
            return $this->db->query("SELECT * FROM produit")->result_array();
            // $this->db->select('*');
            // $this->db->from("produit");
            // return $this->db->get()->result_array();
        }
    }