<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Vegmarket';
		$data['description'] = 'Vegmarket';
		$data['keywords'] = 'Vegmarket';
		$this->load->view('login/login', $data);
	}

	public function check()
	{
		$user = $this->input->post("username");
		$mdp = $this->input->post("passwrd");
		$this->load->model('Login_model');
		if ($this->Login_model->check_connexion($user, $mdp) == true) {
			redirect(site_url('tableau/chart'));
		} else {
			redirect(site_url('login'));
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		redirect('login');
	}
}
