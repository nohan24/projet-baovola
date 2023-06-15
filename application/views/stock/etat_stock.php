<div class="p-1">
    <h2 class="mb-3">Etat de stock</h2>
    <div class="card">
        <div class="d-flex flex-column gap-2 detail">
            <?php
            foreach ($etat as $e) { ?>
                <div class="py-2 etat-detail">
                    <h4><i class="fa-solid fa-warehouse" style="font-size:14px; color:#264026;"></i> <?php echo $e['adresse']; ?></h4>
                    <div class="d-flex flex-wrap gap-2">
                        <?php
                        foreach ($e['element'] as $element) { ?>
                            <div class="etat-card">
                                <h5> <?php echo $element['produit']; ?></h5>
                                <b>Quantité stocké : <?php echo $element['instock']; ?> <span style="font-size:10px; background:transparent;">x Kg</span></b>
                                <br>
                                <b>Quantité restante : <?php echo $element['qtt_max'] - $element['instock']; ?> <span style="font-size:10px; background:transparent;">x Kg</span></b>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>