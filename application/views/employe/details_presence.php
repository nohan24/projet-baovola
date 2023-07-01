<style>
    .info {
        display: flex;
        justify-content: space-around;
    }

    .photo {
        width: 120px;
        height: 120px;
        overflow: hidden;
        border: 1px solid whitesmoke;
    }

    .photo img {
        width: 100%;
        heigh: 100%;
        object-fit: cover;
    }
</style>

<div class="p-1">
    <h3>Présence Employé</h3>
    <div class="card">
        <div class="row info">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Detail pour <span class="nom"><?php echo $employe[0]['nom'] ?> <?php echo $employe[0]['prenomemploye'] ?></h4></span>
            </div>
            <div class="photo">
                <img src="<?php echo base_url('assets/img/user.png') ?>" alt="">
            </div>
        </div>

        <div class="label">Dernière action :</div>
        <div class="entree_sortie ">
            <div class="label"> Entree: <span class="entree"></span></div>
            <div class="label"> Sortie : <span class="sortie"></span></div>
        </div>
        <div>
            <div class="filtre_date">
                <form data-cheminsalaire="<?php echo base_url("Employe/async_details_presence/" . $employe[0]['id_emp']) ?>" data-chemintemps="<?php echo base_url("Employe/async_temps_jour_heure_emp/" . $employe[0]['id_emp']) ?>" class="filtre_temps" method="POST">
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
            <div class="labelH2">Salaire</div>
            <div class="salaire_temps label">
                <span class="salaire"><?php echo $vola['salairemensuel'] ?>ar</span> pour <span class="temps"><?php echo $vola['tempstravail'] ?> </span> de travail
            </div>
        </div>
        <!-- temps de travail -->
        <div class="labelH22">Presence</div>

        <table id="calendar2">
            <thead>
                <tr class="text-center">
                    <th scope="col">L</th>
                    <th scope="col">M</th>
                    <th scope="col">M</th>
                    <th scope="col">J</th>
                    <th scope="col">V</th>
                    <th scope="col">S</th>
                    <th scope="col">D</th>
                </tr>
            </thead>
            <div class="line"></div>
            <tbody>
                <tr class="">
                </tr>
            </tbody>
        </table>


    </div>

</div>
<script src="<?php echo base_url('assets/js/jquery.min.js') ?> "></script>
<script src="<?php echo base_url('assets/js/presence.js') ?> "></script>
<script>
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1;
    var currentYear = currentDate.getFullYear();
    $('#mois').val(currentMonth).prop('selected', true);
    $('#annee').val(currentYear).prop('selected', true);

    var selectedMonth = $('#mois').val();
    $('.labelH2').text('Salaire mois de ' + mois[selectedMonth - 1]);
    $('.labelH22').text('Presence mois de ' + mois[selectedMonth - 1]);

    var dateEntree = "<?php echo $action['dateentree']; ?>";
    var formatteddateEntree = formatDate(dateEntree);
    $('.entree_sortie .entree').text(formatteddateEntree);
    var dateSortie = "<?php echo $action['datesortie']; ?>";
    var formatteddatesortie = formatDate(dateSortie);
    $('.entree_sortie .sortie').text(formatteddatesortie);

    charger_details_presecence();
</script>