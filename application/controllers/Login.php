<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index(){
        $data['title'] = 'Vegmarket';
        $data['description'] = 'Vegmarket';
        $data['keywords'] = 'Vegmarket';
        $this->load->view('login',$data); 
	}

	public function check(){
		$user=$this->input->post("username");
		$mdp=$this->input->post("password");
		$this->load->model('login');
		if ($this->login->check_connexion($user,$mdp)==true) {
			redirect('tableau/chart');
		}
		else{
			redirect('login');
		}
	}

	public function logout(){
		$this->session->unset_userdata('connected');
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('error_login');
		redirect('login');
	}
}
