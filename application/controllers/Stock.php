<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Stock extends CI_Controller
	{
        public function historique($mv)
        {
            if($mv == "sortie"){
                $data['title'] = "Historique de sortie.";
                $data['content'] = "stock/historique_sortie";
                $this->load->view('components/body',$data);
            }
        }

        public function mouvement()
        {
         
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