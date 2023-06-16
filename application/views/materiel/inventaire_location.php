<div class="p-1">
    <h2 class="mb-3">Matériel</h2>
    <div class="card">
        <div class="col-10 mb-2 d-flex align-items-center">
            <h4 class="me-4">Inventaire des matériels loués</h4> <a href="<?php echo site_url("materiel/inventaire/achat"); ?>" class="link-redirect"><i class="fa-regular fa-hand-pointer"></i> Inventaire des achats ici</a>
        </div>
        <table class="table table-borderless" id="filter">
            <thead>
                <tr class="text-center">
                    <th scope="col">Date location</th>
                    <th scope="col">Nom du matériel</th>
                    <th scope="col">Fournisseur</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Type</th>
                    <th scope="col">Durée restante</th>
                </tr>
            </thead>
            <div class="line"></div>
            <tbody>
                <?php
                foreach ($locations as $l) { ?>
                    <tr class="text-center">
                        <td><?php echo $l['date_debut']; ?></td>
                        <td><?php echo $l['nom_materiel']; ?></td>
                        <td><?php echo $l['nom_fournisseur']; ?></td>
                        <td><?php echo $l['quantite']; ?></td>
                        <td>
                            <?php
                            if ($l['type_materiel'] == 1) {
                                $type = "Entrepôt";
                                $class = "entrepot";
                            } else {
                                $type = "Champs";
                                $class = "champs";
                            }
                            ?>
                            <span class="<?php echo $class; ?>"><?php echo $type; ?></span>
                        </td>
                        <td><b><?php echo $l['days'] ?> jour(s)</b></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>