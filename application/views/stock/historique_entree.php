<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Historique d'entrée</h4> <a href="<?php echo site_url("stock/historique/sortie"); ?>" class="link-redirect"><i class="fa-regular fa-hand-pointer"></i> Voir l'historique des sorties ici</a>
            </div>

        </div>
        <div style="margin-bottom: 20px; background:transparent;">
            <input type="text" id="filter0" onkeyup="filterDate()" placeholder="Filtrer par date">
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
                    </tr>
                </thead>
                <div class="line"></div>
                <tbody>
                    <tr class="text-center">
                        <td><b style="background:transparent;">2023/05/01</b></td>
                        <td>Tomate</td>
                        <td><b>9</b> <span style="font-size:10px; background:transparent;">x1000 Kg</span></td>
                        <td><b>B</b></td>
                    </tr>
                    <tr class="text-center">
                        <td><b style="background:transparent;">2023/05/01</b></td>
                        <td>Tomate</td>
                        <td><b>9</b> <span style="font-size:10px; background:transparent;">x1000 Kg</span></td>
                        <td><b>A</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>
