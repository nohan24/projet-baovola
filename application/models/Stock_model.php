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

    public function insertSortie($data)
    {
        $this->db->select('instock');
        $this->db->from('v_etat_stock');
        $this->db->where('entrepotid', $data['entrepot']);
        $this->db->where('produitid', $data['produit']);
        $stock = $this->db->get()->row_array();
        if ($stock['instock'] < $data['quantite']) {
            return -1;
        }
        $sql = "insert into sortie_stock values(default, %s, %s, %s, %s, %s)";
        $this->db->query(sprintf($sql, $data['entrepot'], $data['produit'], $this->db->escape($data['date']), $data['quantite'], $data['type']));
        if ($data['type'] != 3) {
        }
        return 1;
    }

    public function insertEntre($data)
    {
        $this->db->select('instock');
        $this->db->from('v_etat_stock');
        $this->db->where('entrepotid', $data['entrepot']);
        $this->db->where('produitid', $data['produit']);
        $stock = $this->db->get()->row_array();
        if ($stock['quantitestock'] - $stock['instock'] < $data['quantite']) {
            return -1;
        }
        $sql = "insert into entre_stock values(default, %s, %s, %s, %s)";
        $this->db->query(sprintf($sql, $data['entrepot'], $data['produit'], $this->db->escape($data['date']), $data['quantite']));
        return 1;
    }

    public function getEtatStock()
    {
        $this->db->select('*');
        $this->db->from('v_etat_stock');
        $ar = $this->db->get()->result_array();
        $dict = array();
        foreach ($ar as $e) {
            if (!isset($dict[$e['entrepotid']])) {
                $dict[$e['entrepotid']] = array(
                    'element' => array(),
                    'adresse' => $e['adresse']
                );
            }
            $d = array(
                'produit' => $e['nom_produit'],
                'qtt_max' => $e['quantitestock'],
                'instock' => $e['instock']
            );
            array_push($dict[$e['entrepotid']]['element'], $d);
        }
        return $dict;
    }
}
