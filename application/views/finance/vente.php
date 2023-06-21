<style>
    #picked {

        font-weight: bold;
    }

    .date-picked {
        text-align: center;
    }

    .ta td {

        border-radius: 50px;
        width: 40px;
        height: 40px;
        margin: 0 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ta th {
        text-align: center;
    }

    .ta tr {
        display: flex;
        align-items: center;
        border: none;
    }

    .ta th {
        width: 50px;
    }

    .not:hover {
        background-color: rgb(237, 237, 237);
        cursor: pointer;
    }

    #calender-header {
        align-items: center;
        color: #fff;
    }

    button {
        border: none;
        background-color: transparent;
        color: #fff;
        margin: 0 20px;
    }
</style>
<div class="p-1">
    <h2 class="mb-3">Insertion vente</h2>
    <div class="card">
        <div class="row">
            <form action="<?php echo site_url("finance/insertVente"); ?>" method="post" class="d-flex gap-2 px-5 py-3">
                <input type="hidden" name="date_transac" id="date-mvt">
                <div class="w-50">
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="libelle">Libellé : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="libelle" placeholder="Libellé">
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Quantité : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="quantite" placeholder="Quantité">
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="unite">Unite : </label>
                        <select name="unite">
                            <?php
                            foreach ($unites as $unite) { ?>
                                <option value="<?php echo $unite['uniteid']; ?>"><?php echo $unite['nom_unite']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="unitaire">Prix unitaire : </label>
                        <div class="d-flex align-items-end gap-1">
                            <input type="text" name="unitaire" placeholder="Prix Unitaire">
                        </div>
                    </div>
                    <input type="submit" value="Valider" class="btn-1">
                </div>
                <div class="w-50 d-flex justify-content-center">
                    <div>
                        <p class="date-picked">Date actuellement choisie : <span id="picked"></span></p>
                        <p class="d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle" style="font-size:10px; color: #eb7c38"></i> Date d'aujourd'hui</p>
                        <div id="calender-header" class="d-flex align-items-center justify-content-center mb-2">
                            <button id="pm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-left"></i></button>
                            <span id="month" style="color:#264026; text-align:center;"></span>
                            <button id="nm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <table class="table table-borderless ta">
                            <thead>
                                <tr>
                                    <th>D</th>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>M</th>
                                    <th>J</th>
                                    <th>V</th>
                                    <th>S</th>
                                </tr>
                            </thead>
                            <tbody id="calendar">

                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="p-1 mt-3">
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
                foreach ($vente as $v) { ?>
                    <tr class="text-center">
                        <td><b style="background:transparent;"><?php echo $v['date']; ?></b></td>
                        <td><?php echo $v['libelle']; ?></td>
                        <td><?php echo $v['quantite']; ?></td>
                        <td><?php echo $v['unite']; ?></td>
                        <td><?php echo number_format(doubleval($v['prix_unitaire']), 2); ?> Ar</td>
                        <td><b><?php echo number_format(doubleval($v['montant']), 2); ?> Ar</b></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
        <?php if (count($vente) == 0) { ?>
            <b class="text-center">Vide</b>
        <?php } ?>
    </div>
</div>
<script src="<?php echo base_url('assets/js/filtrage.js'); ?>"></script>
<script>
    const picked = document.getElementById("picked");
    const month = document.getElementById("month");
    const calendar = document.getElementById("calendar");
    const form = document.querySelector("form");
    const DATE = new Date();
    let thisMonth = DATE.getMonth();
    let year = DATE.getFullYear();
    const nm = document.querySelector("#nm");
    const pm = document.querySelector("#pm");

    const MONTHS = [
        "Janvier",
        "Fevrier",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Aout",
        "Septembre",
        "Octobre",
        "Novembre",
        "Decembre",
    ];
    let ss = (thisMonth + 1).toString()
    if (ss.length < 2) {
        ss = "0" + ss
    }
    let da = DATE.getDate().toString()
    if (da.length < 2) {
        da = "0" + da
    }
    picked.innerHTML = `${year}/${ss}/${da}`;
    document.getElementById("date-mvt").value = `${year}/${ss}/${da}`;
    const createCalendar = () => {
        month.innerHTML = `${MONTHS[thisMonth]}, ${year}`;

        const dayOne = new Date(year, thisMonth).getDay();
        const monthDays = 32 - new Date(year, thisMonth, 32).getDate();

        date = 1;
        for (let i = 0; i < 6; i++) {
            let row = document.createElement("tr");
            for (let j = 0; j < 7; j++) {
                let column = document.createElement("td");
                if (date > monthDays) break;
                else if (i === 0 && j < dayOne) {
                    let columnText = document.createTextNode("");
                    column.classList.add("none")
                    column.appendChild(columnText);
                    row.appendChild(column);
                } else {
                    let columnText = document.createTextNode(date);
                    column.appendChild(columnText);
                    column.classList.add("not")

                    if (date === DATE.getDate() && thisMonth === DATE.getMonth() && year === DATE.getFullYear()) {
                        column.style.backgroundColor = "#eb7c38"
                        column.style.color = "white"
                    }

                    column.onclick = () => {
                        let mm = (thisMonth + 1).toString();
                        let dd = (column.textContent).toString();
                        if (mm.length < 2) {
                            mm = "0" + mm
                        }
                        if (dd.length < 2) {
                            dd = "0" + dd
                        }

                        picked.innerHTML = `${year}/${mm}/${dd}`;
                        document.getElementById("date-mvt").value = `${year}/${mm}/${dd}`;

                    };

                    row.appendChild(column);

                    date++;
                }
            }
            calendar.appendChild(row);
        }
    };

    createCalendar();

    const nextMonth = () => {
        thisMonth = thisMonth + 1;
        calendar.innerHTML = ""

        if (thisMonth > 11) {
            year = year + 1
            thisMonth = 0
        }
        createCalendar()
        return thisMonth
    };

    const prevMonth = () => {
        thisMonth = thisMonth - 1;
        calendar.innerHTML = ""

        if (thisMonth < 0) {
            year = year - 1
            thisMonth = 11
        }
        createCalendar()
        return thisMonth
    };

    nm.addEventListener("click", (e) => {
        e.preventDefault()
        nextMonth()
    });

    pm.addEventListener("click", (e) => {
        e.preventDefault()
        prevMonth()
    })
</script>