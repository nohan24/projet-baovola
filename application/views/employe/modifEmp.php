<form id="myForm" action="<?php echo site_url("Employe/updateEmployee"); ?>" method="post" class="d-flex align-items-start gap-4 mb-2" enctype="multipart/form-data">
    <input type="hidden" name="idemp" id="" value="<?php echo $employe[0]['id_emp']; ?>">
    <div class="card mb-2 col-9 m-3">
        <h3>Modification Employée:</h3>
        <div class="d-flex align-items-end gap-4">
            <div class="mb-3 d-flex flex-column col-5">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" class="" value="<?php echo $employe[0]['nom']; ?>">
            </div>
            <div class="mb-3 d-flex flex-column col-5">
                <label for="prenom">Prenom:</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $employe[0]['prenomemploye']; ?>">
            </div>
        </div>
        <div class="d-flex align-items-end gap-4">
            <div class="mb-3 d-flex col-5 genre">
                <input type="radio" name="genre" id="H" value="0" style="display: none" <?php
                                                                                        if ($employe[0]['sexe'] == 0) { ?> checked <?php } ?> required>
                <input type="radio" name="genre" id="F" value="1" style="display: none" <?php
                                                                                        if ($employe[0]['sexe'] == 1) { ?> checked <?php } ?> required>
                <label for="H" id="laH"><i class="fa-sharp fa-solid fa-mars genger H" id="LH"></i></label>
                <label for="F" id="laF"><i class="fa-sharp fa-solid fa-venus genger F" id="LF"></i></label>
            </div>
            <div class="mb-3 d-flex flex-column col-5">
                <label for="fonction">Fonction:</label>
                <select name="fonction" id="fonction" placeholder="Fonction">
                    <?php foreach ($fonctions as $fonction) { ?>
                        <option value="<?php echo $fonction['id_fonction'] ?>" <?php if ($fonction['id_fonction'] == $employe[0]['id_fonction']) { ?> selected <?php } ?>> <?php echo $fonction['libelle'] ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <label>Date de naissance : </label>
        <input type="date" name="dateNaissance" value="<?php echo $employe[0]['datenaissance']; ?>"><br>
        <label>Date de début: </label>
        <input type="date" name="date" value="<?php echo $employe[0]['dateembauche']; ?>">
        <div class="mb-2 rb-5 d-flex submit m-5">
            <button type="submit" class="card mb-2 rb-5 btn-5"><i class="fa-solid fa-check"></i></button>
            <a href="<?php echo site_url("Employe/AjoutEmploye") ?>" class="card mb-2 rb-5 btn-6"><i class="fa-solid fa-x"></i></a>
        </div>
    </div>
</form>

<script>
    const h = document.getElementById("H");
    const f = document.getElementById("F");
    if (h.checked) {
        document.getElementById('LH').style = 'background-color: rgb(38, 38, 112); color: white';
    }
    if (f.checked) {
        document.getElementById('LF').style = 'background-color: rgb(171, 12, 100); color: white';
    }

    document.getElementById("laH").addEventListener('click', function() {
        document.getElementById('LH').style = 'background-color: rgb(38, 38, 112); color: white';
        document.getElementById('LF').style = 'background-color: white, color: rgb(171, 12, 100)';
    });

    document.getElementById("laF").addEventListener('click', function() {
        document.getElementById('LF').style = 'background-color: rgb(171, 12, 100); color: white';
        document.getElementById('LH').style = 'background-color: white, color: rgb(38, 38, 112)';
    });

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
</script>