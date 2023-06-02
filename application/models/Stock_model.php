<?php 
    class Stock_model extends CI_Model {
        public function insertProduit($nomProduit){
            $sql = "insert into produit values(default,%s)";
            $this->db->query(sprintf($sql,$this->db->escape($nomProduit)));
        }

        public function getProduit(){
            $this->db->select('*');
            $this->db->from("v_p_dispo");
            return $this->db->get()->result_array();
        }

        public function getEntrepot(){
            $this->db->select('*');
            $this->db->from("v_e_dispo");
            return $this->db->get()->result_array();
        }

        public function deleteProd($id){
            $sql = "insert into produit_non_dispo values(default,%s)";
            $this->db->query(sprintf($sql,$id));
        }

        public function insertEntrepot($e){
            $sql = "insert into entrepot values(default, %s,%s,%s)";
            $this->db->query(sprintf($sql,$this->db->escape($e['adresse']),$e['superficie'],$e['hauteur']));
            $prod = $this->getProduit();
            foreach ($prod as $p) {
                $sql = "insert into detail_entrepot values(default,currval('entrepot_seq'),%s,%s)";
                $this->db->query(sprintf($sql,$p['produitid'],$e['p'.$p['produitid']]));
            }
        }
    }