<div class="p-1">
    <h2 class="mb-3">Matériel</h2>
    <div class="card mb-3">
        <div class="row">
            <div class="mb-2 d-flex align-items-center">
                <h4>Modification d'un fournisseur</h4>
            </div>
            <form action="<?php echo site_url('materiel/modifie_fournisseur'); ?>" method="post" class="d-flex gap-2 px-5 py-3 w-100">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Nom du fournisseur : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="nom" placeholder="Nom fournisseur" value="<?php echo $fournisseur['nom']; ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Coordonnées : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="coordonnee" placeholder="Coordonnées" value="<?php echo $fournisseur['coordonnee']; ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="quantite">Adresse : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="adresse" value="<?php echo $fournisseur['adresse']; ?>" placeholder="ex : Lot II P Soavina">
                        </div>
                    </div>

                    <input type="submit" value="Modifier" class="btn-1">
                </div>
            </form>
        </div>
    </div>
</div>