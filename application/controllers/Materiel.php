<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Materiel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materiel_model');
        session_start();
    }

    public function fournisseur()
    {
        $data['title'] = 'Fournisseur.';
        $data['content'] = 'materiel/fournisseur';
        $data['fournisseurs'] = $this->Materiel_model->getFournisseur();
        $this->load->view('components/body', $data);
    }

    public function insertionFournisseur()
    {
        $this->Materiel_model->ajoutFournisseur($_POST);
        redirect(site_url('materiel/fournisseur'));
    }

    public function achat($state = "")
    {
        $data['state'] = $state;
        $data['title'] = 'Achat de matériel.';
        $data['content'] = 'materiel/achat_materiel';
        $data['fournisseurs'] = $this->Materiel_model->getFournisseur();
        $this->load->view('components/body', $data);
    }

    public function location($state = "")
    {
        $data['state'] = $state;
        $data['title'] = 'Achat de matériel.';
        $data['content'] = 'materiel/location';
        $data['fournisseurs'] = $this->Materiel_model->getFournisseur();
        $this->load->view('components/body', $data);
    }

    public function insertionAchat()
    {
        $state = $this->Materiel_model->ajoutAchat($_POST);
        if ($state != 0) redirect(site_url('materiel/achat/add'));
        else redirect(site_url('materiel/achat/error'));
    }

    public function insertionLocation()
    {
        $state = $this->Materiel_model->ajoutLocation($_POST);
        if ($state != 0) redirect(site_url('materiel/location/add'));
        else redirect(site_url('materiel/achat/error'));
    }

    public function inventaire($type = "achat")
    {
        if ($type == "achat") {
            $data['title'] = 'Inventaire des achats.';
            $data['content'] = 'materiel/inventaire_achat';
            $data['achats'] = $this->Materiel_model->getAchat();
        } else {
            $data['title'] = 'Inventaire des locations.';
            $data['locations'] = $this->Materiel_model->getLocation();
            $data['content'] = 'materiel/inventaire_location';
        }
        $this->load->view('components/body', $data);
    }

    public function fournisseur_delete($id)
    {
        $this->Materiel_model->deleteFournisseur($id);
        redirect(site_url("materiel/fournisseur"));
    }

    public function modifie_fournisseur($id = "")
    {
        if ($this->input->post()) {
            $this->Materiel_model->modifEmploye($_POST);
            redirect(site_url('materiel/fournisseur'));
        } else {
            $data['id'] = $id;
            $data['title'] = 'Modification.';
            $data['content'] = 'materiel/modifier_fournisseur';
            $data['fournisseur'] = $this->Materiel_model->getFournisseur($id);
            $this->load->view('components/body', $data);
        }
    }
}
