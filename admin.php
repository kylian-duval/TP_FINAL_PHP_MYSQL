<!DOCTYPE html>
<?php


include 'fonction.php'; connectionbdd();?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    menuco($BDD);

    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $request = $BDD->query("SELECT * FROM `user` WHERE 1"); ?>
    <form action="" method="post">
        <table border="2">
        <tr>
        <td>id_user</td>
        <td>login</td>
        <td>password</td>
        <td>ADMIN</td>
        </tr>
            <?php
            while ($tab = $request->fetch()) { ?>
                <tr>
                    <td><span> <?php echo $tab['id_user'] ?> </span> </td>
                    <td> <?php echo $tab['identifiant'] ?> </td>
                    <td> <?php echo $tab['password'] ?> </td>
                    <td> <?php echo $tab['ADMIN'] ?> </td>
                    <td><input type="checkbox" id="<?php echo $tab["id_user"] ?>" name="id_user[]" value="<?php echo $tab["id_user"] ?>"></td>
                    <td><input type="submit" name="<?php echo $tab['id_user'] ?>" value="mofifier" /></td>
                </tr>
               <?php 
             } ?>
        </table>
        <!-- echo '<p>id_user mots_de_passe ';
        while ($tab = $request->fetch()) {
            echo '<p>' . $tab["id_user"] . ' ' . $tab["identifiant"] .'';

        ?>

            <input type="checkbox" id="<?php // echo $tab["id_user"] 
                                        ?>" name="id_user[]" value="<?php //echo $tab["id_user"] 
                                                                    ?>"> -->


        <?php

        //echo "</p>";
        //} 

        //TTRAITEMENT SUPPRESSION
        if (isset($_POST['supp'])) {

            //NE PAS METTRE []
            foreach ($_POST["id_user"] as $check) {
                if (!isset($checkoptions)) {
                    $checkoptions = $check;
                } else {
                    $checkoptions .= "," . $check;
                }
            }

            $BDD->query("DELETE FROM `user` WHERE id_user IN(" . $checkoptions . ")");
            echo '<meta http-equiv="refresh" content="0">';
        }

        if (isset($_POST['op'])) {

            //NE PAS METTRE []
            foreach ($_POST["id_user"] as $check) {
                if (!isset($checkoptions)) {
                    $checkoptions = $check;
                } else {
                    $checkoptions .= "," . $check;
                }
            }

            $BDD->query("UPDATE `user` SET `ADMIN`='true' WHERE id_user IN(" . $checkoptions . ")");
            echo '<meta http-equiv="refresh" content="0">';
        }
        if (isset($_POST['deop'])) {

            //NE PAS METTRE []
            foreach ($_POST["id_user"] as $check) {
                if (!isset($checkoptions)) {
                    $checkoptions = $check;
                } else {
                    $checkoptions .= "," . $check;
                }
            }

            $BDD->query("UPDATE `user` SET `ADMIN`='false' WHERE id_user IN(" . $checkoptions . ")");
            echo '<meta http-equiv="refresh" content="0">';
        }
        ?>
        <input type="submit" name="op" value="admin" />
        <input type="submit" name="deop" value="retirer les droit" />
        <input type="submit" name="supp" value="suppre ca" />

    </form>
</body>

</html>