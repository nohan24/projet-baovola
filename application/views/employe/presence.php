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
    <h3>Présence Employé</h3>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Liste des Employées</h4>
            </div>
        </div>
        <div style="margin-bottom: 20px;" class="searchbar">
            <input type="text" id="searchEmp" onkeyup="searchEmp()" placeholder="Recherche">
            <img class="search_icon" src="<?php echo base_url("assets/icon/fi-br-search.svg") ?>" alt="Recherche">
        </div>

        <div id="popup" class="popup"></div>

        <table class="table table-borderless" id="liste">
            <thead>
                <tr style="justify-content: space-around;">
                    <th class="sary"></th>
                    <th class="col-2">Date d'action</th>
                    <th class="col-2">Fonction</th>
                    <th class="col-4">Nom & Prénom</th>
                    <th class="col-2">Action</th>
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
                        <td class="col-2">
                            <input type="datetime-local" name="date" class="date" class="col-6">
                        </td>
                        <td class="col-2 p-3"><?php echo $personne['libelle'] ?></td>
                        <td class="col-4 p-3"><?php echo $personne['nom'] ?> <?php echo $personne['prenomemploye'] ?></td>
                        <td class="col-2 d-flex p-3 position-absolute">
                            <div data-idemp="<?php echo $personne['id_emp'] ?>" data-action="<?php echo base_url("Employe/presence_entree"); ?>" class="btn-4 link presence_btn"><i class="fa-solid fa-right-to-bracket" style="color:white; font-size:14px;"></i></div>
                            <div data-idemp="<?php echo $personne['id_emp'] ?>" data-action="<?php echo base_url("Employe/presence_sortie"); ?>" class="btn-2 link presence_btn"><i class="fa-solid fa-right-from-bracket" style="color:white; font-size:14px;"></i></div>
                            <a href="<?php echo base_url("Employe/details_presence/" . $personne['id_emp']); ?>" class="btn-7 link"><img class="detail_icon" src="<?php echo base_url("assets/icon/fi-br-address-book.svg") ?>" alt="detail"></a>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?> "></script>
<script src="<?php echo base_url('assets/js/presence.js') ?> "></script>