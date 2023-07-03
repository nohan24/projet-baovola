<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Model{
	public function check_connexion($user,$mdp){
		$user_valid=false;
		$sentence="select * from utilisateur where username='%s' and passwrd='%s' ";
		$sql=sprintf($sentence,$user,$mdp);
		$query=	$this->db->query($sql);
		$results = $query->Result();
		foreach ($results as $result) {
			$user_valid=true;
			$this->session->unset_userdata('error_login');
			$this->session->set_userdata('connected',$result->idmembre);
			return true;
		}
		if ($user_valid==false) {
			$this->session->set_userdata('error_login','Verifier vos informations');
			return false;
		}
	}
}