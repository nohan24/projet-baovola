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
    <h3>Ajout d'employé</h3>
    <form id="myForm" action="<?php echo site_url("Employe/insertEmployee"); ?>" method="post" class="d-flex align-items-start gap-4 mb-2" enctype="multipart/form-data">
        <input type="hidden" name="upload">
        <div class="col-3">
            <div class="card mb-2 rb-5">
                <label for="image" class="lb-img">
                    <div class="img-box" id="img-box">
                        <i class="img fa-solid fa-plus"></i>
                    </div>
                    <img alt="" id="input-img" class="emp-img" width="100%" height="200px" style="display: none">
                    <div class="align-items-center" style="width: 100%; text-align: center;">
                        <p id="message-valid" class="message" style="display: none"><i class="fa-solid fa-circle-check" style="color: green"></i> Photo valider!</p>
                        <p id="message-invalid" class="message" style="display: none;"><i class="fa-solid fa-circle-exclamation" style="color: red"></i> Photo non valide!</p>
                    </div>
                </label>
                <input type="file" name="image" id="image" style="display: none">
            </div>
            <div class="card mb-2 rb-5">
                <h5>Commentaire:</h5>
                <textarea name="commentaire" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="mb-2 rb-5 d-flex submit">
                <button type="submit" class="card mb-2 rb-5 btn-5"><i class="fa-solid fa-check"></i></button>
                <button type="reset" class="card mb-2 rb-5 btn-6"><i class="fa-solid fa-x"></i></button>
            </div>
        </div>
        <div class="card mb-2 col-7">
            <div class="d-flex align-items-end gap-4">
                <div class="mb-3 d-flex flex-column col-5">
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" placeholder="Nom" class="">
                </div>
                <div class="mb-3 d-flex flex-column col-5">
                    <label for="prenom">Prenom:</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                </div>
            </div>
            <div class="d-flex align-items-end gap-4">
                <div class="mb-3 d-flex col-5 genre">
                    <input type="radio" name="genre" id="H" value="0" style="display: none" required>
                    <input type="radio" name="genre" id="F" value="1" style="display: none" required>
                    <label for="H" id="laH"><i class="fa-sharp fa-solid fa-mars genger H" id="LH"></i></label>
                    <label for="F" id="laF"><i class="fa-sharp fa-solid fa-venus genger F" id="LF"></i></label>
                </div>
                <div class="mb-3 d-flex flex-column col-5">
                    <label for="fonction">Fonction:</label>
                    <select name="fonction" id="fonction" placeholder="Fonction">
                        <?php foreach ($fonctions as $fonction) { ?>
                            <option value="<?php echo $fonction['id_fonction'] ?>"> <?php echo $fonction['libelle'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <label>Date de naissance : </label>
            <input type="date" name="dtn"><br>
            <label>Date d'embauche: </label>
            <input type="date" name="date_embauche">
        </div>

    </form>
</div>

<div class="card">
    <div class="row">
        <div class="col-10 mb-2 d-flex align-items-center">
            <h4 class="me-4">Liste des Employées</h4>
        </div>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr style="justify-content: space-around;">
                <th class="col-2">Date d'embauche</th>
                <th class="col-2">Fonction</th>
                <th class="col-4">Nom & Prénom</th>
                <th class="col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $personne) { ?>
                <tr style="justify-content: space-around;">
                    <td class="col-2"><?php echo $personne['dateembauche'] ?></td>
                    <td class="col-2"><?php echo $personne['libelle'] ?></td>
                    <td class="col-4"><?php echo $personne['nom'] ?> <?php echo $personne['prenomemploye'] ?></td>
                    <td class="col-2 d-flex gap-2"><a href="#" class="btn-4 link"><i class="fa-solid fa-pen" style="color:white; font-size:14px;"></i></a> <a href="#" class="btn-2 link"><i class="fa-solid fa-trash" style="color:white; font-size:14px;"></i></a></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
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
<script>
    var fileInput = document.getElementById('image');
    fileInput.addEventListener("change", function() {
        if (fileInput.files.length == 0) {

        } else {
            const [picture] = fileInput.files;
            const ext = fileInput.value.split('.')[1];
            if (picture && (ext == 'PNG' || ext == 'JPG' || ext == 'JPEG' || ext == "png" || ext == "jpg" || ext == "jpeg")) {
                document.getElementById('input-img').style = "display: initial"
                document.getElementById('input-img').src = URL.createObjectURL(picture);
                document.getElementById('img-box').style = "display: none";
                document.getElementById('message-valid').style = "display: initial";
                document.getElementById('message-invalid').style = "display: none";
            } else {
                document.getElementById('message-invalid').style = "display: initial";
                document.getElementById('message-valid').style = "display: none";
            }
        }
    });

    document.getElementById("laH").addEventListener('click', function() {
        document.getElementById('LH').style = 'background-color: rgb(38, 38, 112); color: white';
        document.getElementById('LF').style = 'background-color: white, color: rgb(171, 12, 100)';
    });

    document.getElementById("laF").addEventListener('click', function() {
        document.getElementById('LF').style = 'background-color: rgb(171, 12, 100); color: white';
        document.getElementById('LH').style = 'background-color: white, color: rgb(38, 38, 112)';
    });
</script>