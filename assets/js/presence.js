// ----FALY DEBUT------------------------
function searchEmp() {
    var input, filter, table, tr, td1, td2, i, txtValue1, txtValue2;
    input = document.getElementById("searchEmp");
    filter = input.value.toUpperCase();
    table = document.getElementById("liste");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[2];
        td2 = tr[i].getElementsByTagName("td")[3];

        if (td1 || td2) {
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            let ligne = txtValue1 + txtValue2;
            console.log(ligne)
            if (ligne.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

$('.presence_btn').each(function() {
    $(this).click(function(e) {
        e.preventDefault();
        let idemp = $(this).data("idemp");
        let action = $(this).data("action");
        let dateValue = $(this).closest("tr").find(".date").val();

        console.log(idemp)
        console.log(action)
        console.log(dateValue)

        $.ajax({
            type: "post",
            url: action,
            data: {
                idemp: idemp,
                date: dateValue,
            },
            success: function(data) {
                openPopup(data)
            },
            error: function(response) {
                console.log(response)

            }
        });
    });
})

$('.filtre_temps').change(function(e) {
    e.preventDefault();
    let selectedmois = $('#mois').val();
    let annee = $('#annee').val();
    let chemin_salaire = $(this).data("cheminsalaire");
    charger_salaire(chemin_salaire, selectedmois, annee)
    let chemin_temps = $(this).data("chemintemps");
    charger_calendar(chemin_temps, selectedmois, annee);


    $('.labelH2').text('Salaire mois de ' + mois[selectedmois - 1]);
    $('.labelH22').text('Presence mois de ' + mois[selectedmois - 1]);
});

function charger_details_presecence() {
    let mois = $('#mois').val();
    let annee = $('#annee').val();
    let chemin_salaire = $('.filtre_temps').data("cheminsalaire");
    charger_salaire(chemin_salaire, mois, annee)
    let chemin_temps = $('.filtre_temps').data("chemintemps");
    charger_calendar(chemin_temps, mois, annee);
}

function charger_calendar(chemin_temps, mois, annee) {
    $.ajax({
        type: "post",
        url: chemin_temps,
        data: { mois: mois, annee: annee },
        success: function(data) {
            console.table(data)
            initializeCalendar(data, mois, annee);
        },
        error: function(response) {
            console.log(response);

        }
    });
}

function charger_salaire(chemin_salaire, mois, annee) {
    $.ajax({
        type: "post",
        url: chemin_salaire,
        data: { mois: mois, annee: annee },
        success: function(data) {
            $('.salaire').text(Math.round(data['salairemensuel']).toLocaleString('fr-FR').replace(/\s/g, ' ') + "ar");
            $('.temps').text(data['tempstravail']);
        },
        error: function(response) {
            console.log(response);

        }
    });
}

const joursSemaine = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
const mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

function formatDate(dateString) {
    if (dateString && dateString.trim() !== "") {
        var date = new Date(dateString);
        if (!isNaN(date.getTime())) {


            var jourSemaine = joursSemaine[date.getDay()];
            var jour = date.getDate();
            var moisTexte = mois[date.getMonth()];
            var annee = date.getFullYear();
            var heure = date.getHours();
            var minutes = date.getMinutes();

            var formattedDate = jourSemaine + " " + jour + " " + moisTexte + " " + annee + " à " + heure + "h" + (minutes < 10 ? "0" : "") + minutes;
            return formattedDate;
        }
    }
    return "pas encore sortie";

}

function formatHour(nombreDecimal) {
    var heures = Math.floor(nombreDecimal);
    var minutes = (nombreDecimal - heures) * 60;

    var heureFormattee = ("0" + heures).slice(-2) + "h:" + ("0" + Math.round(minutes)).slice(-2) + "mn";
    return heureFormattee;
}


function openPopup(text) {
    $('.popup').text(text);
    popup.style.display = 'flex';
    setTimeout(function() {
        popup.style.display = 'none';
    }, 3000);
}

function generateCalendarCells(numDays, month, year, data) {
    const tbody = $("#calendar2 tbody");
    tbody.empty();

    const firstDay = new Date(year, month, 1).getDay();
    const lastDay = new Date(year, month + 1, 0).getDay();

    let currentDay = 1;
    let inc = 0;

    for (let i = 0; i < 6; i++) {
        const row = $("<tr>").addClass("text-center");

        for (let j = 0; j < 7; j++) {
            if ((i === 0 && j < firstDay) || (i === 5 && j > lastDay)) {
                const cell = $("<td>").html("&nbsp;").addClass("empty-cell");
                row.append(cell);
            } else if (currentDay <= numDays) {
                if (inc < data.length && data[inc]['jour'] == currentDay) {
                    const cell = $('<td class="clicable">')
                    cell.append(`
                    <div class="jour">${currentDay}</div>
                    <div class="entree label">${formatDate(data[inc]['dateentree']).split("à")[1]}</div>
                    <div class="sortie label">${formatDate(data[inc]['datesortie']).split("à")[1]}</div>
                    <div class="duree">${formatHour(data[inc]['tempstravail'])}</div>`);
                    cell.addClass("background_calendar");;
                    row.append(cell);
                    inc++;
                } else {
                    const cell = $("<td>");
                    cell.append(`
                    <div class="jour">${currentDay}</div>
                    <div class="entree label"></div>
                    <div class="sortie label"></div>
                    <div class="duree"></div>
                    `);
                    cell.on('click', function() {
                        createDivWithCloseButton();
                    });

                    row.append(cell);

                }
                currentDay++;
            }
        }
        tbody.append(row);
    }
}

function initializeCalendar(data, currentMonth, currentYear) {
    const currentDate = new Date();
    const numDays = new Date(currentYear, currentMonth, 0).getDate();
    generateCalendarCells(numDays, currentMonth, currentYear, data);
}


function createDivWithCloseButton() {
    console.log("misokatra")
    var closeButton = $('<button>').addClass('close-button').text('Fermer');
    closeButton.on('click', function() {
        div.remove();
    });
    div.append(closeButton);
    $('.card').append(div);
}

// ----FALY FIN------------------------