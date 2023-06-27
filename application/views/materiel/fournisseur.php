<div class="p-1">
    <h2 class="mb-3">Matériel</h2>
    <div class="card mb-3">
        <div class="row">
            <div class="mb-2 d-flex align-items-center">
                <h4>Insertion d'un fournisseur</h4>
            </div>
            <form action="<?php echo site_url('materiel/insertionFournisseur'); ?>" method="post" class="d-flex gap-2 px-5 py-3 w-100">
                <div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Nom du fournisseur : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="nom" placeholder="Nom fournisseur">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Coordonnées : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="coordonnee" placeholder="Coordonnées">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Adresse : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="adresse" placeholder="ex : Lot II P Soavina">
                        </div>
                    </div>

                    <input type="submit" value="Ajouter" class="btn-1">
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <h4 class="mb-3">Liste des fournisseurs</h4>
        <table class="table table-borderless">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nom du fournisseur</th>
                    <th scope="col">Coordonnées</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($fournisseurs as $f) { ?>
                    <tr class="text-center">
                        <td><?php echo $f['nom']; ?></td>
                        <td><?php echo $f['coordonnee']; ?></td>
                        <td><?php echo $f['adresse']; ?></td>
                        <td class="d-flex justify-content-center gap-2"> <a href="#" class="btn-4 link"><i class="fa-solid fa-pen" style="color:white; font-size:14px;"></i></a> <a href="#" class="btn-2 link"><i class="fa-solid fa-trash" style="color:white; font-size:14px;"></i></a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>