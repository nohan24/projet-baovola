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
                        <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> Tableau de bord</a>
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
                                <a href="#">First sublink</a>
                            </li>
                            <li class="item">
                                <a href="#">First sublink</a>
                            </li>
                            <li class="item">
                                <a href="#">First sublink</a>
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
                                <i class="fa-solid fa-chevron-left"></i>
                                Matériel
                            </div>
                            <li class="item">
                                <a href="#">Second sublink</a>
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
                                Your submenu title
                            </div>
                            <li class="item">
                                <a href="#">Second sublink</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item">
                        <div class="submenu-item">
                            <span><i class="fa-solid fa-wrench"></i> Finance</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                        <ul class="menu-items submenu">
                            <div class="menu-title">
                                <i class="fa-solid fa-chevron-left"></i>
                                Finance
                            </div>
                            <li class="item">
                                <a href="#">Second sublink</a>
                            </li>
                        </ul>
                    </li>
                    <li class="item logout">
                        <a href="#" class="text-center"><i class="fa fa-sign-out" aria-hidden="true"></i>  Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="main p-3">
           <h1>Welcome !</h1>
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
