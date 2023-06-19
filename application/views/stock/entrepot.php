<div class="p-1">
    <h2 class="mb-3">Entrepôt</h2>
    <div class="card mb-2">
        <h4>Ajout d'un entrepôt</h4>
        <form action="<?php echo site_url("stock/insertionEntrepot"); ?>" method="post">
            <div class="mb-3 d-flex flex-column">
                <label class="mb-2" for="adresse">Adresse : </label>
                <div class="d-flex align-items-end gap-2">
                    <input type="text" name="adresse" placeholder="Adresse de l'entrepôt" maxlength="80" required>
                    <b style="font-size:14px; background:transparent;">80 caractères maximum</b>
                </div>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label class="mb-2" for="superficie">Superficie : </label>
                <div class="d-flex align-items-end gap-2">
                    <input type="number" min="1" name="superficie" placeholder="Superficie de l'entrepôt" required step="0.01">
                    <b style="font-size:14px; background:transparent;">mètre ²</b>
                </div>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label class="mb-2" for="hauteur">Hauteur : </label>
                <div class="d-flex align-items-end gap-2">
                    <input type="number" min="1" name="hauteur" placeholder="Hauteur de l'entrepôt" required step="0.01">
                    <b style="font-size:14px; background:transparent;">mètre</b>
                </div>
            </div>
            <?php
            if (count($produits) != 0) { ?>
                <h5 class="py-2">Quantité stocké pour chaque produit</h5>
                <?php
                foreach ($produits as $produit) { ?>
                    <div class="mb-3 d-flex align-items-center gap-4">
                        <label class="mb-2" for="<?php echo 'p' . $produit['produitid']; ?>"><?php echo $produit['nom_produit']; ?> : </label>
                        <div class="d-flex align-items-end gap-2">
                            <input type="number" name="<?php echo 'p' . $produit['produitid']; ?>" value="0.00" step="0.01" required>
                            <b style="font-size:14px; background:transparent;">x Kg</b>
                        </div>
                    </div>
                <?php }
                ?>
            <?php }
            ?>
            <input type="submit" class="btn-1" value="Valider l'ajout">
    </div>
    </form>
</div>
<div class="card">
    <h4>Liste des entrepôts</h4>
    <table class="table table-borderless">
        <thead>
            <tr class="text-center">
                <th scope="col">Adresse entrepôt</th>
                <th scope="col">Superficie</th>
                <th scope="col">Hauteur</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($entrepots as $entrepot) { ?>
                <tr class="text-center">
                    <td><?php echo $entrepot['adresse']; ?></td>
                    <td><?php echo $entrepot['superficie']; ?> <b>m²</b></td>
                    <td><?php echo $entrepot['hauteur']; ?> <b>m</b></td>
                    <td class="d-flex justify-content-center gap-2"> <a href="<?php echo site_url('stock/modification/entrepot/' . $entrepot['entrepotid']); ?>" class="btn-4 link"><i class="fa-solid fa-pen" style="color:white; font-size:14px;"></i></a> <a href="#" class="btn-2 link"><i class="fa-solid fa-trash" style="color:white; font-size:14px;"></i></a></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>
</div>