<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2">
                <h4>Historique de sortie</h4>
            </div>

        </div>
        <div style="margin-bottom: 20px; background:transparent;">
            <input type="text" id="filter0" onkeyup="filterDate()" placeholder="Filtrer par date">
            <input type="text" id="filter1" onkeyup="filterType()" placeholder="Filtrer par type">
            <input type="text" id="filter2" onkeyup="filterNom()" placeholder="Filtrer par nom">
        </div>

            <table class="table" id="filter">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="w-25">Date</th>
                        <th scope="col" class="w-25">Type</th>
                        <th scope="col" class="w-25">Nom du produit</th>
                        <th scope="col" class="w-25">Quantité</th>
                    </tr>
                </thead>
                <div class="line"></div>
                <tbody>
                    <tr class="text-center">
                        <td><b style="background:transparent;">Mark</b></td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>9</td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>
