<?php
class Materiel_model extends CI_Model
{
    public function getFournisseur($id = "")
    {
        if ($id == "") {
            $this->db->select("*");
            $this->db->from("v_fournisseur_dispo");
            return $this->db->get()->result_array();
        } else {
            $this->db->select("*");
            $this->db->from("v_fournisseur_dispo");
            $this->db->where("fournisseurid", $id);
            return $this->db->get()->row_array();
        }
    }

    public function ajoutFournisseur($data)
    {
        $sql = "INSERT INTO fournisseur VALUES(default,%s,%s,%s)";
        $this->db->query(sprintf($sql, $this->db->escape($data['nom']), $this->db->escape($data['coordonnee']), $this->db->escape($data['adresse'])));
    }

    public function ajoutAchat($data)
    {
        $ret = 0;
        $sql = "INSERT INTO achat_materiel VALUES(default,%s,%s,%s,%s,%s,%s)";
        $ret = $this->db->query(sprintf($sql, $data['fournisseur'], $this->db->escape($data['nom']), $this->db->escape($data['date']), $data['type'], $data['quantite'], $data['pu']));
        return $ret;
    }

    public function ajoutLocation($data)
    {
        $ret = 0;
        $sql = "INSERT INTO location_materiel VALUES(default,%s,%s,%s,%s,%s,%s,%s)";
        $ret = $this->db->query(sprintf($sql, $data['fournisseur'], $this->db->escape($data['nom']), $this->db->escape($data['date']), $data['type'], $data['duree'], $data['quantite'], $data['pu']));
        return $ret;
    }

    public function getLocation()
    {
        $this->db->select("*");
        $this->db->from("v_location_actuel");
        return $this->db->get()->result_array();
    }

    public function getAchat()
    {
        $this->db->select("*");
        $this->db->from("achat_materiel");
        return $this->db->get()->result_array();
    }

    public function deleteFournisseur($id)
    {
        $sql = "insert into fournisseur_non_dispo values(default,%s)";
        return $this->db->query(sprintf($sql, $id));
    }

    public function modifEmploye($data)
    {
        $sql = "update fournisseur set nom = %s, coordonnee = %s, adresse = %s where fournisseurid = %s";
        $this->db->query(sprintf($sql, $this->db->escape($data['nom']), $this->db->escape($data['coordonnee']), $this->db->escape($data['adresse']), $data['id']));
    }
}
