<style>
    td,
    th {
        text-align: center;
        justify-content: space-evenly;
    }


    .photo {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        overflow: hidden;
        border: 1px solid whitesmoke;
    }

    .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sary {
        background: black;
        max-width: 50px;
    }
</style>

<div class="p-1">
    <h3>Salaire Employés</h3>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4"></h4>
            </div>
        </div>
        <div class="interaction">
            <div style="margin-bottom: 20px;" class="searchbar">
                <input type="text" id="searchEmp" onkeyup="searchEmp()" placeholder="Recherche">
                <img class="search_icon" src="<?php echo base_url("assets/icon/fi-br-search.svg") ?>" alt="Recherche">
            </div>
            <form class="filtre_temps" method="POST">
                <label for="mois">Mois :</label>
                <select name="mois" id="mois">
                    <option value="1">Janvier</option>
                    <option value="2">Février</option>
                    <option value="3">Mars</option>
                    <option value="4">Avril</option>
                    <option value="5">Mai</option>
                    <option value="6">Juin</option>
                    <option value="7">Juillet</option>
                    <option value="8">Août</option>
                    <option value="9">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Decembre</option>
                </select>

                <label for="annee">Année :</label>
                <select name="annee" id="annee">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </form>
        </div>


        <div id="popup" class="popup"></div>

        <table class="table table-borderless" id="liste">
            <thead>
                <tr style="justify-content: space-around;">
                    <th class="sary"></th>
                    <th class="col-4">Nom & Prénom</th>
                    <th class="col-2">Fonction</th>
                    <th class="col-2">Salaire</th>
                    <th class="col-2">Temps</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $personne) { ?>
                    <tr style="justify-content: space-around;">
                        <td class="col-1 sary">
                            <div class="photo">
                                <img src="<?php echo base_url('assets/img/user.png') ?>" alt="">
                            </div>
                        </td>
                        <td class="col-4 p-3"><?php echo $personne['nom'] ?> <?php echo $personne['prenomemploye'] ?></td>
                        <td class="col-2 p-3"><?php echo $personne['libelle'] ?></td>
                        <td class="col-2 d-flex p-3 position-absolute">
                        </td>
                        <td>

                        </td>
                        <td>
                            <input type="submit" value="Payer" class="payer btn-5">
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?> "></script>
<script src="<?php echo base_url('assets/js/presence.js') ?> "></script>