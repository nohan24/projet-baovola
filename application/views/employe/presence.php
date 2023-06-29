<style>
    td, th{
        text-align: center;
        justify-content: space-evenly;
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
    <table class="table table-borderless">
        <thead>
            <tr style="justify-content: space-around;">
                <th class="col-2">Date d'action</th>
                <th class="col-2">Fonction</th>
                <th class="col-4">Nom & Prénom</th>
                <th class="col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $personne) { ?>
                <tr style="justify-content: space-around;">
                    <td class="col-2"></label>
                        <input type="datetime-local" name="date" id="date" class="col-6">
                    </td>
                    <td class="col-2 p-3"><?php echo $personne['libelle'] ?></td>
                    <td class="col-4 p-3"><?php echo $personne['nom'] ?> <?php echo $personne['prenomemploye'] ?></td>
                    <td class="col-2 d-flex p-3 position-absolute">
                        <a href="#" class="btn-4 link"><i class="fa-solid fa-right-to-bracket" style="color:white; font-size:14px;"></i></a>
                        <a href="#" class="btn-2 link"><i class="fa-solid fa-right-from-bracket" style="color:white; font-size:14px;"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>