<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_model extends CI_Model
{
	public function check_connexion($user, $mdp)
	{
		session_start();
		$user_valid = false;
		$sentence = "select * from utilisateur where username='%s' and passwrd='%s' ";
		$sql = sprintf($sentence, $user, $mdp);
		$query = $this->db->query($sql);
		$results = $query->Result();
		foreach ($results as $result) {
			$user_valid = true;
			// $this->session->unset_userdata('error_login');
			// $this->session->set_userdata('connected', $result->idmembre);
			$_SESSION['connected'] = $result->userid;
			return true;
		}
		if ($user_valid == false) {
			$_SESSION['error_login'] = 'Verifier vos informations';
			// $this->session->set_userdata('error_login', 'Verifier vos informations');
			return false;
		}
	}
}
