<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Stock extends CI_Controller
	{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Stock_model');
        }

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
            if($this->input->post()){
                if(isset($_POST['produit'])){
                    
                }
            }
            $data['title'] = "Produit.";
            $data['content'] = "stock/produit";
            $data['produits'] = $this->Stock_model->getProduit();
            $this->load->view('components/body',$data);
        }
    }