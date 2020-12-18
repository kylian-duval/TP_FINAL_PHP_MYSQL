<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'fonction.php'; connectionbdd(); ?>
</head>

<body>
    <?php
    //$BDD = new PDO('mysql:host=192.168.65.227; dbname=film;charset=utf8', 'kiki', 'kiki');
    $request = $BDD->query("SELECT `id_film`, `nom`, `imgSource` FROM `film`"); ?>
    <form action="" method="post">
        <select name="idfilme" id="SelectMedecin">
        <?php
        while ($data = $request->fetch()) { 
            echo '<option value="' . $data["id_film"] . '">' . $data['nom'] . '</option>';
        } ?>
        </select>
        <p><input type="submit" name="vote" value="voté" /></p>

        <?php $request = $BDD->query("SELECT `id_film`, `nom`, `imgSource` FROM `film`"); ?>
        <?php
        while ($data = $request->fetch()) { ?>
            <table border="2">
                <tr>
                    <td align=center> <?php echo $data['nom'] ?> </td>
                </tr>
                <tr>
                    <td>
                        <div> <img src="<?php echo $data['imgSource']; ?>"> </div>
                    </td>
                </tr>
            </table>
        <?php
        } ?>

        <?php

        if (isset($_POST['vote'])) {
            $id_user = $_SESSION['id_user'];
            $idfilm = $_POST["idfilme"];

            $BDD->query("INSERT INTO `vote`(`id_user`, `id_film`) VALUES ('$id_user','$idfilm')");
            echo '<meta http-equiv="refresh" content="0">';
        }

        ?>

    </form>
</body>

</html>