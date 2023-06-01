<style>
    #picked {
       
        font-weight: bold;
    }

    .date-picked{
        text-align:center;
    }
    
    td {
        cursor: pointer;
        border-radius: 50px;
        width: 50px;
        height: 50px;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    th{
        text-align:center;
    }

    tr{
        display:flex;
        align-items:center;
    }

    th{
        width:50px;
    }
    
    td:hover {
        background-color: rgb(237, 237, 237);
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

    .today{
        background-color:grey;
    }
</style>

<div class="p-1">
    <h2 class="mb-3">Stock</h2>
    <div class="card">
        <div class="row">
            <h4>Mouvement de sortie</h4>
            <form action="#" method="post" class="d-flex gap-2 px-5 py-3">
                <input type="hidden" name="date" id="date-mvt">
                <div class="w-50">
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="produit">Produit : </label>
                        <select name="produit">
                            <option value="1">Tomate</option>
                            <option value="1">Aubergine</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="quantite">Quantité : </label>
                        <input type="text" name="quantite" placeholder="Quantité mouvementée">
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="mb-2" for="entrepot">Entrepot : </label>
                        <select name="entrepot">
                            <option value="1">A</option>
                            <option value="1">B</option>
                        </select>
                    </div>
                </div>
                <div class="w-50 d-flex justify-content-center">
                    <div>
                        <p class="date-picked">Date actuellement choisie : <span id="picked">2/7/2022</span></p>
                        <div id="calender-header" class="d-flex align-items-center justify-content-center mb-2">
                            <button id="pm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-left"></i></button>
                            <span id="month" style="color:#264026; text-align:center;"></span>
                            <button id="nm"><i style="color:#264026; font-size:12px;" class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>T</th>
                                    <th>W</th>
                                    <th>T</th>
                                    <th>F</th>
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
    if(ss.length < 2){
        ss = "0"+ss
    }
    let da = DATE.getDate().toString()
    if(da.length < 2){
        da = "0"+da
    }
    picked.innerHTML = `${year}/${ss}/${da}`;

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
                    column.appendChild(columnText);
                    row.appendChild(column);
                } else {
                    let columnText = document.createTextNode(date);
                    column.appendChild(columnText);

                    if (date === DATE.getDate() && thisMonth === DATE.getMonth() && year === DATE.getFullYear()) {
                        column.classList.add("today")
                        column.style.backgroundColor = "#eb7c38"
                        column.style.color = "white"
                    }

                    column.onclick = () => {
                        let mm = (thisMonth+1).toString();
                        let dd = (column.textContent).toString();
                        if(mm.length < 2){
                            mm = "0"+mm
                        }
                        if(dd.length < 2){
                            dd = "0"+dd
                        }

                        picked.innerHTML = `${year}/${mm}/${dd}`;
                        console.log(`${year}/${mm}/${dd}`)
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