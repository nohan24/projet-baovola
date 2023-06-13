<div class="p-1">
    <h2 class="mb-3">Produit</h2>
    <div class="card">
        <div class="row mb-4">
            <h4 class="mb-3">Ajout d'un nouveau produit</h4>
            <form action="<?php echo site_url('stock/repartition'); ?>" method="post" class="w-50">
                <div class="mb-3 d-flex flex-column">
                    <label class="mb-2" for="quantite">Produit : </label>
                    <div class="d-flex align-items-end gap-1">
                        <input type="text" name="produit" placeholder="Nom du produit" required>
                    </div>
                </div>
                <input type="submit" value="Ajouter" class="btn-1">
            </form>
        </div>
        <div class="row">
            <h4>Liste des produits en cours</h4>
            <table class="table table-borderless w-50" id="filter">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Nom produit</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <div class="line"></div>
                <tbody>
                    <?php
                    foreach ($produits as $produit) { ?>
                        <tr class="text-center">
                            <td><b><?php echo $produit['nom_produit']; ?></b></td>
                            <td class="d-flex justify-content-center"><a href="<?php echo site_url("stock/deleteProduit/" . $produit['produitid']); ?>" class="btn-2" style="width: 30px; heigth:30px;"><i class="fa-solid fa-trash" style="color:white; font-size:14px;"></i></a></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>