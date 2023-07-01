<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Historique de sortie</h4> <a href="<?php echo site_url("stock/historique/entree"); ?>" class="link-redirect"><i class="fa-regular fa-hand-pointer"></i> Voir l'historique des entrées ici</a>
            </div>

        </div>
        <div style="margin-bottom: 20px; background:transparent;">
            <input type="text" id="filter0" onkeyup="filterDate()" placeholder="Filtrer par date">
            <input type="text" id="filter3" onkeyup="filterType()" placeholder="Filtrer par type">
            <input type="text" id="filter1" onkeyup="filterNom()" placeholder="Filtrer par nom">
            <input type="text" id="filter2" onkeyup="filterEntrepot()" placeholder="Filtrer par entrepôt">
        </div>

        <table class="table table-borderless" id="filter">
            <thead>
                <tr class="text-center">
                    <th scope="col">Date</th>
                    <th scope="col">Nom du produit</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Entrepôt</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <div class="line"></div>
            <tbody>
                <?php
                foreach ($historique as $h) { ?>
                    <tr class="text-center">
                        <td><b style="background:transparent;"><?php echo $h['date_sortie']; ?></b></td>
                        <td><?php echo $h['nom_produit']; ?></td>
                        <td><b><?php echo $h['quantite']; ?></b> <span style="font-size:10px; background:transparent;">x1000 Kg</span></td>
                        <td><b><?php echo $h['adresse']; ?></b></td>
                        <td><span class="<?php echo strtolower($h['type_sortie']); ?>"><?php echo $h['type_sortie']; ?></span></td>
                    </tr>
                <?php }
                ?>

            </tbody>
        </table>
        <?php if (count($historique) == 0) { ?>
            <b class="text-center">Vide</b>
        <?php } ?>
    </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>