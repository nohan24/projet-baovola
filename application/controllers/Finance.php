<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Finance_model');
    }

    public function caisse()
    {
        $this->load->model('Finance_model');
        $data['title'] = "Mouvement.";
        $data['content'] = "finance/mouvement";
        $data['mouvement'] = $this->Finance_model->select_v_mouvement_financier();
        $this->load->view('components/body', $data);
    }
    public function vente()
    {
        $this->load->model('Finance_model');
        $data['title'] = "Vente";
        $data['content'] = "finance/vente";
        $data['vente'] = $this->Finance_model->select_v_vente();
        $data['unites'] = $this->Finance_model->getUnite();
        $this->load->view('components/body', $data);
    }
    public function charge()
    {
        $this->load->model('Finance_model');
        $data['title'] = "Charges";
        $data['content'] = "finance/charge";
        $data['charge'] = $this->Finance_model->select_v_charge();
        $data['unites'] = $this->Finance_model->getUnite();
        $this->load->view('components/body', $data);
    }
    public function insertCharge(){
        $this->load->model('Finance_model');
        $data['title'] = "Charges";
        $data['content'] = "finance/charge";
        $this->Finance_model->insertCharge($_POST['date_transac'],$_POST['libelle'],$_POST['quantite'],$_POST['unite'],$_POST['unitaire']);
        $this->load->view('components/body', $data);
    }
    public function insertVente(){
        $this->load->model('Finance_model');
        $data['title'] = "Vente";
        $data['content'] = "finance/vente";
        $this->Finance_model->insertVente($_POST['date_transac'],$_POST['libelle'],$_POST['quantite'],$_POST['unite'],$_POST['unitaire']);
        $this->load->view('components/body', $data);
    }
}
