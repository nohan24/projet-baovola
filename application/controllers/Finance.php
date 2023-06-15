<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Finance_model');
    }

    public function mouvement()
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
        $data['title'] = "Produit.";
        $data['content'] = "finance/vente";
        $data['vente'] = $this->Finance_model->select_v_vente();
        $this->load->view('components/body', $data);
    }
    public function charge()
    {
        $this->load->model('Finance_model');
        $data['title'] = "Produit.";
        $data['content'] = "finance/charge";
        $data['charge'] = $this->Finance_model->select_v_charge();
        $this->load->view('components/body', $data);
    }
}
