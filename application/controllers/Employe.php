<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Employe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
        session_start();
    }

    public function AjoutEmploye()
    {
        $data['title'] = "Ajout Employé";
        $data['content'] = "employe/ajout";
        $data['employes'] = $this->Employee_model->getAllEmp();
        $data['fonctions'] = $this->Employee_model->getAllFonction();
        if (isset($_GET['error'])) {
            $data['error'] = $_GET['error'];
        }
        $this->load->view('components/body', $data);
    }

    public function ModifEmp($id_Emp)
    {
        $data['title'] = "Modifier Employé";
        $data['content'] = "employe/modifEmp";
        $data['id_emp'] = $id_Emp;
        $data['fonctions'] = $this->Employee_model->getAllFonction();
        $data['employe'] = $this->Employee_model->findEmp($id_Emp);
        $this->load->view('components/body', $data);
    }

    public function updateEmployee()
    {
        $this->Employee_model->modifEmp($_POST, $_POST['idemp']);
        redirect(site_url('Employe/AjoutEmploye'));
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
                echo "mety";
            } else {
                echo "tsy mety";
            }
        } else {
            $_FILES['image']['name'] = 'defaultSary.png';
        }
        $this->Employee_model->insertEmp($_POST, $_FILES['image']['name']);
        redirect(site_url('Employe/AjoutEmploye'));
    }


    public function deleteEmployee()
    {
        $var = $this->Employee_model->deletEmp($_GET);
        if ($var == "impossible") {
            $data['error'] = "Renvoie impossible";
            redirect(site_url('Employe/AjoutEmploye?error=' . $data['error']));
        } else {
            redirect(site_url('Employe/AjoutEmploye'));
        }
    }

    // ----FALY DEBUT------------------------
    public function PresenceEmploye()
    {
        $data['title'] = "Présence Employées";
        $data['content'] = "employe/presence";
        $data['employes'] = $this->Employee_model->getAllEmp();
        $this->load->view('components/body', $data);
    }

    public function details_presence($idemp)
    {
        $currentMonth = 6; // Current month as a number between 1 and 12
        $currentYear = 2023; // Current year

        $data['title'] = "Présence Employée";
        $data['content'] = "employe/details_presence";
        $data['action'] = $this->Employee_model->get_dernier_action_presence($idemp);
        $data['employe'] = $this->Employee_model->findEmp($idemp);
        $data['vola'] = $this->Employee_model->salaire_Mois_heure($idemp, (int)$currentMonth, (int)$currentYear);
        $data['vola']['tempstravail'] = $this->Employee_model->formatHour($data['vola']['tempstravail']);
        $data['temps'] = $this->Employee_model->temps_jour_heure_emp($idemp, $currentMonth, $currentYear);
        $this->load->view('components/body', $data);
    }

    public function async_details_presence($idemp)
    {
        $mois = (int)$this->input->post('mois');
        $annee = (int)$this->input->post('annee');
        $data = $this->Employee_model->salaire_Mois_heure($idemp, $mois, $annee);
        $data['tempstravail'] = $this->Employee_model->formatHour($data['tempstravail']);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function async_temps_jour_heure_emp($idemp)
    {
        $mois = (int)$this->input->post('mois');
        $annee = (int)$this->input->post('annee');
        $data = $this->Employee_model->temps_jour_heure_emp($idemp, $mois, $annee);
        // $data['tempstravail'] = $this->Employee_model->formatHour($data['tempstravail']);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function presence_entree()
    {
        $idemp =  $this->input->post('idemp');
        $date =  $this->input->post('date');
        $retour = $this->Employee_model->presence_entree($idemp, $date);
        header('Content-Type: application/json');
        echo json_encode($retour);
    }

    public function presence_sortie()
    {
        $idemp =  $this->input->post('idemp');
        $date =  $this->input->post('date');
        $retour = $this->Employee_model->presence_sortie($idemp, $date);
        header('Content-Type: application/json');
        echo json_encode($retour);

        $temps = [];
        $temps[] = array(
            "dateentree" => "",
            "datesortie" => "",
            "id_emp" => "",
            "jour" => 2,
            "mois" => 6,
            "annee" => 2023,
            "tempstravail" => ""
        );
    }

    public function salaireEmploye()
    {
        $data['title'] = "Présence Employées";
        $data['content'] = "employe/salaire";
        $data['employes'] = $this->Employee_model->getAllEmp();
        $this->load->view('components/body', $data);
    }
    // ----FALY FIN------------------------

}
