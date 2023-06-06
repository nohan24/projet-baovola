<?php
class Stock_model extends CI_Model
{

    public function getProduit()
    {
        $this->db->select('*');
        $this->db->from("v_p_dispo");
        return $this->db->get()->result_array();
    }

    public function getEntrepot()
    {
        $this->db->select('*');
        $this->db->from("v_e_dispo");
        return $this->db->get()->result_array();
    }

    public function deleteProd($id)
    {
        $sql = "insert into produit_non_dispo values(default,%s)";
        $this->db->query(sprintf($sql, $id));
    }

    public function insertEntrepot($e)
    {
        $sql = "insert into entrepot values(default, %s,%s,%s)";
        $this->db->query(sprintf($sql, $this->db->escape($e['adresse']), $e['superficie'], $e['hauteur']));
        $prod = $this->getProduit();
        foreach ($prod as $p) {
            $sql = "insert into detail_entrepot values(default,currval('entrepot_seq'),%s,%s)";
            $this->db->query(sprintf($sql, $p['produitid'], $e['p' . $p['produitid']]));
        }
    }

    public function getMvtSortie()
    {
        $this->db->select('*');
        $this->db->from("v_historique_sortie");
        return $this->db->get()->result_array();
    }

    public function getMvtEntree()
    {
        $this->db->select('*');
        $this->db->from("v_historique_entre");
        return $this->db->get()->result_array();
    }

    public function getDetailVal($entrepot, $produit)
    {
        $this->db->select('quantitestock');
        $this->db->from('detail_entrepot');
        $this->db->where('entrepotid', $entrepot);
        $this->db->where('produitid', $produit);
        return $this->db->get()->row_array();
    }

    public function insertProd($data)
    {
        $prod = $this->getProduit();
        $entrepot = $this->getEntrepot();
        $sql = "insert into produit values(default, %s)";
        $this->db->query(sprintf($sql, $this->db->escape($data['new_product'])));
        foreach ($entrepot as $e) {
            foreach ($prod as $p) {
                $this->db->query('delete from detail_entrepot where entrepotid = ' . $e['entrepotid'] . ' and produitid = ' . $p['produitid']);
                $sql = "insert into detail_entrepot values(default,%s,%s,%s)";
                $this->db->query(sprintf($sql, $e['entrepotid'], $p['produitid'], $data['p' . $e['entrepotid'] . $p['produitid']]));
            }
            $sql = "insert into detail_entrepot values(default,%s,currval('produit_seq'),%s)";
            $this->db->query(sprintf($sql, $e['entrepotid'], $data['nouveau' . $e['entrepotid']]));
        }
    }
}
