<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_model');
        session_start();
    }

    public function historique($mv = "sortie")
    {
        if ($mv == "sortie") {
            $data["historique"] = $this->Stock_model->getMvtSortie();
            $data['title'] = "Historique de sortie.";
            $data['content'] = "stock/historique_sortie";
        } else {
            $data["historique"] = $this->Stock_model->getMvtEntree();
            $data['title'] = "Historique d'entrée.";
            $data['content'] = "stock/historique_entree";
        }
        $this->load->view('components/body', $data);
    }

    public function mouvement($mvt = "sortie", $state = "")
    {
        $data['state'] = $state;
        $data['entrepots'] = $this->Stock_model->getEntrepot();
        $data['produits'] = $this->Stock_model->getProduit();
        $data['title'] = "Mouvement de stock.";
        if ($mvt == "sortie") {
            $data['content'] = "stock/mouvement_sortie";
        } else {
            $data['content'] = "stock/mouvement_entree";
        }
        $this->load->view('components/body', $data);
    }

    public function etat()
    {
        $data['etat'] = $this->Stock_model->getEtatStock();
        $data['title'] = "Etat de stock.";
        $data['content'] = "stock/etat_stock";
        $this->load->view('components/body', $data);
    }

    public function entrepot($where = "", $id = -1)
    {
        $data['title'] = "Entrepôt.";
        $data['state'] = $where;
        if ($id == -1) {
            $data['content'] = "stock/entrepot";
            $data['produits'] = $this->Stock_model->getProduit();
            $data['entrepots'] = $this->Stock_model->getEntrepot();
        } else {
            $data['content'] = "stock/info_entrepot";
        }
        $this->load->view('components/body', $data);
    }

    public function produit($state = "")
    {
        $data['title'] = "Produit.";
        $data['state'] = $state;
        $data['content'] = "stock/produit";
        $data['produits'] = $this->Stock_model->getProduit();
        $this->load->view('components/body', $data);
    }

    public function repartition()
    {
        $data['title'] = "Produit.";
        $data['content'] = "stock/definition_stock";
        $data['new_produit'] = $_POST['produit'];
        $data['produits'] = $this->Stock_model->getProduit();
        $data['entrepots'] = $this->Stock_model->getEntrepot();
        $this->load->view('components/body', $data);
    }

    public function insertionEntrepot()
    {
        $this->Stock_model->insertEntrepot($_POST);
        redirect(site_url('stock/entrepot'));
    }

    public function insertionProduit()
    {
        $this->Stock_model->insertProd($_POST);
        redirect(site_url('stock/produit'));
    }

    public function deleteProduit($id)
    {
        $a = $this->Stock_model->deleteProd($id);
        if ($a == 1) redirect(site_url('stock/produit/delete'));
        else {
            redirect(site_url('stock/produit/error'));
        }
    }

    public function entrepot_delete($id)
    {
        $a = $this->Stock_model->deleteEntrepot($id);
        if ($a == 1) redirect(site_url('stock/entrepot/success'));
        else {
            redirect(site_url('stock/entrepot/error'));
        }
    }

    public function insertionMvtSortie()
    {
        $state = $this->Stock_model->insertSortie($_POST);
        if ($state == -1) {
            redirect(site_url('stock/mouvement/sortie/limit'));
        }
        if ($state == 1) {
            redirect(site_url('stock/mouvement/sortie/add'));
        }
        redirect(site_url('stock/mouvement/sortie/error'));
    }

    public function insertionMvtEntre()
    {
        $state = $this->Stock_model->insertEntre($_POST);
        if ($state == 1) {
            redirect(site_url('stock/mouvement/entree/add'));
        }
        if ($state == -1) {
            redirect(site_url('stock/mouvement/entree/limit'));
        }
        redirect(site_url('stock/mouvement/entree/error'));
    }

    public function modification($type, $id)
    {
        $data['title'] = 'Modification entrepôt.';
        $data['content'] = 'stock/modif_entrepot';
        $data['entrepot'] = $this->Stock_model->getEntrepot($id)[0];
        $data['detail'] = $this->Stock_model->getDetailEntrepot($id);
        $this->load->view('components/body', $data);
    }

    public function modifEntrepot()
    {
        $this->Stock_model->editEntrepot($_POST);
        redirect(site_url('stock/modification/entrepot/' . $_POST['entrepotid']));
    }
}
