<div class="p-1">
    <h2 class="mb-3">Finance</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Charge</h4>
            </div>

        </div>
        <div style="margin-bottom: 20px; background:transparent;">
            <input type="text" id="filter0" onkeyup="filterDate()" placeholder="Filtrer par date">
            <input type="text" id="filter3" onkeyup="filterType()" placeholder="Filtrer par libellé">
        </div>

            <table class="table table-borderless" id="filter">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Date</th>
                        <th scope="col">Libellé</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Unité</th>
                        <th scope="col">Coût Unitaire</th>
                        <th scope="col">Montant</th>
                    </tr>
                </thead>
                <div class="line"></div>
                <tbody>
                    <?php 
                        $charge = array();
                        foreach ($charge as $c) { ?>
                            <tr class="text-center">
                                <td><b style="background:transparent;"><?php echo $c['date']; ?></b></td>
                                <td><?php echo $c['libelle']; ?></td>
                                <td><?php echo $c['quantite']; ?></td>
                                <td><?php echo $c['unite']; ?></td>
                                <td><?php echo $c['cout_unitaire']; ?></td>
                                <td><b><?php echo $c['montant']; ?></b></td>
                            </tr>
                        <?php }
                    ?>                    
                </tbody>
            </table>
            <?php if(count($charge) == 0){ ?>
                    <b class="text-center">Vide</b>
            <?php } ?>
        </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>
