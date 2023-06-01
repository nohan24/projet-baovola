<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Home extends CI_Controller
	{
        public function dashboard()
        {
            $data['title'] = 'Tableau de bord.';
            $data['content'] = 'dashboard/accueil';
            $this->load->view('components/body', $data);
        }

        
    }