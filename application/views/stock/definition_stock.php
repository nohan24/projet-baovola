<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <h4 class="mb-3">Mise à jour de la répartition de stock</h4>
        <form action="#" method="get">
            <?php 
                foreach ($entrepots as $e) { ?>
                    <div>
                        <h5 class="mb-3">Entrepôt : <?php echo $e['adresse']; ?></h5>
                        <?php 
                            foreach ($produits as $p) { ?>
                                <div class="mb-3 d-flex align-items-center gap-4">
                                    <label class="mb-2" for="<?php echo 'p'.$p['produitid']; ?>"><?php echo $p['nom_produit']; ?> : </label>
                                    <div class="d-flex align-items-end gap-2">
                                        <input type="number" name="<?php echo 'p'.$p['produitid']; ?>" value="0.00" step="0.01" required>
                                        <b style="font-size:14px; background:transparent;">x1000 Kg</b>
                                    </div>
                                </div>
                            <?php }
                        ?>
                    </div>
                <?php }
            ?>
        </form>
    <div>
</div>
