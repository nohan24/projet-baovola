<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Materiel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materiel_model');
    }

    public function fournisseur()
    {
        $data['title'] = 'Fournisseur.';
        $data['content'] = 'materiel/fournisseur';
        $this->load->view('components/body', $data);
    }
}
