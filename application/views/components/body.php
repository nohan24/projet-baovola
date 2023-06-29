<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/icon.png'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title><?php echo $title; ?></title>
</head>

<body>
    <nav class="sidebar">
        <div class="menu-content d-flex flex-column align-items-center">
            <img src="<?php echo base_url('assets/img/nav-icon.png'); ?>" alt="vegmarket-logo" class="w-75">
            <ul class="menu-items w-75" style="padding:0px;">
                <li class="item">
                    <a href="#"><i class="fa-solid fa-chart-simple"></i> Tableau de bord</a>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span><i class="fa-solid fa-box-archive"></i> Stock</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>Stock
                        </div>
                        <li class="item">
                            <a href="<?php echo site_url('stock/historique/sortie'); ?>"><i class="fa-regular fa-circle"></i> Historique</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('stock/etat'); ?>"><i class="fa-regular fa-circle"></i> Etat de stock</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('stock/mouvement'); ?>"><i class="fa-regular fa-circle"></i> Mouvement stock</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('stock/entrepot'); ?>"><i class="fa-regular fa-circle"></i> Entrepôt</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('stock/produit'); ?>"><i class="fa-regular fa-circle"></i> Produit</a>
                        </li>
                    </ul>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span><i class="fa-solid fa-wrench"></i> Matériel</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>Matériel
                        </div>
                        <li class="item">
                            <a href="<?php echo site_url('materiel/achat'); ?>"><i class="fa-regular fa-circle"></i> Achat matériel</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('materiel/location'); ?>"><i class="fa-regular fa-circle"></i> Location matériel</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('materiel/fournisseur'); ?>"><i class="fa-regular fa-circle"></i> Fournisseur</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url("materiel/inventaire/achat"); ?>"><i class="fa-regular fa-circle"></i> Inventaire</a>
                        </li>
                    </ul>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span><i class="fa-solid fa-user-group"></i> Employé</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Employé
                        </div>
                        <li class="item">
                            <a href="<?php echo site_url("Employe/AjoutEmploye") ?>"><i class="fa-regular fa-circle"></i> Ajouter</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url("Employe/PresenceEmploye") ?>"><i class="fa-regular fa-circle"></i> Présence</a>
                        </li>
                        <li class="item">
                            <a href="#"><i class="fa-regular fa-circle"></i> Salaire</a>
                        </li>
                    </ul>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span><i class="fa-solid fa-chart-pie"></i> Finance</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Finance
                        </div>
                        <li class="item">

                            <a href="<?php echo site_url('finance/caisse'); ?>"><i class="fa-regular fa-circle"></i>Caisse</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('finance/vente'); ?>"><i class="fa-regular fa-circle"></i>Ventes</a>
                        </li>
                        <li class="item">
                            <a href="<?php echo site_url('finance/charge'); ?>"><i class="fa-regular fa-circle"></i>Charges</a>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="main py-3 px-4">
        <?php $this->load->view($content); ?>
    </main>

    <script>
        const sidebar = document.querySelector(".sidebar");

        const menu = document.querySelector(".menu-content");
        const menuItems = document.querySelectorAll(".submenu-item");
        const subMenuTitles = document.querySelectorAll(".submenu .menu-title");
        menuItems.forEach((item, index) => {
            item.addEventListener("click", () => {
                menu.classList.add("submenu-active");
                item.classList.add("show-submenu");
                menuItems.forEach((item2, index2) => {
                    if (index !== index2) {
                        item2.classList.remove("show-submenu");
                    }
                });
            });
        });
        subMenuTitles.forEach((title) => {
            title.addEventListener("click", () => {
                menu.classList.remove("submenu-active");
            });
        });
    </script>
</body>

</html>