<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Stock extends CI_Controller
	{
        public function historique($mv = "sortie")
        {
            if($mv == "sortie"){
                $data['title'] = "Historique de sortie.";
                $data['content'] = "stock/historique_sortie";
            }else{
                $data['title'] = "Historique d'entrée.";
                $data['content'] = "stock/historique_entree";
            }   
            $this->load->view('components/body',$data);
        }

        public function mouvement($mvt = "sortie")
        {
            $data['title'] = "Mouvement de stock."; 
            if($mvt == "sortie"){
                $data['content'] = "stock/mouvement_sortie";
            }else{
                $data['content'] = "stock/mouvement_entree";
            }
            $this->load->view('components/body',$data);
        }

        public function etat()
        {

        }

        public function entrepot()
        {

        }

        public function produit()
        {
            $data['title'] = "Produit.";
            $data['content'] = "stock/produit";
            $this->load->view('components/body',$data);
        }
    }