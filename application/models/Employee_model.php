<?php
class Employee_model extends CI_Model
{
    public function insertEmp($data, $sary)
    {
        $sql = "insert into employe (nom, prenomEmploye, sexe, imgEmp, id_fonction ,dtn, dateEmbauche, commentaire) values (%s, %s, %s, %s, %s, %s ,%s ,%s)";
        $req = sprintf($sql, $this->db->escape($data['nom']), $this->db->escape($data['prenom']), $data['genre'], $this->db->escape($sary), $data['fonction'], $this->db->escape($data['dtn']), $this->db->escape($data['date_embauche']), $this->db->escape($data['commentaire']));
        $this->db->query($req);
    }

    public function getAllEmp()
    {
        $this->db->select('*');
        $this->db->from("v_infoemp");
        return $this->db->get()->result_array();
    }

    public function getAllFonction()
    {
        $this->db->select('*');
        $this->db->from("fonction");
        return $this->db->get()->result_array();
    }
}
