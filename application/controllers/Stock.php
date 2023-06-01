<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Stock extends CI_Controller
	{
        public function historique($mv = "sortie")
        {
            if($mv == "sortie"){
                $data['title'] = "Historique de sortie.";
                $data['content'] = "stock/historique_sortie";
                $this->load->view('components/body',$data);
            }else{
                $data['title'] = "Historique d'entrée.";
                $data['content'] = "stock/historique_entree";
                $this->load->view('components/body',$data);
            }   
        }

        public function mouvement()
        {
            $data['title'] = "Mouvement de stock."; 
            $data['content'] = "stock/mouvement";
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
            
        }
    }