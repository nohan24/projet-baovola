<div class="p-1">
    <h2 class="mb-3">Entrepôt</h2>
    <div class="card">
        <h4>Edition d'entrepôt</h4>
        <form action="<?php echo site_url('stock/modifEntrepot'); ?>" method="post" class="d-flex gap-2 px-5 py-3">
            <div>
                <input type="hidden" name="entrepotid" value="<?php echo $entrepot['entrepotid']; ?>">
                <div class="mb-3 d-flex gap-3">
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Adresse : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" value="<?php echo $entrepot['adresse']; ?>" name="adresse">
                            <b style="font-size:14px; background:transparent;"></b>
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Superficie : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" value="<?php echo $entrepot['superficie']; ?>" name="superficie">
                            <b style="font-size:14px; background:transparent;">m²</b>
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Hauteur : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" value="<?php echo $entrepot['hauteur']; ?>" name="hauteur">
                            <b style="font-size:14px; background:transparent;">m</b>
                        </div>
                    </div>
                </div>
                <h5 class="py-2">Quantité stocké pour chaque produit</h5>
                <?php
                foreach ($detail as $d) { ?>
                    <div class="mb-3 d-flex align-items-center gap-4">
                        <label class="mb-2"><?php echo $d['nom_produit']; ?> : </label>
                        <div class="d-flex align-items-end gap-2">
                            <input type="number" name="<?php echo 'p' . $d['detail_entrepot_id']; ?>" value="<?php echo $d['quantitestock'] ?>" step="0.01" required>
                            <b style="font-size:14px; background:transparent;">x Kg</b>
                        </div>
                    </div>
                <?php }
                ?>
                <br><input type="submit" value="Editer" class="btn-1">
            </div>

        </form>
    </div>
</div>