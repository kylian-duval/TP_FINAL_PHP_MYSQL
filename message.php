<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <?php include 'fonction.php';
    $BDD = connectionbdd(); ?>
</head>

<body>
    <?php
    if (isset($_SESSION['login'])) {
        if ($_SESSION['ADMIN'] == 'true') {
            menuco($BDD); ?>
            <div align=center>
                <?php

                //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
                $request = $BDD->query("SELECT * FROM `Contact` WHERE 1"); ?>
                <form action="" method="post">
                    <?php
                    while ($tab = $request->fetch()) { ?>
                        <table border="2">
                            <tr>
                                <td><span> <?php echo $tab['nom'] ?> </span> </td>
                                <td> <?php echo $tab['prénom'] ?> </td>
                            </tr>
                            <tr>
                                <td> <?php echo $tab['mail'] ?> </td>
                                <td>
                                    <p>&nbsp;</p>
                                </td>
                                <td><input type="checkbox" id="<?php echo $tab["id_Contact"] ?>" name="id_Contact[]" value="<?php echo $tab["id_Contact"] ?>"></td>
                            </tr>
                            <tr>
                                <td> <?php echo $tab['message'] ?> </td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    <?php } ?>



                    <?php

                    if (isset($_POST['SuppMes'])) {

                        //NE PAS METTRE []
                        foreach ($_POST["id_Contact"] as $check) {
                            if (!isset($checkoptions)) {
                                $checkoptions = $check;
                            } else {
                                $checkoptions .= "," . $check;
                            }
                        }

                        $BDD->query("DELETE FROM `Contact` WHERE id_Contact IN(" . $checkoptions . ")");
                        echo '<meta http-equiv="refresh" content="0">';
                    }

                    ?>
                    <input type="submit" name="SuppMes" value="supprimer" />
                </form>

            </div>

    <?php } else {
            menuco($BDD);
            echo "seul les administrateur de l'aplication web on accès au message";
        }
    } else {
        menuco($BDD);
        echo "connecter vous pour avoir accès au contenu de la page";
    } ?>

</body>

</html>