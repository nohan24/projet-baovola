<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Stock extends CI_Controller
	{
        public function historique()
        {
            $data['title'] = 'Home.';
            $this->load->view('components/body', $data);
        }

        public function mouvement()
        {

        }

        public function etat_stock()
        {

        }

        public function entrepot()
        {

        }

        public function produit()
        {
            
        }
    }