<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Employe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
    }

    public function AjoutEmploye()
    {
        $data['title'] = "Ajout Employé";
        $data['content'] = "employe/ajout";
        $data['employes'] = $this->Employee_model->getAllEmp();
        $data['fonctions'] = $this->Employee_model->getAllFonction();
        $this->load->view('components/body', $data);
    }

    public function PresenceEmploye(){
        $data['title'] = "Présence Employé";
        $data['content'] = "employe/presence";
        $data['employes'] = $this->Employee_model->getAllEmp();
        $this->load->view('components/body', $data);
    }

    public function insertEmployee()
    {
        if (!empty($_FILES['image']['name'])) {
            // Set preference
            $config['upload_path'] = 'img/';
            $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
            $config['file_name'] = $_FILES['image']['name'];
            $config['max_size'] = '30000';
            // Load upload library
            $this->load->library('upload', $config);
            // File upload
            if ($this->upload->do_upload('image')) {
                // Get data about the file               
            } else {
            }
        } else {
        }
        $this->Employee_model->insertEmp($_POST, $_FILES['image']['name']);
        redirect(site_url('Employe/AjoutEmploye'));
    }
}
