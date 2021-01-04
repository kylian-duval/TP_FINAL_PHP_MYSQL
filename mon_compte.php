<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Interface.css">
    <title>Mon espace</title>
    <?php include 'fonction.php';
    connectionbdd(); ?>
</head>

<body>
<?php if (isset($_SESSION['login'])) {
    menuco($BDD); ?>
    <div class="login-box">
    <h2>Compte</h2>
    <form action="" method="POST">
    <div class="user-box">
        <input type="password" name="Mdp">
        <label>Nouveau Mot de passe</label>
    </div>
    <div class="user-box">
        <input type="password" name="ConfiMdp">
        <label>Confirmer Mot de passe</label>
    </div>

        <?php
        if (isset($_POST['MifMdp'])) {
            if ($_POST['ConfiMdp'] == $_POST['Mdp']) {
                $id_user = $_SESSION['id_user'];
                $MDP = $_POST['ConfiMdp'];
                $BDD->query("UPDATE `user` SET `password`= '$MDP' WHERE  id_user = '$id_user' ");
            } else {
                echo 'les 2 mots de passe ne sont pas identique';
            }
        }


        ?>
        <input class="lmyButton" type="submit" name="MifMdp" value="Modifier" />
    </form>
    <form action="" method="POST">
        <?php

        //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');

        if (isset($_POST['SuppUser'])) {

            $id_user = $_SESSION['id_user'];
            $BDD->query("DELETE FROM `user` WHERE id_user = '$id_user' ");
            session_destroy();
            echo '<meta http-equiv="refresh" content="0">';
        }

        ?>
        <input class ="lmyButton" type="submit" name="SuppUser" value="Supprimer mon compte" />
    </form>
    </div>

    <?php } else {
        menuco($BDD);
        echo 'connecter vous pour avoir accès au contenue de la page ';
    } ?>

</body>

</html>