<?php

use LDAP\Result;

class Employee_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model');
    }

    public function insertEmp($data, $sary)
    {
        $sql = "insert into employe (nom, prenomEmploye, sexe, imgEmp, id_fonction , dateNaissance ,dateEmbauche, commentaire) values (%s, %s, %s, %s, %s, %s ,%s ,%s)";
        $req = sprintf($sql, $this->db->escape($data['nom']), $this->db->escape($data['prenom']), $data['genre'], $this->db->escape($sary), $data['fonction'], $this->db->escape($data['dateNaissance']), $this->db->escape($data['date']), $this->db->escape($data['commentaire']));
        $this->db->query($req);
    }

    public function modifEmp($data, $id_emp)
    {
        $sql = "update employe set nom=%s, prenomEmploye=%s, sexe=%s , id_fonction=%s, dateNaissance=%s, dateEmbauche=%s where id_emp=%s";
        $req = sprintf($sql, $this->db->escape($data['nom']), $this->db->escape($data['prenom']), $data['genre'], $data['fonction'], $this->db->escape($data['dateNaissance']), $this->db->escape($data['date']), $id_emp);
        $this->db->query($req);
    }

    public function getAllEmp()
    {
        $this->db->select('*');
        $this->db->from("empvalide");
        return $this->db->get()->result_array();
    }

    public function getEmploye($idEmp)
    {
        $this->db->select('*');
        $this->db->where('id_emp', $idEmp);
        $this->db->from("employe");
        return $this->db->get()->row_array();
    }

    public function getAllFonction()
    {
        $this->db->select('*');
        $this->db->from("fonction");
        return $this->db->get()->result_array();
    }

    public function findEmp($id_emp)
    {
        $this->db->select('*');
        $this->db->from("employe");
        $this->db->where('id_emp', $id_emp);
        return $this->db->get()->result_array();
    }

    public function isEntreer($id_emp)
    {
        $sql = "select * from V_dernier_action_presence where dateentree is not null and datesortie is null and id_emp=" . $id_emp;
        $req = $this->db->query($sql);
        return $req->result_array();
    }

    public function deletEmp($data)
    {
        $tab = $this->isEntreer($data['id_emp']);
        if (count($tab) == 0) {
            $sql = "insert into historiqueEmp (id_emp,dateDepart) values (%s , %s)";
            $data['datedelete'] = date('Y-m-d');
            $req = sprintf($sql, $this->db->escape($data['id_emp']), $this->db->escape($data['datedelete']));
            $this->db->query($req);
            return "possible";
        } else {
            return "impossible";
        }
    }

    // -------FALY DEBUT------------------------------

    public function get_dernier_action_presence($idEmp)
    {
        $sql = "SELECT * from V_dernier_action_presence where id_emp = %s";
        $sql = sprintf($sql, $idEmp);
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function salaire_Mois_heure($idEmp, $mois, $annee)
    {
        $sql = "SELECT * from V_salaire_heure_mois where id_emp = %s and mois = %s and annee=%s ";
        $sql = sprintf($sql, $idEmp, $mois, $annee);
        $query = $this->db->query($sql);
        $numRows = $query->num_rows();

        if ($numRows == 0) {
            $result = array(
                "id_emp" => $idEmp,
                "mois" => $mois,
                "annee" => $annee,
                "salairemensuel" => "Pas travailler durant ce mois",
                "tempstravail" => ""
            );
        } else {
            $result =  $query->row_array();
        }
        return $result;
    }

    public function temps_jour_heure_emp($idEmp, $mois, $annee)
    {
        $sql = "SELECT * from V_temps_employe_jour where id_emp = %s and mois = %s and annee=%s ";
        $sql = sprintf($sql, $idEmp, $mois, $annee);
        $query = $this->db->query($sql);
        $numRows = $query->num_rows();

        if ($numRows == 0) {
            $result = [];
            $result[0] = array(
                "dateentree" => "",
                "datesortie" => "",
                "id_emp" => $idEmp,
                "jour" => 0,
                "mois" => $mois,
                "annee" => $annee,
                "tempstravail" => "0"
            );
        } else {
            $result =  $query->result_array();
        }
        return $result;
    }

    public function presence_sortie($idemp, $date)
    {
        $rendue = "";
        $action = $this->get_dernier_action_presence($idemp);
        if (empty($action['datesortie'])) {
            $sql = "UPDATE presence SET dateSortie ='%s'  WHERE id_emp = %s AND dateEntree ='%s'";
            $this->db->query(sprintf($sql, $date, $idemp, $action['dateentree']));
            $rendue = "Sortie";
        } else {
            $rendue = "Entrée d'abord !";
        }
        return $rendue;
    }
    public function presence_entree($idemp, $date)
    {
        $rendue = "";

        $action = $this->Employee_model->get_dernier_action_presence($idemp);
        if (!empty($action['datesortie']) || $action == null) {
            $sql = "INSERT INTO presence values(%s,'%s',null)";
            $this->db->query(sprintf($sql, $idemp, $date));
            $rendue = "Entrée";
        } else {
            $rendue = "Sortie d'abord !";
        }
        return $rendue;
    }


    public function toDatetime($input_date, $input_hour, $input_minute)
    {
        $date = new DateTime($input_date);
        $combined_datetime = new DateTime($date->format('Y-m-d') . " " . $input_hour . ":" . $input_minute);
        $formatted_datetime = $combined_datetime->format('Y-m-d H:i:s');
        return $formatted_datetime;
    }

    public function formatHour($nombreDecimal)
    {
        $heures = floor($nombreDecimal);
        $minutes = ($nombreDecimal - $heures) * 60;
        $heureFormattee = sprintf("%02dh:%02dmn", $heures, $minutes);
        return $heureFormattee;
    }
    // -------FALY FIN------------------------------

}
