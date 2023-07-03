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

<style>
    label {
        margin: 12px;
        margin-bottom: 0;
    }

    body {
        width: 100%;
        position: absolute;
        display: flex;
        justify-content: center;
        overflow-x: hidden;
        min-height: 100vh;
        align-items: center;
    }
</style>

<body>
    <div class="card col-6">
        <form action="<?php echo site_url('login/check'); ?>" method="post" class="col-12 p-2">
            <img src="<?php echo base_url('assets/img/nav-icon.png'); ?>" alt="vegmarket-logo" class="w-50">
            <label for="user" class="col-12">Nom d'utilisateur:</label>
            <input type="text" placeholder="Username" id="user" name="username" class="col-12 m-2">
            <label for="pswd" class="col-12">Mot de passe:</label>
            <input type="password" placeholder="Password" id="pswd" name="passwrd" class="col-12 m-2">
            <input type="submit" value="Connexion" class="btn-1 col-12 m-2">
        </form>
    </div>
</body>