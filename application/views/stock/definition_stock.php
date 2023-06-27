<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <h4 class="mb-3">Mise à jour de la répartition de stock</h4>
        <form action="<?php echo site_url("stock/insertionProduit"); ?>" method="post">
            <input type="hidden" name="new_product" value="<?php echo $new_produit; ?>">
            <?php
            foreach ($entrepots as $e) { ?>
                <div>
                    <h5 class="mb-3">Entrepôt : <?php echo $e['adresse']; ?></h5>
                    <?php
                    foreach ($produits as $p) { ?>
                        <div class="mb-3 d-flex align-items-center gap-4">
                            <label class="mb-2" for="<?php echo 'p' . $e['entrepotid'] . $p['produitid']; ?>"><?php echo $p['nom_produit']; ?> : </label>
                            <div class="d-flex align-items-end gap-2">
                                <input type="number" name="<?php echo 'p' . $e['entrepotid'] . $p['produitid']; ?>" value="<?php echo $this->Stock_model->getDetailVal($e['entrepotid'], $p['produitid'])['quantitestock']; ?>" step="0.01" required>
                                <b style="font-size:14px; background:transparent;">x Kg</b>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="mb-3 d-flex align-items-center gap-4">
                        <label class="mb-2"><?php echo $new_produit; ?> : </label>
                        <div class="d-flex align-items-end gap-2">
                            <input type="number" name="<?php echo 'nouveau' . $e['entrepotid']; ?>" value="0.00" step="0.01" required>
                            <b style="font-size:14px; background:transparent;">x Kg</b>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
            <input type="submit" class="btn-1" value="Valider">
        </form>
        <div>
        </div>