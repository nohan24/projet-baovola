<div class="p-1">
    <h2 class="mb-3">Entrepôt</h2>
    <div class="card mb-2">
        <h4>Ajout d'un entrepôt</h4>
        <form action="<?php echo site_url("stock/insertionEntrepot"); ?>" method="post">
                <div class="mb-3 d-flex flex-column">
                    <label class="mb-2" for="adresse">Adresse : </label>
                    <div class="d-flex align-items-end gap-1">
                        <input type="text" name="adresse" placeholder="Adresse de l'entrepôt" required>
                        <b style="font-size:14px; background:transparent;">80 caractères maximum</b>
                    </div>
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label class="mb-2" for="superficie">Superficie : </label>
                    <div class="d-flex align-items-end gap-1">
                        <input type="number" name="superficie" placeholder="Superficie de l'entrepôt" required>
                        <b style="font-size:14px; background:transparent;">mètre ²</b>
                    </div>
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label class="mb-2" for="hauteur">Hauteur : </label>
                    <div class="d-flex align-items-end gap-1">
                        <input type="number" name="hauteur" placeholder="Hauteur de l'entrepôt" required>
                        <b style="font-size:14px; background:transparent;">mètre</b>
                    </div>
                </div>
                <h5 class="py-2">Quantité stocké pour chaque produit</h5>
                <?php  
                    foreach ($produits as $produit) { ?>
                        <div class="mb-3 d-flex align-items-center gap-4">
                            <label class="mb-2" for="<?php echo 'p'.$produit['produitid']; ?>"><?php echo $produit['nom_produit']; ?> : </label>
                            <div class="d-flex align-items-end gap-1">
                                <input type="number" name="<?php echo 'p'.$produit['produitid']; ?>" value="0.00" required>
                                <b style="font-size:14px; background:transparent;">x1000 Kg</b>
                            </div>
                        </div>
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
                            <td><?php echo $produit['adresse']; ?></td>
                            <td><?php echo $produit['superficie']; ?> <b>m²</b></td>
                            <td><?php echo $produit['hauteur']; ?> <b>m</b></td>
                            <td class="d-flex justify-content-center gap-2"><a href="#" class="btn-4 link"><i class="fa-solid fa-info" style="color:white;"></i></a> <a href="#" class="btn-3 link"><i class="fa-solid fa-pen" style="color:white; font-size:14px;"></i></a> <a href="#" class="btn-2 link"><i class="fa-solid fa-trash d-flex" style="color:white;"></i></a></td>
                        </tr>
                    <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>