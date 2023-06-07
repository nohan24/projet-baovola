<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Finance extends CI_Controller
	{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Stock_model');
        }

        public function mouvement()
        {
            $data['title'] = "Mouvement.";
            $data['content'] = "finance/mouvement";
            $this->load->view('components/body',$data);
        }
        public function vente()
        {
            $data['title'] = "Produit.";
            $data['content'] = "finance/vente";
            $this->load->view('components/body',$data);
        }
        public function charge()
        {
            $data['title'] = "Produit.";
            $data['content'] = "finance/charge";
            $this->load->view('components/body',$data);
        }
    }