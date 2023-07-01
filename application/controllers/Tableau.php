<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tableau extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tableau_model');
        $this->load->model('Stock_model');
    }

    public function chart()
    {
        $data['produit'] = $this->Stock_model->getProduit();
        $data['title'] = "Tableau de bord";
        $data['content'] = "tableau/chart";
        $this->load->view('components/body', $data);
    }

    public function getData($id)
    {
        echo ($this->Tableau_model->getStat($id));
    }
}
