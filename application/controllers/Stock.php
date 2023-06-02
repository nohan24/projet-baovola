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
                $data["historique"] = $this->Stock_model->getMvtSortie();
                $data['title'] = "Historique de sortie.";
                $data['content'] = "stock/historique_sortie";
            }else{
                $data["historique"] = $this->Stock_model->getMvtEntree();
                $data['title'] = "Historique d'entrée.";
                $data['content'] = "stock/historique_entree";
            }   
            $this->load->view('components/body',$data);
        }

        public function mouvement($mvt = "sortie")
        {
            $data['entrepots'] = $this->Stock_model->getEntrepot();
            $data['produits'] = $this->Stock_model->getProduit();
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

        public function entrepot($where="",$id=-1)
        {
            $data['title'] = "Entrepôt.";
            if($id == -1){
                $data['content'] = "stock/entrepot";
                $data['produits'] = $this->Stock_model->getProduit();
                $data['entrepots'] = $this->Stock_model->getEntrepot();
            }else{
                $data['content'] = "stock/info_entrepot";
            }
            $this->load->view('components/body',$data);
        }

        public function produit()
        {
            $data['title'] = "Produit.";
            $data['content'] = "stock/produit";
            $data['produits'] = $this->Stock_model->getProduit();
            $this->load->view('components/body',$data);
        }

        public function insertionProduit()
        {
            $this->Stock_model->insertProduit($_POST['produit']);
            redirect(site_url('stock/produit'));
        }

        public function insertionEntrepot()
        {
            $this->Stock_model->insertEntrepot($_POST);
            redirect(site_url('stock/entrepot'));
        }

        public function deleteProduit($id)
        {
            $this->Stock_model->deleteProd($id); 
            redirect(site_url('stock/produit'));
        }
    }