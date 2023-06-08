<div class="p-1">
    <h2 class="mb-3">Finance</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Vente</h4>
            </div>

        </div>
        <div style="margin-bottom: 20px; background:transparent;">
            <input type="text" id="filter0" onkeyup="filterDate()" placeholder="Filtrer par date">
            <input type="text" id="filter1" onkeyup="filterNom()" placeholder="Filtrer par produit">
        </div>

            <table class="table table-borderless" id="filter">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Date</th>
                        <th scope="col">Produit</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Unité</th>
                        <th scope="col">Prix Unitaire</th>
                        <th scope="col">Montant</th>
                    </tr>
                </thead>
                <div class="line"></div>
                <tbody>
                    <?php 
                        $vente = array();
                        foreach ($vente as $v) { ?>
                            <tr class="text-center">
                                <td><b style="background:transparent;"><?php echo $v['date']; ?></b></td>
                                <td><?php echo $v['produit']; ?></td>
                                <td><?php echo $v['quantite']; ?></td>
                                <td><?php echo $v['unite']; ?></td>
                                <td><?php echo $v['prix_unitaire']; ?></td>
                                <td><b><?php echo $v['montant']; ?></b></td>
                            </tr>
                        <?php }
                    ?>                    
                </tbody>
            </table>
            <?php if(count($vente) == 0){ ?>
                    <b class="text-center">Vide</b>
            <?php } ?>
        </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>
                