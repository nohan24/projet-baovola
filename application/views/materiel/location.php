<style>
    #picked {

        font-weight: bold;
    }

    .date-picked {
        text-align: center;
    }

    td {

        border-radius: 50px;
        width: 40px;
        height: 40px;
        margin: 0 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    th {
        text-align: center;
    }

    tr {
        display: flex;
        align-items: center;
        border: none;
    }

    th {
        width: 50px;
    }

    td,
    tr,
    th {
        color: #191e16;
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

    .today {
        background-color: grey;
    }
</style>

<div class="p-1">
    <h2 class="mb-3">Matériel</h2>
    <div class="card">
        <div class="row">
            <div class="col-10 mb-2 d-flex align-items-center">
                <h4 class="me-4">Location de matériel</h4>
                <?php
                if ($state == "add") { ?>
                    <span class="success ms-2"><i class="fa-solid fa-check"></i> Location validé</span>
                <?php }
                if ($state == "error") { ?>
                    <span class="error ms-2"><i class="fa-solid fa-triangle-exclamation"></i> Location non validé</span>
                <?php }
                ?>
            </div>

            <form action="<?php echo site_url('materiel/insertionLocation'); ?>" method="post" class="d-flex gap-2 px-5 py-3">
                <input type="hidden" name="date" id="date-mvt">
                <div class="w-50">
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="fournisseur">Fournisseur : </label>
                        <select name="fournisseur">
                            <?php
                            foreach ($fournisseurs as $f) { ?>
                                <option value="<?php echo $f['fournisseurid']; ?>"><?php echo $f['nom']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="nom">Nom du matériel : </label>
                        <div>
                            <input type="text" name="nom" placeholder="Entrez le nom ici" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="type">Type de location : </label>
                        <select name="type">
                            <option value="1">Entrepôt</option>
                            <option value="2">Champs</option>
                            <option value="3">Fourniture</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Quantité : </label>
                        <div>
                            <input type="number" min="1" value="1" name="quantite" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <span class="mb-2 label">Prix par jour / unitaire : </span>
                        <div class="d-flex align-items-end gap-2">
                            <input type="number" name="pu" min="1" value="1" required>
                            <b style="font-size:14px; background:transparent;">Ariary</b>
                        </div>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="duree">Durée : </label>
                        <div class="d-flex align-items-end gap-2">
                            <input type="number" name="duree" min="1" value="1" required>
                            <b style="font-size:14px; background:transparent;">jour(s)</b>
                        </div>
                    </div>
                    <input type="submit" value="Valider l'achat" class="btn-1">
                </div>
                <div class="w-50 d-flex justify-content-center">
                    <div>
                        <p class="date-picked">Date actuellement choisie : <span id="picked">2/7/2022</span></p>
                        <p class="d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle" style="font-size:10px; color: #eb7c38"></i> Date d'aujourd'hui</p>
                        <div id="calender-header" class="d-flex align-items-center justify-content-center mb-2">
                            <button id="pm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-left"></i></button>
                            <span id="month" style="color:#264026; text-align:center;"></span>
                            <button id="nm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <table class="table table-borderless">
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