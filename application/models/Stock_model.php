<?php
class Stock_model extends CI_Model
{

    public function getProduit()
    {
        $this->db->select('*');
        $this->db->from("v_produit_dispo");
        return $this->db->get()->result_array();
    }

    public function getEntrepot($id = "")
    {
        $this->db->select('*');
        $this->db->from("v_entrepot_dispo");
        if ($id != "") {
            $this->db->where("entrepotid", $id);
        }
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
        $this->db->query(sprintf($sql, $this->db->escape(trim($e['adresse'])), $e['superficie'], $e['hauteur']));
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
        $this->db->query(sprintf($sql, $this->db->escape(trim($data['new_product']))));
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
        $ret = 0;
        $this->db->select('instock');
        $this->db->from('v_etat_stock');
        $this->db->where('entrepotid', $data['entrepot']);
        $this->db->where('produitid', $data['produit']);
        $stock = $this->db->get()->row_array();
        if ($stock['instock'] < $data['quantite']) {
            return -1;
        }
        $sql = "insert into sortie_stock values(default, %s, %s, %s, %s, %s)";
        $ret = $this->db->query(sprintf($sql, $data['entrepot'], $data['produit'], $this->db->escape($data['date']), $data['quantite'], $data['type']));
        if ($data['type'] != 3) {
            // $sql = "insert into ";
            // $this->db->query();
            $ret = 1;
        }
        return $ret;
    }

    public function insertEntre($data)
    {
        $ret = 0;
        $this->db->select('instock');
        $this->db->from('v_etat_stock');
        $this->db->where('entrepotid', $data['entrepot']);
        $this->db->where('produitid', $data['produit']);
        $stock = $this->db->get()->row_array();
        if ($stock['quantitestock'] - $stock['instock'] < $data['quantite']) {
            return -1;
        }
        $sql = "insert into entre_stock values(default, %s, %s, %s, %s)";
        $ret = $this->db->query(sprintf($sql, $data['entrepot'], $data['produit'], $this->db->escape(trim($data['date'])), $data['quantite']));
        return $ret;
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

    public function getDetailEntrepot($id)
    {
        $this->db->select('*');
        $this->db->from('v_etat_stock');
        $this->db->where('entrepotid', $id);
        return $this->db->get()->result_array();
    }

    public function editEntrepot($data)
    {
        $sql1 = "update entrepot set adresse = %s, superficie=%s, hauteur = %s where entrepotid = %s";
        $sql2 = "update detail_entrepot set quantitestock = %s where detail_entrepot_id = %s";
        $this->db->query(sprintf($sql1, $this->db->escape(trim($data['adresse'])), $data['superficie'], $data['hauteur'], $data['entrepotid']));
        foreach ($this->getDetailEntrepot($data['entrepotid']) as $p) {
            $this->db->query(sprintf($sql2, $data['p' . $p['detail_entrepot_id']], $p['detail_entrepot_id']));
        }
    }
}
