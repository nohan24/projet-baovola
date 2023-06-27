<div class="p-1">
    <h2 class="mb-3">Matériel</h2>
    <div class="card">
        <div class="col-10 mb-2 d-flex align-items-center">
            <h4 class="me-4">Inventaire des matériels achetés</h4> <a href="<?php echo site_url("materiel/inventaire/location"); ?>" class="link-redirect"><i class="fa-regular fa-hand-pointer"></i> Inventaire des locations ici</a>
        </div>
        <table class="table table-borderless" id="filter">
            <thead>
                <tr class="text-center">
                    <th scope="col">Date</th>
                    <th scope="col">Nom du matériel</th>
                    <th scope="col">Type</th>
                    <th scope="col">Quantité</th>
                </tr>
            </thead>
            <div class="line"></div>
            <tbody>
                <?php
                foreach ($achats as $a) { ?>
                    <tr class="text-center">
                        <td><?php echo $a['date_achat']; ?></td>
                        <td><?php echo $a['nom_materiel']; ?></td>
                        <td>
                            <?php
                            if ($a['type_materiel'] == 1) {
                                $type = "Entrepôt";
                                $class = "entrepot";
                            } else {
                                $type = "Champs";
                                $class = "champs";
                            }
                            ?>
                            <span class="<?php echo $class; ?>"><?php echo $type; ?></span>
                        </td>
                        <td><b><?php echo $a['quantite']; ?></b></td>

                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>